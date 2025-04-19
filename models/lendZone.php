<?php
class LendZoneModel extends Model {
    public function index($userId)
    {
        $this->query("SELECT * FROM book JOIN lend ON book.id = lend.book_id WHERE user_id = $userId AND userConfirmation = 0");
        return $this->resultSet();
    }

    public function confirm($id)
    {
        $this->query("UPDATE lend SET userConfirmation = 1 WHERE book_id = $id");
        $this->execute();
    }
}
?>