<?php  
include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Update Profile";
$FileName = 'login_profile.php';
$iClassName = ADMIN_URL;
$validate=new Validation();
if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
   unset($_SESSION['success']);
}

if(isset($_POST['update']))
	{ 
	if(isset($_FILES["company_logo"]["name"]) && !empty($_FILES["company_logo"]["name"]))
				{	 
 					$filename = basename($_FILES['company_logo']['name']);
					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
					if(in_array($ext1,array('jpg','png', 'gif')))
					{ 	  
						$newfile=md5(time())."_".$filename;
 						move_uploaded_file($_FILES['company_logo']['tmp_name'],"../uploads/".$newfile);
 					 }				
				 }         
 
	else { $newfile =$_POST['company_logo_old']; }
	
		$iCheckEMailID=$db->getVal("select   emailid from  admin_login where email='".$_POST['email']."' and id!='".$_SESSION[LOGIN_ADMIN]['id']."'");
 		
		   if($iCheckEMailID!='')
			{   		   
				$stat['error'] = "This email id is already register";
			}
			else{
	

	
     $aryData=array(	
									'fullname'     	 	     	=>	$_POST['fullname'],
									'emailid'     	 	     	=>	$_POST['emailid'],
									'fullname'     	 	     	=>	$_POST['fullname'],
 									'profileimage'     	 	     =>	$newfile,
									'mobile_no'     	 	     =>	$_POST['mobile_no'],
									 
 								 );  
					$flgIn = $db->updateAry("admin_login", $aryData , "where id='".$_SESSION[LOGIN_ADMIN]['id']."'");
					
					$_SESSION['success']="Profile updatd successfully";
					unset($_POST);
					redirect($iClassName.$FileName);
			}
	}
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
            <h4 class="page-title"><?php echo $PageTitle; ?></h4>
            <ol class="breadcrumb">
              <li> <a href="<?php echo $iClassName; ?>">Home</a> </li>
              <li class="active"> <?php echo $PageTitle; ?> </li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card-box aplhanewclass">
              <div class="row">
                <div class="col-md-9"> <?php echo msg($stat); ?> </div>
              </div>
            </div>
            <?php   $aryDetail=$db->getRow("select * from  admin_login where id='".$_SESSION[LOGIN_ADMIN]['id']."'");  ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Full Name*</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="fullname" name="fullname" value="<?php echo $aryDetail['fullname']; ?>">
                      </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Email Id *</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="userName" name="emailid" value="<?php echo $aryDetail['emailid']; ?>">
                      </div>
                    </div>
                     
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Profile Image</label>
                      <div class="col-lg-10">
                        <input type="file" class="form-control required" id="logo" name="company_logo"   >
                        <input type="hidden" class="form-control required"  id="company_logo_old" name="company_logo_old"  value="<?php echo $aryDetail['company_logo'] ?>" >
                        <img src="../uploads/<?php echo $aryDetail['profileimage'] ?>" style="height:50px;"> </div>
                    </div>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Mobile No *</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="mobile_no" value="<?php echo $aryDetail['mobile_no']; ?>">
                      </div>
                    </div>
                   
                    
                    <button type="submit" name="update" class="btn btn-default">Update</button>
                  </section>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('inc.footer.php'); ?>
  </div>
</div>
<?php include('inc.js.php'); ?>
</body>
</html>