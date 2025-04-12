<?php

    class Community extends Controller{
        protected function index()
        {
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->index(), true);
        }

        protected function add()
        {
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->add(), true);
        }

        protected function show()
        {
            $id = $this->request['id'];
            $viewmodel = new CommunityModel();
            $this->returnView($viewmodel->show($id), true);
        }
    }
?>