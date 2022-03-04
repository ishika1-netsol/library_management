<?php

// require_once("db.php");
include 'classes/User.php';
$user = new User();
if (isset($_GET['GetID'])) {
    $UserID = $_GET['GetID'];
    // $query = " select * from users where id ='" . $UserID . "'";
    // $result = mysqli_query($conn, $query);
    $result = $user->editUser($UserID);
    //  echo $result;
    while ($row = $result->fetch_assoc()) {
        $UserID = $row['id'];
        $UserName = $row['name'];
        $UserEmail = $row['email'];
        // $UserPassword = $row['password'];
        $UserStatus = $row['status'];
        $UserType = $row['user_type'];
        $Created_at = $row['created_at'];
        $Updated_at = $row['updated_at'];

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" a href="CSS/bootstrap.css" />
            <title>Document</title>
        </head>

        <body>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card mt-5">
                            <div class="card-title">
                                <h3 class="bg-success text-white text-center py-3"> Update Form in PHP</h3>
                            </div>
                            <div class="card-body">

                                <form action="update.php?ID=<?php echo $UserID ?>" method="post">
                                    <input type="text" class="form-control mb-2" placeholder=" User Name " name="name" value="<?php echo $UserName ?>">
                                    <input type="email" class="form-control mb-2" placeholder=" User Email " name="email" value="<?php echo $UserEmail ?>">

                                    <p>select user_status:</p>
                                    <input type="radio" id="active" name="status" value="1" <?php if ($UserStatus == "1") {
                                                                                                echo "checked";
                                                                                            } ?>>
                                    <label for="active">active</label>
                                    <input type="radio" id="inactive" name="status" value="0" <?php if ($UserStatus == "0") {
                                                                                                    echo "checked";
                                                                                                } ?>>
                                    <label for="inactive">inactive</label>
                                    <br>
                                    <label for="user_type">Choose a user:</label>
                                    <select id="user_type" name="user_type">
                                        <option value="student" <?php if ($UserType == "student") {
                                                                    echo "selected";
                                                                } ?>>student</option>
                                        <option value="admin" <?php if ($UserType == "admin") {
                                                                    echo "selected";
                                                                } ?>>admin</option>
                                    </select>
                                    <br>
                                    <input type="text" class="form-control mb-2" placeholder=" Created_at " name="created_at" value="<?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?>" disabled>
                                    <input type="text" class="form-control mb-2" placeholder=" Updated_at " name="updated_at" value="<?php print date(" h:i d-F-Y", strtotime($Created_at))?> " disabled>
                                    <button class="btn btn-primary" name="update">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </body>

        </html>
<?php
    }
}
?>