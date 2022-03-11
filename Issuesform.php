<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
    exit();
}
require_once("./classes/Book.php");
$book = new Book();
include('./classes/Issue.php');
$issue = new Issue();

$result = $book->fetchBook();
$selection = array();
$selections = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $BookID = $row['id'];
        $BookName = $row['book_name'];
        $BookStatus = $row['status'];
        $BookQuantity = $row['quantity'];
        $Created_at = $row['created_at'];
        $Updated_at = $row['updated_at'];
        array_push($selection, $BookID);
        $selections[$BookID] = $BookName;
    }
}

if (isset($_GET['GetID'])) {
    $BookID = $_GET['GetID'];
}

$issuedates = array();
if (isset($_POST['create'])) {
    $IssueDate = $_POST['issue_date'];
    $ReturnDate = $_POST['return_date'];
    $BookID  = $_POST['book_id'];
    $UserID  = $_SESSION['id'];
    $status = 0;
    $quantity = $book->fetchQuantity($BookID);
  
    for ($i = $IssueDate; $i <= $ReturnDate; $i++) {
        $IssuedCount = $issue->getIssuedBookCount($BookID, $i);
        if ($IssuedCount >= $quantity) {
            $issuedates[] = $i;
        }
    }
   
    if (empty($issuedates)) {
        $query = $issue->insertIssues($IssueDate, $ReturnDate, '', $BookID, $UserID, $status);
        header("Location:IssueTable.php");
    } else {
        $error = $issuedates;
    }
}

?>
<?php require_once("header.php");?>
<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->
        <?php
        require_once("sideBar.php");
        require_once("navbar.php");
        ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Issue Form</h4>
                                <!-- <p class="card-description"> Basic form elements </p> -->
                                <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php
                                            echo implode(",", $error);
                                            echo '</br>';
                                            echo "Not available for this particular slot";

                                            ?></div>
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label for="issue_date">IssueDate</label>
                                        <input type="date" class="form-control" name="issue_date" value="<?php echo isset($_POST['issue_date']) ? $_POST['issue_date'] : '' ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="return_date">ReturnDate</label>
                                        <input type="date" class="form-control" name="return_date" value="<?php echo isset($_POST['return_date']) ? $_POST['return_date'] : '' ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="book_id">Choose a Book:</label>
                                        <select class="form-control" id="book_id" name="book_id">
                                            <option value="0">Please Select Option</option>
                                            <?php
                                            foreach ($selections as $book_id => $BookName) {

                                                $selected = ($book_id == $BookID) ? "selected" : "";
                                            ?>
                                                <option value="<?php echo $BookID ?>" <?php echo $selected ?>><?php echo $BookName ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>                                   
                                    <input type="submit" class="btn btn-primary mr-2" name="create" value="submit">
                                    <button class="btn btn-dark" name="Cancel" type="submit" value="Cancel">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>