<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../News/index.php";
switch ($action) {
    case "save":
         $field = array();
         $field['user_state'] = get_safe_post('user_state');
		  $field['user_district'] = get_safe_post('user_district');
		   $field['cat_id'] = get_safe_post('cat_id');
		    $field['news_name'] = get_safe_post('news_name');
		 $field['news_description'] = get_safe_post('news_description');
		 $field['news_status'] = get_safe_post('news_status');
		 $field['news_startfrom'] = date('Y-m-d H:i:s');
		  $img_name = "";
            if ($_FILES["images"]["error"] == 0) {
                $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["images"]["name"]));
                move_uploaded_file($_FILES["images"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
            }
            if ((isset($_FILES["images"])) && !empty($img_name)) {
                $field['url_link'] = $img_name;
            }
		 $primary_value = get_safe_post('data_id');
		 
         $output =  save_command(tbl_news, $field, "news_id", $primary_value);
        // echo 'sdfsdf';die;
         $_SESSION['msg'] = $output;
         
        break;
   
case "del":
		$field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_news, "news_id", $primary_value,false);
        $_SESSION['message'] = $output;
        break;
  
case "status":
			if(isset($_GET['id']))
			{
			  $id=urlencode(decryptIt($_GET['id']));
			  $row = getnews_byID($id);
			  $st=$row['news_status'];
			}
			if($st=="0")
			{
				$status="1";
			}
			else
			{
				$status="0";
			}
		 $field['news_status'] = $status;
		 $primary_value =$id;
         $output =  save_command(tbl_news,$field,"news_id",$primary_value);
         $_SESSION['msg'] = $output;
		 
        break;

}
header("Location:".$url_return);
?>