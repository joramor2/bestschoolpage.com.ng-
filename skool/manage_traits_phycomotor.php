<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Manage Traits And Psychomotor";
$FileName = 'manage_traits_phycomotor.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['add_trait']))
{
	$validate->addRule($_POST['trait'],'','Trait',true);
    if($validate->validate() && count($stat) == 0)
    {
        $iLastId=$db->getVal("select id from school_trait order by id desc ")+1;
		$iRandomId=randomFix(15).'-'.$iLastId;

        $aryData = array(
								'usertype'     	 	         			    =>	$_SESSION['usertype'],
								'userid'     	 	         			    =>	$_SESSION['userid'],
								
								'trait'     	 	         			=>	$_POST['trait'],
								'userid'                                    => $_SESSION['userid'],
                               'usertype'                                   => $_SESSION['usertype'],
			                   'create_by_userid'                           => $create_by_userid,
                               'create_by_usertype'                         => $create_by_usertype,
								'randomid'     	 	         		        =>	$iRandomId,
						);
				
				$flgIn = $db->insertAry("manage_traits", $aryData);
			
				
				$_SESSION['success']="Added successfully.";
				redirect($FileName.'?action=manage_trait');
    }
    else
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['edit_trait'])) 
{
		$aryData = array(
						
						'trait'     	 	         			        =>	$_POST['trait'],
						);
			$flgIn2 = $db->updateAry("manage_traits", $aryData, "where randomid='".$_GET['randomid']."'");
			//echo $flgIn2 = $db->getLastQuery();
			//exit;
			$_SESSION['success']="Saved successfully.";
			redirect($FileName.'?action=manage_trait');
   
}
elseif($_GET['action']=='delete_mas') 
{
	$flgIn1 = $db->delete("manage_traits", "where randomid='".$_GET['randomid']."'");
	$_SESSION['success'] = 'Deleted Successfully';
   redirect($FileName.'?action=manage_trait');
    
}
if (isset($_POST['add_phycomotor'])) {

    $validate->addRule($_POST['phycomotor'], '', 'Phycomotor', true);
    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
             'phycomotor'             => $_POST['phycomotor'],
             
			 'userid'              => $_SESSION['userid'],
            'usertype'                => $_SESSION['usertype'],
			'create_by_userid'              => $create_by_userid,
            'create_by_usertype'                => $create_by_usertype,
            'randomid'                => randomFix(10),
        );
        $flgIn2 = $db->insertAry("manage_phycomotor", $aryData);
		
        $stat['success'] = "Submited successfully";
		redirect($FileName.'?action=manage_phycomotor');
    }
    else {$stat['error'] = $validate->errors();}
}

elseif (isset($_POST['edit_phycomotor'])) {

    if ($validate->validate() && count($stat) == 0) {


        $aryData = array(
             'phycomotor'              => $_POST['phycomotor'],
        );
        $flgIn2 = $db->updateAry("manage_phycomotor", $aryData, "where randomid='".$_GET['randomid']."' ");
		
		$stat['success'] = "Updated successfully";
          redirect($FileName.'?action=manage_phycomotor');
        
    }
}


elseif (($_REQUEST['action'] == 'delete')) {
    $flgIn1 = $db->delete("manage_phycomotor", "where randomid='" . $_GET['randomid'] . "' ");
    redirect($FileName.'?action=manage_phycomotor');
    //$stat['success'] = 'Deleted Successfully';
}

if (isset($_POST['add_scale'])) {

    $validate->addRule($_POST['rating'],'', 'Rating', true); 
    $validate->addRule($_POST['review'], '', 'Review', true);   


    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
					'review'                     => $_POST['review'],
					'rating'                     => $_POST['rating'],             
					'userid'                      => $_SESSION['userid'],
					'usertype'                    => $_SESSION['usertype'],
					'create_by_userid'            => $create_by_userid,
					'create_by_usertype'          => $create_by_usertype,
					'randomid'                    => randomFix(10),
					);
        $flgIn2 = $db->insertAry("school_scale", $aryData);
       

        $stat['success'] = "Submited successfully";
		redirect($FileName.'?action=grade');
    }
    else {$stat['error'] = $validate->errors();}
}

elseif (isset($_POST['edit_scale'])) {

    $validate->addRule($_POST['rating'],'', 'Rating', true); 
    $validate->addRule($_POST['review'], '', 'Review', true);  

    if ($validate->validate() && count($stat) == 0)
    {
        $aryData = array(
             'review'                     => $_POST['review'],
             'rating'                     => $_POST['rating'],   
            
        );
        $flgIn2 = $db->updateAry("school_scale", $aryData, "where randomid='".$_GET['randomid']."' ");
		
       

        $stat['success'] = "Updated successfully";
		redirect($FileName.'?action=grade');
    }
    else {$stat['error'] = $validate->errors();}
}


elseif (($_REQUEST['action'] == 'delete_scale')) {
    $flgIn1 = $db->delete("school_scale", "where randomid='" . $_GET['randomid'] . "' ");
    redirect($FileName.'?action=grade');
    //$stat['success'] = 'Deleted Successfully';
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
        <?php echo msg($stat);?> </div>
    </div>
    <!-- Basic Form Wizard -->
    <div class="abhi">
      <div class="container">
        <div class="row">
          <div class="col-md-12  col-xm-12"> 
            <!-- Nav tabs -->
            <div class="card">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="<?php if($_GET['action']=='' || $_GET['action']=='manage_trait') { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=manage_trait"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <span>Manage Traits</span> </a> </li>
                <li role="presentation" class="<?php if($_GET['action']=='manage_phycomotor') { echo "active"; } ?>"> <a href="<?php echo $FileName; ?>?action=manage_phycomotor"> <i class="fa fa-users" aria-hidden="true"></i> <span>Manage Phycomotor</span> </a> </li>
                <li role="presentation" class="<?php if($_GET['action']=='grade') { echo "active"; } ?>"> <a href="<?php echo $FileName; ?>?action=grade"> <i class="fa fa-users" aria-hidden="true"></i> <span>Manage Scale</span> </a> </li>
              </ul>
              <div class="tab-content">
                <?php if($_GET['action']=='' || $_GET['action']=='manage_trait') {
						$iupdatedetails = $db->getRow("select * from  school_register where create_by_userid='".$create_by_userid."'"); 
						?>
                <!-- Tab panes -->
                <div role="tabpanel" class="tab-pane active" id="home">
                  <div class="ab-1">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10  col-xm-12"> 
                          
                          <!---<div class="form-group clearfix">
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
											</div>---->
                          
                          <div class="form-group clearfix">
                            <label class="col-lg-2 control-label " for="userName">Traits Name </label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="trait" name="trait" value="<?php echo $_POST['trait']; ?>" placeholder="Eg.PUNCTUALITY" />
                            </div>
                          </div>
                          <div class="form-group clearfix bfrcs ">
                            <div class="col-lg-12 col-md-12  col-xs-12 ">
                              <button type="submit" name="add_trait" class="btn"> <i class="fa fa-plus" aria-hidden="true"></i><span>Add Traits</span> </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-1"></div>
                      </div>
                    </form>
                    <div class="card-box table-responsive tablthisresponsive">
                      <form action="" method="POST">
                        <table  class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Trait Name </th>
                              <th>Edit</th>
                              <th>Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=0;
				$aryList=$db->getRows("select * from manage_traits where create_by_userid='".$create_by_userid."'");
						foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							 ?>
                            <tr>
                              <td><?php echo $i ?></td>
                              <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                <input type="text" name="trait" value="<?php echo $iList['trait']; ?>" class="form-control">
                                <?php } else { echo $iList['trait']; } ?></td>
                              <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                <input type="submit" name="edit_trait" value="SAVE" class="btn btn-primary" style="color:white;">
                                <?php } else { ?>
                                <a href="<?php echo $FileName; ?>?action=manage_trait&randomid=<?php echo $iList['randomid']; ?>" class="table-action-btn"> <i class="fa fa-pencil"></i> </a>
                                <?php } ?></td>
                              <td><a href="javascript:del('<?php echo $FileName; ?>?action=delete_mas&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> <i class="fa fa-times"></i> </a></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </form>
                    </div>
                  </div>
                </div>
                <?php } elseif($_GET['action']=='manage_phycomotor') {
						$iupdatedetails = $db->getRow("select * from  manage_phycomotor where id='".$_SESSION['userid']."' and create_by_userid='".$create_by_userid."'"); 
						?>
                <!-- Tab panes -->
                <div role="tabpanel" class="tab-pane active" id="home">
                  <div class="ab-1">
                    <form action="" method="POST">
                      <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10   col-xm-12">
                          <div class="form-group clearfix">
                            <label class="col-lg-2 control-label " for="userName">Phycomotor Name </label>
                            <div class="col-lg-10">
                              <input type="text" class="form-control required" id="phycomotor" name="phycomotor"  value="<?php echo $_POST['phycomotor']; ?>" placeholder="Eg.GAMES" />
                            </div>
                          </div>
                          <div class="form-group clearfix bfrcs ">
                            <div class="col-lg-12 ">
                              <button type="submit" name="add_phycomotor" class="btn"> <i class="fa fa-plus" aria-hidden="true"></i><span>Add</span> </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-1"></div>
                      </div>
                    </form>
                   <div class="card-box table-responsive tablthisresponsive">
                      <form action="" method="POST">
                        <table  class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Phycomotor</th>
                              <th>Edit</th>
                              <th>Remove</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $i=0;
				$aryList=$db->getRows("select * from manage_phycomotor where create_by_userid='".$create_by_userid."'");
						foreach($aryList as $iList)
							{	$i=$i+1;
							  
							 ?>
                            <tr>
                              <td><?php echo $i ?></td>
                              <td><?php if($_GET['randomid']==$iList['randomid'])
												 { ?>
                                <input class="form-control" type="text" name="phycomotor" value="<?php echo $iList['phycomotor']; ?>" >
                                <?php } else { echo $iList['phycomotor'];   } ?></td>
                              <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                <input type="submit" name="edit_phycomotor" value="SAVE" class="btn btn-primary" style="color:white;">
                                <?php } else { ?>
                                <a href="<?php echo $FileName; ?>?action=manage_phycomotor&randomid=<?php echo $iList['randomid']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>
                                <?php } ?></td>
                              <td><a href="javascript:del('<?php echo $FileName; ?>?action=delete&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> <i class="fa fa-times"></i> </a></td>
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
                            <div class="col-md-10    col-xm-12">
                              <div class="form-group clearfix">
                                <label class="col-lg-2 control-label " for="userName"> Rating</label>
                                <div class="col-lg-10">
                                  <input type="text" class="form-control required" id="rating" name="rating" placeholder="Eg. 5" value="<?php echo $_POST['review']; ?>">
                                </div>
                              </div>
                              <div class="form-group clearfix">
                                <label class="col-lg-2 control-label " for="userName"> Review </label>
                                <div class="col-lg-10">
                                  <input type="text" class="form-control required" id="review" name="review" placeholder="Excellence Degree of Observable Trait"  value="<?php echo $_POST['review']; ?>">
                                </div>
                              </div>
                              <div class="form-group clearfix bfrcs ">
                                <div class="col-lg-12 ">
                                  <button type="submit" name="add_scale" class="btn"> <i class="fa fa-plus" aria-hidden="true"></i><span>Add Scale</span> </button>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-1"></div>
                          </div>
                        </form>
                       <div class="card-box table-responsive tablthisresponsive">
                      <form action="" method="POST">
                        <table  class="table table-striped table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Rating</th>
                                  <th>Review</th>
                                  <th>Edit</th>
                                  <th>Remove</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i=0;
				$aryList=$db->getRows("select * from school_scale where create_by_userid='".$create_by_userid."'");
						foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							 ?>
                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                    <input type="text" name="rating" value="<?php echo $iList['rating']; ?>" class="form-control">
                                    <?php } else { echo $iList['rating']; } ?></td>
                                  <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                    <input type="text" name="review" value="<?php echo $iList['review']; ?>" class="form-control">
                                    <?php } else { echo $iList['review']; } ?></td>
                                  <td><?php if($_GET['randomid']==$iList['randomid']) { ?>
                                    <input type="submit" name="edit_scale" value="SAVE" class="btn btn-primary" style="color:white;">
                                    <?php } else { ?>
                                    <a href="<?php echo $FileName; ?>?action=grade&randomid=<?php echo $iList['randomid']; ?>" class="table-action-btn"> <i class="fa fa-pencil"></i> </a>
                                    <?php } ?></td>
                                  <td><a href="javascript:del('<?php echo $FileName; ?>?action=delete_scale&randomid=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> <i class="fa fa-times"></i> </a></td>
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
</body>
</html>
