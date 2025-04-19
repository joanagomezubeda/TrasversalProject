<?php
require_once('models/main.php');

class AppService {
    public static function getLastBook() {
        if (!isset($_SESSION['is_logged_in'])) {
            return null;
        }

        $userId = $_SESSION['user_data']['id'];
        $viewmodel = new MainModel();
        return $viewmodel->getLastBook($userId);
    }
}
?>