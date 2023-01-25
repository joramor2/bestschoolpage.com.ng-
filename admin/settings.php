<?php  
include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="settings";
$FileName = 'settings.php';
$iClassName = ADMIN_URL;
$validate=new Validation();
if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
   unset($_SESSION['success']);
}

if(isset($_POST['update']))
	{ 
                         
						 
						 
						 
     $aryData=array(	
					'call_number'     	 	     	 =>	$_POST['call_number'],
					'banner_description'     	 	         	 =>	$_POST['banner_description'],
					'marketing_expert'     	 	     =>	$_POST['marketing_expert'],
				 
					'marketing_callno'     	 	     =>	$_POST['marketing_callno'],
					'request_demo_content'     	 	         =>	$_POST['request_demo_content'],
					
					
					
					'automate_1'     	 	         =>	$_POST['automate_1'],
					'automate_2'     	 	         =>	$_POST['automate_2'],
					'automate_3'     	 	         =>	$_POST['automate_3'],
					
					
					'institute_process_1'     	 	         =>	$_POST['institute_process_1'],
					'institute_process_2'     	 	         =>	$_POST['institute_process_2'],
					'institute_process_3'     	 	         =>	$_POST['institute_process_3'],
					
					
					'newsletter_content'     	 	     =>	$_POST['newsletter_content'],
					'contact_address'     	 =>	$_POST['contact_address'],
					
					
					'contact_phoneno'     	 	            =>	$_POST['contact_phoneno'],
					'contact_email'     	                 =>	$_POST['contact_email'],
					
					
					
					'footer_content'     	 =>	$_POST['footer_content'],
					
					
					
					'fb_link'     	 						=>	$_POST['fb_link'],
					'twitter_link'     	 					=>	$_POST['twitter_link'],
					'linkedin_link'     					=>	$_POST['linkedin_link'],
					'youtube_link'     	 					=>	$_POST['youtube_link'],
					'footer_description'     	 			=>	$_POST['footer_description'],
					 
					);  
					
						// Replace injection attacks
						foreach($aryData as $key => $value){
						    $value = str_ireplace('meta','_',$value);
						    $value = str_ireplace('script','_',$value);
						    $value = str_ireplace('drop','_',$value);
						    $aryData[$key] = $value;
                        }
		$flgIn = $db->updateAry("home_content", $aryData , "where id='1'");						 
	 				 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						   if(isset($_FILES["companylogo"]["name"]) && !empty($_FILES["companylogo"]["name"]))
                            {  
                               $filename = basename($_FILES['companylogo']['name']);
                              $ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
                               if(in_array($ext1,array('jpg','png','jpeg', 'gif')))
                            {     
                                $newfile=md5(time())."_".$filename;

                                move_uploaded_file($_FILES['companylogo']['tmp_name'],"../uploads/".$newfile);
                            }       
                            }
                              else
                             { 
                                 $newfile =$_POST['companylogo_old'];
                             }
     $aryData=array(	
					'headerphone'     	 	     	 =>	$_POST['headerphone'],
					'emailid'     	 	         	 =>	$_POST['emailid'],
					'headeraddress'     	 	     =>	$_POST['headeraddress'],
					'companylogo'     	 	         =>	$newfile,
					'facebook_link'     	 	     =>	$_POST['facebook_link'],
					'tweeter_link'     	 	         =>	$_POST['tweeter_link'],
					'google_link'     	 	         =>	$_POST['google_link'],
					'instagram_link'     	 	     =>	$_POST['instagram_link'],
					'customer_service_email'     	 =>	$_POST['customer_service_email'],
					'youtube'     	 	            =>	$_POST['youtube'],
					'linkedin'     	                 =>	$_POST['linkedin'],
					'customer_service_phone'     	 =>	$_POST['customer_service_phone'],
					'customer_service_timing'     	 =>	$_POST['customer_service_timing'],
					'technical_support_email'     	 =>	$_POST['technical_support_email'],
					'technical_support_phone'     	 =>	$_POST['technical_support_phone'],
					'technical_support_timing'     	 =>	$_POST['technical_support_timing'],
					'minreturnday'     	 			 =>	$_POST['minreturnday'],
					'footer_timing'     	         =>	$_POST['footer_timing'],
					'footer_copyrights'     	     =>	$_POST['footer_copyrights'],
					);  
		$flgIn = $db->updateAry("settings", $aryData , "where id='".$_SESSION[LOGIN_ADMIN]['id']."'");
			//	echo 	$flgIn = $db->getLastQuery();exit;
					$_SESSION['success']="Profile updatd successfully";
					unset($_POST);
					redirect($iClassName.$FileName);
			
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
            
            
            
            
            
            <style>
			.thisisform label { text-transform:capitalize; }
			</style>
            
            
           <?php   $aryDetail=$db->getRow("select * from  home_content where id = '1'");  ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data"  class="thisisform">
                <div>
       
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">call number</label>
                      <div class="col-lg-10">
                      
                        <input type="text" class="form-control required" id="call_number" name="call_number" value="<?php echo $aryDetail['call_number']; ?>">
                      </div>
                    </div>
                    
                    
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">banner description</label>
                      <div class="col-lg-10">
                       <textarea class="form-control required" name="banner_description" ><?php echo $aryDetail['banner_description']; ?></textarea> 
                       </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">marketing expert</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="headerphone" name="marketing_expert" value="<?php echo $aryDetail['marketing_expert']; ?>">
                      </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">marketing callno</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="headerphone" name="marketing_callno" value="<?php echo $aryDetail['marketing_callno']; ?>">
                      </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">request demo content</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="request_demo_content" name="request_demo_content" value="<?php echo $aryDetail['request_demo_content']; ?>">
                      </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">automate 1</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="automate_1" name="automate_1" value="<?php echo $aryDetail['automate_1']; ?>">
                      </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">automate 2</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="automate_2" name="automate_2" value="<?php echo $aryDetail['automate_2']; ?>">
                      </div>
                    </div>
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">automate 3</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="automate_3" name="automate_3" value="<?php echo $aryDetail['automate_3']; ?>">
                      </div>
                    </div>
                    
                    
                    
                      <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">institute process 1</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="institute_process_1" value="<?php echo $aryDetail['institute_process_1']; ?>">
                      </div>
                    </div>
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">institute process 2</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="institute_process_2" value="<?php echo $aryDetail['institute_process_2']; ?>">
                      </div>
                    </div>
                    
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">institute process 3</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="institute_process_3" value="<?php echo $aryDetail['institute_process_3']; ?>">
                      </div>
                    </div>
                    
                    
                    
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">newsletter content</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="newsletter_content" value="<?php echo $aryDetail['newsletter_content']; ?>">
                      </div>
                    </div>
                    
                    
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">contact address</label>
                      <div class="col-lg-10">
 
                           <textarea class="form-control required" name="contact_address" ><?php echo $aryDetail['contact_address']; ?></textarea> 
                      </div>
                    </div>
                    
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">contact phoneno</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="contact_phoneno" value="<?php echo $aryDetail['contact_phoneno']; ?>">
                      </div>
                    </div>
                    
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">contact email</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="contact_email" value="<?php echo $aryDetail['contact_email']; ?>">
                      </div>
                    </div>
                    
                    
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">footer content</label>
                      <div class="col-lg-10">
                       <textarea class="form-control required" name="footer_content" ><?php echo $aryDetail['footer_content']; ?></textarea> 
             
                      </div>
                    </div>
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">fb link</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="fb_link" value="<?php echo $aryDetail['fb_link']; ?>">
                      </div>
                    </div>
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">twitter link</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="twitter_link" value="<?php echo $aryDetail['twitter_link']; ?>">
                      </div>
                    </div>
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">linkedin link</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="linkedin_link" value="<?php echo $aryDetail['linkedin_link']; ?>">
                      </div>
                    </div>
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">youtube link</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="youtube_link" value="<?php echo $aryDetail['youtube_link']; ?>">
                      </div>
                    </div>
                         <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">footer description</label>
                      <div class="col-lg-10">
            
                         <textarea class="form-control required" name="footer_description" ><?php echo $aryDetail['footer_description']; ?></textarea> 
                      </div>
                    </div>
                           
					 
					
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-default">Update</button>
              
            
              </form>
            </div> 
            
            
 
               
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