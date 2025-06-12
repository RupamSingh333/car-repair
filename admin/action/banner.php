<?php
include("../../system_config.php");

$action = get_safe_get('action');
$url_return = "../banner/index.php";

switch ($action) {
	case "save":
		$field = array();
		$field['banner_name'] = trim(get_safe_post('title'));
		$field['banner_paragraph'] = trim(get_safe_post('paragraph')); // <-- Add paragraph field
		$field['banner_startfrom'] = date('Y-m-d');
		$field['banner_status'] = get_safe_post('select');
		$field['banner_type'] = get_safe_post('banner_type');

		$primary_value = get_safe_post('data_id');
		$img_name = "";

		if (isset($_FILES["images"]) && $_FILES["images"]["error"] == 0) {
			// Clean file name
			$original_name = $_FILES["images"]["name"];
			$ext = pathinfo($original_name, PATHINFO_EXTENSION);
			$base_name = pathinfo($original_name, PATHINFO_FILENAME);
			$clean_name = preg_replace('/[^a-zA-Z0-9\-]/', '_', strtolower($base_name));
			$img_name = time() . "_" . $clean_name . "." . $ext;

			// Delete old image if editing
			if (!empty($primary_value)) {
				$oldData = getbanner_byID($primary_value);
				if (!empty($oldData['banner_img'])) {
					$oldPath = "../../" . $config['category_thumb'] . $oldData['banner_img'];
					if (file_exists($oldPath)) {
						unlink($oldPath);
					}
				}
			}

			// Upload new image
			move_uploaded_file($_FILES["images"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
			$field['banner_img'] = $img_name;
		}

		// Save to DB
		$output = save_command(tbl_banner, $field, "banner_id", $primary_value);
		$_SESSION['msg'] = $output;
		break;

	case "del":
		$primary_value = urlencode(decryptIt(get_safe_get('id')));
		$row = getbanner_byID($primary_value);

		// Delete image file if exists
		if (!empty($row['banner_img'])) {
			$image_path = "../../" . $config['category_thumb'] . $row['banner_img'];
			if (file_exists($image_path)) {
				unlink($image_path);
			}
		}

		// Delete banner from DB
		$output = del_command(tbl_banner, "banner_id", $primary_value, false);
		$_SESSION['message'] = $output;
		break;


	case "status":
		if (isset($_GET['id'])) {
			$id = urlencode(decryptIt($_GET['id']));
			$row = getbanner_byID($id);
			$status = ($row['banner_status'] == "0") ? "1" : "0";
			$field['banner_status'] = $status;
			$output = save_command(tbl_banner, $field, "banner_id", $id);
			$_SESSION['msg'] = $output;
		}
		break;
}

header("Location:" . $url_return);
