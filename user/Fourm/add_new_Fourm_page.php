<?php 
include("../../system_config.php");
include_once("../common/head.php");

$name="Add New Fourm";
if(isset($_GET['id']))
{
  $name="Update Fourm";
  $id = urlencode(decryptIt($_GET['id']));  
  $row = getfourm_byID($id);
}
?>
<script type="text/javascript" src="<?php echo SITEPATH;?>/syspanel/js/custom.js"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { 
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	function getState(countryId) {		
		var strURL="<?php echo SITEPATH;?>/user/user/findState.php?country="+countryId;
		var req = getXMLHTTP();
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;
						document.getElementById('citydiv').innerHTML='<select name="city"required class="form-control1">'+
						'<option>Select District</option>'+
				        '</select>';						
					} else {
						alert("Problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	
</script>
<script src="<?php echo SITEPATH;?>/ckeditor/ckeditor.js"></script>
<script src="<?php echo SITEPATH;?>/ckeditor/samples/js/sample.js"></script>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper"> 
    <!-- Content Header -->
    <section class="content-header">
      <h1><?php echo $name;?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>user/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $name;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <form id="form" name="form" action="<?php  echo SITEPATH;?>/user/action/fourm.php?action=save" method="post" enctype="multipart/form-data"  >
          <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
          <div class="box-body">
            <div class="row">
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>State Name</label>
                  <select id="user_state" name="user_state" class="form-control" onChange="getState(this.value)">
                    <?php  
					$rows_list = getState_list(); 
$i=1;
					foreach ($rows_list as $rows) {?>
                    <option value="<?php echo $rows['stateID'];?>"<?php if($rows['stateID']==$row['user_state'])  echo "selected"; ?> ><?php echo $rows['stateName'] ;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label >District Name</label>
                  <div id="statediv">
                    <?php 
					if(isset($row['user_district']))
					{
						$_REQUEST["user_district"]=$row['user_district'];
						$query="SELECT district_id,district_name FROM district WHERE district_id=".$_REQUEST["user_district"];
					
					$result=mysqli_query($link,$query);
					?>
                    <select name="user_district"  class="form-control" id="state" >
                      <?php while ($rown=mysqli_fetch_array($result)) { ?>
                      <option value="<?php echo $rown['district_id']?>"<?php if($_REQUEST["user_district"]==$row['district_id'])  echo "selected"; ?>><?php echo $rown['district_name']?></option>
                      <?php }?>
                    </select>
                    <?php
					}else{?>
                    <select name="user_district" class="form-control">
                      <option>Select District Name</option>
                    </select>
                    <?php }?>
                  </div>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Category Name</label>
                  <select id="cat_id" name="cat_id" class="form-control" >
                    <?php  
					$rows_list = getCategory_list(); 
$i=1;
					foreach ($rows_list as $rows) {?>
                    <option value="<?php echo $rows['cat_id'];?>"<?php if($rows['cat_id']==$row['cat_id'])  echo "selected"; ?> ><?php echo $rows['cat_name'] ;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
                <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                  <label>Customer Name</label>
                  <select id="user_id" name="user_id" class="form-control" >
                    <?php  
					$rows_list = getcustomer_list(); 
$i=1;
					foreach ($rows_list as $rows) {?>
                    <option value="<?php echo $rows['user_id'];?>"<?php if($rows['user_id']==$row['user_id'])  echo "selected"; ?> ><?php echo $rows['first_name'] ;?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
                <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Question</label>
                  <input id="fourm_name" class="form-control" name="fourm_name" type="text" REQUIRED value="<?php echo (isset($row['fourm_name'])) ? $row['fourm_name'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="fourm_description" id="editor"><?php echo (isset($row['fourm_description'])) ? stripslashes($row['fourm_description']) : ''; ?></textarea>
                </div>
              </div>
              <div class="clearfix"></div>
               <?php 
			  if(isset($_GET['id']))
				{
			  ?>
               <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Remark</label>
                  <input id="fourm_new_dec" class="form-control" name="fourm_new_dec" type="text" REQUIRED value="<?php echo (isset($row['fourm_new_dec'])) ? $row['fourm_new_dec'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <?php }?>
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Upload Image :</label>
                  <input type="file" name="images" id="images" accept="image/*" class="form-control"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Status</label>
                  <select id="news_status" name="news_status" class="form-control">
                    <?php
                                    foreach ($config['display_status'] as $key => $value) {
                                          $selected = ($key == $row['fourm_status']) ? ' selected="selected"' : '';
                                    echo '<option ' . $selected . ' value="' . $key . '">' . $value . '</option>';
                                    }
                                    ?>
                  </select>
                </div>
              </div>
              <div class="clearfix"></div>
              
              <!--buttons-->
              <div class="clearfix"></div>
              <div class="btn-submit-active">
                <input type="submit" value="Submit"/>
                <span></span></div>
              <a href="<?php  echo SITEPATH;?>/user/Fourm" class="btn btn-cancel">Cancel</a> </div>
          </div>
        </form>
        <div class="box-footer clearfix"> </div>
      </div>
    </section>
  </div>
  <!--close page contets , start footer-->
  <footer class="main-footer">
    <?php include_once("../common/copyright.php");?>
  </footer>
</div>
<?php include_once("../common/footer.php");?>
<script>
	initSample();
</script>
</body>
</html>