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

                // Separación del nombre y del apellido (StringTokenizer)
                $completeName = explode(' ', $post['completeName']);
                $name = $completeName[0];
                $surname = $completeName[1];

                // Separación de los campos adress, city y province (StringTokenizer)
                $completeAddress = explode(',', $post['completeAddress']);
                $address = $completeAddress[0];
                $city = $completeAddress[1];
                $province = $completeAddress[2];

                // Insert into MySQL
                $this->query('INSERT INTO user(name, email, password, surname, rol, address, city, province) VALUES(:name, :email, :password, :surname, :rol, :address, :city, :province)');
                $this->bind(':name', $name);
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $this->bind(':surname', $surname);
                $this->bind(':rol', $rol);
                $this->bind(':address', $address);
                $this->bind(':city', $city);
                $this->bind(':province', $province);
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
                        "id" => $row['id'],
                        "name" => $row['name'],
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



    }

?>