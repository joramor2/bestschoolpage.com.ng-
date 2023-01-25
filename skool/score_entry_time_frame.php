<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Score Entry Time Frame";
$FileName = 'score_entry_time_frame.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['add_assessment']))
{
    //$validate->addRule($_POST['session'],'','session',true);
	//$validate->addRule($_POST['section'],'','Section',true);
	//$validate->addRule($_POST['term_id'],'','Term',true);
	$validate->addRule($_POST['class'],'','class',true);
	$validate->addRule($_POST['assesment'],'','Assesment',true);

    if($validate->validate() && count($stat) == 0)
    {
        $iLastId=$db->getVal("select id from school_assessment order by id desc ")+1;
		$iRandomId=randomFix(15).'-'.$iLastId;

        $aryData = array(
								'usertype'     	 	         			    =>	$_SESSION['usertype'],
								'userid'     	 	         			    =>	$_SESSION['userid'],
								//'session'     	 	         			=>	$_POST['session'],
								//'section'     	 	         		    =>	$_POST['section'],
								//'term_id'     	 	         			=>	$_POST['term_id'],
								'class_id'     	 	         	    		=>	$_POST['class'],
								'assesment'     	 	         			=>	$_POST['assesment'],
								'userid'                                    => $_SESSION['userid'],
                               'usertype'                                   => $_SESSION['usertype'],
			                   'create_by_userid'                           => $create_by_userid,
                               'create_by_usertype'                         => $create_by_usertype,
								'randomid'     	 	         		        =>	$iRandomId,
						);
				
				$flgIn = $db->insertAry("school_assessment", $aryData);
				
				$stat['success']="Added successfully.";
				$_SESSION['success']="Added successfully.";
				redirect($FileName.'?action=manage_assessment');
    }
    else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['edit_assesment'])) 
{
   
    
		$aryData = array(
						
						'assesment'     	 	         			        =>	$_POST['assesment'],
						);
			$flgIn2 = $db->updateAry("school_assessment", $aryData, "where randomid='".$_GET['randomid']."'");
			//echo $flgIn2 = $db->getLastQuery();
			//exit;
			$stat['success']="Saved successfully.";
			$_SESSION['success']="Saved successfully.";
			redirect($FileName.'?action=manage_assessment');
   
}
elseif($_GET['action']=='delete_mas') 
{
	$flgIn1 = $db->delete("school_assessment", "where randomid='".$_GET['randomid']."'");
	$stat['success'] = 'Deleted Successfully';
	$_SESSION['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=manage_assessment');
    
}
if (isset($_POST['add_score_entry'])) {

    $validate->addRule($_POST['session'],'', 'Session', true);
    $validate->addRule($_POST['term_id'],'','Term',true);
	$validate->addRule($_POST['class'],'','Class',true);
    $validate->addRule($_POST['assesment'], '', 'Assesment', true);
	$validate->addRule($_POST['percentage'], '', 'Percentage', true);
    $validate->addRule($_POST['start_date'], '', 'Start Date', true);
    $validate->addRule($_POST['end_date'], '', 'End Date', true);


    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
             'session'               => $_POST['session'],
			 'term_id'     	 	     =>	$_POST['term_id'],
             'class'                 => $_POST['class'],
            'assesment_id'           => $_POST['assesment'],
			'percentage'             => $_POST['percentage'],
            'start_date'             => $_POST['start_date'],
            'end_date'               => $_POST['end_date'],
			 'userid'                => $_SESSION['userid'],
            'usertype'               => $_SESSION['usertype'],
			'create_by_userid'       => $create_by_userid,
            'create_by_usertype'     => $create_by_usertype,
            'randomid'               => randomFix(10),
        );
        $flgIn2 = $db->insertAry("score_entry_time_frame", $aryData);
		
       
		 $_SESSION['success'] = "Submited successfully";
        $stat['success'] = "Submited successfully";
		redirect($FileName.'?action=score_entry');
    }
    else {$stat['error'] = $validate->errors();}
}

elseif (isset($_POST['edit_score_entry'])) {


    

    if ($validate->validate() && count($stat) == 0) {


        $aryData = array(
		
             'percentage'              => $_POST['percentage'],
            'start_date'              => $_POST['start_date'],
            'end_date'                => $_POST['end_date'],

        );
        $flgIn2 = $db->updateAry("score_entry_time_frame", $aryData, "where randomid='".$_GET['randomid']."' ");
		
		$_SESSION['success'] = "Updated successfully";
		$stat['success'] = "Updated successfully";
          redirect($FileName.'?action=score_entry');
        
    }
}


elseif (($_REQUEST['action'] == 'delete')) {
    $flgIn1 = $db->delete("score_entry_time_frame", "where randomid='" . $_GET['randomid'] . "' ");
	$stat['success'] = "Deleted successfully";
    redirect($FileName.'?action=score_entry');
    //$stat['success'] = 'Deleted Successfully';
}



if (isset($_POST['add_grade'])) {

    $validate->addRule($_POST['maximum_number'],'', 'Maximum Number', true); 
    $validate->addRule($_POST['minimum_number'], '', 'Minimum Number', true);
    $validate->addRule($_POST['grade'], '', 'grade', true);
	$validate->addRule($_POST['description'], '', 'Description', true);
    $validate->addRule($_POST['order_type'], '', 'Order Type', true);
    


    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
		     'maximum_number'             => $_POST['maximum_number'],
             'minimum_number'             => $_POST['minimum_number'],
             'description'                => $_POST['description'],
			  'comment'                		=> $_POST['comment'],
             'order_type'                 => $_POST['order_type'],
            'grade'                       => $_POST['grade'],
            'userid'                      => $_SESSION['userid'],
            'usertype'                    => $_SESSION['usertype'],
			'create_by_userid'            => $create_by_userid,
            'create_by_usertype'          => $create_by_usertype,
            'randomid'                    => randomFix(10),
        );
        $flgIn2 = $db->insertAry("school_grade", $aryData);
       

        $stat['success'] = "Submited successfully";
		redirect($FileName.'?action=grade');
    }
    else {$stat['error'] = $validate->errors();}
}

elseif (isset($_POST['edit_grade'])) {

    $validate->addRule($_POST['maximum_number'],'', 'Maximum Number', true);
 
    $validate->addRule($_POST['minimum_number'], '', 'Minimum Number', true);
    $validate->addRule($_POST['grade'], '', 'grade', true);
	 $validate->addRule($_POST['description'], '', 'Description', true);
    $validate->addRule($_POST['order_type'], '', 'Order Type', true);
    


    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
             'maximum_number'             => $_POST['maximum_number'],
             'minimum_number'                 => $_POST['minimum_number'],
            'grade'                      => $_POST['grade'],
			'comment'                		=> $_POST['comment'],
			'description'                => $_POST['description'],
             'order_type'                 => $_POST['order_type'],
            
        );
        $flgIn2 = $db->updateAry("school_grade", $aryData, "where randomid='".$_GET['randomid']."' ");
		
       

        $stat['success'] = "Updated successfully";
		redirect($FileName.'?action=grade');
    }
    else {$stat['error'] = $validate->errors();}
}


elseif (($_REQUEST['action'] == 'delete_grade')) {
    $flgIn1 = $db->delete("school_grade", "where randomid='" . $_GET['randomid'] . "' ");
     $stat['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=grade');
   
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
	background: # #5a4080 none repeat scroll 0% 0%;
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
							<li role="presentation" class="<?php if($_GET['action']=='' || $_GET['action']=='manage_assessment') { echo "active"; } ?>">
								<a href="<?php echo $Filename; ?>?action=manage_assessment">
									<i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>Manage Assessment</span>
								</a>
                            </li>
							<li role="presentation" class="<?php if($_GET['action']=='score_entry') { echo "active"; } ?>">
								<a href="<?php echo $FileName; ?>?action=score_entry">
									<i class="fa fa-users" aria-hidden="true"></i>
                                    <span>Manage Score Entry</span>
								</a>
							</li>
							
							<li role="presentation" class="<?php if($_GET['action']=='grade') { echo "active"; } ?>">
								<a href="<?php echo $FileName; ?>?action=grade">
									<i class="fa fa-users" aria-hidden="true"></i>
                                    <span>Manage Grade</span>
								</a>
							</li>
							
							

						</ul>
						<div class="tab-content">
						<?php if($_GET['action']=='' || $_GET['action']=='manage_assessment') {
						$iupdatedetails = $db->getRow("select * from  school_register where create_by_userid='".$create_by_userid."'"); 
						?>
							<!-- Tab panes -->
							 <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="ab-1">
								<form action="" method="POST">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
									
										

										<!--<div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="employee_id">Section</label>
											<div class="col-lg-10">
											
                                            <select  class="required form-control" name="section" id="section" >
			  <option>Select Section</option>
			  <?php $aryDetail=$db->getRows("select * from  school_section where create_by_userid='".$create_by_userid."'");
					   foreach($aryDetail as $iList)
									{	$i=$i+1;?>
             <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['section']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['section']; ?></option>
									<?php }?>
            </select>
                                        </div></div>
										
										<div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="employee_id">Session</label>
                                            <div class="col-lg-10">

                                                <select  class="required form-control" name="session" id="session" >
                                                    <option>Select Session</option>
                                                    <?php $aryDetail=$db->getRows("select * from  school_session where create_by_userid='".$create_by_userid."'");
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['session']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['session']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
											</div>
											
											
											<div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="employee_id">Term</label>
                                            <div class="col-lg-10">

                                                <select  class="required form-control" name="term_id" id="term_id" >
                                                    <option>Select Term</option>
                                                    <?php $aryDetail=$db->getRows("select * from  school_term where create_by_userid='".$create_by_userid."'");
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['term_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['term']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
											</div>-->
											<div class="form-group clearfix">
											<label class="col-lg-2 control-label " for="userName">Class  </label>
											<div class="col-lg-10">
											<select  class="required form-control" name="class" id="class" >
                                                    <option value="">Select Class</option>
                                                    <?php $aryDetail=$db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['class']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['name']; ?></option>
                                                    <?php }?>
                                                </select>
												</div>
											</div>
											
											
											<div class="form-group clearfix">
											<label class="col-lg-2 control-label " for="userName">Assesment  </label>
											<div class="col-lg-10">
											<input type="text" class="form-control required" id="assesment" name="assesment" placeholder="Eg. CA1" value="<?php echo $_POST['assesment']; ?>">
											</div>
											</div>
										
										<div class="form-group clearfix bfrcs ">
											<div class="col-lg-12 ">
												<button type="submit" name="add_assessment" class="btn">
													<i class="fa fa-plus" aria-hidden="true"></i><span>Add Assesment</span>
												</button>
											</div>
										</div> 
										
									</div>
									<div class="col-md-1"></div>
								</div>
								</form>
								 <div class="card-box table-responsive tablthisresponsive">
								<form action="" method="POST">
									<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<!--<th>School Session</th>-->
											<th>Class</th>
											<th>Assesment Name </th>
											<th>Edit</th>
											<th>Remove</th>
										</tr>
									</thead>
                                    <tbody>
                                    <?php $i=0;
				$aryList=$db->getRows("select * from school_assessment where create_by_userid='".$create_by_userid."' order by id desc");
						foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							 ?>
                                        <tr>
											<td><?php echo $i ?></td>
											 
												
											<!--<td>
												
												<?php  echo $db->getVal("select session from school_session where id='".$iList['session']."'");  
												?>
											</td>-->
											<td>
												
												<?php  echo $db->getVal("select name from school_class where id='".$iList['class_id']."'");  
												?>
											</td>
											
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="assesment" value="<?php echo $iList['assesment']; ?>" class="form-control">
												<?php } else { echo $iList['assesment']; } ?>
											</td>
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="submit" name="edit_assesment" value="SAVE" class="btn btn-primary" style="color:white;"> 
												<?php } else { ?>
												<a href="<?php echo $FileName; ?>?action=manage_assessment&randomid=<?php echo $iList['randomid']; ?>" class="table-action-btn">
                                                    <i class="fa fa-pencil"></i> 
												</a>
												<?php } ?>
											</td>
											<td>
												<a href="javascript:del('<?php echo $FileName; ?>?action=delete_mas&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> 
													<i class="fa fa-times"></i> 
												</a>
											</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>
								</form>	
								</div>
							</div>
							</div>  
						<?php } elseif($_GET['action']=='score_entry') {
						$iupdatedetails = $db->getRow("select * from  school_register where id='".$_SESSION['userid']."' and create_by_userid='".$create_by_userid."'"); 
						?>
							<!-- Tab panes -->
							<div role="tabpanel" class="tab-pane active" id="home">
                            <div class="ab-1">
								<form action="" method="POST">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
									
                                        <div class="form-group clearfix">
                                            <label class="col-lg-1 control-label" for="employee_id">Session </label>
                                            <div class="col-lg-3">
											
                                                <select  class="required form-control" name="session" id="session"  ><!---onchange="getassesment();"---->
                                                    <option  value="">Select Session</option>
                                                    <?php $aryDetail=$db->getRows("select * from  school_session  where create_by_userid='".$create_by_userid."'");
													
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['session']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['session']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
											
											<label class="col-lg-1 control-label" for="employee_id">Term</label>
                                            <div class="col-lg-3">
											
                                                 <select  class="required form-control" name="term_id" id="term_id" >
                                                    <option  value="">Select Term</option>
                                                    <?php $aryDetail=$db->getRows("select * from  school_term where create_by_userid='".$create_by_userid."'");
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['term_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['term']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
											
											

                                            <label class="col-lg-1 control-label" for="employee_id" > Class </label>
                                            <div class="col-lg-3">
                                                <select  class="required form-control" name="class" id="class_id" onchange="getassesment();" >
                                                    <option  value="">Select Class</option>
                                                    <?php $aryDetail=$db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
                                                    foreach($aryDetail as $iList)
                                                    {	$i=$i+1;?>
                                                        <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['class']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['name']; ?></option>
                                                    <?php }?>
                                                </select>
                                            </div>
                                        </div>

										<div class="form-group clearfix">

                                            <label class="col-lg-2 control-label " for="confirm"> Assesment </label>
                                            <div class="col-lg-4">
											<span id="getasses">
                                                <select class=" form-control" name="assesment" id="assesment" >
												<option  value="">Select Assesment</option>
													<?php $assesment=$db->getRows("select * from school_assessment where class_id='".$_POST['class_id']."' and create_by_userid='".$create_by_userid."'");
													foreach ($assesment as $iList)
													{ ?>
													<option  value="<?php echo $iList['id']; ?>" <?php if($_POST['assesment']==$iList['id']) { echo  "selected"; } ?> > <?php echo $iList['assesment']; ?>
	                                                </option>
                                                   <?php } ?>
										      </select>
											</span>
                                            </div>

                                            <label class="col-lg-2 control-label " for="price"> Percentage </label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control " placeholder="eg. 40%" name="percentage"  value="<?php echo $_POST['percentage'];?>" autocomplete="off" />
                                            </div>
                                        </div>
										<div class="form-group clearfix">

                                            <label class="col-lg-2 control-label " for="price"> Start Date </label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control datepicker"  name="start_date" autocomplete="off" value="<?php echo $_POST['start_date'];?>" />
                                            </div>

                                          <label class="col-lg-2 control-label " for="price"> End Date </label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control datepicker" autocomplete="off" name="end_date" value="<?php echo $_POST['end_date'];?>" />
                                            </div>
                                        </div>
										 

										
										<div class="form-group clearfix bfrcs ">
											<div class="col-lg-12 ">
												<button type="submit" name="add_score_entry" class="btn">
													<i class="fa fa-plus" aria-hidden="true"></i><span>Add</span>
												</button>
											</div>
										</div> 
										
									</div>
									<div class="col-md-1"></div>
								</div>
								</form>
									<div class="card-box table-responsive tablthisresponsive">
								<form action="" method="POST">
									<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											<th>Session</th>
											<th>Term</th>
											<th>Class</th>											
											<th>Assesment</th>
											<th>Percentage</th>											
											<th>Start date</th>
											<th>End date</th>
											<th>Edit</th>
											<th>Remove</th>
										</tr>
									</thead>
                                    <tbody>
                                    <?php $i=0;
				$aryList=$db->getRows("select * from score_entry_time_frame where create_by_userid='".$create_by_userid."'");
						foreach($aryList as $iList)
							{	$i=$i+1;
							  $aryStudent= $db->getRow("select * from school_session where id ='" .$iList['session']. "' where create_by_userid='".$create_by_userid."'");
								$aryPgAct["id"]=$iList['id'];
							 ?>
                                        <tr>
											<td><?php echo $i ?></td>
											 
												
												  <td><?php echo $db->getVal("select session from school_session where id='".$iList['session']."'");  ?> </td>
												  <td><?php echo $db->getVal("select term from school_term where id='".$iList['term_id']."'");  ?> </td>
												    <td><?php echo $db->getVal("select name from school_class where id='" .$iList['class']. "'");  ?> </td>
												 
												  <td><?php echo $db->getVal("select assesment from school_assessment where id='" .$iList['assesment_id']. "'");  ?> </td>
												   <td>
												  
												 <?php if($_GET['randomid']==$iList['randomid'])
												 { ?> <input class="form-control" type="text"  placeholder="eg. 40%" name="percentage" value="<?php echo $iList['percentage']; ?>" > <?php } else { echo $iList['percentage'];   } ?>
												 
												 </td>
													 
													 <td>
												  
												 <?php if($_GET['randomid']==$iList['randomid'])
												 { ?> <input class="form-control datepicker" type="text" name="start_date" value="<?php echo $iList['start_date']; ?>" autocomplete="off"> <?php } else { echo $iList['start_date'];   } ?>
												 
												 </td>
												   <td>
												 <?php if($_GET['randomid']==$iList['randomid'])
												 { ?> <input class="form-control datepicker" type="text" name="end_date" value="<?php echo $iList['end_date']; ?>" autocomplete="off"> <?php } else { echo $iList['end_date'];   } ?>
												 
												 </td>
											
											<td>
											<?php if($_GET['randomid']==$iList['randomid']) { ?>
											<input type="submit" name="edit_score_entry" value="SAVE" class="btn btn-primary" style="color:white;">  <?php } else { ?> 
												<a href="<?php echo $FileName; ?>?action=score_entry&randomid=<?php echo $iList['randomid']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>
											<?php } ?>
											</td>
											<td>
												<a href="javascript:del('<?php echo $FileName; ?>?action=delete&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> 
													<i class="fa fa-times"></i> 
												</a>
											</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>
								</form>	
								</div>
								
				 

                        <?php } elseif($_GET['action']=='' || $_GET['action']=='grade') {
						$iupdatedetails = $db->getRow("select * from  school_register where id='".$_SESSION['userid']."'"); 
						?>
							<!-- Tab panes -->
							 <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="ab-1">
								<form action="" method="POST">
								<div class="row">
									<div class="col-md-1"></div>
									<div class="col-md-10">
									
										
                     <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Maximum Number</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="maximum_number" name="maximum_number" value="<?php echo $_POST['maximum_number']; ?>">
                      </div>
                    </div>
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Minimum Number </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="minimum_number" name="minimum_number" value="<?php echo $_POST['minimum_number']; ?>">
                      </div>
                    </div>
											
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Grade </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="grade" name="grade" value="<?php echo $_POST['grade']; ?>">
                      </div>
                    </div>
					
                    <div class="form-group clearfix">
					<label class="col-lg-2 control-label " for="userName">Comment</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="comment" name="comment" value="<?php echo $_POST['comment']; ?>">
                      </div></div>
                    
                    
                    <div class="form-group clearfix">
					<label class="col-lg-2 control-label " for="userName">Description</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="description" name="description" value="<?php echo $_POST['description']; ?>">
                      </div></div>
					  <div class="form-group clearfix">
					  <label class="col-lg-2 control-label " for="userName">Order Type</label>
                      <div class="col-lg-10">
                       												 <select name="order_type" class="form-control required" >
												    <option  value="">Select Order Type</option>
													<option value="Fail" <?php if($_POST['order_type']=='Fail') { echo "selected"; } ?>>Fail</option>
													<option value="Poor" <?php if($_POST['order_type']=='Poor') { echo "selected"; } ?>>Poor</option>
													<option value="Destinction" <?php if($_POST['order_type']=='Destinction') { echo "selected"; } ?>>Destinction</option>
													<option value="Credit" <?php if($_POST['order_type']=='Credit') { echo "selected"; } ?>>Credit</option>
													<option value="Pass" <?php if($_POST['order_type']=='Pass') { echo "selected"; } ?>>Pass</option>
													</select>
                      </div>                      </div>
										
										<div class="form-group clearfix bfrcs ">
											<div class="col-lg-12 ">
												<button type="submit" name="add_grade" class="btn">
													<i class="fa fa-plus" aria-hidden="true"></i><span>Add Grade</span>
												</button>
											</div>
										</div> 
										
									</div>
									<div class="col-md-1"></div>
								</div>
								</form>
								<div class="card-box table-responsive tablthisresponsive">
								<form action="" method="POST">
									<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>#</th>
											 <th>Comment</th>
                                             <th>Description</th>
											  <th>Order Type </th>
											   <th>Maximum Number </th>
											  <th>Minimum Number </th>
											   <th>Grade </th>
											<th>Edit</th>
											<th>Remove</th>
										</tr>
									</thead>
                                    <tbody>
                                    <?php $i=0;
				$aryList=$db->getRows("select * from school_grade where create_by_userid='".$create_by_userid."'");
						foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							 ?>
                                        <tr>
											<td><?php echo $i ?></td>
											
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="comment" value="<?php echo $iList['comment']; ?>" class="form-control">
												<?php } else { echo $iList['comment']; } ?>
											</td>
                                            <td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="description" value="<?php echo $iList['description']; ?>" class="form-control">
												<?php } else { echo $iList['description']; } ?>
											</td>
											
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												 <select name="order_type" class="form-control required" >
												    <option>Select Order Type</option>
													<option value="Fail" <?php if($iList['order_type']=='Fail') { echo "selected"; } ?> >Fail</option>
													<option value="Poor" <?php if($iList['order_type']=='Poor') { echo "selected"; } ?> >Poor</option>
													<option value="Destinction" <?php if($iList['order_type']=='Destinction') { echo "selected"; } ?> >Destinction</option>
													<option value="Credit" <?php if($iList['order_type']=='Credit') { echo "selected"; } ?> >Credit</option>
													<option value="Pass" <?php if($iList['order_type']=='Pass') { echo "selected"; } ?> >Pass</option>
													</select>
												<?php } else { echo $iList['order_type']; } ?>
											</td>
											 
												
												<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="maximum_number" value="<?php echo $iList['maximum_number']; ?>" class="form-control">
												<?php } else { echo $iList['maximum_number']; } ?>
											</td>
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="minimum_number" value="<?php echo $iList['minimum_number']; ?>" class="form-control">
												<?php } else { echo $iList['minimum_number']; } ?>
											</td>
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="text" name="grade" value="<?php echo $iList['grade']; ?>" class="form-control">
												<?php } else { echo $iList['grade']; } ?>
											</td>
											<td>
												<?php if($_GET['randomid']==$iList['randomid']) { ?>
												<input type="submit" name="edit_grade" value="SAVE" class="btn btn-primary" style="color:white;"> 
												<?php } else { ?>
												<a href="<?php echo $FileName; ?>?action=grade&randomid=<?php echo $iList['randomid']; ?>" class="table-action-btn">
                                                    <i class="fa fa-pencil"></i> 
												</a>
												<?php } ?>
											</td>
											<td>
												<a href="javascript:del('<?php echo $FileName; ?>?action=delete_grade&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> 
													<i class="fa fa-times"></i> 
												</a>
											</td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                    </table>
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
	<?php include('inc.footer.php'); ?>
</div>
</div>
	<?php include('inc.js.php'); ?>
<!--<script> 
function getClass()
{
	
	var section_id = document.getElementById("section_id").value;

	$.post("ajax.php",  
			{	
				"action"	     	:	"Action_getClass",
				section_id	     	:	section_id,
			},
		function(data){
			
			$("#showclass").html(data);
					
				
			});
}



</script>	---->

<script> 
function getassesment()
{
	
	var class_id = document.getElementById("class_id").value;
	
	$.post("ajax.php",  
			{	
				"action"	     	:	"Action_getassesment",
				class_id	     	:	class_id,
			},
		function(data){
			$("#getasses").html(data);
					
				
			});
}



</script>	
</body>
</html>