<?php
    class Home extends Controller {
        protected function index()
        {
            $viewModel = new HomeModel();
            $this->ReturnView($viewModel->index(), true);
        }
    }
?>