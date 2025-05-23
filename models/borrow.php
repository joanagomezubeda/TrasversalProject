<?php
   class BorrowModel extends model{
       public function index($selectedGenre)
       {
           if (!isset($_SESSION['user_data']) || !isset($_SESSION['user_data']['id'])) {
               return [];
           }

           $userId = $_SESSION['user_data']['id'];
           $elementsPage = 6;
           $actualPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

           $start = ($actualPage - 1) * $elementsPage;
           if ($start < 0) {
               $start = 0;
           }

           if (!empty($selectedGenre)){
               $condition = 'AND genre = :selected_genre';
           } else {
               $condition = '';
           }
            // Get all books of the user
           $this->query("SELECT *,
           CASE
                WHEN (SELECT 1 FROM lend WHERE borrow_user_id = :userId AND book_id = book.ID) THEN 1
                ELSE 0
           END AS isBorrowed FROM book
           WHERE id_user != :userId AND ( ID NOT IN (SELECT book_id FROM lend) OR ID IN (SELECT book_id FROM lend WHERE borrow_user_id = :userId))
           $condition LIMIT :start, :elementsPage");

           $this->bind(':userId',$userId);
           $this->bind(':start', $start);
           $this->bind(':elementsPage', $elementsPage);
           $this->bind(':selected_genre', $selectedGenre);
           $rows = $this->resultSet();

           // Count them
           $this->query("SELECT COUNT(*) AS total FROM book WHERE id_user != :userId 
            AND (ID NOT IN (SELECT book_id FROM lend) 
            OR ID NOT IN (SELECT lend.BOOK_ID FROM lend WHERE return_date > CURRENT_DATE())) $condition");
           $this->bind(':userId', $userId);

           if (!empty($selectedGenre)) {
               $this->bind(':selected_genre', $selectedGenre);
           }

           $total = $this->single()['total'];

           return [
               'books' => $rows,
               'total' => $total,
               'page' => $actualPage,
               'elementsPage' => $elementsPage,
               'start' => $start,
               'selectedGenre' => $selectedGenre,
               'genres' => $this->getGenres()
           ];
       }

       public function getGenres()
       {
           $this->query("SELECT DISTINCT genre FROM book ");
           $rows = $this->resultSet();
           return $rows;
       }

       public function show($id = null)
       {
           $userId = $_SESSION['user_data']['id'];
           $this->query("SELECT *,
                CASE
                    WHEN (SELECT 1 FROM lend WHERE user_id = :user_id AND book_id = book.ID AND userConfirmation = 1)  THEN 1
                    ELSE 0
                END AS isLent FROM book WHERE ID = :id");
           $this->bind(':user_id', $userId);
           $this->bind(':id', $id);
           return $this->single();
       }


       public function delete($id = null)
       {
           $this->query("DELETE FROM book where ID=$id");
           $this->execute();
           return;
       }

       public function getRelatedBooksByGenre($genre, $id)
       {
           $this->query("SELECT * FROM book WHERE ID = $id");
           $this->execute();
           $result = $this->single();

           if ($result > 0){
               $this->query("SELECT * FROM book WHERE genre = :genre AND title NOT IN (SELECT title FROM book WHERE author = :author) GROUP BY title;");
               $this->bind(':genre', $genre);
               $this->bind(':author', $result['author']);
               $rows = $this->resultSet();
               return ($rows);
           }

       }

       public function unborrow($id)
       {
           $this->query("DELETE FROM lend WHERE book_id = $id");
           $this->execute();
           header('Location: ' . ROOT_URL);
       }

       public function borrowBook($id, $userId)
       {
           try {
               $this->query("SELECT id_user FROM book WHERE id = $id");
               $result = $this->single();

               if ($result > 0) {
                   $this->query('INSERT INTO lend(user_id, book_id, lend_date,borrow_user_id) VALUES(:user_id, :book_id, :lend_date, :borrow_user_id)');
                   $this->bind(':borrow_user_id', $userId);
                   $this->bind(':user_id', $result['id_user']);
                   $this->bind(':book_id', $id );
                   $this->bind(':lend_date', date("Y-m-d"));
                   $this->execute();
                   Messages::setMessage('You had borrow the book!', 'success');
                   header('Location: ' . ROOT_URL . 'borrow?page=1');
               }

           } catch (\Exception $e){
               Messages::setMessage('There was a trouble borrowing the book! <i class=" ms-1 bi bi-emoji-frown"></i>', 'error');
               header('Location: ' . ROOT_URL . 'borrow/show/' . $id);
           }

       }

       public function isBorrowed($id, $userId)
       {
           $this->query("SELECT * FROM lend WHERE book_id = $id AND borrow_user_id = $userId");
           $result = $this->single();

           return $result > 0;
       }

       public function isConfirmed($id, $userId)
       {
           $this->query("SELECT * FROM lend WHERE userConfirmation = 1 AND borrow_user_id = $userId AND book_id = $id");
           $result = $this->single();

           return $result > 0;
       }

       public function saveBook($id, $userId)
       {
           $this->query("SELECT * FROM book WHERE ID = $id");
           $result = $this->single();

           if ($result > 0){
               $this->query("INSERT INTO book(title, description, author, editorial, genre, image, id_user, create_time) VALUES (:title, :description, :author, :editorial, :genre, :image, :id_user, CURRENT_TIMESTAMP)");
               $this->bind(':title', $result['title']);
               $this->bind(':description', $result['description']);
               $this->bind(':author', $result['author']);
               $this->bind(':editorial', $result['editorial']);
               $this->bind(':genre', $result['genre']);
               $this->bind(':image', $result['image']);
               $this->bind(':id_user', $userId);
               $this->execute();
           }

       }

       public function isSaved($id, $userId)
       {
           $this->query("SELECT * FROM book WHERE ID = $id AND id_user = $userId");
           $result = $this->single();

           return $result > 0;
       }

   }
?>