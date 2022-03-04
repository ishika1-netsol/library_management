<?php
require_once("classes/Book.php");
$book = new Book();
if (isset($_GET['Del'])) {
    $BookID = $_GET['Del'];
    $result = $book->deleteBook($BookID);
    // $query = " delete from records where User_ID = '".$UserID."'";

    // $result = mysqli_query($con,$query);
    if ($result) {
        header("location:bookList.php");
        exit;
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location:bookList.php");
    exit;
}
