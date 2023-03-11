<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Manage User";
$FileName = 'manage_user.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['add_attrition_status']))
{
    $validate->addRule($_POST['attrition_id'],'','Attrition ID',true);
	$validate->addRule($_POST['description'],'','Description',true);

    if($validate->validate() && count($stat) == 0)
    {
        $iLastId=$db->getVal("select id from manage_attrition order by id desc")+1;
		$iRandomId=randomFix(15).'-'.$iLastId;

        $aryData = array(
						'usertype' 				=>	$_SESSION['usertype'],
						'userid' 				=>	$_SESSION['userid'],
						'attrition_id' 			=>	$_POST['attrition_id'],
						'description' 			=>	$_POST['description'],
						'create_by_usertype' 	=>	$create_by_usertype,
						'create_by_userid' 		=>	$create_by_userid,
						'randomid' 				=>	$iRandomId,
						);
				$flgIn = $db->insertAry("manage_attrition", $aryData);
				$_SESSION['success']="Added successfully.";
				redirect($FileName.'?action=manage_attrition_status');
    }
    else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['editmas'])) 
{
    $validate->addRule($_POST['attrition_id'],'','Attrition ID',true);
	$validate->addRule($_POST['description'],'','Description',true);

    if($validate->validate() && count($stat) == 0)
    {
		$aryData = array(
						'attrition_id' 			=>	$_POST['attrition_id'],
						'description' 			=>	$_POST['description'],
						);
			$flgIn2 = $db->updateAry("manage_attrition", $aryData, "where randomid='".$_GET['randomid']."'");
			$_SESSION['success']="Saved successfully.";
			redirect($FileName.'?action=manage_attrition_status');
    }
	else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif($_GET['action']=='delete_mas') 
{
	$flgIn1 = $db->delete("manage_attrition", "where randomid='".$_GET['randomid']."'");
	$_SESSION['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=manage_attrition_status');
    
}
elseif(isset($_POST['update_status']))
{
    if($validate->validate() && count($stat) == 0)
    {
		$iStudent=$db->getRow("select * from manage_student where randomid='".$_GET['randomid']."'");
		
		$iStatus=$db->getRow("select * from manage_student_attrition where student_id='".$iStudent['id']."'");
		
		if($iStatus['id']=='')
		{
			$iLastId=$db->getVal("select id from manage_student_attrition order by id desc")+1;
			$iRandomId=randomFix(15).'-'.$iLastId;

			$aryData = array(
							'usertype' 				=>	$_SESSION['usertype'],
							'userid' 				=>	$_SESSION['userid'],
							'student_id' 			=>	$iStudent['id'],
							'status' 				=>	$_POST['status'],
							'date' 					=>	$_POST['date'],
							'comments' 				=>	$_POST['comments'],
							'create_by_usertype' 	=>	$create_by_usertype,
							'create_by_userid' 		=>	$create_by_userid,
							'randomid' 				=>	$iRandomId,
							);
					$flgIn = $db->insertAry("manage_student_attrition", $aryData);
					$_SESSION['success']="Updated successfully.";
					redirect($FileName.'?action=manage_student_attrition&view=status&randomid='.$_GET['randomid']);
		}
		else
		{
			$aryData = array(
							'status' 				=>	$_POST['status'],
							'date' 					=>	$_POST['date'],
							'comments' 				=>	$_POST['comments'],
							);
					$flgIn2 = $db->updateAry(" ", $aryData, "where randomid='".$iStatus['randomid']."'");
					$_SESSION['success']="Updated successfully.";
					redirect($FileName.'?action=manage_student_attrition&view=status&randomid='.$_GET['randomid']);
		}
    }
    else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['submit_parent']))
{
	if($validate->validate() && count($stat) == 0)
    {
		foreach($_POST['parent_id'] as $key=>$val)
		{
		$aryData = array(
						'status' 				=>	$_POST['parent_status'][$key],
						);
			$flgIn2 = $db->updateAry("student_guardian", $aryData, "where id='".$_POST['parent_id'][$key]."'");
		}
			$_SESSION['success']="Updated successfully.";
			redirect($FileName.'?action=staff_account');
	}
}
elseif(isset($_POST['submit_staff']))
{
	if($validate->validate() && count($stat) == 0)
    {
		foreach($_POST['staff_id'] as $key => $val)
		{
		
		$aryData = array(
						'status' 				=>	$_POST['staff_status'][$key],
						);
			$flgIn2 = $db->updateAry("school_register", $aryData, "where id='".$_POST['staff_id'][$key]."'");
		}
		
			$_SESSION['success']="Updated successfully.";
			redirect($FileName.'?action=view_staff');
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
	background:  #5a4080 none repeat scroll 0% 0%;
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
.abhi{min-height:1200px; }
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
            <?php echo msg($stat);?> </div>
        </div>
        <!-- Basic Form Wizard -->
        <div class="abhi">
          <div class="container">
            <div class="row">
              <div class="col-md-12  col-xs-12">
                <div class="card">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php if($_GET['action']=='' || $_GET['action']=='verification_status') { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=verification_status"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Verification Status</span> </a> </li>
                    <li role="presentation" class="<?php if($_GET['action']=='staff_account') { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=staff_account"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Parents Accounts</span> </a> </li>
                    <li role="presentation" class="<?php if($_GET['action']=='view_staff') { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=view_staff"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Staff Accounts</span> </a> </li>
                  </ul>
                  <div class="tab-content">
                    <?php if($_GET['action']=='' || $_GET['action']=='verification_status') { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish">
                        <div class="row">
                          <div class="col-md-12 col-xs-12">
                            
                              <div class="form-group clearfix">
                              <form action="" method="POST">
                                <div class="col-lg-4  col-md-4 col-xs-12">
                                  <select class="required form-control" name="usertype">
                                    <option value="">Select User</option>
                                    <option value="1" <?php if($_POST['usertype']=='1') { echo "selected"; } ?>>Staff</option>
                                    <option value="2" <?php if($_POST['usertype']=='2') { echo "selected"; } ?>>Parent</option>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <button type="submit" name="submit" class="btn"> <span>Search</span> </button>
                                </div>
                                </form>
                                <div class="col-lg-6">
                                <form action="csv_manage_user.php?action=verification_status" method="post">
                                 <button type="submit" name="submit" class="btn"> <i class="fa fa-file-excel-o" style="padding-right:0px!important; "></i> Download Excel </button>
                                 </form>
                                
                                </div>
                              </div>
                            
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-xs-12">
                            <form action="" method="POST">
                              <div class="card-box  table-responsive tablthisresponsive">
                                <table  class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>User Name</th>
                                      <th>Full Name</th>
                                      <th>Phone Number</th>
                                      <th>User Type</th>
                                      <th>Email</th>
                                      <th>Password</th>
                                      <th>Status</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $i=0; 
									$iSearch="";
									if($_POST['usertype']!='')
									{
										$iSearch=" and usertype='".$_POST['usertype']."'";
									}
									
                                    $aryList = $db->getRows("select * from school_register where create_by_userid='".$create_by_userid."' $iSearch order by id desc");
									foreach($aryList as $iList) 
									{ $i=$i+1;
									?>
                                    <tr>
                                      <td><?php echo $i ?></td>
                                      <td><?php echo $iList['username'];?></td>
                                      <td><?php echo $iList['name'];?></td>
                                      <td><?php echo $iList['contact_no'];?></td>
                                      <td><?php if($iList['usertype']=='1') { echo "STAFF"; } 
											if($iList['usertype']=='2') { echo "PARENT"; }
											?></td>
                                      <td><?php echo $iList['email'];?></td>
                                      <td><?php echo $iList['password'];?></td>
                                      <td><?php if($iList['status']=='1') { echo "Active"; } 
												if($iList['status']=='0') { echo "InActive"; }  
												if($iList['status']=='2') { echo "Deactivated"; } ?></td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php }  elseif($_GET['action']=='staff_account') { 
						$GetEmailId=$db->getRow("select * from 	student_guardian where randomid='".$_GET['randomid']."' and create_by_userid='".$create_by_userid."'");
						?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish"> 
                       <div class="row">
                        <div class="col-lg-12">
                                <form action="csv_manage_user.php?action=staff_account" method="post">
                                 <button type="submit" name="submit" class="btn"> <i class="fa fa-file-excel-o" style="padding-right:0px!important; "></i> Download Excel </button>
                                 </form>
                                
                                </div>
                          <div class="col-md-12 col-xs-12"> 
                          <form action="" method="POST">
                      <div class="card-box  table-responsive tablthisresponsive">
                          
                            <table  class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>User Name</th>
                                  <th>Full Name</th>
                                  <th>Email</th>
                                  <th>Password</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i=0;
								
									$aryList=$db->getRows("select parent_id  from student_guardian where create_by_userid='".$create_by_userid."' 
									group by parent_id order by id asc");
									foreach($aryList as $iList) 
									{ $i=$i+1;
									

$manageParent=$db->getRow("select * from student_guardian where parent_id = '".$iList['parent_id']."' and  create_by_userid='".$create_by_userid."' order by id asc");
									?>
                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php echo $manageParent['parent_id'];?></td>
                                  <td><?php echo $manageParent['first_name'];?> <?php echo $manageParent['last_name'];?></td>
                                  <td><?php echo $manageParent['email'];?></td>
                                  <td><?php echo $manageParent['password'];?></td>
                                  <td><input type="hidden" name="parent_id[]" value="<?php echo $manageParent['id']; ?>">
                                    <input type="checkbox" name="pstatus[]" id="pstatus<?php echo $manageParent['id']; ?>" value="1" <?php if($manageParent['status']=='1') { echo "checked"; } ?> onChange="parent('<?php echo $manageParent['id']; ?>')">
                                    <input type="hidden" name="parent_status[]" id="parent_status<?php echo $manageParent['id']; ?>" value="<?php echo $manageParent['status']; ?>"></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                            <input type="submit" name="submit_parent" value="Update Parent Status" class="btn btn-primary pull-right">
                         
                        </div>
                         </form>
                      	</div>
                       </div> 
                      </div>
                    </div>
                    <?php } elseif($_GET['action']=='view_staff') { 
						$GetEmailId=$db->getRow("select * from  school_register where randomid='".$_GET['randomid']."' and create_by_userid='".$create_by_userid."'");
						?>
                   <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish"> 
                       <div class="row">
                        <div class="col-lg-12">
                                <form action="csv_manage_user.php?action=view_staff" method="post">
                                 <button type="submit" name="submit" class="btn"> <i class="fa fa-file-excel-o" style="padding-right:0px!important; "></i> Download Excel </button>
                                 </form>
                                
                                </div>
                          <div class="col-md-12 col-xs-12"> 
                          <form action="" method="POST">
                      <div class="card-box  table-responsive tablthisresponsive">
                          
                            <table  class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>User Name</th>
                                  <th>Role</th>
                                  <th>Full Name</th>
                                  <th>Email</th>
                                  <th>Password</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i=0;
							$aryList = $db->getRows("select * from school_register where usertype='1' and create_by_userid='".$create_by_userid."'");
							foreach($aryList as $iList) 
							{ 
							$i=$i+1;
							$iFindRole=$db->getRow("select id,role_id from  assign_role where create_by_userid='".$create_by_userid."' and staff_id='".$iList['id']."'");
							$iRoleName=$db->getRow("select role from roles where create_by_userid='".$create_by_userid."' and id='".$iFindRole['id']."'");
     						
							?>
                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php echo $iList['username'];?></td>
                                  <td><?php echo $iRoleName['role'];?></td>
                                  <td><?php echo $iList['name'];?></td>
                                  <td><?php echo $iList['email'];?></td>
                                  <td><?php echo $iList['password'];?></td>
                                  <td><input type="hidden" name="staff_id[]" value="<?php echo $iList['id']; ?>">
                                    <input type="checkbox" value="1" id="status<?php echo $iList['id']; ?>" <?php if($iList['status']=='1') { echo "checked"; } ?> onChange="staff('<?php echo $iList['id']; ?>')">
                                    <input type="hidden" name="staff_status[]" id="staff_status<?php echo $iList['id']; ?>" value="<?php echo $iList['status']; ?>" ></td>
                                </tr>
                                <?php } ?>
                              </tbody>
                            </table>
                            <input type="submit" name="submit_staff" value="Update Staff Status" class="btn btn-primary pull-right">
                          </div>
                          </form>
                          </div>
                          </div>
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
  <script>	
function staff(sid)
{
	if(document.getElementById("status"+sid).checked==true)
	{
		document.getElementById("staff_status"+sid).value='1';
	}
	else
	{
		document.getElementById("staff_status"+sid).value='0';
	}
}
function parent(pid)
{
	if(document.getElementById("pstatus"+pid).checked==true)
	{
		document.getElementById("parent_status"+pid).value='1';
	}
	else
	{
		document.getElementById("parent_status"+pid).value='0';
	}
}
</script>
</body>
</html>