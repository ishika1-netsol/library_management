<?php
require_once('classes/User.php');
$user = new User();
if (
  isset($_POST['email']) && isset($_POST['password']) &&
  isset($_POST['login'])
) {
  function test_input($data)
  {
    $data = trim($data);
    return $data;
  }
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
  // $user_type = test_input($_POST["user_type"]);

  if (empty($email)) {
    $error = "email is required";
  } else if (empty($password)) {
    $error = "password is required";
  } else {
    $query = $user->login($email);
    if ($query->num_rows > 0) {
      while ($row = $query->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
          session_start();
          $_SESSION["id"] = $row['id'];
          $_SESSION["name"] = $row['name'];
          $_SESSION["user_type"] = $row['user_type'];
          $_SESSION["status"] = $row['status'];

          if ($_SESSION['user_type'] === 'admin') {
            header("location:template/dashboard.php");
            exit();
          } else if ($_SESSION['user_type'] === 'student') {
            header("location:forms.php");
          }
        } else {
          $error= "INVALID USERNAME OR PASSWORD";
        }
      }
    } else {
      header("location: login.php");
      exit();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title> Login Form </title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
  <div>
    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="login-form">
      <h1>Login</h1>
      <?php if (isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $error;
          ?></div>
      <?php
      }
      ?>
      <div class="content">
        <div class="input-field">
          <input type="email" placeholder="Email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
        </div>
        <div class="input-field">
          <input type="password" placeholder="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
        </div>
        <!-- <a href="#" class="link">Forgot Your Password?</a> -->
        <div class="input-field">
          <input class="btn btn-success btn-lg btn-block" type="submit" name="login" value="submit">
          <p>Don't have an account <a href="forms.php">Register</a></p>
          <!-- <input class="btn btn-success btn-lg btn-block" > -->
        </div>
        <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-center">
          <button class="btn btn-primary me-md-2" type="button">Button</button>
        
        </div> -->
      </div>
      <!-- <div class="action"> -->
      <!-- <input class="btn btn-success" type="submit" name="login" value="submit"> -->

      <!-- <p>Don't have an account <a href="forms.php"></a>Register Here</p> -->
      <!-- <button><a href="forms.php">Register</a></button> -->
      <!-- <button><a href="user_list.php">Login</a></button>  -->
      <!-- <button name="login">Login</button> -->
      <!-- </div> -->
    </form>
  </div>
  <!-- partial -->
  <!-- <script  src="./script.js"></script> -->

</body>

</html>