<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
unset($_SESSION["user_type"]);
unset($_SESSION["status"]);
session_destroy();
header("Location:userlogin.php");
?>