<?php 
//Databse Connection file
require_once('db.php');
if(isset($_POST['create']))
  {
    $name=$_POST['firstname'];
    $email=$_POST['email'];
     $password=$_POST['password'];
     $user_type=$_POST['user_type'];
    $user_status=$_POST['user_status'];
   
     $query = mysqli_query($conn, "INSERT INTO users(name,email,password, user_type, status,created_at,updated_at) value('$name','$email', '$password', '$user_type', '$user_status',current_timestamp(),current_timestamp() )");
     if ($query) {
    echo 'You have successfully inserted the data';
  }
  else
    {
      echo 'Something Went Wrong. Please try again';
    }
}
mysqli_close($conn);
?>