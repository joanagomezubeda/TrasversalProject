<?php

    class MyLibraryModel extends Model {


        public function index($userId, $selectedGenre)
        {
            $elementsPage = 6;
            $actualPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

            $start = ($actualPage - 1) * $elementsPage;



            if ($start < 0) {
                $start = 0;
            }

            if (!empty($selectedGenre)){
                $condition = 'AND genre = :selected_genre';
            } else {
                $condition = '';
            }

            $this->query("
                SELECT book.*, 
                       -- Se ha pedido prestado
                       CASE 
                           WHEN lend.borrow_user_id = :user_id THEN 1 
                           ELSE 0 
                       END AS isBorrowed,
                       -- Le han confirmado el libro
                       CASE
                            WHEN userConfirmation = 1 THEN 1
                            ELSE 0
                       END AS isConfirmed,
                       -- Es el dueño del libro y lo ha confirmado
                       CASE
                            WHEN userConfirmation = 1 AND lend.user_id = :user_id THEN 1
                            ELSE 0
                       END AS isLent
                FROM book 
                LEFT JOIN lend ON book.ID = lend.book_id
                WHERE (book.id_user = :user_id OR lend.borrow_user_id = :user_id) $condition LIMIT :start, :elementsPage
            ");

            $this->bind(':user_id', $userId);
            $this->bind(':start', $start);
            $this->bind(':elementsPage', $elementsPage);
            $this->bind(':selected_genre', $selectedGenre);
            $rows = $this->resultSet();

            $this->query("SELECT COUNT(*) as total FROM book 
                LEFT JOIN lend ON book.ID = lend.book_id AND lend.borrow_user_id = $userId
                WHERE (book.id_user = $userId OR lend.borrow_user_id = $userId) $condition");

            if (!empty($selectedGenre)) {
                $this->bind(':selected_genre', $selectedGenre);
            }
            $total = $this->single()['total'];

            $genres = $this->getGenres();
            return [
                'books' => $rows,
                'total' => $total,
                'page' => $actualPage,
                'elementsPage' => $elementsPage,
                'start' => $start,
                'genres' => $genres,
                'selectedGenre' => $selectedGenre,
            ];
        }

        public function getGenres()
        {
            $this->query("SELECT DISTINCT genre FROM book ");
            $rows = $this->resultSet();
            return $rows;
        }

        public function edit($id = null)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->update($id);
            }

            $this->query("SELECT * FROM book WHERE id = $id");
            return $this->single();
        }

        public function delete($id = null)
        {
            $this->query("DELETE FROM book where id=$id");
            $this->execute();
            return;
        }

        public function add($id)
        {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );

            if(isset($post['submit'])){
                if ($post['title'] == '' || $post['description'] == ''|| $post['author'] == '' || $post['editorial'] == ''
                    || $post['genre'] == ''){
                    Messages::setMessage('Please Fill In All Fields', 'error');
                    return;
                }

                /* Tratamiento de la imagen
                   Fuente: https://es.stackoverflow.com/questions/512919/como-remplazar-una-imagen-al-actualizar-un-registro-con-php
                   Segunda fuente: https://es.stackoverflow.com/questions/478716/como-borrar-imagen-de-servidor-php
                   :)
               */

                if (isset($_FILES['image'])){
                    $newImage = $_FILES['image']['name']; // Get the name of the image
                    $imageTmp = $_FILES['image']['tmp_name']; // Get the temporal path where the img is

                    $imageExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION)); // Get the extension of the img
                    $validExtensions = array('jpeg', 'jpg', 'png'); // The valid extensions I want (mimes:jpg,jpeg,png in Laravel)

                    if (array($imageExtension, $validExtensions)){ // If the imageExtension is in the array of valid extensions
                        $uploadDir = 'assets/bookImages/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved
                        move_uploaded_file($imageTmp, $uploadPath); // Move the img to the path I want

                        $imageToSave = $uploadPath;

                    } else {
                        Messages::setMessage('The extension is not valid', 'error');
                    }
                } else {
                    $imageToSave = 'assets/images/icon.png';
                }

                try {
                    $this->query("SELECT COUNT(*) as totalBooks FROM book WHERE id_user = $id");
                    $row = $this->single();

                    if ($row['totalBooks'] < 50){
                        $lendTheBook = $post['lendTheBook'];
                        $userId = $_SESSION['user_data']['id'];
                        // Insert into MySQL
                        $this->query("INSERT INTO book(title, description, author, editorial, genre, image,toLend,id_user,create_time) VALUES(:title, :description, 
                     :author, :editorial, :genre ,:image,:toLend, :id_user, CURRENT_TIMESTAMP)");
                        $this->bind(':title', $post['title']);
                        $this->bind(':description', $post['description']);
                        $this->bind(':author', $post['author']);
                        $this->bind(':editorial', $post['editorial']);
                        $this->bind(':genre', $post['genre']);
                        $this->bind(':image', $imageToSave);
                        $this->bind(':id_user', $userId);


                        // If the user said "yes"
                        if ($lendTheBook === 'yes'){
                            /*
                            $this->query('INSERT INTO lend(user_id, book_id, lend_date) VALUES(:user_id, :book_id, :lend_date)');
                            $this->bind(':user_id', $userId);
                            $this->bind(':book_id', $bookId );
                            $this->bind(':lend_date', date("Y-m-d"));
                            $this->execute();
                            */
                            $this->bind(':toLend', 1);
                            $this->execute();
                        } else {
                            $this->bind(':toLend', 0);
                            $this->execute();
                        }

                        header('Location:'.ROOT_URL.'myLibrary?page=1');
                    } else {
                        Messages::setMessage('You can only add 50 books to your library!', 'error');
                    }
                    // Var from de select of the form

                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }

            }
            return;
        }


        public function update($id = null)
        {

            $this->query("SELECT image FROM book WHERE id = $id");
            $response = $this->single();
            $oldPhoto = $response['image'];
            // Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($post['submit'])) {
                if ($post['title'] == '' || $post['description'] == ''|| $post['author'] == '' || $post['editorial'] == ''
                    || $post['genre'] == ''){
                    Messages::setMessage('Please Fill In All Fields', 'error');
                    return;
                }

                /* Tratamiento de la imagen
                    Fuente: https://es.stackoverflow.com/questions/512919/como-remplazar-una-imagen-al-actualizar-un-registro-con-php
                    Segunda fuente: https://es.stackoverflow.com/questions/478716/como-borrar-imagen-de-servidor-php
                    :)
                */

                if (isset($_FILES['image'])){
                    $newImage = $_FILES['image']['name']; // Get the name of the image

                    $imageTmp = $_FILES['image']['tmp_name']; // Get the temporal path where the img is

                    $imageExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION)); // Get the extension of the img
                    $validExtensions = array('jpeg', 'jpg', 'png'); // The valid extensions I want (mimes:jpg,jpeg,png in Laravel)
                    //$newUserPhoto = rand(1000, 1000000).".".$imageExtension;

                    if (array($imageExtension, $validExtensions)){ // If the imageExtension is in the array of valid extensions
                        $uploadDir = 'assets/bookImages/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved
                        if (move_uploaded_file($imageTmp, $uploadPath)) {
                            if (is_writable($oldPhoto)){ // To remove the img of the folder
                                unlink($oldPhoto);
                            }
                            $imageToSave = $uploadPath;
                        } else {
                            $imageToSave = $oldPhoto;
                        }

                    } else {
                        Messages::setMessage('The extension is not valid', 'error');
                    }
                } else {
                    $imageToSave = $oldPhoto;
                }

                // Insert into MySQL
                try {
                    // Variable of the select of the form in HTML
                    $lendTheBook = $post['lendTheBook'];
                    $this->query("UPDATE book SET title = :title, description = :description, author = :author, 
                    editorial = :editorial, genre = :genre, image = :image, toLend = :toLend, update_time = CURRENT_TIMESTAMP WHERE id = :id");
                    $this->bind(':title', $post['title']);
                    $this->bind(':description', $post['description']);
                    $this->bind(':image', $imageToSave);
                    $this->bind(':author', $post['author']);
                    $this->bind(':editorial',$post['editorial']);
                    $this->bind(':genre', $post['genre']);
                    $this->bind(':id', $id);

                    // If the user said yes it will update the table
                    if ($lendTheBook === 'yes'){
                        $this->bind(':toLend', 1);
                        $this->execute();
                    } else {
                        $this->bind(':toLend', 0);
                        $this->execute();
                    }

                    header('Location: ' . ROOT_URL.'myLibrary?page=1');
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
            }
        }
    }
?>