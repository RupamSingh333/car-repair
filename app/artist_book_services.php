<?php
include("system_config.php");
$url_return = SITEPATH;

// pr($_POST);die;



$dates = date('Y-m-d');
$desc = mysqli_real_escape_string($link, $_REQUEST["user_desc"]);
$sql = "INSERT into customer (user_email,first_name,cat_id,user_startfrom,user_phone,user_pass,user_district,user_state,user_tel,user_address,user_logo,user_status,user_desc,f_date,a_id,login_id,cat_type) values ('" . $_REQUEST["user_email"] . "','" . $_REQUEST["first_name"] . "','" . $_REQUEST["cat_id"] . "','" . $dates . "','" . $_REQUEST['user_phone'] . "','MTIzNDU2','" . $_REQUEST['user_district'] . "','" . $_REQUEST["user_state"] . "','','" . $_REQUEST["user_address"] . "','','0','$desc','" . $_REQUEST["f_date"] . "','" . $_REQUEST["a_id"] . "','" . $_REQUEST["login_id"] . "','" . $_REQUEST["cat_type"] . "')";

if (mysqli_query($link, $sql)) {
	$name = $_REQUEST["first_name"];
	$user_phone = $_REQUEST['user_phone'];
	$user_district = $_REQUEST["user_district"];
	$pagetype = $config['pagetype'][$_REQUEST["cat_type"]];

	$request = "";
	$param['username'] = "usicly";
	$param['password'] = "123456";
	$param['senderid'] = "USICLY";
	$param['route'] = "7";
	$param['templateid'] = "1207168121232139568";
	$param['number'] = "91" . $_REQUEST['user_phone'];
	$param['message'] = "Thanks $name
Thank you for filling out our sign up form. Someone from our customer care team will get in touch within 24 hours.
codelabsindia
USICLY";
	foreach ($param as $key => $val) {
		$request .= $key . "=" . urlencode($val);
		$request .= "&";
	}
	$request = substr($request, 0, strlen($request) - 1);
	$url = "http://sms.codelabsindia.com/http-api.php?" . $request;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);

	$request = "";
	$param['username'] = "usicly";
	$param['password'] = "123456";
	$param['senderid'] = "USICLY";
	$param['route'] = "7";
	$param['templateid'] = "1207168234130023870";
	$param['number'] = "917414056370";
	$param['message'] = "Customer Name : $name
Mobile No. : $user_phone
Details: $user_district $pagetype Books
USICLY
codelabsindia";
	foreach ($param as $key => $val) {
		$request .= $key . "=" . urlencode($val);
		$request .= "&";
	}
	$request = substr($request, 0, strlen($request) - 1);
	$url = "http://sms.codelabsindia.com/http-api.php?" . $request;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);


?>
<script type="text/javascript" language="javascript">
alert("Thank you for filling our form.We’ll get back to you very soon.");
window.location.href = '<?php echo "https://" . $_SERVER["HTTP_HOST"] ?>';
</script>
<?php
} else {
?>
<script type="text/javascript" language="javascript">
alert("error!");
window.location.href = '<?php echo "https://" . $_SERVER["HTTP_HOST"] ?> ';
</script>
<?php } ?>