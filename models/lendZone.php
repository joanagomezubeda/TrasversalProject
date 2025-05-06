<?php
class LendZoneModel extends Model {
    public function index($userId)
    {
        $elementsPage = 6;
        $actualPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        /* If Im on the page 1 i want to show 6 books  (1-1) * 6 = 0 (You will see from 0-6)
            If Im on the page 2 I want to show from the id 6 (2-1)*6 = 6 (You'll see from 6-11)
            If im on the page 2, the next 6 books (3-1)*6 = 12 (You'll see from 12-17)
        */
        $start = ($actualPage - 1) * $elementsPage;
        if ($start < 0){
            $start = 0;
        }


        $this->query("SELECT * FROM book JOIN lend ON book.id = lend.book_id WHERE user_id = :userId AND userConfirmation = 0 LIMIT :start, :elementsPage");
        $this->bind(':start', $start);
        $this->bind(':elementsPage', $elementsPage);
        $this->bind(':userId', $userId );
        $rows = $this->resultSet();

        $this->query("SELECT COUNT(*) as total FROM book JOIN lend ON book.id = lend.book_id WHERE user_id = :userId AND userConfirmation = 0 ");
        $this->bind(':userId', $userId );


        $total = $this->single()['total'];

        return [
            'books' => $rows,
            'total' => $total,
            'page' => $actualPage,
            'elementsPage' => $elementsPage,
            'start' => $start,

        ];

    }


    public function confirm($id)
    {
        // FUENTE: https://elinawebs.com/como-sumar-y-restar-fechas-con-php-con-strtotime-y-date/ :)
        $today = date('Y-m-d');
        $new_date = date('Y-m-d', strtotime($today. "+ 1 month"));
        $this->query("UPDATE lend SET userConfirmation = 1, return_date = :month_later, update_time = CURRENT_TIMESTAMP WHERE book_id = $id");
        $this->bind(':month_later', $new_date);
        $this->execute();
    }

    public function cancel($id)
    {
        $this->query("DELETE FROM lend WHERE book_id = $id");
        $this->execute();
    }
}
?>