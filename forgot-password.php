<?php include('config.php'); 
if($_SESSION['userid']!='')
{
	redirect(SKOOL_URL);
}
$validate=new Validation();
if(isset($_POST['get_password']))
{ 
    
	$validate->addRule($_POST['email'],'','Email ',true);

	if($validate->validate() && count($stat)==0)
	{   
        
        if (strpos($_POST['email'], '@') !== false) {
        	$aryChkName=$db->getRow("select * from school_register where email='".$_POST['email']."'");
        } 
        

		if(is_array($aryChkName) && count($aryChkName)>0)
		{   
			$aryChkPswd=$db->getRow("select * from school_register where email='".$aryChkName['email']."'");
		
			if(is_array($aryChkPswd) && count($aryChkPswd)>0)
			{ 	
				if($aryChkPswd['id']!='')
				{
				    	$randomPass = randomPassword();
				    	$iUpdate=$db->update("update school_register set password = '".$randomPass."' where id = '".$aryChkPswd['id']."'");
					
        $header  = "From:info@bestschoolpage.com.ng	 \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";
        $to      = $aryChkName['email'];
        $subject = "New Password From Best School Page";
        $message .= "<b>Hello ".$aryChkPswd['name'].".</b>";
        $message .= "<p>Your new password is <b> ".$randomPass." </b> you can change your password after login with this new password. </p>\r\n";
        $message .= "<a href='https://www.bestschoolpage.com.ng/login.php'><span>Click here to login</span>\r\n</a><br></br>\r\n";
         $message .= "<b>Thanks & Regards .</b><br>";
         $message .= "<b>BEST SCHOOL PAGE</b>";
        $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "<b style='color:green;'>Password information has been sent to the registered mail...</b></br>";
            echo "<p style='color:green;'>If you didn't get the email in the inbox, please check in Updates or Promotions or Spam folder of your mailbox. If you still don't find it, please make sure if the password requested email & mailbox you're checking are same....</p>";
            exit;
         }else {
            echo "Message could not be sent...";
            exit;
         }
         
				
					
				
				}
			}
			else
			{
				$stat['error']='Email address does not exist in our record.';
			}
		}
		else
		{
			$stat['error']="Email address does not exist in our record.";
		}
	}
	else
	{
		$stat['error'] = $validate->errors();
	}
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 11; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
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
                <h4 style="color: #FFEB3B;">Enter your email address to get new password</h4>
              </div>
              <div class="center-align green-text" style="color:red;">
                <h5><?php echo msg($stat);?></h5>
                <p></p>
              </div>
              <div class="form-group">
                <input autocomplete="off" class="form-control" name="email" value="" placeholder="Enter your email *" type="email">
              </div>
             
              <div class="form-group frgt">
                <div class="row">
                  <div class="col-md-10">
                    <div class="here"><a href="https://www.bestschoolpage.com.ng/login.php"><span>login here</span></a></div>
                  </div>
                  <div class="col-md-2 register-btn">
                    <button class="btn btn-primary btn-lg" type="submit" name="get_password">Get Password</button>
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
