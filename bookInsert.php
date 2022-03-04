<?php 
//Databse Connection file
require_once('classes/Book.php');
$book = new Book();

if(isset($_POST['create']))
  {
    $bookName=$_POST['name'];
    $authorName=$_POST['authorName'];
  $target = "img/" . basename($_FILES['image']['name']);
  $image = $_FILES['image']['name'];
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

    $status=$_POST['status'];
   $query = "hi";
    // $query = $book->insertBook($bookName, $authorName,$image, $status);
    echo $query;
    die();
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $msg = "image uploaded successfully";
  } else {
    $msg = "Error in image uploading";
  }  
     if ($query) {
    echo 'You have successfully inserted the data';
  }
  else
    {
      echo 'Something Went Wrong. Please try again';
    }
}
  // header("Location: http://localhost/library%20system/bookList.php");
  // mysqli_close($conn);
?>