<div class="topbar">
	<div class="topbar-left">
		<div class="text-center"> 
			<img src="../uploads/dezven-logo.png" alt="user-img" class="img-circle" style="border:none!important; visibility:hidden"> 
		</div>
	</div>
	<div class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="">
				<div class="pull-left taugl">
					<div class="row">
						<div class="col-md-3">
							<button class="button-menu-mobile open-left"><i class="fa fa-bars"></i></button>
							<span class="clearfix"></span> 
						</div>
						<div class="col-md-9">
							<h2  class="ven" style="font-size: 20px;width:468px; margin-top: 15px;"><?php echo $iCurrentskoolnameDetails['name']; ?></h2>
						</div>
					</div>
				</div>
				
				<ul class="nav navbar-nav navbar-right pull-right">
					<li class="dropdown"> 
						<a class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true"> 
							<img src="../image/user.png">  
						</a>
						<ul class="dropdown-menu">
							<li><a href="login_profile.php"><i class="ti-user m-r-5"></i> Update Profile</a></li>
							<!--<li><a href="<?php echo SKOOL_URL; ?>login_pass.php"><i class="ti-user m-r-5"></i>Change Password</a></li>-->
							<li><a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>