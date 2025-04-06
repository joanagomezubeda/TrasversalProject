<?php
    class HomeModel extends Model {
        public function index()
        {
            $this->query('SELECT * FROM book ORDER BY create_time ASC LIMIT 4 ');
            $rows = $this->resultSet();
            return($rows);
        }
    }
?>