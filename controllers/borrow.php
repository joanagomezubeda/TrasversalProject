<?php

    class Borrow extends Controller{
        protected function index()
        {
            $viewmodel = new BorrowModel();
            $this->returnView($viewmodel->index(), true);
        }

        protected function show()
        {
            $id = $this->request['id'];
            $userId = $_SESSION['user_data']['id'];
            $viewmodel = new BorrowModel();
            $book = $viewmodel->show($id);
            if (isset($book)){
                $genre = $book['genre'];
                $relatedBooks = $viewmodel->getRelatedBooksByGenre($genre, $id);
            }
            $isSavedBook = $viewmodel->isSaved($id, $userId);
            $isBorrowed = $viewmodel->isBorrowed($id, $userId);
            $isConfirmed = $viewmodel->isConfirmed($id,$userId);
            $this->returnView(['book'=>$book, 'relatedBooks' => $relatedBooks, 'isSaved' => $isSavedBook, 'isBorrowed' => $isBorrowed, 'isConfirmed' => $isConfirmed], true);
        }

        protected function delete()
        {
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->delete($id);
            header('Location:'. ROOT_URL.'borrow');
        }


        protected function unborrow()
        {
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->unborrow($id);
            header('Location:'. ROOT_URL.'borrow');
        }

        protected function borrowBook()
        {
            $userId = $_SESSION['user_data']['id'];
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->borrowBook($id, $userId);

        }

        protected function saveBook()
        {
            $userId = $_SESSION['user_data']['id'];
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->saveBook($id, $userId);
            header('Location: ' . ROOT_URL . 'myLibrary');
        }


    }