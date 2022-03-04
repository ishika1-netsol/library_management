<?php

require_once 'classes/Db.php';
class Book extends Db
{
    function insertBook($name, $author_name, $image, $status, $quantity)
    {
        $stmt = $this->_mysqli->prepare("INSERT INTO books (name,author_name,image,status,quantity )VALUES (?,?,?,?,?)");
        $stmt->bind_param("ssssi", $name, $author_name, $image, $status, $quantity);
        return $stmt->execute();
    }
    function updateBook($name, $author_name, $status, $quantity, $id)
    {
        $stmt = $this->_mysqli->prepare("UPDATE books SET name=?,author_name=?,quantity=?,status=?  where id =?");
 
        $stmt->bind_param("sssii", $name, $author_name, $quantity, $status, $id);
        return $stmt->execute();
    }
    function deleteBook($id)
    {
        $stmt = $this->_mysqli->prepare("DELETE FROM books WHERE id=?");

        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    function fetchBook()
    {
        $stmt = $this->_mysqli->prepare('SELECT * FROM books');
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function editBook($id)
    {
        $stmt = $this->_mysqli->prepare("SELECT * FROM books WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $query = $stmt->get_result();
        return $query;
    }
    function insertIssues($book_id, $user_id)
    {
        $stmt = $this->_mysqli->prepare("INSERT INTO issues (book_id,user_id )VALUES (?,?)");
        $stmt->bind_param("ii", $book_id, $user_id);
        return $stmt->execute();
    }
    function fetchQuantity($book_id){
        $stmt = $this->_mysqli->prepare("SELECT quantity FROM books WHERE id =?");
        $stmt->bind_param("i", $book_id);
        $stmt->execute();
        $query = $stmt->get_result();
        $row = $query->fetch_assoc();
        $result = $row['quantity'];
        return $result;
    }



}

?>