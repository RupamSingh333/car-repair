<?php
include("../../system_config.php");
$action = get_safe_get('action');
$url_return = "../Fourm/index.php";
switch ($action) {
    case "save":
         $field = array();
         $field['user_state'] = get_safe_post('user_state');
		  $field['user_district'] = get_safe_post('user_district');
		   $field['cat_id'] = get_safe_post('cat_id');
		    $field['fourm_name'] = get_safe_post('fourm_name');
		 $field['fourm_description'] = get_safe_post('fourm_description');
		 $field['fourm_status'] = get_safe_post('fourm_status');
		 $field['user_id'] = get_safe_post('user_id');
		  $img_name = "";
            if ($_FILES["images"]["error"] == 0) {
                $img_name = time() . "_" . strtolower(str_replace(" ", "_", $_FILES["images"]["name"]));
                move_uploaded_file($_FILES["images"]["tmp_name"], "../../" . $config['category_thumb'] . $img_name);
            }
            if ((isset($_FILES["images"])) && !empty($img_name)) {
                $field['fourm_img'] = $img_name;
            }
		 $primary_value = get_safe_post('data_id');
		  if($primary_value!="")
		 {
			$field['fourm_endat'] = date('Y-m-d H:i:s'); 
			$field['fourm_new_dec'] = get_safe_post('fourm_new_dec');	
		 }
		 else
		 {
			  $field['fourm_startfrom'] = date('Y-m-d H:i:s');	
		 }
         $output =  save_command(tbl_fourm, $field, "fourm_id", $primary_value);
        // echo 'sdfsdf';die;
         $_SESSION['msg'] = $output;
         
        break;
   
case "del":
		$field = array();
        $primary_value = urlencode(decryptIt(get_safe_get('id')));
		$output =  del_command(tbl_fourm, "fourm_id", $primary_value,false);
        $_SESSION['message'] = $output;
        break;
  
case "status":
			if(isset($_GET['id']))
			{
			  $id=urlencode(decryptIt($_GET['id']));
			  $row = getfourm_byID($id);
			  $st=$row['fourm_status'];
			}
			if($st=="0")
			{
				$status="1";
			}
			else
			{
				$status="0";
			}
		 $field['fourm_status'] = $status;
		 $primary_value =$id;
         $output =  save_command(tbl_fourm,$field,"fourm_id",$primary_value);
         $_SESSION['msg'] = $output;
		 
        break;

}
header("Location:".$url_return);
?>