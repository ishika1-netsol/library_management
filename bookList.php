<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
include("classes/Book.php");
$book = new Book();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" a href="CSS/bootstrap.css" />
    <title>View Books</title>
</head>

<body>
    <a href="user_list.php">User List</a>
    <a href="bookForm.php">ADD BOOK</a>
    <div class="container">
       
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <table class="table table-bordered">
                        <tr>
                            <td> Book ID </td>
                            <td> Name </td>
                            <td> AuthorName </td>
                            <td> Book Image</td>
                            <td> Status </td>
                            <td> quantity </td>
                            <td> Created_at </td>
                            <td> Updated_at </td>
                            <td> Edit </td>
                            <td> Delete </td>
                        </tr>

                        <?php
                        $result = $book->fetchBook();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $BookID = $row['id'];
                                $BookName = $row['name'];
                                $AuthorName = $row['author_name'];
                                $BookImage  = $row['image'];
                                $BookStatus = $row['status'];
                                $BookQuantity = $row['quantity'];
                                $Created_at = $row['created_at'];
                                $Updated_at = $row['updated_at'];
                        ?>
                                <tr>

                                    <td><?php echo $BookID ?></td>
                                    <td><?php echo $BookName ?></td>
                                    <td><?php echo $AuthorName ?></td>
                                    <td><?php echo ("<img src='img/" . $row['image'] . "' height=80px; width=60px: />") ?></td>
                                    <td><?php
                                        if ($BookStatus == '1') {
                                            echo "issued";
                                        } elseif ($BookStatus == '0') {
                                            echo "return";
                                        } ?></td>
                                    <td><?php echo $BookQuantity ?></td>
                                    <td><?php print date("h:i d-F-Y", strtotime($Created_at)) ?></td>
                                    <td><?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?></td>
                                    <td><a href="BookEdit.php?GetID=<?php echo $BookID ?>">Edit</a></td>
                                    <td><a href="BookDelete.php?Del=<?php echo $BookID ?>">Delete</a></td>
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


