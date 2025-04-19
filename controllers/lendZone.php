<?php
class LendZone extends Controller {
    protected function index()
    {
        $userId = $_SESSION['user_data']['id'];
        $viewModel = new LendZoneModel();
        $this->ReturnView($viewModel->index($userId), true);
    }

    protected function confirm()
    {
        $id = $this->request['id'];
        $viewmodel = new LendZoneModel();
        $viewmodel->confirm($id);
        header('Location: '.ROOT_URL.'lendZone');
    }
}
?>