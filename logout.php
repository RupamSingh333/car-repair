<?php
ob_start();
session_start();
// include 'webadmin/config.php';

session_unset();
session_destroy();
// Redirect to login page
header("Location: https://usicly.com/login_user");
exit();
