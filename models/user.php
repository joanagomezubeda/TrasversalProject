<?php

    class UserModel extends Model {
        public function register()
        {
            // Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );


            if(isset($post['submit'])){
                $password = md5($post['password']);
                if ($post['completeName'] == '' || $post['email'] == ''|| $post['password'] == '' ){
                    Messages::setMessage('Please Fill In All Fields', 'error');
                    return;
                }

                $this->query("SELECT * FROM user WHERE rol = 'admin'");
                $row = $this->single();
                if ($row > 0) {
                    $rol = 'user';
                } else {
                    $rol = 'admin';
                }

                // Split of name and surname (Like a stringTokenizer)
                $completeName = explode(' ', $post['completeName']);
                $name = $completeName[0];
                $surname = $completeName[1];

                // Split of adress, city y province (Like a stringTokenizer)
                $completeAddress = explode(',', $post['completeAddress']);
                $address = $completeAddress[0];
                $city = $completeAddress[1];
                $province = $completeAddress[2];

                //Profile image
                $image = 'assets/userImages/defaultProfile.jpg';

                // Insert into MySQL
                $this->query('INSERT INTO user(name, email, password, surname, rol, image, address, city, province) VALUES(:name, :email, :password, :surname, :rol, :image, :address, :city, :province)');
                $this->bind(':name', $name);
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $this->bind(':surname', $surname);
                $this->bind(':rol', $rol);
                $this->bind(':address', $address);
                $this->bind(':city', $city);
                $this->bind(':province', $province);
                $this->bind(':image', $image);
                $this->execute();

                // Verify

                if ($this->lastInsertId()){
                    // Redirect
                    header('Location:'.ROOT_URL.'users/login');
                }
            }
        }

        public function login()
        {
            // Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING );

            if(isset($post['submit'])) {
                $password = md5($post['password']);
                // Compare Login
                $this->query('SELECT * FROM user WHERE email = :email AND password = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $row = $this->single();

                if ($row){
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "name" => $row['name'],
                        "id" => $row['id'],
                        "email" => $row['email'],
                        "image" => $row['image'],
                        "surname" => $row['surname'],
                        "rol" => $row['rol'],
                        "address" => $row['address'],
                        "city" => $row['city'],
                        "province" => $row['province'],
                    );

                    header('Location:'.ROOT_URL.'home');

                } else {
                    Messages::setMessage('Incorrect Login', 'error');
                }

            }
            return;
        }

        public function profile($id)
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->update($id);
            }

            $this->query("SELECT * FROM user WHERE id = $id ");
            return $this->single();
        }

        public function update($id = null)
        {
            $this->query("SELECT image FROM user WHERE id = $id");
            $response = $this->single();
            $oldPhoto = $response['image'];
            // Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($post['submit'])) {
                if ($post['completeName'] == '' || $post['email'] == ''|| $post['password'] == '' || $post['completeAddress'] == ''){
                    Messages::setMessage('Please Fill In All Fields', 'error');
                    return;
                }

                $password = md5($post['password']);

                // Split of name and surname (Like a stringTokenizer)
                $completeName = explode(' ', $post['completeName']);
                $name = $completeName[0];
                $surname = $completeName[1];

                // Split of adress, city y province (Like a stringTokenizer)
                $completeAddress = explode(',', $post['completeAddress']);
                $address = $completeAddress[0];
                $city = $completeAddress[1];
                $province = $completeAddress[2];

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
                        $uploadDir = 'assets/userImages/'; // The directory where the img are
                        $uploadPath = $uploadDir . $newImage; // Path where the img will be saved

                        if (move_uploaded_file($imageTmp, $uploadPath)) { // To store the img in the folder
                            $imageToSave = $uploadPath;
                            $_SESSION['user_data']['image'] = 'assets/userImages/' . $newImage;
                            if (is_writable($oldPhoto)){
                                unlink($oldPhoto);
                            }
                        } else {
                            $imageToSave = $oldPhoto;
                        }
                    } else {
                        $imageToSave =$oldPhoto;
                        Messages::setMessage('The extension is not valid', 'error');
                    }
                } else {
                    $imageToSave =$oldPhoto;
                }


                // Insert into MySQL
                try {
                    $this->query("UPDATE user SET name = :name, surname = :surname, email = :email, password = :password, 
                    address = :address, city = :city, province = :province, rol = :rol, image = :image WHERE id = :id");
                    $this->bind(':name', $name);
                    $this->bind(':email', $post['email']);
                    $this->bind(':image', $imageToSave);
                    $this->bind(':password', $password);
                    $this->bind(':surname', $surname);
                    $this->bind(':rol', $_SESSION['user_data']['rol']);
                    $this->bind(':address', $address);
                    $this->bind(':city', $city);
                    $this->bind(':province', $province);
                    $this->bind(':id', $id);
                    $this->execute();
                    //header('Location: ' . ROOT_URL);
                } catch (\Exception $e){
                    Messages::setMessage($e->getMessage(), 'error');
                }
            }
        }

        public function getLastBooks($id = null)
        {

            $this->query("SELECT * FROM book WHERE id_user = $id ORDER BY create_time DESC LIMIT 4");
            $rows = $this->resultSet();
            return ($rows);
        }
    }

?>