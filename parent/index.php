<?php include('../config.php'); 
$validate=new Validation();
if(isset($_POST['login']))
{ 
$validate->addRule($_POST['username'],'','username ',true);
		$validate->addRule($_POST['password'],'','Password',true);
		
		 
		if($validate->validate() && count($stat)==0)
			{
				
					
		 if (strpos($_POST['username'], '@') !== false) {
        $aryChkName=$db->getRow("select * from student_guardian where email='".$_POST['username']."' order by id asc");
        } else {
           $aryChkName=$db->getRow("select * from student_guardian where parent_id='".$_POST['username']."' order by id asc");
        }
        
	

	if(is_array($aryChkName) && count($aryChkName)>0)
			{   
		$aryChkPswd=$db->getRow("select * from  student_guardian where password = '".$_POST['password']."' and id='".$aryChkName['id']."' order by id asc  ");
		
		
			if(is_array($aryChkPswd) && count($aryChkPswd)>0)
					{ 	
						 
						 
							if($aryChkPswd['status']=='1')
							{
								  $_SESSION['userid']=$aryChkPswd['id'];
									echo "logged in successfully";
									 
									redirect('login_profile.php');	
									
							}
							else{
									$stat['error']='Your account is inactive, please contact admin.';
							}
						 
					}
				else{
						$stat['error']='INVALID_PASSWORD';
					}
			}
		else{
				$stat['error']='THIS_USER_NAME_DO_NOT_EXIST';
			}
			}
		else{
			$stat['error'] = $validate->errors();
			}
		
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Skool</title>
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
@-moz-keyframes Gradient {
 0% {
 background-position: 0% 50%
}
 50% {
 background-position: 100% 50%
}
 100% {
 background-position: 0% 50%
}
}
 @keyframes Gradient {
 0% {
 background-position: 0% 50%
}
 50% {
 background-position: 100% 50%
}
 100% {
 background-position: 0% 50%
}
}
.carousel-indicators {
	display: none;
}
.form-group {
	margin-bottom: 20px !important;
}
.input-group-icon, .input-search {
	width: 100%;
	table-layout: fixed;
}
.mr-xs {
	margin-right: 5px;
}
.input-group {
	position: relative;
	display: table;
	border-collapse: separate;
	border: none;
	border-bottom: .1px solid;
	border-color: #DDD;
}
.input-group-addon, .input-group-btn, .input-group .form-control {
	display: table-cell;
}
.input-group .form-control {
	position: relative;
	z-index: 2;
	float: left;
	width: 100%;
	margin-bottom: 0;
}
.input-group-addon {
	padding: 6px 12px;
	font-size: 14px;
	font-weight: normal;
	line-height: 1;
	color: #555;
	text-align: center;
	border-radius: 4px;
	background: transparent;
	border: 0;
}
.btn-signin:hover {
	background-color: #04337d;
	color: #ffffff;
	border-color: #1f5a99;
}
.btn-signin {
	background-color: #fff;
	color: #1f5a99;
	border-color: #04337d;
}
.btn-lg, .btn-group-lg > .btn {
	line-height: 1.334;
}
.btn-block {
	display: block;
	width: 100%;
}
.btn-lg, .btn-group-lg > .btn {
	padding: 10px 16px;
	font-size: 18px;
	line-height: 1.3333333;
	border-radius: 6px;
}
.input-group input {
	background: none;
	font-size: 16px;
	border: none;
	border-bottom: .1px solid;
	border-color: #DDD;
	box-shadow: none;
}
.input-group input:focus {
	box-shadow: none;
}
.ad-nav-head nav {
	background: #1f5a99;
	margin: 0;
	border: 0;
}
.panel-sign .panel-body {
	background: #FFF;
	border-radius: 5px 0 5px 5px;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
	padding: 33px 33px 15px;
}
.navbar-default .navbar-nav>li>a:hover, .navbar-default .navbar-nav>li>a:focus {
	color: #fff;
}
.body-sign-add {
	position: absolute;
	top: 0;
	bottom: 0;
	height: 50%;
	margin: auto;
	left: 0;
	right: 0;
	VERTICAL-ALIGN: MIDDLE;
}
.carousel-inner>.item>img, .carousel-inner>.item>a>img {
	height: 607px;
}
.panel-sign .panel-title-sign .title {
	background-color: #337ab7;
	border-radius: 5px 5px 0 0;
	color: #FFF;
	display: inline-block;
	font-size: 1.2rem;
	line-height: 2rem;
	padding: 13px 17px;
	vertical-align: bottom;
}
.panel-sign .panel-title-sign .title {
	background-color: #0088cc;
	margin: 0;
	border: 0;
}
.bg-colorflow2 {
	color: #fff !important;
	background-image: linear-gradient(-45deg, #ffffff, #1f5a99, #ffffff, #1f5a99, #ffffff, #1f5a99, #ffffff, #1f5a99, #04337d) !important;
	/* background-image: linear-gradient(-45deg, #EE7752, #E73C7E, #23A6D5, #23D5AB) !important; */
	background-size: 400% 400% !important;
	-webkit-animation: Gradient 15s ease infinite !important;
	-moz-animation: Gradient 15s ease infinite !important;
	animation: Gradient 15s ease infinite !important;
}
.center-sign {
	width: 71%;
	border: 0;
	padding: 0;
	margin: 0 auto;
}
.panel.panel-sign {
	border: 0px;
}
.nav>li {
  
    z-index: 99999999999999999999999999999999999999;
}
</style>
</head>
<body>
<div class="ad-nav-head">
  <div class=""> 
    <nav class="navbar navbar-default">
      <div class=""> 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li> <a href="<?php echo SITE_URL; ?>" class="btn-default"> <i class="fa fa-home"></i> Home </a> </li>
           
            <li> <a href="<?php echo SITE_URL; ?>faq.php" class="btn-default"> <i class="fa fa-user-plus"></i> Faq</a> </li>
            <li> <a href="<?php echo SITE_URL; ?>contact-us.php" class="btn-default"> <i class="fa fa-envelope"></i> Contact </a> </li>
            
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
<div class="fade-bannner">
  <div class="banner-inn">
    <div id="myCarousel" class="carousel slide" data-ride="carousel"> 
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <?php
		$aryList=$db->getRows("select * from plogin_slider	order by id desc");
		foreach($aryList as $iList)
			{	
			$i=$i+1;
			 ?>
        <div class="item <?php if($i%2==0){echo "active"; }?>"> <img src="../uploads/<?php echo $iList['image']; ?>"  style="width:100%;"> </div>
        <?php } ?>
      </div>
    </div>
    <section class="body-sign-add" >
      <div class="container">
        <div class="row">
          <div class="col-sm-3"> </div>
          <div class="col-sm-6">
            <div class="center-sign">
              <div class="panel panel-sign" >
                <div class="panel-title-sign text-center">
                  <div class="center-align green-text" style="color:red;">
                    <h5><?php echo msg($stat);?></h5>
                    <p></p>
                  </div>
                  <h4 class="title m-none bg-colorflow2" style="width:100%; font-size:18px; color:#fff;"> <i class="fa fa-user mr-xs"></i>Parent Portal Login </h4>
                </div>
                <div class="panel-body " >
                  <form id="login-add" method="post" action="">
                    <div class="form-group mb-lg">
                      <div class="input-group input-group-icon">
                        <input  id="email" type="text" name="username"  placeholder="E-Mail or Reg. No." class="form-control input-lg">
                      </div>
                    </div>
                    <div class="form-group mb-lg">
                      <div class="input-group">
                        <input name="password"  type="password" placeholder="Password" class="form-control input-lg">
                        <span class="input-group-addon" > <a href="" class="icon icon-sm" style="color:inherit; text-decoration:none;width:100%;"> 
                        <!--<i class="fa fa-eye" id="eye_icon"></i> 
										<span id="show_txt">show</span>--> 
                        </a> </span> </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-sm-12 text-center">
                        <button type="submit" name="login" class=" btn-signin btn-block btn-lg "> Sign In <i class="fa fa-sign-in"></i> </button>
                      </div>
                    </div>
                    <br>
                  </form>
                  <div class="text-left"> <a href="#"> 
                    </a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-3"> </div>
        </div>
      </div>
    </section>
  </div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>
</html>