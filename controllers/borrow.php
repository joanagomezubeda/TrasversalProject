<?php

    class Borrow extends Controller{
        protected function index()
        {
            $viewmodel = new BorrowModel();
            $selectedGenre = isset($_GET['filterByGenre']) && $_GET['filterByGenre'] !== '' ? $_GET['filterByGenre'] : null;
            $this->returnView($viewmodel->index($selectedGenre), true);
        }

        protected function show()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

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
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->delete($id);
            header('Location:'. ROOT_URL.'borrow');
        }


        protected function unborrow()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->unborrow($id);
            header('Location:'. ROOT_URL.'borrow');
        }

        protected function borrowBook()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $userId = $_SESSION['user_data']['id'];
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->borrowBook($id, $userId);

        }

        protected function saveBook()
        {
            if(!isset($_SESSION['is_logged_in'])){
                header('Location: '.ROOT_URL);
            }

            $userId = $_SESSION['user_data']['id'];
            $id = $this->request['id'];
            $viewmodel = new BorrowModel();
            $viewmodel->saveBook($id, $userId);
            header('Location: ' . ROOT_URL . 'myLibrary');
        }


    }