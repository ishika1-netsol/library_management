<?php
//getting data from database
//getting data from issue table
// var_dump($_POST);
// die();
include('./classes/Issue.php');
$issue = new Issue();
include('./classes/Book.php');
$book = new Book();
$result = $issue->fetchIssueDate();
//storing in array
$data = array();
//  while($row = $result->fetch_assoc()){
//     $row['issue_date'] = date('d-m-Y', strtotime($row['issue_date'])); 
//     $data[] =  $row;

//  }
if (isset($_POST['book_id'])) {
    $BookID = $_POST['book_id'];
}
if (isset($_POST['year'])) {
    $year = $_POST['year'];
}
if (isset($_POST['month'])) {
    $month = $_POST['month'];
}
// $BookID = 7;
// echo$BookID;
$quantity = $book->fetchQuantity($BookID);
// echo $quantity;
$issuedates = [];
$IssueDate = date('Y-m-01',strtotime($year.'-'.$month));
$ReturnDate = date('Y-m-t', strtotime($year . '-' . $month));
// echo$IssueDate ;
// echo$ReturnDate;
// die();
for ($i = $IssueDate; $i <= $ReturnDate; $i++) {
    // var_dump($i);
    $IssuedCount = $issue->getIssuedBookCount($BookID, $i);   
    // var_dump($IssuedCount);
    if ($IssuedCount >= $quantity) {
        $issuedates[] = date('d-m-Y', strtotime($i));;
    }
}
// var_dump($IssuedCount);
// die();
// var_dump($issuedates);
// die();
//returning in JSON Format
echo json_encode($issuedates);
?>

