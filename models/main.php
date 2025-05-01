<?php

class MainModel extends Model{

    public function getLastBook($userId)
    {
        $this->query("SELECT * FROM book WHERE id_user = $userId ORDER BY create_time DESC LIMIT 5 ");
        $rows = $this->resultSet();
        return $rows;
    }
    
}