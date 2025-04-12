<?php
    class MyLibrary extends Controller{

        protected function index()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $_SESSION['user_data']['id'];
            $viewmodel = new MyLibraryModel();
            $this->returnView($viewmodel->index($id), true);
        }


        protected function edit()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new MyLibraryModel();
            $this->ReturnView($viewmodel->edit($id), true);
        }


        protected function delete()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new MyLibraryModel();
            $viewmodel->delete($id);
            header('Location:'. ROOT_URL.'myLibrary');
        }

        protected function add()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $_SESSION['user_data']['id'];
            $viewmodel = new MyLibraryModel();
            $this->ReturnView($viewmodel->add($id), true);
        }

        protected function update()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $_SESSION['user_data']['id'];
            $viewmodel = new MyLibraryModel();
            $this->returnView($viewmodel->update($id), true);
        }
    }

?>