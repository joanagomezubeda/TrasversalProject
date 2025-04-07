<?php
   class BorrowModel extends model{
       public function index()
       {
           $this->query('SELECT * FROM book WHERE ID not in (SELECT book_id FROM lend) OR ID NOT IN (SELECT lend.BOOK_ID from lend where return_date > current_date())');
           $rows = $this->resultSet();
           return($rows);

       }
   }
?>