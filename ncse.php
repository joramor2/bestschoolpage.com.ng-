<?php include('config.php'); 

$iLoginUserDetail=$db->getRow("select * from school_register where pageurl='".$_GET['pageurl']."'");

 $create_by_usertype = $iLoginUserDetail['create_by_usertype'];
$create_by_userid = $iLoginUserDetail['id'];


$iAboutSchool=$db->getRow("select * from school_about where create_by_userid='".$create_by_userid."'");
$iupdatedetails = $db->getRow("select * from  skool_settings where create_by_userid='".$create_by_userid."'"); 

?>
<!DOCTYPE html>
<html lang="en-US" prefix="#">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Eduction Website</title>
<link rel="stylesheet"href="<?php echo SITE_URL; ?>owlcarousel/owl.carousel.css">
<link rel="stylesheet"href="<?php echo SITE_URL; ?>owlcarousel/owl.theme.css">
<link rel='stylesheet' href="css/nces-css.css" type='text/css' media='all' />
<?php include('inc.meta-new.php'); ?>
</head>
<body class="home page-template page-template-tpl-home page-template-tpl-home-php page page-id-14">
<div id="page" class="site">
  <?php include('inc.header-new.php');	?>
  <div id="content" class="site-content">
  <div class="container">
    <div class="dld">
      <div id="container" class="cf">
        <div id="main" role="main">
          <section class="slider">
            <div class="flexslider carousel">
              <ul class="slides">
                <?php
				$iSlider=$db->getRows("select * from school_slider where create_by_userid='".$create_by_userid."'");
				foreach($iSlider as $iList)
				{ $i=$i+1;
				?>
                <li> <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['image']; ?>"> </li>
                <?php } ?>
              </ul>
            </div>
          </section>
        </div>
      </div>
      <div id="MainContent">
        <div id="ContentArea_base" tabindex="-1">
          <div id="ctl00_PlaceHolderMain_DisplayModePanel">
            <div class="naep-panel naep-image-slider-panel merge-bottom">
              <div class="panel-body">
                <div class="carousel flexslider">
                  <div class="shadow-box">&nbsp;</div>
                </div>
              </div>
            </div>
            <div class="naep-panel first-row-attractors">
              <div class="first-row-attractor"> <a href="<?php echo $iAboutSchool['link_school_fee']; ?>" target="_blank" class="row-attractor-title">pay school fees </a> </div>
              <div class="first-row-attractor"> <a href="<?php echo $iAboutSchool['link_apply_addmission']; ?>" target="_blank" class="row-attractor-title">Apply for admission</a> </div>
              <div class="first-row-attractor"> <a href="<?php echo PARENT_URL; ?>" class="row-attractor-title"> Check result </a> </div>
              <div class="first-row-attractor"> <a href="<?php echo LIVE_URL; ?>ckeck_admission.php?id=<?php echo $iupdatedetails['id']; ?>" class="row-attractor-title"> Check admission </a> </div>
            </div>
            <div class="naep-panel split-panel">
              <div class="abhi-jee">
                <div class="abhii-j">
                  <?php if($iLoginUserDetail['logo']=='') { ?>
                  <img src="image/black-wheat-and-mortarboard.png">
                  <?php } else { ?>
                  <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iLoginUserDetail['logo']; ?>">
                  <?php } ?>
                </div>
                <div class="gtg">
                  <div class="heas">
                    <h2>Contact Details</h2>
                  </div>
                  <div class="gghu">
                    <p><?php echo $iLoginUserDetail['name']; ?></p>
                  </div>
                  <div class="ggh">
                    <p><?php echo $iLoginUserDetail['location']; ?></p>
                  </div>
                  <div class="maill">
                    <p><i class="fa fa-envelope" aria-hidden="true"></i><?php echo $iLoginUserDetail['email']; ?></p>
                  </div>
                  <div class="maill">
                    <p><i class="fa fa-phone" aria-hidden="true"></i><?php echo $iLoginUserDetail['contact_no']; ?></p>
                  </div>
                  <div class="2tn">
                    <button>
                    <a href="#">Apply Now</a>
                    </button>
                  </div>
                </div>
              </div>
              <div class="panel-body naep-icon-link-panel">
                <div class="panel-body">
                  <div class="whats-new-header">
                    <h2>PDF Download</h2>
                    <div class="subscribe-newsflash"> <a href="https://ies.ed.gov/newsflash/#nces"> <span>Subscribe to NewsFlash</span> </a> </div>
                  </div>
                  <div class="icon-link pdf-no-size" >
                    <div class="link-icon report-release"><i class="fa fa-graduation-cap" aria-hidden="true"></i></div>
                    <div class="link-text"> <span>School syllabus</span> <a href="uploads/<?php echo $iupdatedetails['skool_syllabus']; ?>" download > <span>PDF Download </span> </a> </div>
                  </div>
                  <div class="icon-link">
                    <div class="link-icon naep-highlight"><i class="fa fa-book" aria-hidden="true"></i></div>
                    <div class="link-text"> <span>Learning material for all classes</span> <a class="icon-link col-lg-2" href="uploads/<?php echo $iupdatedetails['learning_materials']; ?>"   download > <span>PDF Download</span> </a> </div>
                  </div>
                  <div class="icon-link external"  >
                    <div class="link-icon naep-highlight"><i class="fa fa-table" aria-hidden="true"></i></div>
                    <div class="link-text"> <span>Exam timetable</span> <a  href="uploads/<?php echo $iupdatedetails['exam_timetable']; ?>" class="col-lg-2" download > <span>PDF Download</span> </a> </div>
                  </div>
                  <div class="icon-link pdf-no-size">
                    <div class="link-icon naep-highlight"><i class="fa fa-cloud-download" aria-hidden="true"></i></div>
                    <div class="link-text"> <span>Download exam pass questions </span> <a  href="uploads/<?php echo $iupdatedetails['exam_pass_question']; ?>" class="col-lg-2" download > PDF Download </a> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="kfg">
            <div class="abhi-k">
              <div class="naep-panel">
                <div class="headinggg">
                  <h2>Gallery</h2>
                </div>
                <div class="owl-carousel">
                  <?php
					$iGallery=$db->getRows("select * from school_gallery where create_by_userid='".$create_by_userid."'");
					foreach($iGallery as $iList)
					{ $i=$i+1;
						?>
                  <div><img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['image']; ?>"></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <div class="kfg hfh">
            <div class="naep-panel">
              <div class="container">
                <div class="row">
                  <div class="col-md-7">
                    <div class="abhi-k hgi">
                      <div class="headinggg">
                        <h2>About School</h2>
                      </div>
                      <div> <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iAboutSchool['about_image']; ?>"> </div>
                      <div class="para">
                        <p><?php echo $iAboutSchool['about_description']; ?></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="headinggg">
                      <h2>Upcoming Event</h2>
                    </div>
                    <div class="hgii">
                      <?php
							$iUpcomingEvent=$db->getRows("select * from school_upcoming_event where create_by_userid='".$create_by_userid."'");
							foreach($iUpcomingEvent as $iList)
							{ $i=$i+1;
								?>
                      <div class="evnt">
                        <div class="img"> <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['image']; ?>"> </div>
                        <div class="head"> <span><?php echo $iList['title']; ?></span>
                          <p><?php echo $iList['description']; ?></p>
                        </div>
                        <div class="date">
                          <p><?php echo $iList['date']; ?></p>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="kfg">
            <div class="naep-panel">
              <div class="container">
                <div class="row">
                  <div class="col-md-6 fgd">
                    <div class="panel-body what-is-naep">
                      <div class="panel-body">
                        <div class="lkj">
                          <h2>What is NAEP?</h2>
                          <p>The National Assessment of Educational Progress (NAEP) is the largest nationally representative and continuing assessment of what America's students know and can do in various subject areas.</p>
                          <a class="learn-more" href="/nationsreportcard/about/">Learn More</a> </div>
                        <div>
                          <h2 class="kiuj">Promo Video</h2>
                          <div class="video-asset">
                            <?php
										$ytarray=explode("/", $iAboutSchool['promo_video']);
										$ytendstring=end($ytarray);
										$ytendarray=explode("?v=", $ytendstring);
										$ytendstring=end($ytendarray);
										$ytendarray=explode("&", $ytendstring);
										$ytcode=$ytendarray[0]; ?>
                            <iframe src="https://www.youtube.com/embed/<?php echo $ytcode; ?>" width="500" height="300" youtube="" video="" player="" id="">
                            <p>Your browser does not support iFrame.</p>
                            </iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--<div class="col-md-6">
							<div class="lkj">
								<h2>What is NAEP?</h2>
								<p>The National Assessment of Educational Progress (NAEP) is the largest nationally representative and continuing assessment of what America's students know and can do in various subject areas.</p> 
								<a class="learn-more" href="/nationsreportcard/about/">Learn More</a> 
							</div>
							<div class="kjh">
								<h3>Reminder</h3>
								<hr>
								<div class="fhy">
									<div class="headin">
										<h4>Summer Vacation<br><span>June1, 2019</span></h4>
									</div>
									<div class="dohu">
										<h1>4</br><span>months to go</span></h1>
									</div>
								</div>
							</div>
						</div>--> 
                </div>
              </div>
            </div>
          </div>
          <div class="naep-panel second-row-attractors">
            <div class="panel-body">
              <?php
			$iBlogList=$db->getRows("select * from school_blog where create_by_userid='".$create_by_userid."'");
			foreach($iBlogList as $iList)
			{ 
			?>
              <div class="second-row-attractor"> <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iList['image']; ?>" alt="">
                <h2 class="center"><?php echo $iList['title']; ?></h2>
                <p><?php echo $iList['short_description']; ?></p>
                <a class="learn-more center" href="<?php echo SITE_URL; ?>school/learnmore/<?php echo $iList['pageurl']; ?>">Learn More</a> </div>
              <?php } ?>
            </div>
          </div>
          <div class="naep-panel image-attractors right">
            <div class="panel-body"> <img src="<?php echo SITE_URL; ?>uploads/<?php echo $iAboutSchool['image']; ?>" alt="">
              <h2><?php echo $iAboutSchool['title']; ?></h2>
              <p><?php echo $iAboutSchool['short_description']; ?></p>
             <!-- <a class="learn-more" href="<?php echo SITE_URL; ?>school/learnmore/<?php echo $iList['pageurl']; ?>">Learn More</a>--> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php include('inc.footer-new.php'); ?>
</div>
<?php include('inc.js-new.php'); ?>
<script src="<?php echo SITE_URL; ?>owlcarousel/jquery.min.js"></script>
<script defer src="<?php echo SITE_URL; ?>owlcarousel/jquery.flexslider.js"></script> 
<script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: false,
        item: 1,
        pausePlay: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script> 
<script>
$(document).ready(function() {
  $("#owl-demo").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
 
  });
 
});
</script> 
<script src="<?php echo SITE_URL; ?>owlcarousel/jquery-1.9.1.min.js"></script> 
<script src="<?php echo SITE_URL; ?>owlcarousel/owl.carousel.min.js"></script> 
<script>
$(".owl-carousel").owlCarousel();
</script>
</body>
</html>