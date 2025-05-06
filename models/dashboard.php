<?php
class DashboardModel extends Model {
    public function index()
    {
        $totalUsers = $this->totalUsers();
        $totalLentBook = $this->totalLentBook();
        $totalBooks = $this->totalBooks();
        $users = $this->users();
        $totalPublications = $this->totalPublications();
        $totalComments = $this->totalComments();
        return ['fiveUsers' => $totalUsers, 'lendBooks' => $totalLentBook, 'books' => $totalBooks, 'publications' => $totalPublications, 'comments' => $totalComments, 'users' => $users];
    }

    public function totalUsers()
    {
        $this->query("SELECT * FROM user ORDER BY create_time DESC  LIMIT 5 ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function users()
    {
        $this->query("SELECT * FROM user ORDER BY create_time DESC  ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function totalLentBook()
    {
        $this->query("SELECT *, book.image as book_image FROM lend JOIN book on lend.book_id = book.ID JOIN user ON lend.borrow_user_id = user.id ORDER BY lend_date DESC  LIMIT 5 ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function totalBooks()
    {
        $this->query("SELECT * FROM book  ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function totalPublications()
    {
        $this->query("SELECT * FROM publication  ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function totalComments()
    {
        $this->query("SELECT * FROM comment  ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function totalLendBooks()
    {
        $this->query("SELECT * FROM lend  ");
        $rows = $this->resultSet();
        return $rows;
    }

    public function getComment($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->editComment($id);
        }

        $this->query("SELECT * FROM comment WHERE ID = $id");
        return $this->single();
    }

    public function editComment($id)
    {
        $this->query("SELECT image FROM comment WHERE id = $id");
        $response = $this->single();
        $oldPhoto = $response['image'];
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post['submit'])) {
            if ( $post['description'] == ''){
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
                    $uploadDir = 'assets/commentImage/'; // The directory where the img are
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
                $this->query("UPDATE comment SET  description = :description, image = :image, update_time = CURRENT_TIMESTAMP WHERE ID = :id");

                $this->bind(':description', $post['description']);
                $this->bind(':image', $imageToSave);
                $this->bind(':id', $id);
                $this->execute();
                header('Location: ' . ROOT_URL.'dashboard/comments');
            } catch (\Exception $e){
                Messages::setMessage($e->getMessage(), 'error');
            }
        }
    }

    public function getLendBook($userId, $bookId, $lendDate)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->editLendBook($userId, $bookId, $lendDate);
        }

        $this->query("SELECT * FROM lend WHERE user_Id = :user_id AND book_id = :book_id AND lend_date = :lend_date");
        $this->bind(':user_id', $userId);
        $this->bind(':book_id', $bookId);
        $this->bind(':lend_date', $lendDate);
        return $this->single();
    }

    public function editLendBook($userId, $bookId, $lendDate)
    {
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post['submit'])) {
            if ( $post['user_id'] == '' || $post['book_id'] == '' || $post['lend_date'] == '' || $post['borrow_user_id'] == ''){
                Messages::setMessage('Please Fill In All Fields', 'error');
                return;
            }

            // Insert into MySQL
            try {
                $this->query("UPDATE lend SET user_id = :user_id, book_id = :book_id, lend_date = :lend_date, 
                return_date = :return_date, borrow_user_id = :borrow_user_id, userConfirmation = :userConfirmation, update_time = CURRENT_TIMESTAMP WHERE user_id = :user_id AND book_id = :book_id AND lend_date = :lend_date");

                $this->bind(':user_id', $userId);
                $this->bind(':book_id', $bookId);
                $this->bind(':lend_date', $lendDate);
                $this->bind(':return_date', $post['return_date']);
                $this->bind(':borrow_user_id', $post['borrow_user_id']);
                $this->bind(':userConfirmation', $post['userConfirmation']);
                $this->execute();
                header('Location: ' . ROOT_URL.'dashboard/lendBooks');
            } catch (\Exception $e){
                Messages::setMessage($e->getMessage(), 'error');
            }
        }
    }

    public function getPublication($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->editPublication($id);
        }

        $this->query("SELECT * FROM publication WHERE ID = $id");
        return $this->single();
    }

    public function editPublication($id)
    {
        $this->query("SELECT publication_image FROM publication WHERE id = $id");
        $response = $this->single();
        $oldPhoto = $response['publication_image'];
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($post['submit'])) {
            if ( $post['description'] == ''){
                Messages::setMessage('Please Fill In All Fields', 'error');
                return;
            }

            /* Tratamiento de la imagen
                Fuente: https://es.stackoverflow.com/questions/512919/como-remplazar-una-imagen-al-actualizar-un-registro-con-php
                Segunda fuente: https://es.stackoverflow.com/questions/478716/como-borrar-imagen-de-servidor-php
                :)
            */

            if (isset($_FILES['publication_image'])){
                $newImage = $_FILES['publication_image']['name']; // Get the name of the image

                $imageTmp = $_FILES['publication_image']['tmp_name']; // Get the temporal path where the img is

                $imageExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION)); // Get the extension of the img
                $validExtensions = array('jpeg', 'jpg', 'png'); // The valid extensions I want (mimes:jpg,jpeg,png in Laravel)
                //$newUserPhoto = rand(1000, 1000000).".".$imageExtension;

                if (array($imageExtension, $validExtensions)){ // If the imageExtension is in the array of valid extensions
                    $uploadDir = 'assets/communityImages/'; // The directory where the img are
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
                $this->query("UPDATE publication SET  description = :description, publication_image = :image, update_time = CURRENT_TIMESTAMP WHERE ID = :id");

                $this->bind(':description', $post['description']);
                $this->bind(':image', $imageToSave);
                $this->bind(':id', $id);
                $this->execute();
                header('Location: ' . ROOT_URL.'dashboard/publications');
            } catch (\Exception $e){
                Messages::setMessage($e->getMessage(), 'error');
            }
        }
    }
    public function deleteUser($id)
    {
        $this->query("DELETE FROM user where id=$id");
        $this->execute();
        return;
    }

    public function deleteBook($id)
    {
        $this->query("DELETE FROM book where ID=$id");
        $this->execute();
        return;
    }

    public function deletePublication($id)
    {
        $this->query("DELETE FROM publication where ID=$id");
        $this->execute();
        return;
    }

    public function deleteComment($id)
    {
        $this->query("DELETE FROM comment where ID=$id");
        $this->execute();
        return;
    }


    public function deleteLendBook($userId, $bookId, $lendDate)
    {
        $this->query("DELETE FROM lend where user_id=:user_id AND book_id= :book_id AND lend_date= :lend_date");
        $this->bind(':user_id', $userId);
        $this->bind(':book_id', $bookId);
        $this->bind(':lend_date', $lendDate);

        $this->execute();
        return;
    }
}
?>