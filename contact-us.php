<?php include('config.php'); 
$validate = new Validation();
if(isset($_POST['contactus1']))
		{
			 	$validate->addRule($_POST['fname'],'alpha',' Name',true);
				$validate->addRule($_POST['email'],'email','Email id',true);
				$validate->addRule($_POST['subject'],'','subject',true);
				$validate->addRule($_POST['message'],'','Message',true); 
			 
		if($validate->validate() && count($stat)==0)
				{
					$aryData=array(	
									  'name'   =>$_POST['fname'].' '.$_POST['lname'],
									  'email'   =>$_POST['email'],
									  'subject'   => $_POST['subject'],
									  'message'   => $_POST['message'],
									  'create_at'   => date('Y-m-d H:i:s'),
									 
							);  
					$flgIn = $db->insertAry("contactus", $aryData); 
					$stat['success'] = "You have been successfully registered";	
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
    <div class="home-banner contactbanner"> <img src="images/contactus.png" alt="" class="wow fadeIn" />
      <div class="container">
        <div class="banner-content">
          <h1><span>Contact</span> Us</h1>
          <ul class="breadcrumb">
            <li><a href="<?php echo SITE_URL; ?>">Home</a></li>
            <li>Contact us</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="form-contactt">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <form action="" method="post">
              <?php echo msg($stat); ?>
              <h3>Inquiry Now</h3>
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo $_POST['fname']; ?>">
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                  <div class="form-group">
                    <label for="fname">Last Name</label>
                    <input type="text" class="form-control" name="lname" value="<?php echo $_POST['lname']; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="pwd">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $_POST['email']; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="pwd">Subject:</label>
                    <input type="text" class="form-control" name="subject" value="<?php echo $_POST['subject']; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="form-group">
                    <label for="pwd">Message:</label>
                    <textarea  class="form-control"  name="message"><?php echo $_POST['message']; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <button type="submit"  name="contactus1" class="btn btn-default btn-secondary">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6" style="    z-index: 999999999999999999999;">
            <h3 style="visibility:hidden">Our Offices</h3>
            <div class="adre-detaill"  style="background: #00000003;border: #0000000f 1px solid; color: #000000;font-size: 15px;width: 300px;" >
              <h4> Office Address</h4>
              <p style="    margin-bottom: 10px;"><i class="fa fa-map-marker"></i> <?php echo $iHomeSettingDetails['contact_address']; ?> </p>
              <p style="    margin-bottom: 10px;"><a href="tel:<?php echo $iHomeSettingDetails['contact_phoneno']; ?>"><i class="fa fa-phone"></i> <?php echo $iHomeSettingDetails['contact_phoneno']; ?> </a> </p>
              <p style="    margin-bottom: 10px;"><a href="mailto:<?php echo $iHomeSettingDetails['contact_email']; ?>"><i class="fa fa-envelope-o"></i> <?php echo $iHomeSettingDetails['contact_email']; ?></a> </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include('inc.footer-new.php');	?>
</div>
<?php include('inc.js-new.php');	?>
</body>
</html>
