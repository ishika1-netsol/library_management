<?php

require_once("classes/Book.php");
$book = new Book();
if (isset($_POST['update'])) {
    $bookID = $_GET['ID'];
    $bookName = $_POST['name'];
    $bookAuthor = $_POST['author_name'];
    $bookQuantity = $_POST['quantity'];
    // $password = $_POST['password'];
    $bookStatus = $_POST['status'];
    // $Updated_at = $_POST['updated_at'];
   
    $result = $book->updateBook($bookName, $bookAuthor, $bookStatus,$bookQuantity, $bookID);

    // $query = " update users set name = '".$UserName."', email='".$UserEmail."',password='".$UserPassword."',status='".$UserStatus."',created_at='".$Created_at."',updated_at='".$Updated_at."' where id='".$UserID."'";
    // $result = mysqli_query($conn,$query);

    if ($result) {
        header("location:BookTable.php");
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location: BookTable.php");
}
