<?php

    class Borrow extends Controller{
        protected function index()
        {
            $viewmodel = new BorrowModel();
            $this->ReturnView($viewmodel->index(), true);
        }

        protected function show()
        {
            $id = $this->request['id'];

            $viewmodel = new BorrowModel();
            $book = $viewmodel->show($id);
            if (isset($book)){
                $gender = $book['gender'];
                $relatedBooks = $viewmodel->getRelatedBooksByGender($gender, $id);
            }

            $this->ReturnView(['book'=>$book, 'relatedBooks' => $relatedBooks], true);
        }

        protected function delete()
        {
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->delete($id);
            header('Location:'. ROOT_URL.'borrow');
        }



    }