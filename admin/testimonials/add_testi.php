<?php 
include("../../system_config.php");
include_once("../common/head.php");

$name="Add New Testimonials";
if(isset($_GET['id']))
{
  $name="Update Testimonials";
  $id = urlencode(decryptIt($_GET['id']));  
  $row = gettestimonials_byID($id);
}
?>
<script src="https://www.perfectbrainz.in//ckeditor/ckeditor.js"></script>
	<script src="https://www.perfectbrainz.in//ckeditor/samples/js/sample.js"></script>
	
<body class="hold-transition skin-blue sidebar-mini fixed">
<div class="wrapper">
  <?php include_once("../common/left_menu.php");?>
  <div class="content-wrapper"> 
    <!-- Content Header -->
    <section class="content-header">
      <h1><?php echo $name;?></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo SITEPATH;?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $name;?></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
        <form id="form" name="form" action="<?php  echo SITEPATH;?>/admin/action/testimonials.php?action=save" method="post" enctype="multipart/form-data"  >
          <input id="data_id" name="data_id" type="hidden" value="<?php echo $id ?>" />
          <div class="box-body">
            <div class="row">
              
              
              <div class="col-sm-6 col-md-4 col-lg-6">
                <div class="form-group">
                <label>Name</label>
                  <input id="name" class="form-control" name="name" type="text" REQUIRED value="<?php echo (isset($row['name'])) ? $row['name'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
               
                <!-- <div class="clearfix"></div> -->
              <div class="col-sm-6 col-md-4 col-lg-6">
                <div class="form-group">
                  <label>Title</label>
                  <input id="title" class="form-control" name="title" type="text" REQUIRED value="<?php echo (isset($row['title'])) ? $row['title'] : ''; ?>"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" id="editor"><?php echo (isset($row['description'])) ? stripslashes($row['description']) : ''; ?></textarea>
                </div>
              </div>
              <div class="clearfix"></div>
              
            
              
              <div class="clearfix"></div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Upload Image :</label>
                  <input type="file" name="image" id="image"  class="form-control"/>
                  <label class="label-brdr" style="width: 0%;"></label>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="form-group">
                  <label>Status</label>
                  <select id="status" name="status" class="form-control">
                    <?php
                                    foreach ($config['display_status'] as $key => $value) {
                                          $selected = ($key == $row['status']) ? ' selected="selected"' : '';
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
              <a href="<?php  echo SITEPATH;?>/admin/testimonials" class="btn btn-cancel">Cancel</a> </div>
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
 <script type="text/javascript">  
	     CKEDITOR.replace( 'editor' );  
	  </script>  	  
</body>
</html>