<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
require_once('./classes/Issue.php');
$issue = new Issue();
require_once("./classes/Book.php");
$book = new Book();
if (isset($_POST['create'])) {
    $IssueDate = $_POST['issue_date'];
    $ReturnDate = $_POST['return_date'];
    $BookID    = $_POST['book_id'];
    $UserID  = $_SESSION['id'];
    $status = $_POST['status'];
    $query = $issue->insertIssues($IssueDate, $ReturnDate, '', $BookID, $UserID, $status);
     
    // if ($query) {
    //     echo 'You have successfully inserted the data';
    //     // header("Location: http://localhost/library%20system/bookList.php");
    // } else {
    //     echo 'Something Went Wrong. Please try again';
            // }
}

?>