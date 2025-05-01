<?php
    class CommunityModel extends Model{
        public function index()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->add();
            }

            $this->query('SELECT * FROM publication JOIN user ON publication.id_user = user.id');
            $rows = $this->resultSet();
            return($rows);
        }

        public function show($id,$userId)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->addComment($id, $userId);
            }

            $this->query("SELECT * FROM publication JOIN user ON publication.id_user = user.id WHERE publication.id = $id");
            return $this->single();
        }

        public function getComments($id)
        {
            $this->query("SELECT comment.*, user.image as profileImage, user.name FROM comment JOIN user ON comment.id_user = user.id WHERE id_publication = 1 ORDER BY comment.create_time DESC");
            $rows = $this->resultSet();
            return($rows);
        }

        public function delete($id)
        {
                $this->query("DELETE FROM publication where id=$id");
                $this->execute();
                return;
        }

        public function edit($id = null)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->update($id);
            }

            $this->query("SELECT * FROM publication WHERE id = $id");
            return $this->single();
        }

        public function add()
        {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );

            if(isset($post['submit'])){
                if ($post['description'] == ''){
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

                    if (array($imageExtension, $validExtensions)){ // If the imageExtension is in the array of valid extensions
                        $uploadDir = 'assets/communityImages/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved
                        move_uploaded_file($imageTmp, $uploadPath); // Move the img to the path I want

                        $imageToSave = $uploadPath;

                    } else {
                        Messages::setMessage('The extension is not valid', 'error');
                    }
                } else {
                    $imageToSave = null;
                }

                try {
                    $userId = $_SESSION['user_data']['id'];
                    // Insert into MySQL
                    $this->query("INSERT INTO publication(description, publication_image,id_user, create_time) VALUES(:description,:publication_image, :id_user, CURRENT_TIMESTAMP)");
                    $this->bind(':description', $post['description']);
                    $this->bind(':publication_image', $imageToSave);
                    $this->bind(':id_user', $userId);
                    $this->execute();

                    //header('Location:'.ROOT_URL.'myLibrary');
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
            /*
                if ($this->lastInsertId()){
                    // Redirect
                    header('Location:'.ROOT_URL.'community');
                }
            */
            }
            return;
        }

        public function addComment($id, $userId)
        {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );

            if(isset($post['submit'])){
                if ($post['description'] == ''){
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
                        $uploadDir = 'assets/commentImage/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved
                        move_uploaded_file($imageTmp, $uploadPath); // Move the img to the path I want

                        $imageToSave = $uploadPath;

                    } else {
                        Messages::setMessage('The extension is not valid', 'error');
                    }
                } else {
                    $imageToSave = null;
                }

                try {
                    // Insert into MySQL
                    $this->query("INSERT INTO comment(description, image,id_user, id_publication, create_time) VALUES(:description,:image, :id_user, :id_publication, CURRENT_TIMESTAMP)");
                    $this->bind(':description', $post['description']);
                    $this->bind(':image', $imageToSave);
                    $this->bind(':id_user', $userId);
                    $this->bind(':id_publication', $id);
                    $this->execute();

                    //header('Location:'.ROOT_URL.'myLibrary');
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
                /*
                    if ($this->lastInsertId()){
                        // Redirect
                        header('Location:'.ROOT_URL.'community');
                    }
                */
            }
            return;
        }

        public function update($id)
        {
            $this->query("SELECT publication_image FROM publication WHERE id = $id");
            $response = $this->single();
            $oldPhoto = $response['publication_image'];

            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );
            if(isset($post['submit'])){
                if ($post['description'] == ''){
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

                    if (array($imageExtension, $validExtensions)){ // If the imageExtension is in the array of valid extensions
                        $uploadDir = 'assets/communityImages/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved
                        if (move_uploaded_file($imageTmp, $uploadPath)) { // To store the img in the folder
                            $imageToSave = $uploadPath;
                        } else {
                            $imageToSave = $oldPhoto;
                        }

                    } else {
                        $imageToSave = $oldPhoto;
                        Messages::setMessage('The extension is not valid', 'error');

                    }
                } else {
                    $imageToSave = $oldPhoto;
                }

                try {

                    // Insert into MySQL
                    $this->query("UPDATE publication SET description = :description, publication_image = :publication_image, upadate_time = CURRENT_TIMESTAMP WHERE id = $id");
                    $this->bind(':description', $post['description']);
                    $this->bind(':publication_image', $imageToSave);
                    $this->execute();

                    //header('Location:'.ROOT_URL.'myLibrary');
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
                /*
                    if ($this->lastInsertId()){
                        // Redirect
                        header('Location:'.ROOT_URL.'community');
                    }
                */
            }
            return;
        }
    }

?>