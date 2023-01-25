<style>
.header_bg{    

    background: url(http://rdxshop.com/skool/school-management/images/home-slider.png);
    background-repeat: no-repeat;
    background-position: top right;
	}
	
.school_link{font-size: 40px; color: #1fc5f7!important;font-weight: 700; text-transform: uppercase;}	
@media only screen and (max-width: 414px) {.school_link{font-size: 28px;}}	
</style>

<header id="masthead" class="site-header <?php if($iCurrentFileName!='index.php' && $iCurrentFileName != 'contact-us.php') { ?>header_bg<?php } ?>" >
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-expand-md navbar-light" role="navigation">
        <div class="site-branding navbar-brand"> <a href="<?php echo SITE_URL; ?>" rel="home" class="school_link" style="font-size: 25px; color: #1fc5f7;font-weight: 700; text-transform: uppercase;"> Best school page</a> </div>
        <div id="bs4navbar" class="collapse navbar-collapse">
          <ul id="main-menu" class="navbar-nav mr-auto">
            <li><a href="<?php echo SITE_URL; ?>" class="nav-link active">Home</a></li>
            <li><a href="<?php echo SITE_URL; ?>package.php" class="nav-link">Pricing</a></li>
     
     
            <li><a href="<?php echo SITE_URL; ?>faq.php" class="nav-link">FAQ</a></li>
            <li><a href="<?php echo SITE_URL; ?>contact-us.php" class="nav-link">Contact</a> </li>
            <?php if($_SESSION['userid']=='')	{	?>
            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-58 nav-item"> <a class="btn btn-default" href="<?php echo SITE_URL; ?>login.php" >Sign In</a> </li>		
             <?php } else { ?>
             <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-58 nav-item"> <a class="btn btn-default" href="<?php echo SITE_URL; ?>login.php" >My Profile</a> </li>	
             <?php } ?>
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-58 nav-item"> <a class="btn btn-default" href="<?php echo SITE_URL; ?>parent/" >Parent Login</a> </li>
          </ul>
        </div>
        <span class="navbar-toggler-icon" onClick="openNavNew()"></span>
        <div id="mySidenav" class="sidenav"  style="width:0px; display:none;"> <a href="javascript:void(0)" class="closebtn" onClick="closeNav()">&times;</a>
          <div class="menu-main-menu-container">
            <ul id="main-menu" class="navbar-nav">
              <li><a href="<?php echo SITE_URL; ?>">Home</a> </li>
              <li><a href="<?php echo SITE_URL; ?>package.php">Pricing</a> </li>
              <li><a href="<?php echo SITE_URL; ?>faq.php" >FAQ</a></li>
              <li><a href="<?php echo SITE_URL; ?>contact-us.php">Contact</a> </li>
              <?php if($_SESSION['userid']=='')	{	?>
              <li> <a class="btn btn-default" href="<?php echo SITE_URL; ?>login.php" >Sign In</a> </li>
              <?php } else { ?>
              <li> <a class="btn btn-default" href="<?php echo SITE_URL; ?>login.php" >My Profile </a> </li>
              <?php } ?>
               <li> <a class="btn btn-default" href="<?php echo SITE_URL; ?>parent/" >Parent Login</a> </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</header>



<script>
function openNavNew() {
	document.getElementById("mySidenav").style.width = "100%";
  	document.getElementById("mySidenav").style.display = "block";
}
function closeNav() {
   document.getElementById("mySidenav").style.width = "0";
    document.getElementById("mySidenav").style.display = "none";
}

</script>
