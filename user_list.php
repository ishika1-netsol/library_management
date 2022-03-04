<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
include("classes/User.php");
$user = new User();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/bootstrap.css" />
    <title>View Users</title>
</head>

<body>
    <a href="bookList.php">Book List</a>
    <a href="Forms.php">ADD User</a>
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <table class="table table-bordered">
                        <tr>
                            <!-- <td> User ID </td> -->
                            <td> User Name </td>
                            <td> User Email </td>
                            <!-- <td> User Password </td> -->
                            <td> User Status </td>
                            <td> User Type </td>
                            <td> Created_at </td>
                            <td> Updated_at </td>
                            <td> Edit </td>
                            <td> Delete </td>
                        </tr>

                        <?php
                        $result = $user->fetchUser();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $UserID = $row['id'];
                                $UserName = $row['name'];
                                $UserEmail = $row['email'];
                                // $UserPassword  = $row['password'];
                                $UserStatus = $row['status'];
                                $UserType = $row['user_type'];
                                $Created_at = $row['created_at'];
                                $Updated_at = $row['updated_at'];
                        ?>
                                <tr>

                                    <td><?php echo $UserName ?></td>
                                    <td><?php echo $UserEmail ?></td>

                                    <td><?php
                                        if ($UserStatus == '1') {
                                            echo "active";
                                        } elseif ($UserStatus == '0') {
                                            echo "inactive";
                                        } ?></td>
                                    <td><?php echo $UserType ?></td>
                                    <td><?php print date("h:i d-F-Y", strtotime($Created_at)) ?></td>
                                    <td><?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?></td>
                                    <td><a href="edit.php?GetID=<?php echo $UserID ?>">Edit</a></td>
                                    <td><a href="delete.php?Del=<?php echo $UserID ?>">Delete</a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "NO RECORDS";
                        }
                        ?>


                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>