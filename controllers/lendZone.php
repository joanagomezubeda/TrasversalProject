<?php
class LendZone extends Controller {
    protected function index()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $userId = $_SESSION['user_data']['id'];
        $viewModel = new LendZoneModel();
        $this->returnView($viewModel->index($userId), true);
    }

    protected function confirm()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new LendZoneModel();
        $viewmodel->confirm($id);
        header('Location: '.ROOT_URL.'lendZone?page=1');
    }

    protected function cancel()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new LendZoneModel();
        $viewmodel->cancel($id);
        header('Location: '.ROOT_URL.'lendZone?page=1');
    }
}
?>