<?php

    class Community extends Controller{
        protected function index()
        {
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->index(), true);
        }

        protected function add()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->add(), true);
        }

        protected function show()
        {
            $id = $this->request['id'];
            $userId = $_SESSION['user_data']['id'];
            $viewmodel = new CommunityModel();
            $publication = $viewmodel->show($id, $userId);
            $comments = $viewmodel->getComments($id);
            $this->returnView(['publication' => $publication, 'comments' => $comments], true);
        }

        protected function addComment()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $userId = $_SESSION['user_data']['id'];
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->addComment($id,$userId), true);
        }

        protected function delete()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new CommunityModel();
            $viewmodel->delete($id);
            header('Location: '.ROOT_URL.'community');
        }

        protected function update()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $_SESSION['user_data']['id'];
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->update($id), true);

        }

        protected function edit()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new CommunityModel();
            $this->ReturnView($viewmodel->edit($id), true);
        }
    }
?>