<?php
include("system_config.php");
$url_return = SITEPATH . 'index.php';
$userName = $_REQUEST['userName'];
$userEmail = $_REQUEST['userEmail'];
$userPhone = $_REQUEST['userPhone'];
$dates = date('Y-m-d');
$userMsg = mysqli_real_escape_string($link, $_REQUEST["userMsg"]);

$sql = "INSERT INTO `contactus` (`contactus_id` ,`name` ,`email` ,`telephone` ,`comment` ,`contact_createdon` ,`contact_updatedon` ,`isdeleted` ,`status` ,
`address`)VALUES (NULL , '" . $userName . "', '" . $userEmail . "', '" . $userPhone . "', '" . $userMsg . "', '" . $dates . "', '', '0', '1', '');";
//echo 	$sql;die();



if (mysqli_query($link, $sql)) {
?>
<?php

	$_SESSION['msg_type'] = 'success';
	$_SESSION['msg'] = 'Thank you for filling our form.We’ll get back to you very soon.';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
?>
<?php
} else {
?>
<?php

	$_SESSION['msg'] = 'Try again.';
	$_SESSION['msg_type'] = 'error';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
?>
<?php } ?>