<?php include('../config.php');
include('inc.session-create.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('inc.meta.php'); ?>
</head>
<body class="fixed-left">
	<?php include('inc.header.php'); ?>
	<?php include('inc.sideleft.php'); ?>
<div class="content-page">
<div class="content">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title">Dashboard</h4>
			<p class="text-muted page-title-alt">Welcome To Admin Panel !</p>
		</div>
	</div>
	<div class="row">
		<div class="text-center"></div>
	</div>
	<div class="row">
		<a href="#"> 
			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-pink pull-left">
						<i class="fa fa-shopping-cart text-pink"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from admin_login where usertype='2'");?></b></h3>
						<p class="text-muted">Total Vendors</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div> 
		</a>
		<a href="#"> 
			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-pink pull-left">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from register");?></b></h3>
						<p class="text-muted">Total Users</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div> 
		</a>
		<a href="#"> 
			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-pink pull-left">
						<i class="fa fa-shopping-cart"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from products");?></b></h3>
						<p class="text-muted">Total Products</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</a>
		<a href="#"> 
			<div class="col-md-6 col-lg-3">
				<div class="widget-bg-color-icon card-box">
					<div class="bg-icon bg-icon-pink pull-left">
						<i class="fa fa-shopping-cart text-pink"></i>
					</div>
					<div class="text-right">
						<h3 class="text-dark"><b class="counter"><?php echo $db->getVal("select count(id) from orderdetail where status='1'");?></b></h3>
						<p class="text-muted">Total Orders</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div> 
		</a>
	</div>
</div>
</div>
	<?php include('inc.footer.php'); ?>
</div>
<?php include('inc.js.php'); ?>
</body>
</html>