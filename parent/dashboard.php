<?php include('../config.php');
include('inc.session-create.php');
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('inc.meta.php'); ?>
</head>
<body class="fixed-left">
<div id="wrapper">
	<?php include('inc.header.php'); ?>
	<?php include('inc.sideleft.php'); ?>
<div class="content-page">
<div class="content">
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title-3">Dashboard</h4>
			<p class="text-muted page-title-3-alt">Statistic's and Summary</p>
		</div>
	</div>
	<div class="row">
		<div class="text-center"></div>
	</div>
	
	<div class="row">
	<div class="col-md-6">
	<div class="card-box arjun">
       <div class="row ">
        <div class="col-md-12">
		<P class="mrignyni">Applicants</p>
        </div>
		</div>
	    <div class="row barism">
        <div class="col-md-12">
		
        </div>
		</div>
		
		<div class="row rebel">
        <div class="col-md-4">
		 <div class="planct"><h3>TOTAL APPLICANT</h3></div>
		 <div class="planct"><span>0</span></div>
		</div>
		 <div class="col-md-4">
		  <div class="elam"><h3>MALE</h3></div>
		   <div class="elam"><span>0</span></div>
		</div>
		 <div class="col-md-4">
		 <div class="elamfe"><h3>FEMALE</h3></div>
		 <div class="elamfe"><span>0</span></div>
		</div>
		</div>       
        </div>
	    </div>
	<div class="col-md-6">
	  <div class="evnue"><h3>TOTAL REVENUE GENERATED</h3></div>
	  <div class="evnue"><span> ₦ 0</span></div>	  
	</div>
	</div>

</div>
</div>
	<?php include('inc.footer.php'); ?>
</div>
</div>
<?php include('inc.js.php'); ?>
</body>
</html>