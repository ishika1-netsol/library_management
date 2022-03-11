<?php
require_once("classes/User.php");
$user = new User();
if (isset($_GET['Del'])) {
    $UserID = $_GET['Del'];
    $result = $user->deleteUser($UserID);
    // $query = " delete from records where User_ID = '".$UserID."'";

    // $result = mysqli_query($con,$query);
    if ($result) {
        header("location: UserTable.php");
        exit;
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location:UserTable.php");
    exit;
}

?>



