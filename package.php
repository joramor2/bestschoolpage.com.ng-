<?php include('config.php');

$iLoginUserDetail=$db->getRow("select * from school_register where id='".$_SESSION['userid']."'");
$create_by_usertype = $iLoginUserDetail['create_by_usertype'];
if($iLoginUserDetail['create_by_userid']=='0')
{
	$create_by_userid = $_SESSION['userid'];
}
else
{
	$create_by_userid = $iLoginUserDetail['create_by_userid'];
}

if(isset($_POST['addnewrecord']))
	{


$ipackagePlan=$db->getRow("select * from package where id = '".$_POST['plan_id']."'");	
$iSuccessToken = randomFix(28);

$NewArray = array(
				'create_custom_forms'							=>	$_POST['create_custom_forms'],
				'report_templates'								=>	$_POST['report_templates'],
				'online_and_bank_payment'						=>	$_POST['online_and_bank_payment'],
				'dashboard'										=>	$_POST['dashboard'],
				'exam_feature'									=>	$_POST['exam_feature'],
				'sms_alert'										=>	$_POST['sms_alert'],
				'email_notification'							=>	$_POST['email_notification'],
				'document_upload'								=>	$_POST['document_upload'],
				/*'online_adverts'								=>	$_POST['online_adverts'],
				'sms_campaigns'									=>	$_POST['sms_campaigns'],
				'email_campaigns'								=>	$_POST['email_campaigns'],*/
				);
$myJSON = json_encode($NewArray);



if($_POST['yearly_terms']=='1')
	{
			$iPricePackage = $ipackagePlan['price_yearly'];
			$iNoDaysPackage = $ipackagePlan['days_yearly'];
	}
else {
	
			$iPricePackage = $ipackagePlan['price_term'];
			$iNoDaysPackage = $ipackagePlan['days_term'];
	}

$Date = date('Y-m-d');
$iExpDaTe =  date('Y-m-d', strtotime($Date. " + $iNoDaysPackage days"));


	$aryData = array(
				'plan_id'						=>	$ipackagePlan['id'],
				'plan_name'						=>	$ipackagePlan['title'],
				'price'							=>	$iPricePackage,
				'no_of_days'					=>	$iNoDaysPackage,
				'file_allow'					=>	$myJSON,
				'exp_date'					=>	$iExpDaTe,
				'status'						=>	0,
				'usertype'						=>	0,
				'success_token'					=>	$iSuccessToken,
				'cancel_token'					=>	randomFix(28),
				'create_at'						=>	date("Y-m-d H:i:s"),	
				'userid'						=>	$create_by_userid,
				);
	$flgIn = $db->insertAry("school_purchased_pacakage", $aryData);	
		redirect(SITE_URL.'package_vogupay.php?token='.$iSuccessToken);
	}

?>
<html>
<head>
<title>Package Purchase</title>
<?php include('inc.meta-new.php');	?>
<link rel='stylesheet' href="<?php echo SITE_URL; ?>css/abhi.css" type='text/css' media='all' />
<script>
function yearlytermswise(getid)
	{
		//document.getElementById("yearly_terms").value=getid;
		
		
		  $(".yearly_terms").val(getid);                  
		if(getid=='1') {
			
			$("#btul2").removeClass('yrltrmwse');
		$("#btul1").addClass('yrltrmwse');
		
		
				
		$(".pricesyearly").css('display','block');
		$(".pricesterms").css('display','none');
		
		} else {
		
		$("#btul1").removeClass('yrltrmwse');	
		$("#btul2").addClass('yrltrmwse');	
		$(".pricesterms").css('display','block');
		$(".pricesyearly").css('display','none');
			
		}
	}
</script>
<style>
.yrltrmwse {
	    background: #acf3eb!important;
    border: 1px solid #acf3eb!important;
}
/*.abhii-3.pricing-table-1 .pricing {
    display: block;
    justify-content: center;
    margin: 10px;
}*/

.abhii-3.pricing-table-1 .pricing-palden .pricing-price {
    font-size: 3em;

}
.abhii-3.pricing-table-1 .pricing {
    display: block;
    justify-content: center;
    width: 100%;
    margin: auto;
    padding: 10%;
}

@media only screen and (max-width: 768px) {
	.abhii-3.pricing-table-1 .pricing {
				padding: 5%;
	}
}
</style>
</head>
<body class="home page-template page-template-tpl-home page-template-tpl-home-php page page-id-14">
<div id="page" class="site">
  <?php include('inc.header-new.php');	?>
  <div id="content" class="site-content">
    <section class="abhii-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <h1>FIND A PLAN THAT’S RIGHT FOR YOU.</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="abhii-3 pricing-table-1">
    <input type="button" id="btul1" value="Yearly" onClick="yearlytermswise('1');"  style="width:120px; height:40px; font-size:15px;background: #f9f9f9;"  class="btn btn-default yrltrmwse">
    <input type="button" id="btul2" value="Terms Wise" onClick="yearlytermswise('2');" style="width:120px; height:40px; font-size:15px;background: #f9f9f9;" class="btn btn-default ">
    <br><br>
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
          	 <div class="row">
               <?php			 $i=0;
                          $aryList=$db->getRows("select * from package");
                          foreach($aryList as $iList)
                            {  $i=$i+1; ?>
                            
                     <div class="col-md-4 col-sm-12 col-xs-4">  
                            <div class="pricing pricing-palden">        
                                 <form action="" method="post">
                                <input type="hidden" value="1" name="yearly_terms" class="yearly_terms">
                                      <div class="pricing-item <?php if($i=='2'){ echo "pricing__item--featured ";}?>">
                                        <div class="pricing-deco"  style="background: rgba(0, 0, 0, 0) url(image/pricing1.jpeg) center bottom no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
                                        
                                          
                                          
                                          <div class="pricing-price pricesyearly"><span class="pricing-currency">&#8358;</span><?php echo $iList['price_yearly'];?> </div>
                                          <div class="pricing-price pricesterms" style="display:none;"><span class="pricing-currency">&#8358;</span><?php echo $iList['price_term'];?> </div>
                                          
                                          
                                          
                                          <h3 class="pricing-title"><?php echo $iList['title'];?></h3>
                                        </div>
                                        <ul class="pricing-feature-list">
                                          <li class="pricing-feature">
                                            <?php if($iList['create_custom_forms']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else {  ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?> <input type="hidden" name="create_custom_forms" value="<?php echo $iList['create_custom_forms']; ?>" >
                                            Create custom forms </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['report_templates']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="report_templates" value="<?php echo $iList['report_templates']; ?>" >
                                            Report templates </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['online_and_bank_payment']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="online_and_bank_payment" value="<?php echo $iList['online_and_bank_payment']; ?>" >
                                            Online and Bank Payment </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['dashboard']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="dashboard" value="<?php echo $iList['dashboard']; ?>" >
                                            Dashboard</li>
                                          <li class="pricing-feature">
                                            <?php if($iList['exam_feature']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="exam_feature" value="<?php echo $iList['exam_feature']; ?>" >
                                            Exam Feature </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['sms_alert']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { 	?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="sms_alert" value="<?php echo $iList['sms_alert']; ?>" >
                                            SMS Alerts </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['email_notification']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { 	?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="email_notification" value="<?php echo $iList['email_notification']; ?>" >
                                            E-mail Notifications </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['document_upload']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { 	?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="document_upload" value="<?php echo $iList['document_upload']; ?>" >
                                            Document Upload </li>
                                   <!--       <li class="pricing-feature">
                                            <?php if($iList['online_adverts']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="online_adverts" value="<?php echo $iList['online_adverts']; ?>" >
                                            Online Adverts and Campaigns </li>
                                          <li class="pricing-feature">
                                            <?php if($iList['sms_campaigns']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="sms_campaigns" value="<?php echo $iList['sms_campaigns']; ?>" >
                                            SMS Campaigns</li>
                                          <li class="pricing-feature">
                                            <?php if($iList['email_campaigns']=="1"){?>
                                            <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                            <?php }  else { ?>
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                            <?php } ?><input type="hidden" name="email_campaigns" value="<?php echo $iList['email_campaigns']; ?>" >
                                            Email Campaigns </li>
                                          <li class="pricing-feature"> <i class="fa fa-check-square-o" aria-hidden="true"></i> Reporting & Data export:<?php echo $iList['report_and_data_export'];?> </li>-->
                                        </ul>
                                        <input type="hidden" value="<?php echo $iList['id']; ?>" name="plan_id" >
                                        <input type="submit" class="pricing-action sonu-button-2534 sb_add_cart" name="addnewrecord" value="Choose plan " > 
                                       </div>
                                       </form>
                           </div>
                      </div>
              <?php }  ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include('inc.footer-new.php');	?>
</div>
<?php include('inc.js-new.php');	?>
</body>
</html>
