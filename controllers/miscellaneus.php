<?php
class Miscellaneus extends Controller {

    protected function contactUs()
    {
        $viewModel = new MiscellaneusModel();
        $this->ReturnView($viewModel->contactUs(), true);
    }

    protected function knowUs()
    {
        $viewModel = new MiscellaneusModel();
        $this->ReturnView($viewModel->knowUs(), true);

    }
}
?>