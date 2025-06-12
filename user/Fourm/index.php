<?php 
include("../../system_config.php");
include_once("../common/head.php");
if($r['user_type']=="1")
{
	$rows_list = getfourm_list();
}
else
{
	$rows_list = getfourm_byID_user($_SESSION['userLogin']);
}


?>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>View All Fourm </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>user/dashboard.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">View All Category</li>
      </ol>
    </section>
    <section class="content">
      <h1 align="center" style="color: #337ab7;"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></h1>
      <div class="table-responsive" style="overflow-x: auto;">
        <table id="exportable" align="center" class="table table-bordered table-condensed table-hover">
          <thead>
            <tr>
              <td><strong>Sr no</strong></td>
              <td><strong>Image</strong></td>
              <td><strong>Customer Name</strong></td>
              <td><strong>Question</strong></td>
              <td><strong>State</strong></td>
              <td><strong>District</strong></td>
              <td><strong>Category</strong></td>
              <td><strong>Create Date</strong></td>
               <td><strong>Modified Date</strong></td>
              <td><strong>Action</strong></td>
            
            </tr>
          </thead>
          <tbody>
            <?php 
$i=1;
foreach ($rows_list as $rows) { 
$parts=explode(",",$rows['p_cat']);
$resvvv = getCategory_byID($rows['cat_id']);
$ress = getdistrict_byID($rows['user_district']);
	$res = getState_byID($rows['user_state']);
	$resuser = getcustomer_byID($rows['user_id']);

?>
            <tr>
              <td><?php echo $i; ?></td>
              <td ><img src="<?php  echo SITEPATH;?>/upload/thumb/<?php  echo $rows['fourm_img']; ?>" width="80px"  height="50px"></td>
              <td ><?php  echo $rows['fourm_name']; ?></td>
              <td ><?php  echo $resuser['first_name']; ?></td>
              <td ><?php  echo $res['stateName']; ?></td>
              <td ><?php  echo $ress['district_name']; ?></td>
              <td ><?php  echo $resvvv['cat_name']; ?></td>
              <td ><?php echo $rows['fourm_startfrom']; ?></td>
              <td ><?php echo $rows['fourm_endat']; ?></td>
              <td id="font12" width="20%">
                <a href="<?php  echo SITEPATH;?>/user/action/fourm.php?action=status&id=<?php echo  urlencode(encryptIt($rows['fourm_id'])); ?>"<?php if($rows['fourm_status']=="0"){ ?> onMouseOver="showbox('active<?php echo $i;?>')" onMouseOut="hidebox('active<?php echo $i;?>')" ><i class="fa fa-angle-double-up"></i>
                <?php }else{?>
                onMouseOver="showbox('inactive<?php echo $i;?>')" onMouseOut="hidebox('inactive<?php echo $i;?>')"> <i class="fa fa-angle-double-down"></i>
                <?php }?>
                </a>
                <div id="active<?php echo $i;?>" class="hide1">
                  <p>Active</p>
                </div>
                <div id="inactive<?php echo $i;?>" class="hide1">
                  <p>Inactive</p>
                </div>
                &nbsp;&nbsp; <a href="<?php echo SITEPATH; ?>/user/Fourm/add_new_Fourm_page.php?id=<?php echo  urlencode(encryptIt($rows['fourm_id'])); ?>"onMouseOver="showbox('Edit<?php echo $i;?>')"  onMouseOut="hidebox('Edit<?php echo $i;?>')"> <i class="fa fa-pencil"></i></a>
                <div id="Edit<?php echo $i;?>" class="hide1">
                  <p>Edit</p>
                </div>
                &nbsp;&nbsp;
              
               
                <a href="<?php  echo SITEPATH;?>/user/action/fourm.php?action=del&id=<?php echo  urlencode(encryptIt($rows['fourm_id'])); ?>"onClick="return confirmDelete();" onMouseOver="showbox('Delete<?php echo $i;?>')" onMouseOut="hidebox('Delete<?php echo $i;?>')"><i class="fa fa-times"></i></a>
                <div id="Delete<?php echo $i;?>" class="hide1">
                  <p>Delete</p>
                </div>
              </td>
             
            </tr>
            <?php 
$i++;
} ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <?php include_once("../common/copyright.php");?>
  </footer>
</div>
<?php include_once("../common/footer.php");?>
</body>
</html>