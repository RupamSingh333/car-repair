<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../user/";
// pr($_POST);die;

switch ($action) {
	case "save":
		$field = array();

		// pr($_SESSION);exit;

		if ($_SESSION['AdminLogin'] == 1) {
			$field['user_email'] = get_safe_post('user_email');
		}
		$field['first_name'] = get_safe_post('first_name');
		$field['cat_id'] = get_safe_post('cat_id');
		$field['user_startfrom'] = date('Y-m-d H:i:s');
		$field['user_phone'] = get_safe_post('user_phone');
		$field['user_pass'] = encryptIt(get_safe_post('confirm_password'));
		$field['user_district'] = get_safe_post('user_district');
		$field['user_state'] = get_safe_post('user_state');
		$field['user_tel'] = get_safe_post('user_tel');
		$field['user_type'] = get_safe_post('user_type');
		$field['user_address'] = get_safe_post('user_address');
		$field['user_desc'] = get_safe_post('user_desc');
		$field['note'] = get_safe_post('note');
		$field['short_desc'] = get_safe_post('short_desc');
		$field['home_show'] = get_safe_post('home_show');

		$field['cat_type'] = get_safe_post('cat_type');
		$img_name = "";
		if ($_FILES["user_logo"]["error"] == 0) {
			$img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_logo"]["name"]));
			move_uploaded_file($_FILES["user_logo"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
		}
		if ((isset($_FILES["user_logo"])) && !empty($img_name)) {
			$field['user_logo'] = $img_name;
		}

		$img_name2 = "";
		if ($_FILES["user_video"]["error"] == 0) {
			$img_name2 = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["user_video"]["name"]));
			move_uploaded_file($_FILES["user_video"]["tmp_name"], "../../" . $config['category_video'] . $img_name2);
		}
		if ((isset($_FILES["user_video"])) && !empty($img_name2)) {
			$field['user_video'] = $img_name2;
		}

		if (isset($_POST['listing']) && is_array($_POST['listing'])) {
			$feature_list = array_map('trim', $_POST['listing']); // Trim each listing entry
			$feature_list = array_filter($feature_list, function ($item) {
				return !empty($item); // Remove empty entries
			});
			$field['listing'] = implode(',', $feature_list);
		} else {
			$field['listing'] = ''; // If no features are provided, save an empty string
		}

		$field['user_status'] = get_safe_post('user_status');
		$primary_value = get_safe_post('data_id');

		$output =  save_command(tbl_user, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;
		break;


	case "del":
		$field = array();
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_user_permission, "user_id", $primary_value, false);
		$output =  del_command(tbl_user, "user_id", $primary_value, false);
		$_SESSION['msg'] = $output;
		$_SESSION['msg_type'] = 'success';
		// redirect refferance url 
		header('Location: ' . $_SERVER['HTTP_REFERER']);exit;
		break;


	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getuser_byID($id);
			$st = $row['user_status'];
		}
		if ($st == "0") {
			$status = "1";
		} else {
			$status = "0";
		}
		$field['user_status'] = $status;
		$primary_value = $id;
		$output =  save_command(tbl_user, $field, "user_id", $primary_value);
		$_SESSION['msg'] = $output;

		break;
}
header("Location:" . $url_return);
