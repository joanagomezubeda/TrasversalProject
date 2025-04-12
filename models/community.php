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

        public function show($id)
        {
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
                    $imageToSave = 'assets/images/icon.png';
                }

                try {
                    $userId = $_SESSION['user_data']['id'];
                    // Insert into MySQL
                    $this->query("INSERT INTO publication(description, publication_image,id_user) VALUES(:description,:publication_image, :id_user)");
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
    }

?>