<?php
    class Users extends Controller {
        // Login, Register, Logout
        protected function register()
        {
            $viewmodel = new UserModel();
            $this->returnView($viewmodel->register(), true);
        }

        protected function login()
        {
            $viewmodel = new UserModel();
            $this->returnView($viewmodel->login(),true);
        }

        protected function logout()
        {
            unset($_SESSION['is_logged_in']);
            unset($_SESSION['user_data']);
            session_destroy();
            // Redirect
            header('Location:'.ROOT_URL);
        }

        protected function profile(){
            $id = $this->request['id'];
            $viewmodel = new UserModel();
            $this->returnView($viewmodel->profile($id), true);
        }

        protected function update()
        {
            if (!isset($_SESSION['is_logged_in'])) {
                header('Location: ' . ROOT_URL);
            }
            $viewmodel = new UserModel();
            $id = $this->request['id'];
            $this->returnView($viewmodel->update($id), true);
        }


    }
?>