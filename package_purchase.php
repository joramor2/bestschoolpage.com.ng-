<?php include('config.php');
include('inc.session-create.php');
$PageTitle = "Packages";
$FileName = 'package_purchase.php';
$validate = new Validation();
if($_SESSION['userid']=="")
{
redirect(LIVE_URL.'login.php');
}
if(isset($_POST['pakages']))
{
	$iPlan=$db->getRow("select * from package where id='".$_POST['plan_id']."'");
	$exdate=date('Y-m-d');
    $rSchool_Pakage=$db->getRow("select id from school_purchased_pacakage where id='".$_SESSION['userid']."' and exp_date > $exdate "); 
	echo("select * from school_purchased_pacakage where id='".$_SESSION['userid']."' and exp_date > $exdate ");
	$success_token = randomFix(15);
	
	$cancel_token = randomFix(15);
	
	if($rSchool_Pakage['id']=='' )
	{   
        $date=date('Y-m-d');
		$days = $iPlan['no_of_days'];
		$expDate= date('Y-m-d', strtotime($date. " + $days days"));

		$aryData = array(
						'plan_id'						=>	$iPlan['id'],
						'plan_name'						=>	$iPlan['title'],
						'price'							=>	$iPlan['price'],
						'no_of_days'					=>	$iPlan['no_of_days'],
						'exp_date'						=>	$expDate,			
		                'usertype'						=>	$_SESSION['usertype'],
						'userid'						=>	$_SESSION['userid'],
						'success_token'					=>	$success_token,
						'cancel_token'					=>	$cancel_token,
						'create_at'						=>	date('Y-m-d H:i:s'),
						'status'						=>	0,
						
						);
			$flgIn = $db->insertAry("school_purchased_pacakage", $aryData);
			$_SESSION['payment_id'] = $flgIn;
			exit;
			redirect(LIVE_URL.'package_vogupay.php');
	}
	else {
	
	echo "<script>alert('You Have Already Purchased  Plan');</script>";
	}
	
}
?>
<!DOCTYPE html>
<html lang="en-US" prefix="#">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
  <?php include('inc.meta.php'); ?>  
	<style>
	.price-table .services {
    height: 515px;
}


.vijju{
	padding-bottom:30px;
	    background: #cecece82;
	
}

.main-navbar {
    margin-bottom: 0;
	}




.price-table{
	  margin: 0px 143px 0px 143px;
    padding: 13px 0 10px 0;
}

.vijju .price-table .sec1-head span:hover{

}


.vijju .price-table .sec1-head span{
    font-size: 27px;
    font-family: arial;
    font-weight: 700;
    color: #1B3058;
    margin-left: 101px;
    cursor: default;
}

.price-table h2{
text-align: center;
    font-family: 'Open Sans', sans-serif;
    font-size: 32px;
    font-weight: bold;
    color: tomato;	
}

.price-table .tables-rj{
	      margin: 20px 100px 0px 100px;
}

.price-table .table-vj{
	       text-align: center;
    /* border: 0px solid #cb0e0e4a; */
    padding-bottom: 12px;
    background: white;
    box-shadow: 0px 0px 6px 1px #f8f4f4;
    transition: transform .5s;
	    box-shadow: 0px 0px 1px 0px grey;
	
}

.price-table .table-vj hr{
margin:0;	
	
}


.price-table .basic{
	background: #d39d05;
    padding: 5px;
	
}
.price-table .basic h3{
	    font-family: calibri;
    color: #ffffffd9;
    font-size: 35px;
    margin: 5px;
}

.price-table .basic-price{
	background: #ebb413;
	border-bottom: 1px solid black;
}


.price-table .basic-price h1{
font-family: sans-serif;
    font-size: 40px;
    color: #ffffffe8;
	
}

.price-table .basic-price p{
	color: #ffffffd1;
   /* font-family: monospace; */
    font-size: 15px;
    font-family: Microsoft JhengHei UI heavy;
    padding-bottom: 2px;
}

.price-table .standard-{
	background: #7d1e4a;
    padding: 5px;
	
}

.price-table .standard- h3{
	font-family: calibri;
    color: #ffffffd9;
    font-size: 35px;
    margin: 5px;
	
}

.price-table .standard-price{
    background: #97285b;
	border-bottom: 1px solid black;
}

.price-table .standard-price h1{
	font-family: sans-serif;
    font-size: 40px;
    color: #ffffffe8;
}

.price-table .standard-price p{
    color: #ffffffd1;
    /* font-family: monospace; */
    font-size: 15px;
    font-family: Microsoft JhengHei UI heavy;
    padding-bottom: 2px;
	
}


.price-table .premium{
background: #14646d;
    padding: 5px;
	
}


.price-table .premium h3{
font-family: calibri;
    color: #ffffffd9;
    font-size: 35px;
    margin: 5px;
}



.price-table .premium-price{
	background: #2d818b;
	border-bottom: 1px solid black;
}



.price-table .premium-price h1{
	font-family: sans-serif;
    font-size: 40px;
    color: #ffffffe8;

}

.price-table .premium-price p{
	color: #ffffffd1;
    /* font-family: monospace; */
    font-size: 15px;
    font-family: Microsoft JhengHei UI heavy;
    padding-bottom: 2px;
}


.price-table .services{
          padding: 20px 0 0 0;
    background: white;
    line-height: 30px;
}
.price-table .services p{
	      /* font-family: sans-serif; */
    font-size: 15px;
   color: #0000009e;
    /*font-weight: 700;*/
    font-family: 'Fira Sans Condensed', sans-serif;
	
}

.price-table .sing-up-1{
	padding-top: 20px;
	
}
.price-table .sing-up-2{
	padding-top: 20px;
	
}
.price-table .sing-up-3{
	padding-top: 20px;
	
}

.price-table .sing-up-1 button{
	    padding: 10px 20px 10px 20px;
    border: 0px solid;
   background: #ebb413;
   /* font-family: calibri;*/
    font-weight: 800;
    border-radius: 4px;
	    color: white;
   font-size: 12px;
    font-family: Microsoft JhengHei UI heavy;
	/*text-shadow: 0px 0px 8px black;*/
}
.price-table .sing-up-2 button{
	    padding: 10px 20px 10px 20px;
    border: 0px solid;
   background: #97285b;
   /* font-family: calibri;*/
    font-weight: 800;
	    color: white;
    border-radius: 4px;
    font-size: 12px;
    font-family: Microsoft JhengHei UI heavy;
	/*text-shadow: 0px 0px 8px black;*/
}

.price-table .sing-up-3 button{
	    padding: 10px 20px 10px 20px;
    border: 0px solid;
        background: #2d818b;
    /*font-family: calibri;*/
    font-weight: 800;
    border-radius: 4px;
	    color: white;
    font-size: 12px;
    font-family: Microsoft JhengHei UI heavy;
	/*text-shadow: 0px 0px 8px black;*/
}


.price-table .table-vj:hover {
transform: scale(1.1); 
}




															@media (max-width:767px){
.price-table {
    width: 100%;
    padding: 0;
    margin: 0;
}	
	
.vijju .price-table .sec1-head{
padding-bottom:20px;
}

	
.price-table .tables-rj{
margin: 0;
}	

.price-table .table-vj {
    margin-bottom: 60px;
	border: 4px solid #817d7d4a;
}	
																
																
.price-table .table-vj:hover {
transform: scale(1); 
}
																
																
																
																
																
																
															}
															
															
															@media (min-width:768px) and (max-width:1024px){
.price-table {
    width: 100%;
    padding: 0;
    margin: 0;
}	
																
.price-table .tables-rj{
margin: 0;
}																	
	

.price-table .services {
   line-height: 15px;
}	
	
.vijju .price-table .sec1-head span {
margin:0;	
}
	
	.vijju .price-table .sec1-head{
padding-bottom:20px;
}
																
																
																
																
																
																
																
															}





	
	
	
	
	</style>
	
</head>
<body data-rsssl=1 class="home page-template page-template-page-templates page-template-home page-template-page-templateshome-php page page-id-5780 woocommerce-no-js tribe-no-js">

<div id="container">
<?php include('inc.header.php'); ?>
   
	 <div class="vijju">
	
	<section class="price-table">
<div class="container">


<div class="row">
<div class="col-md-12">
<div class="sec1-head">
<span> Packages </span>

</div>
</div>
</div>

<div class="tables-rj">
<div class="row">
<?php
$i=0;
$aryDetail=$db->getRows("select * from package where status!=0 order by id asc");
foreach($aryDetail as $ilist){
$i++;

	?>
	
<div class="col-md-4 col-sm-4 col-xs-12">
<div class="table-vj" style="text-align:center;">
<div class="<?php if($i=='1'){ echo "basic"; } elseif($i=='2'){ echo "standard-"; } elseif($i=='3'){ echo "premium" ; } else{ echo "basic"; } ?>">
<div class="row">
<div class="col-md-12">
<h3><?php echo $ilist['title']; ?></h3>
</div>

</div>

</div>

<div class="<?php if($i=='1'){ echo "basic"; } elseif($i=='2'){ echo "standard"; } elseif($i=='3'){ echo "premium" ; } else{ echo "basic"; } ?>-price">
<div class="row">
<div class="col-md-12">

<h1>₦ <?php echo $ilist['price']; ?></h1>
<p><?php //echo $ilist['no_of_days']; ?> </p>

</div>
</div>

</div>
<hr>
<div class="services">
<div class="row">
<div class="col-md-12">
<?php if($ilist['create_custom_forms']=='1')      {  ?>               <p>Create custom forms</p>                 <?php } ?>
<?php if($ilist['report_templates']=='1')         {  ?>               <p>Report Templates</p>                    <?php } ?>
<?php if($ilist['online_and_bank_payment']=='1')  {  ?>              <p>Online Bank Payment</p>                  <?php } ?>
<?php if($ilist['dashboard']=='1')                {  ?>              <p>Dashboard</p>                            <?php } ?>
<?php if($ilist['exam_feature']=='1')             {  ?>              <p>Exam Feature</p>                         <?php } ?>
<?php if($ilist['sms_alert']=='1')                {  ?>              <p>Sms Alert</p>                            <?php } ?>
<?php if($ilist['email_notification']=='1')       {  ?>              <p>Email Notification</p>                   <?php } ?>
<?php if($ilist['document_upload']=='1')          {  ?>              <p>Document Upload</p>                      <?php } ?>
<?php if($ilist['sms_campaigns']=='1')            {  ?>              <p>Sms campaigns</p>                        <?php } ?>
<?php if($ilist['email_campaigns']=='1')          {  ?>              <p>Email Campaigns</p>                       <?php } ?>
<?php if($ilist['report_and_data_export']!='')   {  ?>              <p>Report and data export(<?php echo $ilist['report_and_data_export']; ?>)</p>   <?php } ?>
<?php if($ilist['attendance_module']=='1')        {  ?>              <p>Attendance Module</p>        <?php } ?>
</div>
</div>

</div>

<div class="sing-up-1">
<div class="row">
<div class="col-md-12 ">
<form action="" method="post">
<input type="hidden" name="plan_id" value="<?php echo $ilist['id']; ?> ">
<button style="background-color:<?php if($i=='1'){ echo "#ebb313;"; } elseif($i=='2'){ echo "#96285a;"; } elseif($i=='3'){ echo "#35818b;" ; } else{ echo "#ebb313;"; } ?>" type="submit" name="pakages">Buy Now</button>
</form>
</div>
</div>
</div>


</div>
</div>

<?php } ?>
</div>
</div>






</div>
</section> 


	
</div>

   	
	

	<footer class="site-footer">

		<div class="wrapper">

            <div class="widget-areas">

                        			<div class="column">

        				<div class="widget widget_text" id="text-2">			<div class="textwidget"><p>&nbsp;</p>
<h3>Academica University</h3>
<p><small><em>since 1971</em></small></p>
<p><small>910 Elliot Ave S<br />
Minneapolis, MN 55404<br />
1-800-123-4-567</small></p>
</div>
		<div class="cleaner">&nbsp;</div></div>
        				<div class="cleaner">&nbsp;</div>
        			</div><!-- end .column -->

                
                
        			<div class="column">

        				<div class="widget widget_nav_menu" id="nav_menu-5"><h3 class="title">About</h3><div class="menu-about-container"><ul id="menu-about-2" class="menu"><li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-6007"><a href="about/index.html">About</a>
<ul class="sub-menu">
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6012"><a href="about/students-community/index.html">Students&#8217; Community</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6010"><a href="about/location/index.html">Location</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6011"><a href="about/staff/index.html">Staff</a></li>
</ul>
</li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6008"><a href="academics/index.html">Academics</a></li>
<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-6009"><a href="admissions/index.html">Admissions</a></li>
<li class="wpz-button menu-item menu-item-type-custom menu-item-object-custom menu-item-6140"><a href="#">Get the Theme!</a></li>
</ul></div><div class="cleaner">&nbsp;</div></div>
        				<div class="cleaner">&nbsp;</div>
        			</div><!-- end .column -->

                
                        			<div class="column">

        				<div class="widget zoom-social-icons-widget" id="zoom-social-icons-widget-4"><h3 class="title">Connect with us</h3>
		
		<ul class="abhiik zoom-social-icons-list zoom-social-icons-list--with-canvas zoom-social-icons-list--round">

			<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a><span class="zoom-social_icons-list__label"><a href="#">Facebook</a></span></li>
		<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a><span class="zoom-social_icons-list__label"><a href="#">Twitter</a></span></li>
		<li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a><span class="zoom-social_icons-list__label"><a href="#">YouTube</a></span></li>
		<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></i></a><span class="zoom-social_icons-list__label"><a href="#">Instagram</a></span></li>
		<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a><span class="zoom-social_icons-list__label"><a href="#">LinkedIn</a></span></li>
		<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a><span class="zoom-social_icons-list__label"><a href="#">Google Plus</a></span></li>
			
		</ul>

		<div class="cleaner">&nbsp;</div></div>
        				<div class="cleaner">&nbsp;</div>
        			</div><!-- end .column -->

                
                        			<div class="column">

        				<div class="widget jetpack_subscription_widget" id="blog_subscription-2"><h3 class="title">Subscribe for News</h3>
			<form action="#" method="post" accept-charset="utf-8" id="subscribe-blog-blog_subscription-2">
				<div id="subscribe-text"><p>Enter your email address to subscribe to this blog and receive notifications of new posts by email.</p>
</div>					<p id="subscribe-email">
						<label id="jetpack-subscribe-label" for="subscribe-field-blog_subscription-2">
							Email Address						</label>
						<input type="email" name="email" required="required" class="required" value="" id="subscribe-field-blog_subscription-2" placeholder="Email Address" />
					</p>

					<p id="subscribe-submit">
						<input type="hidden" name="action" value="subscribe" />
						<input type="hidden" name="source" value="index.html" />
						<input type="hidden" name="sub-type" value="widget" />
						<input type="hidden" name="redirect_fragment" value="blog_subscription-2" />
												<input type="submit" value="Subscribe" name="jetpack_subscriptions_widget" />
					</p>
							</form>

			<script>
			/*
			Custom functionality for safari and IE
			 */
			(function( d ) {
				// In case the placeholder functionality is available we remove labels
				if ( ( 'placeholder' in d.createElement( 'input' ) ) ) {
					var label = d.querySelector( 'label[for=subscribe-field-blog_subscription-2]' );
						label.style.clip 	 = 'rect(1px, 1px, 1px, 1px)';
						label.style.position = 'absolute';
						label.style.height   = '1px';
						label.style.width    = '1px';
						label.style.overflow = 'hidden';
				}

				// Make sure the email value is filled in before allowing submit
				var form = d.getElementById('subscribe-blog-blog_subscription-2'),
					input = d.getElementById('subscribe-field-blog_subscription-2'),
					handler = function( event ) {
						if ( '' === input.value ) {
							input.focus();

							if ( event.preventDefault ){
								event.preventDefault();
							}

							return false;
						}
					};

				if ( window.addEventListener ) {
					form.addEventListener( 'submit', handler, false );
				} else {
					form.attachEvent( 'onsubmit', handler );
				}
			})( document );
			</script>
				
<div class="cleaner">&nbsp;</div></div>
        				<div class="cleaner">&nbsp;</div>
        			</div><!-- end .column -->

                
            </div>

            <div class="cleaner">&nbsp;</div>

		</div><!-- end .wrapper -->

	</footer>





<div class="wpzoom-style-picker no_display closed" style="display: block;">

    <div class="content">

        <h2 class="picker-title">Homepage Template</h2>


        <ul>
            <li>
                <div>

                    <p><strong>Academica Pro 3.0</strong> includes <strong>4</strong> Page Templates for Home page.</p>

                    <label class="style-option">
                        <a href="index.html" class="active"><img src="../../www.wpzoom.com/wp-content/uploads/2017/06/default.png" alt="Slider Top"><span>Default</span></a>

                    </label>

                    <label class="style-option">
                        <a href="homepage-2/index.html"><img src="../../www.wpzoom.com/wp-content/uploads/2017/06/top.png" alt="Slider Top"><span>Slider at the Top</span></a>

                    </label>

                    <label class="style-option">
                        <a href="homepage-2-2/index.html"><img src="../../www.wpzoom.com/wp-content/uploads/2017/06/full.png" alt="Slider Top"><span>Full-width Slider</span></a>

                    </label>


                    <label class="style-option">
                        <a href="homepage-3/index.html"><img src="../../www.wpzoom.com/wp-content/uploads/2017/06/middle.png" alt="Slider Top"><span>Slider in the Middle</span></a>

                    </label>


                </div>
            </li>
        </ul>


    </div>

    <div class="close-button">
        <a href="#">
         </a>
    </div>


    <style>



    .wpzoom-style-picker{
        box-shadow: 0 2px 32px 10px rgba(0,0,0,.14);
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0px;
        height: 100vh;
        z-index: 999;
        background: #F4F6F8;
        transition: all 0.3s ease 0s;
        border-right: 3px solid #193058;
    }

    .wpzoom-style-picker.closed {
        left: -290px;
        box-shadow: none;
    }


    .wpzoom-style-picker .content{

        height: 100%;
        overflow-y: auto;
        position: relative;
        z-index: 1;
        width: 280px; }


    .wpzoom-style-picker .picker-title{margin: 0 0 15px; background: #193058; padding: 8px 15px; font-weight: 600; color: #fff; text-align: center;  text-transform: none; font-size: 16px;}



    .wpzoom-style-picker .content ul {
        margin: 0;
    }

    @-moz-keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        -moz-transform: translateX(0);
        transform: translateX(0);
      }
      40% {
        -moz-transform: translateX(10px);
        transform: translateX(100px);
      }
      60% {
        -moz-transform: translateX(5px);
        transform: translateX(5px);
      }
    }
    @-webkit-keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        -webkit-transform: translateX(0);
        transform: translateX(0);
      }
      40% {
        -webkit-transform: translateX(10px);
        transform: translateX(10px);
      }
      60% {
        -webkit-transform: translateX(5px);
        transform: translateX(5px);
      }
    }
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% {
        -moz-transform: translateX(0);
        -ms-transform: translateX(0);
        -webkit-transform: translateX(0);
        transform: translateX(0);
      }
      40% {
        -moz-transform: translateX(10px);
        -ms-transform: translateX(10px);
        -webkit-transform: translateX(10px);
        transform: translateX(10px);
      }
      60% {
        -moz-transform: translateX(5px);
        -ms-transform: translateX(5px);
        -webkit-transform: translateX(5px);
        transform: translateX(5px);
      }
    }

    .wpzoom-style-picker.closed .close-button{
        -moz-animation: bounce 2s infinite;
        -webkit-animation: bounce 2s infinite;
        animation: bounce 2s infinite;
        padding-left: 10px;
        width: 50px;
        right: -49px;
    }

    .wpzoom-style-picker .close-button {
        border-radius: 0 4px 4px 0;
        background: #193058;
        overflow: hidden;
        width: 40px;
        height: 44px;
        padding: 4px 0;
        text-align: center;
        position: absolute;
        right: -43px;
        top: 88px;
  }

    .wpzoom-style-picker .close-button a{
        display: inline-block;
        width: 20px;
         text-align: center;
         color: #fff;
         font-family: 'dashicons';
         speak: none;
         font-style: normal;
         font-size: 22px;
         font-weight: normal;
         font-variant: normal;
         text-transform: none;
         -webkit-font-smoothing: antialiased;
         text-decoration: none;
    }

    .wpzoom-style-picker.closed .close-button a {
        -webkit-animation: fa-spin 2s infinite linear;
        animation: fa-spin 2s infinite linear;
    }

    @keyframes fa-spin {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
      }
    }
    .wpzoom-style-picker .close-button a:before {
        content: "\f335";
    }
    .wpzoom-style-picker.closed .close-button a:before {
        content: "\f111";
     }

    .wpzoom-style-picker li{display: block; clear: both; overflow: hidden; padding: 15px 30px; text-align: center; }
    .wpzoom-style-picker li p { text-align: left; margin-bottom: 20px; font-size: 14px; }
    .wpzoom-style-picker li .setting-title{clear: both;  margin: 10px 0; color: #2E75AF; font-size: 14px; font-weight: 600;  }

    .wpzoom-style-picker li label.style-option{  float: left; margin-bottom: 20px; cursor: pointer; transition: all .15s ease-in-out;}

    .wpzoom-style-picker li label { transition: all .2s ease;}

    .wpzoom-style-picker li label select{clear: both;}


    .wpzoom-style-picker li label img {
        border: solid 2px #c0cdd6;
        border-radius: 3px;
        background: #fefefe;
    }

    .wpzoom-style-picker li label.active img {
        border-color: #3173b2;
    }

    .wpzoom-style-picker li label.active span {
        background: #3173b2;
    }
    .wpzoom-style-picker li label span {
        margin: 6px auto 0;
        font-size: 14px;
        padding: 1px 15px;
        text-align: center;
        border-radius: 20px;
        background: #8FB2C9;
        color: #fff;
        font-weight: 600;
        display: inline-block;
    }


    .wpzoom-style-picker .content img {
        max-width: 100%;
        height: auto;
    }

    .wpzoom-style-picker .content a:hover img {
        border-color: #3173b2;
    }

    .wpzoom-style-picker .content label a:hover span {
        background:#3173b2;
    }

    .wpzoom-style-picker .content a.active img {
        border-color: #3173b2;
    }

    .wpzoom-style-picker .content label a.active  span  {
        background: #3173b2;
    }


    @media only screen and (max-width: 768px){
        .wpzoom-style-picker{display: none !important;}
    }

    </style>


    <script>

    jQuery(document).ready(function(){
        jQuery(".wpzoom-style-picker").fadeIn();

        jQuery(".wpzoom-style-picker .close-button").bind("click", function(e){
            jQuery(".wpzoom-style-picker").toggleClass("closed");
            e.preventDefault();
        });

    });

    </script>
</div>




    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-3078969-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-3078969-5');
      gtag('config', 'AW-1029774828');
    </script>


    		<script>
		( function ( body ) {
			'use strict';
			body.className = body.className.replace( /\btribe-no-js\b/, 'tribe-js' );
		} )( document.body );
		</script>
			<div style="display:none">
	</div>
	
<script> /* <![CDATA[ */var tribe_l10n_datatables = {"aria":{"sort_ascending":": activate to sort column ascending","sort_descending":": activate to sort column descending"},"length_menu":"Show _MENU_ entries","empty_table":"No data available in table","info":"Showing _START_ to _END_ of _TOTAL_ entries","info_empty":"Showing 0 to 0 of 0 entries","info_filtered":"(filtered from _MAX_ total entries)","zero_records":"No matching records found","search":"Search:","all_selected_text":"All items on this page were selected. ","select_all_link":"Select all pages","clear_selection":"Clear Selection.","pagination":{"all":"All","next":"Next","previous":"Previous"},"select":{"rows":{"0":"","_":": Selected %d rows","1":": Selected 1 row"}},"datepicker":{"dayNames":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"dayNamesShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"dayNamesMin":["S","M","T","W","T","F","S"],"monthNames":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthNamesShort":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthNamesMin":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"nextText":"Next","prevText":"Prev","currentText":"Today","closeText":"Done","today":"Today","clear":"Clear"}};var tribe_system_info = {"sysinfo_optin_nonce":"6dc846bcdb","clipboard_btn_text":"Copy to clipboard","clipboard_copied_text":"System info copied","clipboard_fail_text":"Press \"Cmd + C\" to copy"};/* ]]> */ </script><script>(function($){$(document).ready(function(){});})(jQuery);</script>	<script type="text/javascript">
		var c = document.body.className;
		c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
		document.body.className = c;
	</script>

	<!--[if lte IE 8]>
<link rel='stylesheet' id='jetpack-carousel-ie8fix-css'  href='https://demo.wpzoom.com/academica-pro-3/wp-content/plugins/jetpack/modules/carousel/jetpack-carousel-ie8fix.css?ver=20121024' type='text/css' media='all' />
<![endif]-->
<script type='text/javascript' src="js/devicepx-jetpack.js"></script>

<script type='text/javascript' src="js/add-to-cart.min.js"></script>
<script type='text/javascript' src="js/js.cookie.min.js"></script>

<script type='text/javascript' src="js/woocommerce.min.js"></script>

<script type='text/javascript' src="js/cart-fragments.min.js"></script>
<script type='text/javascript' src="js/cart-fragments.minn.js"></script>

<script type='text/javascript' src="js/gprofiles.js"></script>

<script type='text/javascript' src="js/wpgrohod.js"></script>
<script type='text/javascript' src="js/comment-reply.min.js"></script>
<script type='text/javascript' src="js/jquery.slicknav.min.js"></script>
<script type='text/javascript' src="js/dropdown.js"></script>
<script type='text/javascript' src="js/flickity.pkgd.min.js"></script>
<script type='text/javascript' src="js/jquery.fitvids.js"></script>
<script type='text/javascript' src="js/search_button.js"></script>

<script type='text/javascript' src="js/functions.js"></script>
<script type='text/javascript' src="js/functionss.js"></script>
<script type='text/javascript' src="js/social-icons-widget-frontend.js"></script>

<script type='text/javascript' src="js/milestone.min.js"></script>
<script type='text/javascript' src="js/new-tab.min.js"></script>
<script type='text/javascript' src="js/galleria.js"></script>
<script type='text/javascript' src="js/wzslider.js"></script>
<script type='text/javascript' src="js/fitvids.min.js"></script>
<script type='text/javascript' src="js/wp-embed.min.js"></script>
<script type='text/javascript' src="js/spin.min.js"></script>
<script type='text/javascript' src="js/jquery.spin.min.js"></script>

<script type='text/javascript' src="js/jetpack-carousel.min.js"></script>
<script type='text/javascript' src="js/tiled-gallery.min.js"></script>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>


</body>

<!-- Mirrored from demo.wpzoom.com/academica-pro-3/ by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Jan 2019 11:24:31 GMT -->
</html>
<!-- Dynamic page generated in 0.635 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2019-01-17 08:38:36 -->

<!-- super cache -->