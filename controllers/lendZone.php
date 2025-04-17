<?php
class LendZone extends Controller {
    protected function index()
    {
        $viewModel = new LendZoneModel();
        $this->ReturnView($viewModel->index(), true);
    }
}
?>