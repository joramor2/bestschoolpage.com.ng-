<?php include('../config.php');
include('inc.session-create.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
</head>
<body class="fixed-left">
<div id="wrapper">
  <?php include('inc.header.php'); ?>
  <?php include('inc.sideleft.php'); ?>
  <div class="content-page">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="page-title-3">menu</h4>
            <p class="text-muted page-title-3-alt">Applicant, Configuration etc</p>
          </div>
        </div>
        <div class="row">
          <div class="text-center"></div>
        </div>
        <div class="row"> <a href="<?php echo SKOOL_URL; ?>home.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-home" aria-hidden="true"></i>
              <h4>Home</h4>
              <p class="stadi">Home</p>
            </div>
          </div>
          </a> 
          
           <?php if($iPackageJsoneDecodeAllowFile['dashboard']=='1') { ?>
          <a href="<?php echo SKOOL_URL; ?>dashboard.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-th-large" aria-hidden="true"></i>
              <h4>Dashboard</h4>
              <p class="stadi">View statistic</p>
            </div>
          </div>
          </a> 
           <?php } ?>
          
          <?php if($iPackageJsoneDecodeAllowFile['create_custom_forms']=='1') { ?>
          <a href="<?php echo SKOOL_URL; ?>application.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-bars" aria-hidden="true"></i>
              <h4>Applications</h4>
              <p class="stadi">Create edit</p>
            </div>
          </div>
          </a> 
          
          <a href="application-view.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-users" aria-hidden="true"></i>
              <h4>Applicants</h4>
              <p class="stadi">View successfully</p>
            </div>
          </div>
          </a> 
          
          <?php } ?>
          
          <a href="<?php echo SKOOL_URL;?>configuration.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-cog" aria-hidden="true"></i>
              <h4>Configuration</h4>
              <p class="stadi">Configure school</p>
            </div>
          </div>
          </a> <a href="<?php echo SKOOL_URL;?>login_profile.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-user" aria-hidden="true"></i>
              <h4>Profile</h4>
              <p class="stadi">View Profile</p>
            </div>
          </div>
          </a> <a href="#">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-rebel" aria-hidden="true"></i>
              <h4>Transactions</h4>
              <p class="stadi">Payment history</p>
            </div>
          </div>
          </a> 
           <?php if($iPackageJsoneDecodeAllowFile['document_upload']=='1') { ?>
          <a href="<?php echo SKOOL_URL;?>upload_document.php">
          <div class="col-sm-6 col-md-3">
            <div class="col-md-12 feature-box bon"> <i class="fa fa-folder" aria-hidden="true"></i>
              <h4>Document</h4>
              <p class="stadi">Upload Document</p>
            </div>
          </div>
          </a>
           <?php } ?>
          
           </div>
      </div>
    </div>
    <?php include('inc.footer.php'); ?>
  </div>
</div>
<?php include('inc.js.php'); ?>
</body>
</html>