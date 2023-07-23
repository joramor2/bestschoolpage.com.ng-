<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Manage Roles";
$FileName = 'manage_role.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['add_role']))
{
	$validate->addRule($_POST['role'],'','Role',true);

    if($validate->validate() && count($stat) == 0)
    {
        $iLastId=$db->getVal("select id from roles order by id desc")+1;
		$iRandomId=randomFix(15).'-'.$iLastId;

		$aryData = array(
						'usertype'     	 	         =>	$_SESSION['usertype'],
						'userid'     	 	         => $_SESSION['userid'],			  
						'role'     	 	         	 =>	$_POST['role'],
						'create_by_userid'     	 	 =>	$create_by_userid,
						'create_by_usertype'     	 =>	$create_by_usertype,
						'randomid'     	 	         =>	$iRandomId,
						);
			$flgIn = $db->insertAry("roles", $aryData);

			$_SESSION['success']="Submitted Successfully";
			redirect($FileName.'?action=manage_roles');
			unset($_POST);
 	}
    else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['edit_role'])) 
{
    if($validate->validate() && count($stat) == 0)
    {
		$aryData = array(
						'role'			=>	$_POST['role'],
						);
			$flgIn2 = $db->updateAry("roles", $aryData, "where randomid='".$_GET['randomid']."'");

			$_SESSION['success']="Update Successfully";
			redirect($FileName.'?action=manage_roles');
    }
	else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['add_files'])) 
{
    if($validate->validate() && count($stat)==0)
    {
		$iGetRoleId=$db->getVal("select id from roles where randomid='".$_GET['randomid']."'");
		
		$flgIn1 = $db->delete("role_permission","where role_id='".$iGetRoleId."'");
		foreach($_POST['file_name'] as $key => $val)
		{ 
			$iLastId=$db->getVal("select id from role_permission order by id desc")+1;
			$iRandomId=randomFix(15).'-'.$iLastId;
		
			$aryData=array(	
							'usertype'     	 	     =>	$_SESSION['usertype'],
							'userid'     	 	     =>	$_SESSION['userid'],			  
							'role_id'     	 	     =>	$iGetRoleId,
							'file_name'     	 	 =>	$_POST['file_name'][$key],
							'create_by_usertype'     =>	$create_by_usertype,
							'create_by_userid'     	 =>	$create_by_userid,
							'randomid'     	 	     =>	$iRandomId,
							);  
				$flgIn11 = $db->insertAry("role_permission",$aryData);
		}
		
		$_SESSION['success']="Submitted Successfully";
		redirect($FileName.'?action=manage_roles');
    }
	else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif($_GET['action']=='delete_roles') 
{
	$iGetRoleId=$db->getVal("select id from roles where randomid='".$_GET['randomid']."'");
	$flgIn1 = $db->delete("roles", "where randomid='".$_GET['randomid']."'");
	$flgIn2 = $db->delete("role_permission", "where role_id='".$iGetRoleId."'");
	$_SESSION['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=manage_attrition_status');
}
elseif(isset($_POST['assginrole']))
{ 
	if($validate->validate() && count($stat)==0)
	{
		$iAlreadyAssign=$db->getVal("select id from assign_role where staff_id='".$_POST['staff_id']."' and create_by_usertype='".$create_by_usertype."'");
		
		if($iAlreadyAssign=='')
		{
			$iLastId=$db->getVal("select id from assign_role order by id desc")+1;
			$iRandomId=randomFix(15).'-'.$iLastId;
			
			$aryData=array(					
							'usertype'					=>	$_SESSION['usertype'],
							'userid'					=>	$_SESSION['userid'],
							'staff_id'					=>	$_POST['staff_id'],
							'principal'					=>	$_POST['principal'],
							'role_id'					=>	$_POST['role_id'],
							'create_by_userid'			=>	$create_by_userid,
							'create_by_usertype'		=>	$create_by_usertype,
							'randomid'					=>	$iRandomId,
							);  
				$flgIn1 = $db->insertAry("assign_role",$aryData);
		      
				$_SESSION['success']="Role Has Been Assigned Successfully";
				redirect($FileName.'?action=assign_role');
				unset($_POST);
		}
		else
		{
			$aryData=array(					
							'role_id'					=>	$_POST['role_id'],
							);  
				$flgIn1 = $db->updateAry("assign_role",$aryData,"where staff_id='".$_POST['staff_id']."' and create_by_userid='".$create_by_userid."'");
				
				$_SESSION['success']="Submitted Successfully";
				redirect($FileName.'?action=assign_role');
				unset($_POST);
		}
	}
	else
	{
		$stat['error'] = $validate->errors();
	}
} 
?>
<!DOCTYPE html>
<html>
<head>
    <?php include('inc.meta.php'); ?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif" />
<style>

body, label, span, a, .gwt-Button {
	
	 font-family: 'Droid Serif' !important; 
}
.abhi .nav-tabs {
	border-bottom: 2px solid #DDD;
}

.abhi .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
	border-width: 0;
}

.abhi .nav.nav-tabs > li > a:hover, .nav.tabs-vertical > li > a:hover {
	color: #1B3058 !important;
}

.abhi .nav-tabs > li > a {
	border: none;
	color: #1B3058 !important;
}

.abhi .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover, .tabs-vertical > li.active > a, .tabs-vertical > li.active > a:focus, .tabs-vertical > li.active > a:hover {
	color: #1B3058 !important;
}

.abhi .nav > li > a i {
	font-size: 16px;
	padding-right: 5px;
}

.abhi .nav-tabs > li > a::after {
	content: "";
	background: #1B3058;
	height: 2px;
	position: absolute;
	width: 100%;
	left: 0px;
	bottom: -1px;
	transition: all 250ms ease 0s;
	transform: scale(0);
}

.abhi .nav-tabs > li.active > a::after, .nav-tabs > a::after {
	transform: scale(1);
}

.abhi .tab-nav > li > a::after {
	background: #5a4080 none repeat scroll 0% 0%;
	color: #fff;
}

.abhi .tab-pane {
	padding: 25px 0;
}

.abhi .tab-content {
	padding: 20px;
}

.abhi .nav-tabs > li {
	width: 30%;
	text-align: center;
}

.abhi .card {
	background: #FFF none repeat scroll 0% 0%;
	box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
	margin-bottom: 30px;
}

.abhi body {
	background: #EDECEC;
	padding: 50px;
}

.abhi .ass .select-hide {
	display: none;
}

.abhi .ass .custom-select select {
	display: none;
}

.abhi .ass .select-selected {
	border-bottom: 1px solid #9e9e9e;
}

.abhi .ass .ytr {
	margin-top: 22px;
}

.abhi .fdg {
	border-bottom: 1px solid #9e9e9e2b;
}

.abhi .shg p {
	color: #1B3058;
}

.abhi .ass .bgb i {
	color: #1B3058;
	font-size: 19px;
}

.abhi .ass .col-md-4 i {
	background: #F44336;
	padding: 8px;
	border-radius: 50%;
	color: #fff;
	font-size: 14px;
}

.abhi .ass .shg {
	padding-top: 29px;
}

.abhi .ass .select-items {
	border: 1px solid #ddd;
	padding: 9px;
	position: relative;
	bottom: 20px;
	background: #fff;
}

.abhi .ass .select-items div {
	padding-bottom: 7px;
}

.abhi .ab-1 {
	text-align: center;
}

.abhi .icon i {
	color: #0b4587;
	background: #fff;
	font-size: 32px;
	border-radius: 50%;
	position: absolute;
	bottom: -25px;
	left: 0;
	right: 0;
	width: 100%;
	margin: 0 auto;
	padding: 15px 10px 15px 10px;
}

.abhi .icon input {
	position: absolute;
	left: 0;
	opacity: 0;
	width: 100%;
	right: 0;
	top: -18px;
}

.abhi .abhish .input-field {
	padding-bottom: 0;
}

.abhi .abh {
	margin-top: 35px;
}

.abhi .input-field input {
	background-color: transparent;
	border: none;
	border-bottom: 1px solid #9e9e9e;
	border-radius: 0;
	outline: none;
	width: 100%;
	margin: 0 0 15px 0;
	padding: 0;
	box-shadow: none;
	box-sizing: content-box;
	transition: all .3s;
}

.abhi .input-field label {
	color: #9e9e9e;
}

.abhi .icon {
	position: relative;
	left: 0;
	bottom: 0;
	width: 7%;
	margin: 0 auto;
	right: 0;
	height: 0;
	top: 0;
}

.abhi .ab-2 {
	background: #0b4587;
	color: #fff;
	width: 23%;
	padding: 28px;
	margin: 0 auto;
}

.abhi .imgage {
	padding-bottom: 13px;
}

.abhi .abb {
	text-align: center;
}

.abhi .ab-3 {
	margin-top: 30px;
}

.abhi .plp {
	margin-bottom: 80px;
}

.abhi .ab-3 .col-md-1 i {
	font-size: 17px;
	color: #000000d6;
}

.abhi .ab-3 .col-md-4 i {
	background: #F44336;
	padding: 8px;
	border-radius: 50%;
	color: #fff;
	font-size: 14px;
}

.abhi .ab-3 input {
	color: rgba(0, 0, 0, 0.26);
	border-bottom: 1px dotted rgba(0, 0, 0, 0.26);
}

.abhi button {
	cursor: pointer;
	float: right;
	background: #1B3058;
	color: #fff;
}

.abhi button:hover {

	background: #1B3058;
	color: #fff;
}

.abhi button i {
	padding-right: 45px;
	font-size: 13px;
}

.abhi .input-field {
	padding-bottom: 20px;
}

.abhi .assde {
	margin-top: 50px;
}

.abhi .ade {
	margin-top: 40px;
}

.abhi .bgb {
	text-align: center;
	padding-top: 3px;
}

.abhi .bgb i {
	color: #1B3058;
	font-size: 19px;
}

@media all and (max-width: 724px) {
	.abhi .nav-tabs > li > a > span {
		display: none;
	}

	.abhi .nav-tabs > li > a {
		padding: 5px 5px;
	}
}
.page-title {
    margin-bottom: 30px;
}
</style>
</head>
<body class="fixed-left">
<div id="wrapper">
	<?php include('inc.header.php'); ?>
	<?php include('inc.sideleft.php'); ?>
<div class="content-page">
<!-- Start content -->
<div class="content">
<div class="container">
	<!-- Page-Title -->
	<div class="row">
		<div class="col-sm-12">
			<h4 class="page-title licat" style="text-align: center;"><?php echo $PageTitle ?></h4>
			<?php echo msg($stat);?>
		</div>
	</div>
	<!-- Basic Form Wizard -->
	<div class="abhi">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- Nav tabs -->
					<div class="card">
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="<?php if($_GET['action']=='' || $_GET['action']=='manage_roles') { echo "active"; } ?>">
								<a href="<?php echo $Filename; ?>?action=manage_roles">
									<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>Manage Role</span>
								</a>
                            </li>
							<li role="presentation" class="<?php if($_GET['action']=='assign_role') { echo "active"; } ?>">
								<a href="<?php echo $Filename; ?>?action=assign_role">
									<i class="fa fa-line-chart" aria-hidden="true"></i><span>Assign Role</span>
								</a>
							</li>
						</ul>
						<div class="tab-content">
						<?php if($_GET['action']=='' || $_GET['action']=='manage_roles') { ?>
						<!-- Tab panes -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<?php if($_GET['add']=='') { ?>
							<div class="ab-1">
							<div class="row">
							<form action="" method="POST">
							
								<div class="col-md-12">
									<div class="form-group clearfix">
										<label class="col-lg-2 control-label " for="userName">Role </label>
										<div class="col-lg-10">
											<input type="text" class="form-control required" id="userName" name="role" placeholder="Eg. Class Teacher" value="<?php echo $_POST['role']; ?>">
										</div>
									</div>

									<div class="form-group clearfix bfrcs ">
										<div class="col-lg-12 ">
											<button type="submit" name="add_role" class="btn">
												<i class="fa fa-plus" aria-hidden="true"></i><span>Add</span>
											</button>
										</div>
									</div> 
								</div>
						
							</form>	
							</div>
							
							 <div class="card-box table-responsive tablthisresponsive">
							<form action="" method="POST">
							 <table  class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>#</th>
								<th>Role</th>
								<th>Edit</th>
								<th>Remove</th>
								<th>Add Files</th>
							</tr>
							</thead>
                            <tbody>
                            <?php $i=0;
							$aryList=$db->getRows("select * from roles where create_by_userid='".$create_by_userid."' order by id desc");
							foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							?>
                            <tr>
								<td><?php echo $i ?></td>
								<td>
									<?php if($_GET['randomid']==$iList['randomid']) { ?>
									<input type="text" name="role" value="<?php echo $iList['role']; ?>" style="width:100px;" class="form-control">
									<?php } else { echo $iList['role']; } ?>
								</td>
								<td>
									<?php if($_GET['randomid']==$iList['randomid']) { ?>
									<input type="submit" name="edit_role" value="SAVE" class="btn btn-primary" style="color:white;"> 
									<?php } else { ?>
									<a href="<?php echo $FileName; ?>?action=manage_roles&randomid=<?php echo $iList['randomid']; ?>" class="table-action-btn">
										<i class="fa fa-pencil"></i> 
									</a>
									<?php } ?>
								</td>
								<td>
									<a href="javascript:del('<?php echo $FileName; ?>?action=delete_roles&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> 
										<i class="fa fa-times"></i> 
									</a>
								</td>
								<td>
									<a href="<?php echo $FileName; ?>?action=manage_roles&add=add_files&randomid=<?php echo $iList['randomid']; ?>" class="btn btn-info">Add</a>
								</td>
							</tr>
                            <?php } ?>
							</tbody>
							</table>
							</form>	
							</div>
							</div>
							<?php } elseif($_GET['add']=='add_files') {
							$iGetRoles=$db->getRow("select * from roles where randomid='".$_GET['randomid']."'");
							?>
							<div class="ab-1">
							<div class="row">
							<form action="" method="POST">
						
								<div class="col-md-12">
									<div class="form-group clearfix">
										<label class="col-lg-1 control-label " for="userName">Role </label>
										<div class="col-lg-11">
											<input type="text" class="form-control required" id="userName" name="role" value="<?php echo $iGetRoles['role']; ?>" disabled>
										</div>
									</div>

									<div class="form-group clearfix">
									<label class="col-lg-1 control-label " for="price">File*</label>
									<div class="col-lg-11">
										<table class="table table-bordered" id="table-data"  style="width:100%!important">
										<tr>
										<?php $iKKK=0;
										$aryList=$db->getRows("select * from school_filename");
										foreach($aryList as $iList)
										{ $iKKK=$iKKK+1; 
										$iAlreadyFile=$db->getVal("select id from role_permission where create_by_userid='".$create_by_userid."' and role_id='".$iGetRoles['id']."' and file_name='".$iList['file_name']."'");
										?>
										<td style="border: 1px solid #ddd;">
										<input type="checkbox" id="file_name" name="file_name[]" value="<?php echo $iList['file_name']; ?>" multiple <?php if($iAlreadyFile!='') { echo "checked"; } ?>>
										</td>
										<td style="border: 1px solid #ddd;"> <?php echo $iList['title']; ?></td>
										<?php if($iKKK%6=='0') { echo '</tr><tr>';	} } ?>
										</tr>
										</table>
									</div>
									</div>
								
									<div class="form-group clearfix bfrcs ">
										<div class="col-lg-12 ">
											<button type="submit" name="add_files" class="btn">
												<i class="fa fa-plus" aria-hidden="true"></i><span>Add</span>
											</button>
										</div>
									</div> 
								</div>
							
							</form>	
							</div>
							</div>
							<?php } ?>	
						</div>
						<?php }
						elseif($_GET['action']=='assign_role') {
					    $GetEmailId=$db->getRow("select * from staff_manage where randomid='".$_GET['randomid']."'");
						$iStaffId=$db->getVal("select id from school_register where username='".$GetEmailId['staff_id']."'");
						$irole=$db->getRow("select id,role_id from assign_role where staff_id='".$iStaffId."' and create_by_usertype='".$create_by_usertype."' and create_by_userid='".$create_by_userid."'");

						?>
						<div role="tabpanel" class="tab-pane active" id="profilxe">
						<div class="abhish">
							<?php if($_GET['role']=='assign_role_staff') { ?>
							<form role="form" action="" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="staff_id" value="<?php echo $iStaffId; ?>">
							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="userName">Staff ID :</label>
								<?php echo $db->getVal("select staff_id from staff_manage where id='".$GetEmailId['id']."'");  ?>
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="userName">First Name:</label>
								<?php echo $GetEmailId['first_name']; ?> 
							</div>

							<div class="form-group clearfix">
								<label class="col-lg-2 control-label " for="userName">Last Name :</label>
								<?php echo $GetEmailId['last_name']; ?>
							</div>
							
							<div class="form-group clearfix">
							<label class="col-lg-2 control-label " for="userName">Role </label>
							<div class="col-lg-10">
								<select name="role_id" class="form-control">
								<option value="">Select Role </option>
								<?php $i=0;
								$aryList=$db->getRows("select * from roles where create_by_userid='".$create_by_userid."'");
								foreach($aryList as $iList)
								{	$i=$i+1;
								?>
								<option value="<?php echo $iList['id']; ?>" <?php if($irole['role_id']==$iList['id']){echo "selected";} ?>> <?php echo $iList['role'];?></option>
								<?php } ?>
								</select>
							</div>
							</div>
					
							<button type="submit" name="assginrole" class="btn btn-default">Assign Role</button>
							<a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a>
							</form>
							<?php } ?>
							<?php if($_GET['role']=='') { ?>
								 <div class="card-box table-responsive tablthisresponsive">
						
							 <table  class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>#</th>
								<th>Staff Id </th>
								<th>First Name </th>
								<th>Last Name </th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php $i=0;
							$aryList=$db->getRows("select * from staff_manage where create_by_userid='".$create_by_userid."' order by id desc");
							foreach($aryList as $iList)
							{	$i=$i+1;
							$aryPgAct["id"]=$iList['id'];
							?>
							<tr>
								<td><?php echo $i; ?> </td>
								<td><?php echo $db->getVal("select staff_id from staff_manage where id='".$iList['id']."'");  ?></td>
								<td><?php echo $iList['first_name']; ?></td>
								<td><?php echo $iList['last_name']; ?></td>
								<td>
								<a href="<?php echo $iClassName.$FileName; ?>?action=assign_role&role=assign_role_staff&randomid=<?php echo $iList['randomid']; ?>"  class="table-action-btn" > Assign Role </a> 
								</td>
							</tr>
							<?php } ?>
							</tbody>
							</table>
							<?php } ?>
						</div>
						</div>
						<?php } ?>
						</div>
					</div>
                </div>
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