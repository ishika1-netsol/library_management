<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: http://localhost/library%20system/userlogin.php");
    exit();
}
include("classes/User.php");
$user = new User();
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
                                <h4 class="card-title">User Table</h4>
                                <!-- <p class="card-description"> Add class <code>.table-dark</code> -->
                                </p>
                                <div class="table-responsive">
                                    <table class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th> User Name </th>
                                                <th> User Email</th>
                                                <th> User Status</th>
                                                <th> User Type </th>
                                                <th>Created_at </th>
                                                <th> Updated_at </th>
                                                <th>Edit </th>
                                                <th> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody>         
                                            <?php
                                            $number = 1;
                                            $result = $user->fetchUser();

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $UserID = $row['id'];
                                                    $UserName = $row['name'];
                                                    $UserEmail = $row['email'];
                                                    $UserStatus = $row['status'];
                                                    $UserType = $row['user_type'];
                                                    $Created_at = $row['created_at'];
                                                    $Updated_at = $row['updated_at'];
                                            ?>
                                                    <tr>
                                                        <td><?php echo $number ?></td>
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
                                                        <td><a href="userEdit.php?GetID=<?php echo $UserID ?>">Edit</a></td>
                                                        <td><a href="delete.php?Del=<?php echo $UserID ?>">Delete</a></td>
                                                    </tr>
                                            <?php
                                                    $number++;
                                                }
                                            } else {
                                                echo "NO RECORDS";
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
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com
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