<?php
// require_once("db.php");
include 'classes/Book.php';
$book = new Book();
if (isset($_GET['GetID'])) {
    $BookID = $_GET['GetID'];
    // $query = " select * from users where id ='" . $UserID . "'";
    // $result = mysqli_query($conn, $query);
    $result = $book->editBook($BookID);
    //  echo $result;
    while ($row = $result->fetch_assoc()) {
        $bookID = $row['id'];
        $bookName = $row['name'];
        $authorName = $row['author_name'];
        // $UserPassword = $row['password'];
        $bookStatus = $row['status'];
        $bookQuantity = $row['quantity'];
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

                                <form action="BookUpdate.php?ID=<?php echo $bookID ?>" method="post">
                                    <input type="text" class="form-control mb-2" placeholder=" Book Name " name="name" value="<?php echo $bookName ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" Author Name " name="author_name" value="<?php echo $authorName ?>">

                                    <p>select user_status:</p>
                                    <input type="radio" id="issued" name="status" value="1" <?php if ($bookStatus == "1") {
                                                                                                echo "checked";
                                                                                            } ?>>
                                    <label for="issued">issued</label>
                                    <input type="radio" id="return" name="status" value="0" <?php if ($bookStatus == "0") {
                                                                                                echo "checked";
                                                                                            } ?>>
                                    <label for="return">return</label>
                                    <br>
                                    <input type="text" class="form-control mb-2" placeholder="quantity" name="quantity" value="<?php echo $bookQuantity ?>">
                                    <input type="text" class="form-control mb-2" placeholder=" Created_at " name="created_at" value="<?php print date(" h:i d-F-Y", strtotime($Created_at)) ?>" disabled>
                                    <input type="text" class="form-control mb-2" placeholder=" Updated_at " name="updated_at" value="<?php print date(" h:i d-F-Y", strtotime($Updated_at)) ?> " disabled>
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