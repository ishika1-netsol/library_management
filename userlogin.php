<?php
require_once('classes/User.php');
$user = new User();
if (isset($_POST['login'])) {  
    $email = $_POST["email"];
    $password = $_POST["password"];
    $canLogin = true;
    if (empty($email)) {
        $emailError = "email is required";
        $canLogin = false;
    }
    if (empty($password)) {
        $passwordError = "password is required";
        $canLogin = false;
    }
    if ($canLogin) {
        $query = $user->login($email);       
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                if (password_verify($password, $row["password"])) {
                    session_start();
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["name"] = $row['name'];
                    $_SESSION["user_type"] = $row['user_type'];
                    $_SESSION["status"] = $row['status'];
                    $_SESSION["email"] = $row['email'];
                    if ($_SESSION['user_type'] == 'admin'){          
                        header("location:template/dashboard.php");
                        exit();
                    } else if ($_SESSION['user_type'] == 'student') {
                        header("location:http://localhost/library%20system/template/dashborad1.php");
                        exit();
                    }
                }else{
                    $passwordError = "You have Entered Incorrect Password";
                }
            }
        }else{
            $emailError = "Please Enter Correct Email"; 
        }       
    }      
} 
require_once("header.php");
?>

<body>
    <div class="container-scroller">
        <!-- partial:../../partials/_sidebar.html -->

        <!-----partial--->
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Login</h3>
                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                                <div class="form-group">
                                    <label for="email">email</label>
                                    <input type="email" class="form-control p_input" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    <p class="text-danger"><?php if (isset($emailError)) {
                                                                echo $emailError;
                                                            } ?></p>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control p_input" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                                    <p class="text-danger"><?php if (isset($passwordError)) {
                                                                echo $passwordError;
                                                            } ?></p>
                                </div>
                                <!-- <div class="form-group d-flex align-items-center justify-content-between">
                                     <div class="form-check">
                                         <label class="form-check-label">
                                             <input type="checkbox" class="form-check-input"> Remember me </label>
                                     </div>
                                     <a href="#" class="forgot-pass">Forgot password</a>
                                 </div> -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn" name="login" value="submit">Login</button>
                                </div>
                                <!-- <div class="d-flex">
                                     <button class="btn btn-facebook mr-2 col">
                                         <i class="mdi mdi-facebook"></i> Facebook </button>
                                     <button class="btn btn-google col">
                                         <i class="mdi mdi-google-plus"></i> Google plus </button>
                                 </div> -->
                                <p class="sign-up">Don't have an Account?<a href="UserForm.php">Register</a></p>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
    </div>
</body>