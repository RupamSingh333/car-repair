<?php 
include($_SERVER['DOCUMENT_ROOT'] . "/car-repair/system_config.php");
session_start();
session_destroy();
header("Location:" . SITEPATH . "admin/");
