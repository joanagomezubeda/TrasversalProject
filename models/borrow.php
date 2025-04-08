<?php
   class BorrowModel extends model{
       public function index()
       {
           $this->query('SELECT * FROM book WHERE ID not in (SELECT book_id FROM lend) OR ID NOT IN (SELECT lend.BOOK_ID from lend where return_date > current_date())');
           $rows = $this->resultSet();
           return($rows);

       }

       public function show($id = null)
       {
           $this->query("SELECT * FROM book WHERE ID = $id");
           return $this->single();
       }

       public function delete($id = null)
       {
           $this->query("DELETE FROM book where ID=$id");
           $this->execute();
           return;
       }

       public function getRelatedBooksByGender($gender, $id)
       {
           $this->query("SELECT * FROM book WHERE gender = '$gender' AND ID not in (SELECT ID FROM book WHERE ID = $id)");
           $rows = $this->resultSet();
           return ($rows);

       }
   }
?>