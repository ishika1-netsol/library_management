<?php
require_once('classes/User.php');
$user = new User();
if (isset($_POST['create'])) {
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];
    $status = "1";
    $canLogin = true;

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
        $canLogin = false;
    } else if(empty($name)){
        $nameErr = "name is required";
        $canLogin = false;
    }

    if (strlen($password) <= '6'&& (!($password) == "")) {
        $passwordError = "password must contain minimum 6 characters";
        $canLogin = false;
    } else if(empty($password)){
        $passwordError = "password is required";
        $canLogin = false;
    }
    if (!($password === $cpassword)) {
        $confirmPasswordError = "password does not match";
        $canLogin = false;
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
    if (empty($email)) {
        $emailError = "email is required";
        $canLogin = false;
    }else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $canLogin = false;
        $emailError = "Invalid email";
    } else {
        $query = $user->login($email);
        if ($query->num_rows > 0) {
            $emailError = "email is already exist";
            $canLogin = false;
        }
    }
    // if ($password === $cpassword) {
    //     $hash = password_hash($password, PASSWORD_DEFAULT);
    //     $query = $user->insertUser($name, $email, $hash, $user_type, $status);
    // }

    // if ($query) {
    //     header("Location: userlogin.php");
    //     exit();
    // } else {
    //     echo 'Something Went Wrong. Please try again';
    // }
    if ($canLogin) {
        $query = $user->insertUser($name, $email, $hash, $user_type, $status);
        header("Location: userlogin.php");
        exit();
    }
}
require_once('header.php') ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            <h3 class="card-title text-left mb-3">Register</h3>
                            <form action="userRegister.php" method="post">
                                <div class="form-group">
                                    <label for="firstname">Username</label>
                                    <input type="text" class="form-control p_input" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                                    <p class=text-danger><?php if (isset($nameErr)) {
                                                                echo $nameErr;
                                                            } ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control p_input" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                                    <p class=text-danger><?php if (isset($emailError)) {
                                                                echo $emailError;
                                                            } ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control p_input" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                                    <p class=text-danger><?php if (isset($passwordError)) {
                                                                echo $passwordError;
                                                            } ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="cpassword"> Confirm Password</label>
                                    <input type="password" class="form-control p_input" name="cpassword" value="<?php echo isset($_POST['cpassword']) ? $_POST['cpassword'] : '' ?>">
                                    <p class=text-danger><?php if (isset($confirmPasswordError)) {
                                                                echo $confirmPasswordError;
                                                            } ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="user_type">Choose a user:</label>
                                    <select class="form-control p_input" id="user_type" name="user_type" value="<?php echo isset($_POST['user_type']) ? $_POST['user_type'] : '' ?>">
                                        <option value="student">Student</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label>select user_status:</label>
                                    <div class="form-check">
                                        <label class="form-check-label" for="active" ></label>
                                        <input type="radio" class="form-check-input" id="active" name="status" value="1"> Active </label>
                                        <label class="form-check-label" for="inactive"></label>
                                        <input type="radio" class="form-check-input" id="inactive" name="status" value="0"> Inactive </label>
                                    </div>
                                </div> -->
                                <!-- <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input"> Remember me </label>
                                    </div>
                                    <a href="#" class="forgot-pass">Forgot password</a>
                                </div> -->
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary btn-block enter-btn" name="create" value="submit">
                                </div>
                                <!-- <div class="d-flex">
                                    <button class="btn btn-facebook col mr-2">
                                        <i class="mdi mdi-facebook"></i> Facebook </button>
                                    <button class="btn btn-google col">
                                        <i class="mdi mdi-google-plus"></i> Google plus </button>
                                </div> -->
                                <p class="sign-up text-center">Already have an Account?<a href="userlogin.php">Login</a></p>
                                <!-- <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p> -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

</body>