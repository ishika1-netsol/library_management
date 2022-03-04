<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}

//Databse Connection file
require_once('classes/Book.php');
$book = new Book();

if (isset($_POST['create'])) {
    $bookName = $_POST['name'];
    $authorName = $_POST['authorName'];
    $target = "img/" . basename($_FILES['image']['name']); //foldername
    $image = $_FILES['image']['name']; // stored 
    //     if($_FILES["image"]["error"] === 4){
    //       echo"<script>alert('image not exist');</script>";
    //     }else{
    //       $filename =$_FILES["image"]["name"];
    //       $fileSize = $_FILES["image"]["size"];
    //       $tmpName = $_FILES["image"]["tmp_name"];


    //       $validImageExtension = ['jpg','jpeg','png'];
    //       $imageExtension = explode('.',$filename);
    //       $imageExtension = strtolower(end($imageExtension));
    // if(!in_array($imageExtension,$validImageExtension)){
    //   echo 
    //   "<script>alert('invalid image extension');</script>";
    // }else if ($filesize > 1000000){
    //   echo "<script>alert(' image size is too large');</script>";
    // }
    // else{
    //   $newImageName = uniqid();
    //   $newImageName.='.'.$imageExtension;

    // }
    //   } 
    // }

    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $query = $book->insertBook($bookName, $authorName, $image, $status, $quantity);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "image uploaded successfully";
    } else {
        $msg = "Error in image uploading";
    }
    if ($query) {
        // echo 'You have successfully inserted the data';
        header("Location: http://localhost/library%20system/bookList.php");
    } else {
        echo 'Something Went Wrong. Please try again';
    }
}

// mysqli_close($conn);
?>




<!DOCTYPE html>
<html>

<head>
    <title>BOOK FORM</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>
    <div>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h1> BOOK FORM</h1>
                        <hr class="mb-3">
                        <label for="name"><b>BookName<b></label>
                        <input class="form-control" type="text" name="name" required>

                        <label for="authorName"><b>AuthorName<b></label>
                        <input class="form-control" type="text" name="authorName" required>

                        <input type="file" name="image" id="image" value="">
                        <br><br>
                        <p>select user_status:</p>
                        <input type="radio" id="issued" name="status" value="0">
                        <label for="active">issued</label>
                        <input type="radio" id="return" name="status" value="1">
                        <label for="inactive">return</label>
                        <br>
                        <label for="quantity"><b>quantity<b></label>
                        <input class="form-control" type="text" name="quantity" required>
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