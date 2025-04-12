<?php

    class MyLibraryModel extends Model {

        public function index($id)
        {
            $this->query("SELECT * FROM book WHERE id_user = $id");
            $rows = $this->resultSet();
            return($rows);
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

        public function add($id = null)
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
                    $lendTheBook = $post['lendTheBook'];
                    $userId = $_SESSION['user_data']['id'];
                    // Insert into MySQL
                    $this->query("INSERT INTO book(title, description, author, editorial, genre, image,id_user) VALUES(:title, :description, 
                     :author, :editorial, :genre ,:image, :id_user)");
                    $this->bind(':title', $post['title']);
                    $this->bind(':description', $post['description']);
                    $this->bind(':author', $post['author']);
                    $this->bind(':editorial', $post['editorial']);
                    $this->bind(':genre', $post['genre']);
                    $this->bind(':image', $imageToSave);
                    $this->bind(':id_user', $userId);
                    $this->execute();
                    $bookId = $this->lastInsertId();
                    if ($lendTheBook === 'yes'){
                        $this->query('INSERT INTO lend(user_id, book_id, lend_date) VALUES(:user_id, :book_id, :lend_date)');
                        $this->bind(':user_id', $userId);
                        $this->bind(':book_id', $bookId );
                        $this->bind(':lend_date', date("Y-m-d"));
                        $this->execute();
                    }
                    header('Location:'.ROOT_URL.'myLibrary');
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
                            if (is_writable($oldPhoto)){
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
                    $lendTheBook = $post['lendTheBook'];
                    $this->query("UPDATE book SET title = :title, description = :description, author = :author, 
                editorial = :editorial, genre = :genre, image = :image WHERE id = :id");
                    $this->bind(':title', $post['title']);
                    $this->bind(':description', $post['description']);
                    $this->bind(':image', $imageToSave);
                    $this->bind(':author', $post['author']);
                    $this->bind(':editorial',$post['editorial']);
                    $this->bind(':genre', $post['genre']);
                    $this->bind(':id', $id);
                    $this->execute();
                    $bookId = $id;
                    $userId = $_SESSION['user_data']['id'];
                    if ($lendTheBook === 'yes'){
                        $this->query('UPDATE lend SET user_id = :user_id, book_id = :book_id, lend_date = :lend_date');
                        $this->bind(':user_id', $userId);
                        $this->bind(':book_id', $bookId );
                        $this->bind(':lend_date', date("Y-m-d"));
                        $this->execute();
                    } elseif ($lendTheBook === 'no'){
                        $this->query('DELETE FROM lend WHERE book_id = :book_id AND user_id = :user_id');
                        $this->bind(':user_id', $userId);
                        $this->bind(':book_id', $bookId );
                        $this->execute();
                    }
                    header('Location: ' . ROOT_URL.'myLibrary');
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
            }
        }
    }
?>