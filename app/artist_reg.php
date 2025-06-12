<?php
include("system_config.php");
$url_return = SITEPATH . 'index.php';

// print_r($_POST);
// die;
$queryu = "SELECT * FROM reg_user where user_email = '" . $_REQUEST["user_email"] . "' ";
$resultu = mysqli_query($link, $queryu);
$rowcount = mysqli_num_rows($resultu);
if ($rowcount == 0) {
	if ($_FILES["user_logo"]["error"] == 0) {
		$img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_logo"]["name"]));
		move_uploaded_file($_FILES["user_logo"]["tmp_name"], "./" . $config['category_thumb'] . $img_name);
	}
	if ($_FILES["user_video"]["error"] == 0) {
		$img_name2 = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_video"]["name"]));
		move_uploaded_file($_FILES["user_video"]["tmp_name"], "./" . $config['category_thumb'] . $img_name2);
	}

	if ($_REQUEST["cat_type"] == "1") {
		$cat_id = $_REQUEST["cat_id2"];
	} else {
		$cat_id = $_REQUEST["cat_id1"];
	}
	$dates = date('Y-m-d');
	$user_desc = mysqli_real_escape_string($link, $_REQUEST["user_desc"]);

	if ($_REQUEST["confirm_password"] != $_REQUEST["user_pass"]) {
		$_SESSION['msg_type'] = 'error';
		$_SESSION['msg'] = 'Password and Confirm Password not match';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

	$encryptedPassword = encryptIt($_REQUEST["confirm_password"]);
	// pr($encryptedPassword);exit;

	if ($_REQUEST['user_type'] == 3) {
		// pr("if");die;
		$sql = "INSERT into reg_user (user_email,first_name,cat_id,user_startfrom,user_phone,user_pass,user_district,user_state,user_tel,user_address,user_logo,user_video,user_status,user_desc,cat_type, user_type) values ('" . $_REQUEST["user_email"] . "','" . $_REQUEST["first_name"] . "','" . $cat_id . "','" . $dates . "','" . $_REQUEST['user_phone'] . "','" . $encryptedPassword . "','" . $_REQUEST['user_district'] . "','" . $_REQUEST["user_state"] . "','" . $_REQUEST["user_tel"] . "','" . $_REQUEST["user_address"] . "','" . $img_name . "','" . $img_name2 . "','1','" . $user_desc . "','" . $_REQUEST["cat_type"] . "','" . $_REQUEST["user_type"] . "')";
		// pr($sql);die;
	} else {
		// pr("else");die;
		$sql = "INSERT into reg_user (user_email,first_name,cat_id,user_startfrom,user_phone,user_pass,user_district,user_state,user_tel,user_address,user_logo,user_video,user_status,user_desc,cat_type, user_type) values ('" . $_REQUEST["user_email"] . "','" . $_REQUEST["first_name"] . "','" . $cat_id . "','" . $dates . "','" . $_REQUEST['user_phone'] . "','" . $encryptedPassword . "','" . $_REQUEST['user_district'] . "','" . $_REQUEST["user_state"] . "','" . $_REQUEST["user_tel"] . "','" . $_REQUEST["user_address"] . "','" . $img_name . "','" . $img_name2 . "','0','" . $user_desc . "','" . $_REQUEST["cat_type"] . "','" . $_REQUEST["user_type"] . "')";
	}

	if (mysqli_query($link, $sql)) {

		$insert_id = mysqli_insert_id($link);
		// pr($insert_id);exit;


		// $name = $_REQUEST["first_name"];
		// $user_phone = $_REQUEST['user_phone'];
		// $user_district = $_REQUEST["user_district"];
		// $pagetype = $config['pagetype'][$_REQUEST["cat_type"]];

		// $request = "";
		// $param['username'] = "usicly";
		// $param['password'] = "123456";
		// $param['senderid'] = "USICLY";
		// $param['route'] = "7";
		// $param['templateid'] = "1207168121232139568";
		// $param['number'] = "91" . $_REQUEST['user_phone'];
		// $param['message'] = "Thanks $name\nThank you for filling out our sign up form. Someone from our customer care team will get in touch within 24 hours.\n	codelabsindia\nUSICLY";
		// foreach ($param as $key => $val) {
		// 	$request .= $key . "=" . urlencode($val);
		// 	$request .= "&";
		// }
		// $request = substr($request, 0, strlen($request) - 1);
		// $url = "http://sms.codelabsindia.com/http-api.php?" . $request;
		// $ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $curl_scraped_page = curl_exec($ch);
		// curl_close($ch);

		// $request = "";
		// $param['username'] = "usicly";
		// $param['password'] = "123456";
		// $param['senderid'] = "USICLY";
		// $param['route'] = "7";
		// $param['templateid'] = "1207168234130023870";
		// $param['number'] = "917414056370";
		// $param['message'] = "Customer Name : $name
		// Mobile No. : $user_phone
		// Details: $user_district $pagetype Reg.
		// USICLY
		// codelabsindia";
		// foreach ($param as $key => $val) {
		// 	$request .= $key . "=" . urlencode($val);
		// 	$request .= "&";
		// }
		// $request = substr($request, 0, strlen($request) - 1);
		// $url = "http://sms.codelabsindia.com/http-api.php?" . $request;
		// $ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $curl_scraped_page = curl_exec($ch);
		// curl_close($ch);

		// set here good message below
		$_SESSION['msg'] = 	"Thank you for filling our form.We’ll get back to you very soon.";
		$_SESSION['msg_type'] = 'success';
		$_SESSION['registerId'] = $insert_id;
		if ($_REQUEST['user_type'] == 0) {
			header('Location: login_user');
		} else {
			header('Location: checkout');
		}
		exit;
	} else {
		$_SESSION['msg_type'] = 'error';
		$_SESSION['msg'] = 'Please fill all the fields.';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	} ?>
<?php
} else {

	$_SESSION['msg_type'] = 'error';
	$_SESSION['msg'] = 'Your are already registered';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
	exit;
} ?>