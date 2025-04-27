<?php
class Politics extends Controller {

    protected function privatePolitics()
    {
        $viewModel = new PoliticsModel();
        $this->ReturnView($viewModel->privatePolitics(), true);
    }

    protected function cookies()
    {
        $viewModel = new PoliticsModel();
        $this->ReturnView($viewModel->cookies(), true);

    }
}
?>