<?php include('config.php'); 
if($_SESSION['userid']!='')
{
	redirect(SKOOL_URL);
}

$validate=new Validation();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{
	$validate->addRule($_POST['school_name'],'','School Name ',true);
	$validate->addRule($_POST['location'],'','School Address',true);
	$validate->addRule($_POST['state'],'','state ',true);
	$validate->addRule($_POST['email'],'email','Email ',true);
	$validate->addRule($_POST['contact_no'],'num','Contact No',true);
	$validate->addRule($_POST['school_type'],'','School Type',true);
	$validate->addRule($_POST['username'],'','User Name',true);
	$validate->addRule($_POST['password'],'','Password',true);
	$validate->addRule($_POST['confirm_pass'],'','Confirm Password',true);
		
	if($validate->validate() && count($stat)==0)
	{
	    $iVerifyId=randomFix(10);
	
		$iCheckEmailId=$db->getVal("select email from  school_register where email='".$_POST['email']."'");
		$iCheckusername=$db->getVal("select username from  school_register where username='".$_POST['username']."'");
        $iCheckcontactno=$db->getVal("select contact_no from  school_register where contact_no='".$_POST['contact_no']."'");
   		if($iCheckEmailId!='')
		{ 
			$stat['error']="This email id already exit.";
		}
		elseif($iCheckusername!='')
		{
			$stat['error']="This Username is Already Registered.";
		}
		elseif($iCheckcontactno!='')
		{
			$stat['error']="This Contact No. is Already Registered.";
		}
		elseif($_POST['password']!=$_POST['confirm_pass'])
		{
			$stat['error']="Password do not match.";
		}
		else
		{
			$iLastId=$db->getVal("select id from school_register order by id desc")+1;
			$iRandomId=randomFix(20).'-'.$iLastId;
			$iPageUrl=PageUrl($_POST['school_name']).'-'.$iLastId;
			
			$aryData=array(
							'usertype'     	 	         		=>	0,
							'name'     	 	         			=>	$_POST['school_name'],
							'username'     	 	         	    =>	$_POST['username'],
							'state'     	 	         	    =>	$_POST['state'],
							'contact_no'     	 	         	=>	$_POST['contact_no'],
							'email'     	 	         	    =>	$_POST['email'],
							'location'     	 	         	    =>	$_POST['location'],
							'password'     	 	         	    =>	$_POST['password'],
							'school_type'     	 	            =>	$_POST['school_type'],
							'status'     	 	                =>	0,
							'verifyid'     	 	            	=>	randomFix(15),
							'create_at'     	 	            =>	date('Y-m-d H:i:s'),
							'randomid'                          =>	$iRandomId,
							'pageurl'                          	=>	$iPageUrl,
							'create_by_userid'                  =>	0,
							'create_by_usertype'                =>	0,
							'walletamount'						=>	0,
							);
				$flgIn1 = $db->insertAry("school_register",$aryData);
			/*	
			$aryData=array(
							'create_by_userid'                =>	$flgIn1,
							);
				$flgIn123 = $db->updateAry("school_register",$aryData,"where id='".$flgIn1."'");	
			*/
				$_SESSION['usertype'] =0;
				 $_SESSION['userid'] = $flgIn1;
			
				$_SESSION['success']="You have been register successfully.";
				redirect(SITE_URL.'package.php');
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
    <section class="registartion-area">
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <form action="" method="POST" class="learnpro-register-form">
              <div class="center-align green-text">
                <h4>Register your school</h4>
                <p></p>
              </div>
              <div class="center-align green-text" style="color:red;">
                <h5><?php echo msg($stat);?></h5>
                <p></p>
              </div>
              <div class="form-group">
                <input autocomplete="off" class="form-control" placeholder="School Name *" value="<?php echo $_POST['school_name']; ?>"  name="school_name" type="text">
              </div>
              <div class="form-group">
                <input autocomplete="off" class="form-control" placeholder="Location *" value="<?php echo $_POST['location']; ?>" name="location"type="text">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-4">
                    <select class="required form-control" name="state" >
                      <option>Select State</option>
                      <?php $i=0;
						$aryList=$db->getRows("select * from state where status='1'");
						foreach($aryList as $iList)
						{ $i=$i+1;
						?>
                      <option value="<?php echo $iList['id']; ?>"><?php echo $iList['title']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-8">
                    <input class="required form-control" placeholder="Email *" name="email" type="text" value="<?php echo $_POST['email']; ?>">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input autocomplete="off" class="required form-control" name="contact_no" value="<?php echo $_POST['contact_no']; ?>" placeholder="Contact No.*" type="text">
                  </div>
                  <div class="col-md-6">
                    <select class="required form-control" name="school_type" >
                      <option value="">Select School Type</option>
                      <?php $i=0;
							$aryList=$db->getRows("select * from school_type ");
							foreach($aryList as $iList)
							{ $i=$i+1;
							?>
                      <option value="<?php echo $iList['id']; ?>" <?php if($_POST['school_type']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['school_type']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="admin"> <span>(Admin login details.)</span> </div>
              <div class="form-group">
                <input class="required form-control" placeholder="User Name *" value="<?php echo $_POST['username']; ?>" name="username" type="text">
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <input class="required form-control" name="password" placeholder="Password *" type="password" value="<?php echo $_POST['password']; ?>">
                  </div>
                  <div class="col-md-6">
                    <input class="required form-control" name="confirm_pass" placeholder="Confirm Password *" type="password" >
                  </div>
                </div>
              </div>
              <div class="form-group sclacu">
                <div class="row">
                  <div class="col-md-6">
                    <p class="reva">Already have a school account.</p>
                  </div>
                  <div class="col-md-6">
                    <div class="here"><a href="<?php SITE_URL;?>login.php "><span>Log In here</span></a></div>
                  </div>
                </div>
              </div>
              <div class="form-group register-btn">
                <div class="row">
                  <div class="col-md-7"></div>
                  <div class="col-md-5">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg">Register School<i class="fa fa-pencil" aria-hidden="true"></i></button>
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
