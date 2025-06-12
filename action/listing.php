<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../web/my_listing";
// pr($_POST);die;
switch ($action) {
    case "save":
        $field = array();
// pr($_POST);die;

        $field['title'] = get_safe_post('title');
        $field['message'] = get_safe_post('message');
        $field['categoryID'] = get_safe_post('categoryID');
        $field['galleryId'] = get_safe_post('galleryId');
        $field['email'] = get_safe_post('email');
        $field['website_url'] = get_safe_post('website_url');
        $field['phone'] = get_safe_post('phone');
        $field['packageId'] = get_safe_post('packageId');
        $field['status'] = get_safe_post('status');
        $field['tag'] = get_safe_post('tag');
        $field['userid'] = get_safe_post('userid'); 
        $img_name = "";
        if ($_FILES["image"]["error"] == 0) {
            $img_name =  time() . "_" . strtolower(str_replace(" ", "_", $_FILES["image"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "/upload/image" . $config['game_image'] . $img_name);
            move_uploaded_file($_FILES["image"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name);
        }

        if (!empty($img_name)) {
            $field['image'] = $img_name;
        }
        $img_name1 = "";
        if ($_FILES["logo"]["error"] == 0) {
            $img_name1 =  time() . "_" . strtolower(str_replace(" ", "_", $_FILES["logo"]["name"]));
            // move_uploaded_file($_FILES["image"]["tmp_name"], "/upload/image" . $config['game_image'] . $img_name1);
            move_uploaded_file($_FILES["logo"]["tmp_name"], "../../upload/image/" . $config['game_image'] . $img_name1);
        }

        if (!empty($img_name1)) {
            $field['logo'] = $img_name1;
        }
        $primary_value = get_safe_post('data_id');



        $output =  save_command(tbl_listing, $field, "id", $primary_value);
        $_SESSION['msg'] = $output;
        break;

    case "del":
        $field = array();
      //  pr($_POST);die;
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
        $output =  del_command(tbl_listing, "id", $primary_value, false);
        $_SESSION['msg'] = $output;
        break;
}
header("Location:" . $url_return);
