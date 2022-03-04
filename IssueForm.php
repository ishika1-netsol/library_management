<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
include("./classes/Book.php");
$book = new Book();
require_once('./classes/Issue.php');
$issue = new Issue();
$result = $book->fetchBook();
$selection = array();
$selections = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $BookID = $row['id'];
        $BookName = $row['name'];
        $BookStatus = $row['status'];
        $BookQuantity = $row['quantity'];
        $Created_at = $row['created_at'];
        $Updated_at = $row['updated_at'];
        array_push($selection, $BookID);
        $selections[$BookID] = $BookName;
        // echo$BookID.'</br>';
    }
}


$issuedate = array();
if (isset($_POST['create'])) {
    $IssueDate = $_POST['issue_date'];
    $ReturnDate = $_POST['return_date'];
    $BookID  = $_POST['book_id'];
    $UserID  = $_SESSION['id'];
    $status = $_POST['status'];
    $result = $book->fetchQuantity($BookID);
    for($i= $IssueDate; $i<=$ReturnDate;$i++){
    $saved = $issue->getIssuedBookCount($BookID,$i);
    print_r($saved);
    }
 
    // $query = $issue->fetchBookDates($BookID);
    //  if($query->num_rows > 0){
    //     while ($row = $query->fetch_assoc()){
    //         $bookIssue = $row['issue_date'];
    //         $bookReturn = $row['return_date'];
    //         array_push($issuedate, $bookIssue);
    //         // print_r($issuedate);
      
    //     } 
    //  }
//  die();      
    if ($result > $saved) {
        $query = $issue->insertIssues($IssueDate, $ReturnDate, '', $BookID, $UserID, $status);
    } else {
        $error = "No book is available for this slot";
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>ISSUE FORM</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error;
                    ?></div>
            <?php
            }
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h1> ISSUE FORM</h1>
                        <hr class="mb-3">
                        <label for="issue_date"><b>issueDate<b></label>
                        <input class="form-control" type="date" name="issue_date" value="<?php echo isset($_POST['issue_date']) ? $_POST['issue_date'] : '' ?>" required>
                        <label for="return_date"><b>returnDate<b></label>
                        <input class="form-control" type="date" name="return_date" value="<?php echo isset($_POST['return_date']) ? $_POST['return_date'] : '' ?>" required>
                        <br>

                        <label for="book_id">Choose a book:</label>

                        <select id="book_id" name="book_id">
                            <option value="0">Please Select Option</option>
                            <?php
                            foreach ($selections as $BookID => $BookName) {
                                $selected = ($options == $BookID) ? "selected" : "";
                            ?>
                                <option value="<?php echo $BookID ?>" <?php echo $selected ?>><?php echo $BookName ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <br>
                        <!-- <p>select issue_status:</p>
                        <input type="radio" id="active" name="status" value="1">
                        <label for="active">issued</label>
                        <input type="radio" id="inactive" name="status" value="0">
                        <label for="inactive">not issued</label>
                        <br> -->
                        <input class="btn btn-success" type="submit" name="create" value="submit">
                        <button class="btn btn-success" name="Cancel" type="submit" value="Cancel">Cancel</button>
                        <!-- <button class="btn btn-success" value="cancel"><a href="forms.php">Cancel</a></button> -->
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>