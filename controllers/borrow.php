<?php

    class Borrow extends Controller{
        protected function index()
        {
            $viewmodel = new BorrowModel();
            $this->ReturnView($viewmodel->index(), true);
        }
    }