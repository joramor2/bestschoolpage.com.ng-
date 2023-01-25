<?php include('config.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<?php include('inc.meta.php');?>
<style>
.service-type1 {
    background: white;
    padding: 40px 0 30px 0;
}
.add_wishtry_left{
	margin-top:150px;	
}
.whatis{
	margin-top: 20px;
}
.service-type1 .carousel-control.left {
    background-image: unset;
}
.service-type1 .carousel-control.right {
    background-image: unset;
}
.content{
	background: #f4f4f4;
}
.trigger{
	display:none;
}
.content .heading .text h2{
	background:#f4f4f4;
}
body{
	margin:0px;
}
.modal-body {
  position:relative;
  padding:0px;
}
.close {
  position:absolute;
  right:-30px;
  top:0;
  z-index:999;
  font-size:2rem;
  font-weight: normal;
  color:#fff;
  opacity:1;
}
.modal-body iframe {
    height: 573px !important;
}
.modal.in .modal-dialog {
    width: 1020px;
}
.btn-primary:hover{
	color: #fff;
    background-color: #f21151!important;
    border-color: #f21151!important;
}
.btn-primary:focus, .btn-primary.focus {
    color: #fff;
    background-color: #f21151;
    border-color: #f21151;
}
.submit-slide .btn {
    padding: 10px 15px 10px 15px;
    margin-top: 5px;
}
.submit-slide.pawer .btn {
    padding: 10px 15px 10px 15px;
	margin-bottom:15px !important;
}

.home-event {
	padding: 46px 0 95px 0;
	position: relative;
}
.home-event .event-box {
	padding: 42px 0 0 0;
	display: block;
	text-align: center;
}
.home-event .event-box .img {
	width: 100%;
	display: block;
	margin-bottom: 22px;
	text-align: center;
	position: relative;
	background: #000;
}
.home-event .event-box a {
	display: block;
	font-size: 14px;
	color: #f15b25;
	line-height: 24px;
}
.event-box .img a img {
	height: 200px;
	width: 100%;
	box-shadow: 3px 0px 7px 1px grey;
}
.serc .banner-search {
	display: inline-flex;
	width: 100%;
	background: white;
	padding: 10px;
	border-radius: 35px;
	padding-left: 20px;
	padding-top: 4px;
	padding-bottom: 4px;
	padding-right: 5px;
	height: 59px;
}
.banner-search .input-box:before {
	position: absolute;
	top: 1px;
	height: 115%;
	width: 1px;
	margin: auto;
	bottom: 0px;
	left: 0px;
	background: #c3bebe;
	content: "";
}
.banner-search .input-box input {
	position: absolute;
	left: 10px;
	width: 90%;
	margin: 12px;
	border: 0;
	padding-left: 13px;
}
.serc .banner-search .input-box .icon {
	position: absolute;
	left: 10px;
	top: 18px;
	z-index: 99;
}
#more {
	display: none;
}

@media screen and (max-width: 767px){
#showdata_mobile .banner-search .input-box select {
    top: 0;
    position: absolute!important;
}
#showdata_mobile  .banner-search .input-box {
   
    height: 44px;
  
}
.service-type-work .modal-body iframe {
    height: 191px !important;
}

#showdata_mobile .banner-search {
    margin-bottom: 10px;
}

.navbar-brand.arsha {
    margin: 0px!important;
    padding: 14px 0 70px 0!important;
}
.navbar-toggle.raushan {
    top: 25px!important;
}
.navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
    margin-top: 26px!important;
	padding:0px 0 0 0px!important;
}
.navbar-nav > li ul {
    box-shadow: 0 0px 0px!important;
}
.modal-content {
    margin-top: 205px!important;
}
.add_wishtry_left {
    margin-top: 25px;
}
.trigger{
	display:block;
}
.kam {
    display: block!important;
}
.xz {
    display: none;
}

}
.kam {
    display: none;
}
@media (min-width: 768px) and (max-width: 1024px){

.service-type-work .modal.in .modal-dialog {
    width: 100%;
	    padding: 71px;
}
 .login-popup {
    padding-top: 81px;
	    padding: 78px;
}
.service-type-work .modal-body iframe {
    height: 433px !important;
}
.service-type.service-type-work .banner-search .input-box select, .service-type.service-type-work .input-box input {
    
    width: 80%;
    
}
#friend_slider .owl-next {
    right: 9px;
}
}
@media (min-width: 1024px) and (max-width: 1366px){

#friend_slider .owl-next {
    right: 9px;
}}
</style>
</head>
<body>
<div class="page">
	<?php include('inc.header.php');?>
<div class="raj99">
<section class="banner">
	<div class="carousel" id="mainBnner">
		<?php $getslider=$db->getRows("select * from slider order by id desc ");
		foreach($getslider as $islider)
		{ ?>
		<div class="item"><img src="uploads/<?php echo $islider['image']; ?>"></div>
		<?php } ?>
	</div>
	<div class="banner-nav">
		<div class="prev"><span class="icon icon-arrow-left"></span></div>
		<div class="next"><span class="icon icon-arrow-right"></span></div>
	</div>
	<div class="banner-text">
		<div class="container">
			<div class="search-title">
				<h1> Every Event Should be <span>Perfect</span></h1>
			</div>
		</div>
	</div>
</section>
	
<section class="service-type service-type-work">
<div class="container">
	<div class="submit-slide pawer">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/YnMRCWm4aic" data-target="#myModal">
			See How it Works <i class="fa fa-caret-right" aria-hidden="true"></i>
		</button>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-body">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>        
						<!-- 16:9 aspect ratio -->
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/YnMRCWm4aic" id="video"  allowscriptaccess="always">></iframe>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
	<!---___DESKTOP____----->
	<div class="trigger1 xz">
	<form action="" method="GET">
		<div class="serc">
            <div class="banner-search">
				<div class="input-box">
					<div class="icon fa fa-list-alt"></div>
					<select name="category" id="category" class="form-control" onChange="customfield()">
						<option value="">Category</option>
						<?php $fetch_cat=$db->getRows("select * from event_category order by id desc");
						foreach($fetch_cat as $icat)
						{ ?>
						<?php $get_real_categ=$db->getRow("select * from admin_event where category='".$icat['id']."'");
						$dd=$db->getRow("select * from event_category where id='".$get_real_categ['category']."'");
						?>
						<option value="<?php echo $icat['id'];?>"><?php echo $icat ['title'];?></option>
						<?php } ?>
					</select>
				</div>
				<div class="input-box">
					<div class="icon fa fa-calendar-o"></div>
					<input type="text" name="event_name" placeholder="Event name">
				</div>
				<div class="input-box">
					<div class="icon icon-grid-view"></div>
					<p>
						<input type="text" placeholder="Date: DD-MM-YYYY" id="datepicker22" name="event_date">
					</p>
				</div>
				<div class="input-box location">
					<div class="icon icon-location-1"></div>
					<input type="text" placeholder="Ex: Event City" name="event_city">
				</div>
				<div class="submit-slide">
					<input type="submit" value="Search Now" name="submit" class="btn">
				</div>
			</div>
            <div class="fd" id="showdata"></div>
			
			<input type="text" id="newvalue" name="newvalue">
			
		</div>
	</form>
	</div>
	<!---___DESKTOP____----->

	

<script>	
function chekbox(getid)
{
	var values = $("input[name^='value']").map(function (idx, ele) {
	   return $(ele).val();
	   $(ele).val().replace(',','-');
	}).get();
	
	var finalvalue = values.join("-");
	
	document.getElementById('newvalue').value = finalvalue;
}
function getdropvalue(dopid)
{
	document.getElementById('newvalue'+dopid).value = document.getElementById('value'+dopid).value;
}
</script>	
	
		<div  class="trigger1 kam">
        <form action="" method="GET">
           <div class="serc">
            <div class="banner-search">
              <div class="input-box">
                <div class="icon fa fa-list-alt"></div>
                <select name="category" id="category_mobile" class="form-control" onChange="customfield_mobile()">
                  <option value="">Category</option>
                  <?php $fetch_cat=$db->getRows("select * from event_category order by id desc");
							  foreach($fetch_cat as $icat)
							  { ?>
                  <?php $get_real_categ=$db->getRow("select * from admin_event where category='".$icat['id']."'");
								   $dd=$db->getRow("select * from event_category where id='".$get_real_categ['category']."'");
								   ?>
                  <option value="<?php echo $icat['id'];?>"><?php echo $icat ['title'];?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="input-box">
                <div class="icon fa fa-calendar-o"></div>
		
                <input type="text" name="event_name" placeholder="Event name">
              </div>
              <div class="input-box">
                <div class="icon icon-grid-view"></div>
                <p>
                  <input type="text" placeholder="Date: DD-MM-YYYY" id="datepicker22" name="event_date">
                </p>
              </div>
              <div class="input-box location">
                <div class="icon icon-location-1"></div>
                <input type="text" placeholder="Ex: Event City" name="event_city">
              </div>
             

		   </div>
             <div class="fd" id="showdata_mobile">
            </div>
			
			
			 <div class="submit-slide">
                <input type="submit" value="Search Now" name="submit" class="btn">
              </div>
           

          </div>
        </form>
		 </div>
			
	  </div>
    </section>

  
    <section class="abhi-1" style="padding-bottom: 0px;"> </section>
     <?php if($_SESSION['userid']=='') { ?>
    <section class="abhi-1" style="padding-bottom: 0px;">
      <div class="container">
        <div class="row">
          <div class="rod">
            <h2>Category Listing</h2>
          </div>
          <hr style="margin-top:15px; border-top: 1px dotted #9b9b9b; margin-bottom: 0px;">
          <?php
					 $aryList=$db->getRows("select * from category_parent  order by id desc");
					 $i=0;
							 foreach($aryList as $iList)
									{	$i=$i+1;
									 
							 ?>
          <div class="col-md-3 col-xs-6 lst">
            <div class="cours2" style="overflow:hidden;"> <span class="babycatt"><?php echo $iList['pcategory']; ?></span> <img src="uploads/<?php echo $iList['image'] ?>" style="width:100%;height:200px;border:1px solid transparent;transition:1s;">
              <div class="cours3">
                <h2 style="text-align:center;color:rgb(255, 92, 0);"><?php echo $iList['pcategory']; ?></h2>
                
              </div>
              <div class="cours4 text-center"> <a href="<?php echo SITE_URL; ?>product_listing.php?m_cid=<?php echo $iList['m_cid'];?>&p_cid=<?php echo $iList['id'];?>" class="cou" style="border:1px solid transparent;padding:10px 20px ;font-size:16px;border-radius:10%;background-color:rgb(255, 92, 0);color:white;">View More</a> </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } else { ?>
    <section class="success-story" style="padding:0px;">
      <div class="container">
        <div class="row">
          <div class="rod">
            <h2 >Event Listing </h2>
          </div>
          <hr style="margin-bottom: 30px; border-top: 1px dotted #9b9b9b; ">
          <?php 
			$iSearch ='';
			
			if($_GET['event_name']!='')
		  	{
				$iEventName = $_GET['event_name'];
				$iSearch .= " and event_name LIKE '%$iEventName%'";
			}
			if($_GET['event_date']!='')
		  	{
				$iSearch .= " and event_date = '". $_GET['event_date']."'";
			}
			if($_GET['event_city']!='')
		  	{
				$iSearch .= " and event_city = '". $_GET['event_city']."'";
			}
			if($_GET['category']!='')
		  	{
 				$iSearch .= " and category = '". $_GET['category']."'";
			}
			if($_GET['category']=='' and $_GET['event_name']=='' and $_GET['event_date']=='' and $_GET['event_city']=='')
			{
				if($_SESSION['userid']!='')
				{
					$iGetEvenIds=$db->getVal("select GROUP_CONCAT(event_id) from invited_users where userid='".$_SESSION['userid']."'");
					
					if($iGetEvenIds=='')
					{
						$iSearch .= " and userid='".$_SESSION['userid']."'";
					}
					else
					{
						$iSearch .= " and id IN ($iGetEvenIds) or userid='".$_SESSION['userid']."'";
					}
				}
			}
			if($_GET['newvalue']!='')
		  	{
				$iCustomValue = explode('-',$_GET['newvalue']);

				foreach($iCustomValue as $val)
				{
					$iGetEventId = $db->getVal("select GROUP_CONCAT(event_id) from custom_event_field where value LIKE '%$val%'");
					
					$iCustomEventId .= $iGetEventId.','; 
				}
				$iFInalEventIds = rtrim($iCustomEventId,',');
				
				$iSearch .= " and id IN ($iFInalEventIds) or userid='".$_SESSION['userid']."'";
			}
		
		$getRowss=$db->getRows("select * from admin_event where status=1  $iSearch  order by id desc");
		
	    if(count($getRowss)>0) {
			foreach($getRowss as $lists)
			{   
		 $getcat=$db->getRow("select * from category where id='".$lists['category']."'");
		$iAlreadyWishList=$db->getRow("select * from invited_users where userid='".$_SESSION['userid']."' and event_id='".$lists['id']."'");
		
			?>
         
          <div class="col-sm-4">
             
			 <div class="story-box"> 
			 
			 <img src="uploads/<?php echo $lists['image']; ?>">
			   
              <div class="text">
                <div class="inner-text">
                  <a href="<?php echo SITE_URL; ?>event_detail.php?id=<?php echo $lists['id'];?>"><h3 style="color: #fff;"><?php echo $lists['event_name'];?></h3>
				  </a>
                  <p class="musiccc pull-right"> 
				  <i class="fa fa" aria-hidden="true"></i> <?php echo $getcat['title'];?></p>
				  
                  <div class="row row-inadd">
                    <div class="col-sm-8 col-xs-6">
                      <div class="icon icon-location-1"><span class="locat"><?php echo $lists['event_city'];?></span></div>
                    </div>
                    <div class="col-sm-4  col-xs-6">
                      <div class="sec-in-ic">
                        <div class="col-sm-4 col-xs-4">
						<div class="ettu">
						<a href="#"><i class="fa fa-indent" aria-hidden="true"></i></a></div></div>
                        <div class="col-sm-4 col-xs-4">
						<div class="ekuo">
                        <i  id="event<?php echo $lists['id'];?>" onclick="invition('<?php echo $lists['id'];?>')" class="fa fa-heart <?php if($iAlreadyWishList['id']!='') { echo "active"; } ?>" aria-hidden="true"></i>
						</div>
						</div>
                        <div class="col-sm-4 col-xs-4">  
                        <div class="thg">						
						<div id="socialHolder">
        		<div id="socialShare" class="btn-group share-group">
                    <a data-toggle="dropdown" class="btn btn-info">
                         <i class="fa fa-share-alt fa-inverse"></i>
                    </a>
    				<button href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle share">
    					<span class="caret"></span>
    				</button>
    				<ul class="dropdown-menu">
					<li>
    					    <a data-original-title="Whatsapp" rel="tooltip"  href="https://api.whatsapp.com/send?phone=<?php echo $getdata['mobile']?>&text=<?php echo SITE_URL;?>/event_detail.php?id=<?php echo $lists['id'];?>" class="btn btn-whatsapp" class="btn btn-whatsapp" data-placement="left">
								<i class="fa fa-whatsapp"></i>
							</a>
    					</li>
        				<li>
    					    <a data-original-title="Twitter" rel="tooltip"  href="https://twitter.com/share?url=<?php echo SITE_URL; ?>event_detail.php?id=<?php echo $lists['id'];?>&text=<?php echo $getdata['event_name'];?>&via=[via]&hashtags=<?php echo $getdata['event_name'];?>" class="btn btn-twitter" data-placement="left">
								<i class="fa fa-twitter"></i>
							</a>
    					</li>
    					<li>
    						<a data-original-title="Facebook" rel="tooltip"  href="http://www.facebook.com/sharer.php?u=<?php echo SITE_URL; ?>event_detail.php?id=<?php echo $lists['id'];?>" class="btn btn-facebook" data-placement="left">
								<i class="fa fa-facebook"></i>
							</a>
    					</li>					
    					<li>
    						<a data-original-title="Google+" rel="tooltip"  href="https://plus.google.com/share?url=<?php echo SITE_URL; ?>event_detail.php?id=<?php echo $lists['id'];?>" class="btn btn-gp" class="btn btn-google" data-placement="left">
								<i class="fa fa-google-plus"></i>
							</a>
    					</li>
    				    <li>
    						<a data-original-title="LinkedIn" rel="tooltip" href="http://www.linkedin.com/shareArticle?url=<?php echo SITE_URL; ?>event_detail.php?id=<?php echo $lists['id'];?>&title=<?php echo $getdata['event_name'];?>" class="btn btn-linkedin" data-placement="left">
								<i class="fa fa-linkedin"></i>
							</a>
    					</li>
    					<li>
    						<a data-original-title="Pinterest" rel="tooltip"  class="btn btn-pinterest" data-placement="left">
								<i class="fa fa-pinterest"></i>
							</a>
    					</li>
                        <li>
    						<a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?php echo SITE_URL;?>/event_detail.php?id=<?php echo $lists['id'];?>" data-original-title="Email" rel="tooltip" class="btn btn-mail" data-placement="left">
								<i class="fa fa-envelope"></i>
							</a>
    					</li>
                    </ul>
    			</div>
    			</div>
            </div></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
       
          <?php } } else { ?>
		<p>Event not yet created please <a href="<?php echo SITE_URL;?>create_event.php">create it.</a></p>	
		<?php } ?>		
		 
		 
        </div>
      </div>
    </section>
    <?php } ?>
     <!--<section class="service-type">
      <div class="container">
        <div class="heading">
          <div class="icon"><em class="icon icon-heading-icon"></em></div>
          <div class="text">
            <h2>Our Services</h2>
          </div>
          <div class="info-text">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
        </div>
        <div class="service-catagari">
          <ul>
            <?php $getServices=$db->getRows("select * from services order by id desc");
					 foreach($getServices as $iservices)
					 { ?>
            <li> <a href="#"> <img src="uploads/<?php echo $iservices['image']; ?>" style="height: 149px; padding-bottom: 15px;"> 
			<span class="text"><?php echo $iservices ['title'];?></span> </a> </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </section>-->
   
   <section class="service-type1">
      <div class="container">
	  <?php $aryList=$db->getRow("select * from whats_gopartee  order by id desc"); ?>
        <div class="heading">
          <div class="icon"><em class="icon icon-heading-icon"></em></div>
          <div class="text">
            <h2>what is Gopartee?</h2>
          </div>
          <div class="info-text"></div>
        </div>
		<div class="whatis">
                    <div class="row">
                        <div class="col-md-6 add_wishtry_left wow fadeInLeft animated" style=" visibility: visible; animation-name: fadeInLeft;" data-wow-animation-name="fadeInLeft">
                            
                            <p class="color_black text-justify">
                                <?php echo $aryList['description']; ?>
                                <a href="<?php echo SITE_URL; ?>about.php" class="knowmore_click">Learn More</a>
                            </p>
                        </div>
                        <div class="col-md-6 text-center wow fadeInRight animated" data-wow-animation-name="fadeInRight" style="visibility: visible; animation-name: fadeInRight;">
                            <a href="#">
                                <img src="uploads/<?php echo $aryList['image']; ?>" class="home_add_gift_right_img" alt="">
                            </a>
                        </div>
                    </div>
		
		</div>
      </div>
    </section>
   
	
	<!--<section class="content">
      <div class="container">
        <div class="home-event">
          <div class="heading">
            <div class="icon"><em class="icon icon-heading-icon"></em></div>
            <div class="text">
              <h2>Events Overview</h2>
            </div>
            <div class="info-text">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</div>
          </div>
          <div class="row">
            <?php $getOverview=$db->getRows("select * from overview order by id desc limit 3 ");
							  foreach($getOverview as $overview)
							  {
								  ?>
            <div class="col-md-4">
              <div class="event-box">
                <div class="img"> <a href="#"> <img src="uploads/<?php echo $overview['image']; ?>"> </a> </div>
                <div class="name"><?php echo $overview['title'];?></div>
                <p><?php echo $overview['short_desc'];?> <span id="dots">...</span> </p>
                <a onclick="myFunction()" id="myBtn">Readmore</a> <span id="more"><?php echo $overview['short_desc'];?></span> </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>-->
 
   <section class="service-type1">
      <div class="container">
        <div class="heading">
          <div class="icon"><em class="icon icon-heading-icon"></em></div>
          <div class="text">
            <h2>Gopartee Partner Offer</h2>
          </div>
        </div>
		<div class="offers">
        <div class="row">

  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
	<?php

		$aryList=$db->getRows("select * from offer_banner  order by id desc");
          $i=0;
		foreach($aryList as $iList)

			{
         $i=$i+1;				?>
      <div class="item <?php if($i=='1'){echo"active";} ?>">
        <img src="uploads/<?php echo $iList['image']; ?>" alt="Los Angeles" style="width:100%;">
      </div>
			<?php } ?>
      
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


        </div>
		
		</div>
      </div>
    </section>
   
 
   <section class="friends-block">
      <div class="container">
        <div class="sub-title">
          <div class="icon"><em class="icon icon-heading-icon"></em></div>
          <h2>Client Say’s</h2>
          <div class="img"><img src="images/heading-blackBgimg.png" alt=""></div>
        </div>
        <div id="friend_slider" class="carousel">
          <?php $gettesti=$db->getRows("select * from testimonal order by id desc");
					   foreach($gettesti as $itesti)
					   { ?>
          <div class="item">
            <div class="friends-info">
              <div class="friend-img">
                <div class="img"><img src="uploads/<?php echo $itesti['image']; ?>"></div>
                <div class="img-fream"><img src="images/img-fream.png" alt=""></div>
                <div class="name"><?php echo $itesti['title'];?></div>
              </div>
              <div class="text">
                <p><img src="images/starting-point.png" alt="" class="start-img"><?php echo $itesti['event_description'];?> <img src="images/ending-point.png" alt="" class="end-img"></p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>
  
	


 </div>
  <?php include('inc.footer.php');?>
</div>
<?php include('inc.js.php');?>
 <script>
		function customfield()
			{
			var category = document.getElementById('category').value;
			 $.post("ajax.php",
				{		 
					 action:'getcategoryname',
					 category:category,
				 },
		function(data){	
        		
		document.getElementById('showdata').innerHTML=data;
				});
			}
		</script>
		
		
		<script>
		function customfield_mobile()
			{
				
				
			var category = document.getElementById('category_mobile').value;
			 $.post("ajax.php",
				{		 
					 action:'getcategoryname',
					 category:category,
				 },
		function(data){	
        		
		document.getElementById('showdata_mobile').innerHTML=data;
				});
			}
		</script>
		
		

<script>
$(document).ready(function() {

// Gets the video src from the data-src on each button

var $videoSrc;  
$('.video-btn').click(function() {
    $videoSrc = $(this).data( "src" );
});
console.log($videoSrc);

  
  
// when the modal is opened autoplay it  
$('#myModal').on('shown.bs.modal', function (e) {
    
// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#video").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" ); 
})
  
  
// stop playing the youtube video when I close the modal
$('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src',$videoSrc); 
}) 
    
    


  
  
// document ready  
});

</script>



		<script>
		function invition(evid)
			{
			var userid='<?php echo $_SESSION['userid']; ?>';

			if(userid=='')
			{
			window.location.href='<?php echo SITE_URL; ?>index.php';	
			}
				
				
				var evid=evid;
				
			 $.post("ajax.php",
				{		 
					 action:'invited_users',
					 evid:evid,
					
				 },
		function(data){	
		if(data==1)
		{
			document.getElementById("event"+evid).classList.add("active");
				
		}
		if(data==2)
		{
			document.getElementById("event"+evid).classList.remove("active");
		}
				});
			}
		</script>



</body>
</html>
