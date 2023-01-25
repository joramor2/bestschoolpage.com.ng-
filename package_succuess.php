<?php include('config.php'); 
include('skool/inc.session-create.php');

$iPayment=$db->getRow("select * from school_purchased_pacakage where success_token = '".$_GET['token']."'");

if($_GET['transaction_id']!='')
		{
			$url = 'https://voguepay.com/?v_transaction_id='.$_GET['transaction_id'].'&type=json&demo=true';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$result = curl_exec($ch);
			curl_close($ch);
			$obj = json_decode($result, true);
			/*echo '<pre>';
			print_r($obj);
			echo '</pre>';*/
			$obj['status'];
			$isAPproved='0';
			
			
			
		if($obj['status']=='Approved' && $iPayment['id']!='')
			{
				$aryData = array(
								'status'						=>	1,
								);
				$flgIn = $db->updateAry("school_purchased_pacakage", $aryData,"where id='".$iPayment['id']."'");
				//echo $flgIn = $db->getLastQuery();
				
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
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <?php if($isAPproved=='1') { ?>
          <h2>Congratulation! Payment have done sucessfully.</h2>
          <?php }  elseif($_GET['action']=='cancel') { ?>
          <h2>Payment have been cancelled.</h2>
          <?php } elseif($_GET['action']=='success') { ?>
          <h2>Registeration have done sucessfully.</h2>
          <?php } else { ?>
          <h2>Invalid URL.</h2>
          <?php } ?>
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>
  <?php include('inc.footer-new.php');	?>
</div>
<?php include('inc.js-new.php');	?>
</body>
</html>
