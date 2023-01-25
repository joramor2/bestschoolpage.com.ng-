<?php include('config.php');	?>
<html>
<head>
<?php include('inc.meta-new.php');	?>
</head>
<body class="home page-template page-template-tpl-home page-template-tpl-home-php page page-id-14">
<div id="page" class="site">
  <?php include('inc.header-new.php');	?>
  <div id="content" class="site-content">
    <div class="home-banner"> <img src="images/home-slider.png" alt="" class="wow fadeIn" />
      <div class="container">
        <div class="banner-content"> <a href="tel:<?php echo $iHomeSettingDetails['call_number']; ?>" target="_self" class="xs-btn btn btn-secondary"> <span class="xs-button-text">Call Now : <?php echo htmlspecialchars($iHomeSettingDetails['call_number'], ENT_QUOTES); ?></span> <span></span> </a>
          <p class="wow fadeInLeft" style="color: black;"><?php echo htmlspecialchars($iHomeSettingDetails['banner_description'], ENT_QUOTES); ?></p>
        </div>
      </div>
    </div>
    <div class="application-info">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12 wow fadeInLeft">
            <div class="speakerr">
              <h2><?php echo htmlspecialchars($iHomeSettingDetails['marketing_expert'], ENT_QUOTES); ?></h2>
              <div class="cal-icn"> <i class="fa fa-volume-control-phone" aria-hidden="true"></i> <span><?php echo htmlspecialchars($iHomeSettingDetails['marketing_callno'], ENT_QUOTES); ?></span> </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 wow fadeInRight"> <img src="images/abooutt.PNG"> </div>
        </div>
      </div>
    </div>
    <div class="app-features">
      <div class="app-features-bottom">
        <div class="school-img"> <img src="images/school.png" alt="" class="wow bounceInDown" />
          <div class="container">
            <div class="row no-gutters">
              <?php 
				  	$iHomIma=0;
				  $aryList=$db->getRows("select * from home_image order by id desc");
							 foreach($aryList as $iList)
									{	$iHomIma=$iHomIma+1;  ?>
              <?php if($iHomIma%2!='0') { ?>
              <div class="col-md-6 col-sm-12 wow fadeInLeft">
                <div class="features-list "> <img src="uploads/<?php echo $iList['picons'] ?>" alt="" /> <span class="line"><small></small></span>
                  <h3><span><?php echo htmlspecialchars($iList['title'], ENT_QUOTES); ?></span> <?php echo htmlspecialchars($iList['title_1'], ENT_QUOTES); ?></h3>
                </div>
              </div>
              <?php } ?>
              <?php if($iHomIma%2=='0') { ?>
              <div class="col-md-6 col-sm-12 wow fadeInRight">
                <div class="features-list features-list-right"> <img src="uploads/<?php echo $iList['picons'] ?>" alt="" /> <span class="line2"><small></small></span>
                  <h3><span><?php echo htmlspecialchars($iList['title'], ENT_QUOTES); ?></span> <?php echo htmlspecialchars($iList['title_1'], ENT_QUOTES); ?></h3>
                </div>
              </div>
              <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="why-choose">
      <div class="why-choose-in">
        <div class="container">
          <h2><span>Why</span> Choose Us?</h2>
          <div class="row">
            <?php  
				  $aryListBestClient=$db->getRows("select * from why_choose_us order by id desc");
							 foreach($aryListBestClient as $iListCBC)
									{	 ?>
            <div class="col-md-4 col-sm-12">
              <div id="panel-5-1-0-0" class="so-panel widget widget_themegrill_flash_service tg-widget tg-single-service panel-first-child panel-last-child" data-index="1">
                <div class="tg-service-widget tg-service-layout-1">
                  <div class="service-wrapper">
                    <div class="service-icon-title-wrapper clearfix">
                      <div class="service-icon-wrap"><img src="uploads/<?php echo $iListCBC['picons']; ?>"></div>
                      <h3 class="service-title-wrap"> <a href="#"> <?php echo htmlspecialchars($iListCBC['title'], ENT_QUOTES); ?></a></h3>
                    </div>
                    <div class="service-content-wrap"><?php echo htmlspecialchars($iListCBC['short_description'], ENT_QUOTES); ?></div>
                    <a class="service-more" href="<?php echo SITE_URL; ?>whychooseus/<?php echo $iListCBC['pageurl']; ?>">READ MORE</a></div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="about-us">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-12 wow fadeInLeft">
            <div class="colmul-li-sec">
              <div class="getintouchhh"> <a href="#"><img src="images/getintouchhh.png" alt=""></a> </div>
              <ul>
                <li class="" >
                  <div class="row">
                    <div class="col-xs-3 col-sm-3">
                      <div class="i-connn"><i class="fa fa-bell-o" aria-hidden="true"></i></div>
                    </div>
                    <div class="col-xs-9 col-sm-9">
                      <div class="i-connn-title-head">
                        <div class="title-i-con"><?php echo htmlspecialchars($iHomeSettingDetails['automate_1'], ENT_QUOTES); ?></div>
                        <div class="discription-i-con"><?php echo htmlspecialchars($iHomeSettingDetails['institute_process_1'], ENT_QUOTES); ?></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="" >
                  <div class="row">
                    <div class="col-xs-3 col-sm-3">
                      <div class="i-connn"><i class="fa fa-bullhorn" aria-hidden="true"></i></div>
                    </div>
                    <div class="col-xs-9 col-sm-9">
                      <div class="i-connn-title-head">
                        <div class="title-i-con"><?php echo $iHomeSettingDetails['automate_2']; ?></div>
                        <div class="discription-i-con"><?php echo $iHomeSettingDetails['institute_process_2']; ?></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="" >
                  <div class="row">
                    <div class="col-xs-3 col-sm-3">
                      <div class="i-connn"><i class="fa fa-cog" aria-hidden="true"></i></div>
                    </div>
                    <div class="col-xs-9 col-sm-9">
                      <div class="i-connn-title-head">
                        <div class="title-i-con"><?php echo htmlspecialchars($iHomeSettingDetails['automate_3'], ENT_QUOTES); ?></div>
                        <div class="discription-i-con"><?php echo htmlspecialchars($iHomeSettingDetails['institute_process_3'], ENT_QUOTES); ?></div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <img src="images/laptop.png" alt="" class="wow fadeInRight" /> </div>
      </div>
    </div>
    <div class="our-requestdemo">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <h3><?php echo $iHomeSettingDetails['request_demo_content']; ?></h3>
          </div>
          <div class="col-md-3 col-sm-3 text-center" > <a class="btn btn-default" href="#" data-toggle="modal" data-target="#myModal">request for demo</a></div>
        </div>
      </div>
    </div>
    <div class="our-clients">
      <div class="container">
        <h2><span>Our Best Clients</span></h2>
        <div class="row wow fadeIn">
          <?php  
				  $aryList=$db->getRows("select * from best_client order by id desc");
							 foreach($aryList as $iList)
									{	 ?>
          <div class="col-md-2 col-sm-12"> <a href="<?php echo $iList['urllink'] ?>"> <img src="uploads/<?php echo $iList['picons'] ?>" alt="" /> </a> </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="container"></div>
  </div>
  <?php include('inc.footer-new.php');	?>
</div>
<?php include('inc.js-new.php');	?>
</body>
</html>
