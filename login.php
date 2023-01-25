<?php include('config.php'); 

if($_SESSION['userid']!='')
{
	redirect(SKOOL_URL);
}
$validate=new Validation();
if(isset($_POST['login']))
{ 
    
	$validate->addRule($_POST['username'],'','User Name ',true);
	$validate->addRule($_POST['password'],'','Password',true);
		 
	if($validate->validate() && count($stat)==0)
	{   
        
        if (strpos($_POST['username'], '@') !== false) {
        	$aryChkName=$db->getRow("select * from school_register where email='".$_POST['username']."'");
        } else {
       	$aryChkName=$db->getRow("select * from school_register where username='".$_POST['username']."'");
        }
        
	
		if(is_array($aryChkName) && count($aryChkName)>0)
		{   
			$aryChkPswd=$db->getRow("select * from school_register where password = '".$_POST['password']."' and username='".$aryChkName['username']."'");
		
			if(is_array($aryChkPswd) && count($aryChkPswd)>0)
			{ 	
				if($aryChkPswd['id']!='')
				{
					$_SESSION['userid']=$aryChkPswd['id'];
					$_SESSION['usertype']=$aryChkPswd['usertype'];
					
					$iUpdate=$db->update("update school_register set last_login = '".date('Y-m-d H:i:s')."' where id = '".$_SESSION['userid']."'");
				
					redirect(SKOOL_URL);	
				}
			}
			else
			{
				$stat['error']='Invalid Password.';
			}
		}
		else
		{
			$stat['error']="This User Name Does Not Exist.";
		}
	}
	else
	{
		$stat['error'] = $validate->errors();
	}
}
?>
<html>
<head>
<?php include('inc.meta-new.php');	?>
</head>
<body class="home page-template page-template-tpl-home page-template-tpl-home-php page page-id-14">
<div id="page" class="site">
  <?php include('inc.header-new.php');	?>
  <div id="content" class="site-content">
    <section class="login-part ">
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <form action=""  method="post"class="login-form">
              <div class="center-align green-text">
                <h4 style="color: #FFEB3B;">Login to your school</h4>
              </div>
              <div class="center-align green-text" style="color:red;">
                <h5><?php echo msg($stat);?></h5>
                <p></p>
              </div>
              <div class="form-group">
                <input autocomplete="off" class="form-control" name="username" value="<?php echo $_POST['username']; ?>" placeholder="username *" type="text">
              </div>
              <div class="form-group">
                <input autocomplete="off" class="form-control" name="password" placeholder="password *" type="password">
              </div>
              <div class="form-group frgt">
                <div class="row">
                  <div class="col-md-10">
                    <div class="here"><a href="https://www.bestschoolpage.com.ng/forgot-password.php"><span>Forgot password</span></a></div>
                  </div>
                  <div class="col-md-2 register-btn">
                    <button class="btn btn-primary btn-lg" type="submit" name="login">Log In</button>
                  </div>
                </div>
              </div>
              <div class="form-group sclacu ">
                <div class="row">
                  <div class="col-md-12">
                    <p class="reva">Don't have a school account? <span class="rgstrscl"> <a href="<?php echo SITE_URL; ?>registration.php ">Register School</a> </span> </p>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </section>
  </div>
  <?php include('inc.footer-new.php');	?>
</div>
<?php include('inc.js-new.php');	?>
</body>
</html>
