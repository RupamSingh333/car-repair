<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../Category/index.php";
switch ($action) {
	case "save":
		$field = array();
		$field['user_id'] = get_safe_post('user_id');
		// $field['p_cat'] = "0";
		$field['services_type'] = get_safe_post('services_type');
		$field['cat_sub'] = get_safe_post('cat_sub');
		$field['cat_name'] = get_safe_post('cat_name');
		$field['cat_description'] = get_safe_post('cat_description');
		$field['url'] = get_safe_post('url');
		$field['yurl'] = get_safe_post('yurl');
		$field['p_range'] = get_safe_post('p_range');
		$field['mrp'] = get_safe_post('mrp');
		$field['cat_startfrom'] = date('Y-m-d H:i:s');
		$field['cat_status'] = get_safe_post('display_status');
		$field['sort'] = get_safe_post('sort');
		$field['pagetype'] = get_safe_post('pagetype');
		$field['times'] = get_safe_post('times');
		$field['dropdown'] = get_safe_post('dropdown');

		$field['formate'] = get_safe_post('formate');
		$img_name = "";
		if ($_FILES["logo"]["error"] == 0) {
			$img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["logo"]["name"]));
			move_uploaded_file($_FILES["logo"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
		}
		if ((isset($_FILES["logo"])) && !empty($img_name)) {
			$field['logo'] = $img_name;
		}
		// handle this
		$icon_name = "";
		if ($_FILES["icon"]["error"] == 0) {
			$icon_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["icon"]["name"]));
			$target_path = "../../" . $config['category_thumb'] . $icon_name;

			// Check file type and size
			$image_type = exif_imagetype($_FILES["icon"]["tmp_name"]);
			if (in_array($image_type, [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF]) && $_FILES["icon"]["size"] <= 500000) { // 500KB limit
				move_uploaded_file($_FILES["icon"]["tmp_name"], $target_path);
			} else {
				echo "Unsupported file type or file too large.";
				exit;
			}
		}

		if ((isset($_FILES["icon"])) && !empty($icon_name)) {
			$field['icon'] = $icon_name;
		}

		$primary_value = get_safe_post('data_id');

		$output =  save_command(tbl_categories, $field, "cat_id", $primary_value);
		// echo 'sdfsdf';die;
		$_SESSION['msg'] = $output;

		break;

	case "del":
		$field = array();
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_categories, "cat_id", $primary_value, false);
		$_SESSION['message'] = $output;
		break;

	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getCategory_byID($id);
			$st = $row['cat_status'];
		}
		if ($st == "0") {
			$status = "1";
		} else {
			$status = "0";
		}
		$field['cat_status'] = $status;
		$primary_value = $id;
		$output =  save_command(tbl_categories, $field, "cat_id", $primary_value);
		$_SESSION['msg'] = $output;

		break;
}
header("Location:" . $url_return);
