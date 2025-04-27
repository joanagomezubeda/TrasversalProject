<?php
class Dashboard extends Controller {
    protected function index()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->index(), true);
    }

    protected function users()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->totalUsers(), true);
    }

    protected function books()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->totalBooks(), true);
    }

    protected function publications()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->totalPublications(), true);
    }

    protected function comments()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->totalComments(), true);
    }

    protected function lendBooks()
    {
        $viewModel = new DashboardModel();
        $this->ReturnView($viewModel->totalLendBooks(), true);
    }

    protected function editComment()
    {

        $commentId = $this->request['id'];
        $viewModel = new DashboardModel();
        $comment = $viewModel->getComment($commentId);
        $edit = $viewModel->editComment($commentId);
        $this->ReturnView([$edit, 'comment' => $comment], true);
    }

    protected function editLendBook()
    {
        $userId = $this->request['id'];
        $bookId = $this->request['book_id'];
        $lendDate = $this->request['date'];
        $viewmodel = new DashboardModel();
        $edit = $viewmodel->editLendBook($userId, $bookId, $lendDate);
        $lendBook = $viewmodel->getLendBook($userId, $bookId, $lendDate);
        $this->ReturnView([$edit, 'lendBook' => $lendBook], true);
    }

    protected function editPublication()
    {
        $id = $this->request['id'];
        $viewmodel = new DashboardModel();
        $edit = $viewmodel->editPublication($id);
        $publication = $viewmodel->getPublication($id);
        $this->returnView([$edit, 'publication' => $publication], true);
    }

    protected function deleteUser()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new DashboardModel();
        $viewmodel->deleteUser($id);
        header('Location:'. ROOT_URL.'dashboard');
    }

    protected function deleteBook()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new DashboardModel();
        $viewmodel->deleteBook($id);
        header('Location:'. ROOT_URL.'dashboard');
    }

    protected function deletePublication()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new DashboardModel();
        $viewmodel->deletePublication($id);
        header('Location:'. ROOT_URL.'dashboard');
    }

    protected function deleteComment()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $id = $this->request['id'];
        $viewmodel = new DashboardModel();
        $viewmodel->deleteComment($id);
        header('Location:'. ROOT_URL.'dashboard');
    }

    protected function deleteLendBook()
    {
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL);
        }

        $bookId = $this->request['book_id'];
        $userId = $this->request['id'];
        $lendDate = $this->request['date'];

        $viewmodel = new DashboardModel();
        $viewmodel->deleteLendBook($userId, $bookId, $lendDate);
        header('Location:'. ROOT_URL.'dashboard');
    }
}
?>