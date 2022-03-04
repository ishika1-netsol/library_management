<?php
//Databse Connection file
require_once('classes/User.php');
$user = new User();

if (isset($_POST['create'])) {
  $name = $_POST['firstname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $user_type = $_POST['user_type'];
  $status = $_POST['status'];
  if ($password === $cpassword) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = $user->insertUser($name, $email, $hash, $user_type, $status);
  }

  if ($query) {
    // echo 'You have successfully inserted the data';
    header("Location: login.php");
    exit();
  } else {
    echo 'Something Went Wrong. Please try again';
  }
}
// mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
  <title>USER REGISTRATION</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
  <div>
    <form action="forms.php" method="post">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <h1> REGISTRATION</h1>
            <hr class="mb-3">
            <label for="firstname"><b>Name<b></label>
            <input class="form-control" type="text" name="firstname" required>

            <label for="email"><b>Email<b></label>
            <input class="form-control" type="email" name="email" required>

            <label for="password"><b>Password<b></label>
            <input class="form-control" type="password" name="password" required>
            <br>
            <label for="password"><b> Confirm Password<b></label>
            <input class="form-control" type="password" name="cpassword" required>
            <br>
            <label for="user_type">Choose a user:</label>
            <select id="user_type" name="user_type">
              <option value="student">student</option>
              <option value="admin">admin</option>
            </select>
            <br>
            <p>select user_status:</p>
            <input type="radio" id="active" name="status" value="0">
            <label for="active">active</label>
            <input type="radio" id="inactive" name="status" value="1">
            <label for="inactive">inactive</label>
            <br>
            <hr class="mb-3">
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


 