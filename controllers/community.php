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
    }
?>