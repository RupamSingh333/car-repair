<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../booking/";

switch ($action) {
	case "save":
		$field = array();

		$field['user_email'] = get_safe_post('user_email');
		$field['cat_id'] = get_safe_post('cat_id');
		$field['a_id'] = get_safe_post('a_id');
		$field['f_date'] = get_safe_post('f_date');

		$field['first_name'] = get_safe_post('first_name');
		$field['user_phone'] = get_safe_post('user_phone');
		$field['user_district'] = get_safe_post('user_district');
		$field['user_state'] = get_safe_post('user_state');
		$field['user_address'] = get_safe_post('user_address');
		$field['user_startfrom'] = date('Y-m-d H:i:s');
		$field['user_pass'] = encryptIt('123456');
		$field['user_desc'] = get_safe_post('user_desc');
		$field['cat_type'] = get_safe_post('cat_type');
		
		$img_name = "";
		if ($_FILES["user_logo"]["error"] == 0) {
			$img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_logo"]["name"]));
			move_uploaded_file($_FILES["user_logo"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
		}
		if ((isset($_FILES["user_logo"])) && !empty($img_name)) {
			$field['user_logo'] = $img_name;
		}

		$field['user_status'] = get_safe_post('user_status');
		$primary_value = get_safe_post('data_id');

		$output =  save_command(tbl_customer, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;
		break;


	case "del":
		$field = array();
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_customer, "user_id", $primary_value, false);
		$_SESSION['message'] = $output;
		break;


	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getcustomer_byID($id);
			$st = $row['user_status'];
		}
		if ($st == "0") {
			$status = "1";
		} else {
			$status = "0";
		}
		$field['user_status'] = $status;
		$primary_value = $id;
		$output =  save_command(tbl_customer, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;

		break;
}
header("Location:" . $url_return);
