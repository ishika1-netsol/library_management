<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/login.php");
    exit();
}
include("classes/Book.php");
$book = new Book();
?>
<?php
require_once("header.php");
?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        <?php
        require_once("sideBar.php");
        require_once("navbar.php");
        ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">                              
                                <form method="post" action="bookExport.php">
                                    <input type="submit" name="export" value="CSV Export" class="btn btn-primary" />
                                </form>
                                <h4 class="card-title"> User Book Table</h4>                          
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th> Book ID </th>
                                                <th> Name </th>
                                                <th> AuthorName </th>
                                                <th> Book Image</th>
                                                <th> Status </th>
                                                <th> quantity </th>
                                                <th> Created_at </th>
                                                <th> Updated_at </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_GET['search'])) {
                                                $filterValue = $_GET['search'];
                                                $search = $book->searchBook($filterValue);
                                                
                                                $_SESSION['value'] = $filterValue;
                                                if ($search->num_rows > 0) {
                                                    while ($row = $search->fetch_assoc()) {
                                                        $BookID = $row['id'];
                                                        $BookName = $row['book_name'];
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

                                                        </tr>
                                            <?php
                                                    }
                                                } else {
                                                    echo "NO RECORDS";
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ?? bootstrapdash.com
                            2020</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin
                                templates</a> from Bootstrapdash.com</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
</body>

</html>