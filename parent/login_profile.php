<?php  
include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Update Profile";
$FileName = 'login_profile.php';
$iClassName = PARENT_URL;
$validate=new Validation();
if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
   unset($_SESSION['success']);
}

if(isset($_POST['update']))
	{ 
	if(isset($_FILES["logo"]["name"]) && !empty($_FILES["logo"]["name"]))
				{	 
 					$filename = basename($_FILES['logo']['name']);
					$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
					if(in_array($ext1,array('jpg','png')))
					{ 	  
						$newfile=md5(time())."_".$filename;
 						move_uploaded_file($_FILES['logo']['tmp_name'],"../uploads/".$newfile);
 					 }				
				 }         
 
	else { $newfile =$_POST['logo_old']; }
	
		 
     $aryData=array(	
									'first_name'     	 	    =>		$_POST['username'],
									'email'     	 	     	=>		$_POST['email'],
									'phone'     	 	     	=>		$_POST['phone'],
 									'logo'     	 	    		=>		$newfile,
									 
 									 
									 
 								 );  
					$flgIn = $db->updateAry("student_guardian", $aryData , "where id='".$_SESSION['userid']."'");
					
					$_SESSION['success']="Profile updatd successfully";
					unset($_POST);
					redirect($iClassName.$FileName);
			}
	 
	
	
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif" />
<style>
body, label, span, a, .gwt-Button {
	font-family: 'Droid Serif' !important;
}
.circle img {
	width: 150px;
	border-radius: 80px;
	height: 150px;
	margin-bottom: 20px;
}
.ac h1 {
	color: #1565c0;
}
.up h4 {
	color: #1565c0;
	font-weight: 700;
}
.divider {
	width: 100;
	height: 2px;
	overflow: hidden;
	background-color: #e0e0e0;
}
.ur {
	font-weight: bold;
	color: black;
	margin-bottom: 20px;
	padding: 10px;
}
.ar {
	margin-bottom: 20px;
	padding: 10px;
}
.hh {
	padding: 25px;
}
.sss .btn-flat, .fade .btn-flat .btn-large {
	letter-spacing: normal !important;
	padding: 0 1rem !important;
	line-height: 33px;
	height: 33px;
}
.sss .btn-flat, .fade .btn-flat {
	border: none;
	border-radius: 2px;
	display: inline-block;
	height: 36px;
	line-height: 36px;
	outline: 0;
	padding: 0 2rem;
	vertical-align: middle;
	-webkit-tap-highlight-color: transparent;
}
.sss .btn-flat .fa, .fade .btn-flat .fa {
	font-size: 16px;
	margin-right: 5px;
}
.sss .btn-flat span, .fade .btn-flat span {
	font-size: 16px;
}
.sss .btn-flat, .fade .btn-flat {
	box-shadow: none;
	background-color: transparent;
	color: #1565c0;
	cursor: pointer;
}
.sss .btn {
	text-decoration: none;
	color: #fff;
	background: #1565c0;
	text-align: center;
	letter-spacing: .5px;
	transition: .2s ease-out;
	cursor: pointer;
}
.sss .btn:hover, .btn-floating:hover {
	box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
}
.sss .btn:hover {
	background-color: #1565c0e6;
	color: white!important;
}
.fade ::placeholder {
 color:#9e9e9e;
}
.fade input[type=password] {
	background-color: transparent;
	border: none;
	border-bottom: 1px solid #9e9e9e;
	border-radius: 0;
	outline: none;
	height: 3rem;
	width: 100%;
	font-size: 15px;
	margin: 0 0 0px 0;
	padding: 0;
	box-shadow: none;
	box-sizing: content-box;
	transition: all .3s;
}
.fade input[type=password]:focus:not([readonly]) {
	border-bottom: 1px solid #1565c0;
	box-shadow: 0 1px 0 0 #1565c0;
}
.fade .modal-footer {
	border-radius: 0 0 2px 2px;
	background-color: #fafafa;
	padding: 4px 6px;
	height: 56px;
	width: 100%;
}
.fade .input-field {
	padding: 20px;
}
.fade .modal-dialog {
	width: 25%!important;
	margin: 30px auto;
}
.fade .modal-content span {
	color: #1565c0;
}
</style>
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
      <h4 class="page-title">PROFILE ACCOUNT</h4>
    </div>
  </div>
  <br>
  <Br>
  <div class="row">
    <div class="sectionza">
      <div class="col-md-12   col-xm-12">
        <form method="post" action=""  enctype="multipart/form-data" >
          <?php 		$iupdatedetails=$db->getRow("select * from  student_guardian where id='".$_SESSION['userid']."'");
 ?>
          <div class="col-md-12 up">
            <h4>Update account information<a href="#" > <i class="fa fa-edit" onclick="displayblock();" style="color:darkblue;"></i></a></h4>
          </div>
          <div class="col-md-12 circle"> <img src="../uploads/<?php echo $iupdatedetails['logo']; ?>">
            <input id="changelogo" style="display:none;margin-bottom: 10px;color: blue;" type="file" name="logo" value="<?php echo $iupdatedetails['logo']; ?>" >
            <input type="hidden"   name="logo_old"    value="<?php echo $iupdatedetails['logo']; ?>">
          </div>
          <div class="col-md-12 ">
            <div class="divider" style="width: 100%; height: 2px;"></div>
          </div>
          <div class="hh">
            <div class="row">
              <div class="col-md-5 ur  col-xm-12"> <span>Username</span> </div>
              <div id="username1" style="display:block;"  class="col-md-7 ar col-xm-12"> <span><?php echo $iupdatedetails['first_name'];?> </span> </div>
              <div id="username2" style="display:none;"  class="col-md-7 ar col-xm-12"> <span>
                <input type="text" name="username" value="<?php echo $iupdatedetails['first_name'];?>" >
                </span> </div>
            </div>
            <div class="row">
              <div class="col-md-5 ur  col-xm-12"> <span>Email Address</span> </div>
              <div id="email1" style="display:block;"  class="col-md-7 ar col-xm-12"> <span><?php echo $iupdatedetails['email'];?> </span> </div>
              <div id="email2" style="display:none;"  class="col-md-7 ar col-xm-12"> <span>
                <input type="email" name="email" value="<?php echo $iupdatedetails['email'];?>" >
                </span> </div>
            </div>
            <div class="row">
              <div class="col-md-5 ur  col-xm-12"> <span>Phone No</span> </div>
              <div id="contact1" style="display:block;" class="col-md-7 ar col-xm-12"> <span><?php echo $iupdatedetails['phone'];?> </span> </div>
              <div id="contact2" style="display:none;"  class="col-md-7 ar col-xm-12"> <span>
                <input type="text" name="phone" value="<?php echo $iupdatedetails['phone'];?>" >
                </span> </div>
            </div>
            <div  id="lastlogin" style="display:block;"  class="row">
              <div  class="col-md-5 ur  col-xm-12"> <span>Last Login</span> </div>
              <div class="col-md-7 ar col-xm-12"> <span><?php echo $iupdatedetails['last_login'];?> </span> </div>
            </div>
            <div  id="lastregis" style="display:block;" class="row">
              <div  class="col-md-5 ur  col-xm-12"> <span>Date Registered</span> </div>
              <div class="col-md-7 ar col-xm-12"> <span><?php echo date('Y-m-d',strtotime( $iupdatedetails['create_at']));?> </span> </div>
            </div>
            <div class="row sss">
              <div class="col-md-6">
                <button type="button" class="btn-flat" data-toggle="modal" data-target="#myModal"> <i class="fa fa-shield" aria-hidden="true"></i><span>Change Password</span></button>
              </div>
              <div class="col-md-6">
                <button type="submit" name="update" id="updatebtn" style="display:none;"  class="btn"><i class="fa fa-history" aria-hidden="true"></i> <span>Update Profile</span></button>
              </div>
            </div>
          </div>
        </form>
       </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  
  <Br><Br><Br><Br><Br><Br>
    <?php include('inc.footer.php'); ?>
  </div>
</div>
<?php include('inc.js.php'); ?>
<form method="post" action="" id="changepassword">
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 30px;z-index: 9999999999;">
    <div class="modal-dialog" style="width: 300px!important;margin: 0px auto;">
      <div class="modal-content">
        <div id="update_error"></div>
        <span class="green-text material-label" style="margin-bottom: 20px; font-size: 22px;">Change password</span>
        <div class="row">
          <div class="s12 m12 l12 col">
            <div class="input-field">
              <input type="password" class="gwt-TextBox" id="old_password"  placeholder="Enter old password">
              <label for="gwt-uid-2" class="active"></label>
              <span aria-hidden="true" class="material-label" style="display: none;"></span> </div>
          </div>
        </div>
        <div class="row">
          <div class="s12 m12 l12 col">
            <div class="input-field">
              <input type="password" class="gwt-TextBox" id="new_password"  placeholder="Enter password" >
              <label for="gwt-uid-3"></label>
              <span aria-hidden="true" class="material-label" style="display: none;"> </span> </div>
          </div>
        </div>
        <div class="row">
          <div class="s12 m12 l12 col">
            <div class="input-field">
              <input type="password" class="gwt-TextBox" placeholder="Verify password" id="confirm_password"  >
              <label for="gwt-uid-4"></label>
              <span aria-hidden="true" class="material-label" style="display: none;"></span> </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-flat teal-text" onclick="cnfrmpswd();" style="cursor: pointer;"> <span>Change</span></button>
        <button type="button"  class="btn-flat red-text"data-dismiss="modal" style="cursor: pointer; color:red;"><span>Cancel</span></button>
      </div>
    </div>
    <?php	echo 	 msg($stat); ?>
  </div>
</form>
<script>
 function displayblock(){
	 
	 document.getElementById("username2").style.display="block";
	  document.getElementById("username1").style.display="none";
	  
	   document.getElementById("email1").style.display="none";
	    document.getElementById("email2").style.display="block";
		
		 document.getElementById("contact1").style.display="none";
		 document.getElementById("contact2").style.display="block";
		 
		  document.getElementById("updatebtn").style.display="block";
	 
	  document.getElementById("lastlogin").style.display="none";
		 document.getElementById("lastregis").style.display="none"; 
		  document.getElementById("changelogo").style.display="block";
 }
 
 
 
 
function cnfrmpswd()
{	

	var old_password=document.getElementById("old_password").value;
	var new_password=document.getElementById("new_password").value;
 	var confirm_password=document.getElementById("confirm_password").value; 

 	 $.post("ajax.php",{ 
							 				    action : "Action_changepass",
												old_password 			: old_password,
												new_password 			: new_password,
												confirm_password  : confirm_password, 
												},
										function(data){
											
												if(data==1)
						{
							document.getElementById("update_error").innerHTML='<p style="color:green;">Password changed successfully.</p>';
							document.getElementById("changepassword").reset();
						}
						else
						{
												 
 													 document.getElementById("update_error").innerHTML=data;
						}							 
													 
										});
	 
}
</script>
</body>
</html>