<?php

require_once("classes/User.php");
$user = new User();
if (isset($_POST['update'])) {
    $UserID = $_GET['ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    // $password = $_POST['password'];
    $status = $_POST['status'];
    $user_type = $_POST['user_type'];
    $Updated_at = $_POST['updated_at'];
    // var_dump( $Updated_at);
    // $Updated = date(" h:i d-F-Y", strtotime($Updated_at));
    // echo $Updated;
    $result = $user->updateUser($name, $email, $user_type, $status, date("Y-m-d H:i:s"), $UserID);

    // $query = " update users set name = '".$UserName."', email='".$UserEmail."',password='".$UserPassword."',status='".$UserStatus."',created_at='".$Created_at."',updated_at='".$Updated_at."' where id='".$UserID."'";
    // $result = mysqli_query($conn,$query);

    if ($result) {
        header("location:user_list.php");
    } else {
        echo ' Please Check Your Query ';
    }
} else {
    header("location:user_list.php");
}


?>

