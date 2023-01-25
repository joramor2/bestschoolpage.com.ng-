<footer id="colophon" class="site-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12"> <a href="#" style="font-size: 17px;color: #1fc5f7; font-weight: 700;text-transform: uppercase;">Best school page </a> <br />
        <br>
        <p> <?php echo $iHomeSettingDetails['footer_description']; ?> </p>
      </div>
      <div class="col-md-2 col-sm-12">
        <section id="nav_menu-2" class="widget widget_nav_menu">
          <h2 class="widget-title">Quick Link</h2>
          <div class="menu-company-container">
            <ul id="menu-company" class="menu">
              <li id="menu-item-35" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-14 current_page_item menu-item-35"> <a href="<?php echo SITE_URL; ?>">Home</a> </li>
              <li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a href="<?php echo SITE_URL; ?>package.php">Pricing</a> </li>
              <li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a href="<?php echo SITE_URL; ?>faq.php">FAQ</a> </li>
              <li id="menu-item-36" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-36"><a href="<?php echo SITE_URL; ?>contact-us.php">Contact Us</a> </li>
            </ul>
          </div>
        </section>
      </div>
      <div class="col-md-2 col-sm-12">
        <section id="nav_menu-3" class="widget widget_nav_menu">
          <h2 class="widget-title">Support</h2>
          <div class="menu-support-container">
            <ul id="menu-support" class="menu">
            
                  <?php $i=0;
				$iCMSPageDetails=$db->getRows("select * from cms where status=1 and show_in_footer = '1' order by id desc");
						foreach($iCMSPageDetails as $iCMSPage)
							{	$i=$i+1;  ?>
              <li id="menu-item-40" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40"><a href="<?php echo SITE_URL; ?>pages/<?php echo $iCMSPage['pageurl']; ?>"><?php echo $iCMSPage['title']; ?></a> </li>
          <?php } ?>
            </ul>
          </div>
        </section>
      </div>
      <div class="col-md-2 col-sm-12">
        <section id="custom_html-2" class="widget widget_custom_html">
          <h2 class="widget-title">Contact-Us</h2>
          <div class="textwidget custom-html-widget">
    
            
             <p style="    margin-bottom: 10px;"><i class="fa fa-map-marker"></i> <?php echo $iHomeSettingDetails['contact_address']; ?> </p>
              <p style="    margin-bottom: 10px;"><a href="tel:<?php echo $iHomeSettingDetails['contact_phoneno']; ?>"><i class="fa fa-phone"></i> <?php echo $iHomeSettingDetails['contact_phoneno']; ?>	</a> </p>
              <p style="    margin-bottom: 10px;"><a href="mailto:<?php echo $iHomeSettingDetails['contact_email']; ?>"><i class="fa fa-envelope-o"></i> <?php echo $iHomeSettingDetails['contact_email']; ?></a> </p>
          </div>
        </section>
      </div>
      <div class="col-md-3 col-sm-12">
        <section id="custom_html-3" class="widget widget_custom_html">
          <h2 class="widget-title">Subscribe our newsletter</h2>
          <div class="textwidget custom-html-widget">
            <p><?php echo $iHomeSettingDetails['newsletter_content']; ?> </p>
            <div class="newsletter">
              <div role="form" class="wpcf7" id="wpcf7-f53-o1" lang="en-US" dir="ltr">
                <div class="screen-reader-response"></div>
                <form action="#" method="post" class="wpcf7-form" novalidate>
                  <p style="    margin-bottom: 0px;">
                    <label> <span class="wpcf7-form-control-wrap your-email">
                      <input type="email" name="your-email"  id="subscribe_email" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" placeholder="Email Address" />
                      </span> </label>
                    <br />
                    <input type="button" onclick="subscribe()" value="Send" class="wpcf7-form-control wpcf7-submit" />
                  </p>
                  <div id="showsubscribeerror"></div>
                  <Br />
                </form>
              </div>
            </div>
            <ul class="social-links">
              <li><a href="<?php echo $iHomeSettingDetails['linkedin_link']; ?>"><i class="fa fa-linkedin"></i></a> </li>
              <li><a href="<?php echo $iHomeSettingDetails['fb_link']; ?>"><i class="fa fa-facebook"></i></a> </li>
              <li><a href="<?php echo $iHomeSettingDetails['twitter_link']; ?>"><i class="fa fa-twitter"></i></a> </li>
              <li><a href="<?php echo $iHomeSettingDetails['youtube_link']; ?>"><i class="fa fa-youtube"></i></a> </li>
            </ul>
          </div>
        </section>
      </div>
    </div>
    <p class="copy"><?php echo $iHomeSettingDetails['footer_content']; ?></p>
  </div>
</footer>
<div class="modal fade demo-log" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Request For Demo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="/action_page.php">
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="fname">First Name</label>
                <input type="fname" class="form-control" id="fname">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="fname">Last Name</label>
                <input type="fname" class="form-control" id="fname">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="fname">Name of School</label>
                <input type="fname" class="form-control" id="fname">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="fname">No. of student</label>
                <input type="fname" class="form-control" id="fname">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="pwd">Email:</label>
                <input type="email" class="form-control" id="pwd">
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <div class="form-group">
                <label for="pwd">Number:</label>
                <input type="text" class="form-control" id="pwd">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox">
                  Remember me</label>
              </div>
              <button type="submit" class="btn btn-default btn-secondary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
