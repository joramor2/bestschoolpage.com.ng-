<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Input Score ";
$FileName = 'input_score_class_teacher.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}

$aryList=$db->getRow("select   * from school_class where randomid='".$_GET['randomid']."' and create_by_userid='".$create_by_userid."'");
$subjectid=$db->getRow("select * from school_subject where randomid='".$_GET['subject']."' and create_by_userid='".$create_by_userid."'");
$sessionId=$db->getRow("select * from  school_session where id='".$_GET['session']."' and create_by_userid='".$create_by_userid."'");
$term_id=$db->getRow("select   * from  school_term where id='".$_GET['term_id']."' and create_by_userid='".$create_by_userid."'");
$assesmentId=$db->getRow("select * from school_assessment where id='".$_GET['assesment']."' and create_by_userid='".$create_by_userid."'");

if(isset($_POST['add_score']))  
{   
	$validate->addRule($sessionId['id'],'','session',true);
	$validate->addRule($term_id['id'],'','Term',true);
	$validate->addRule($assesmentId['id'],'','Assesment',true);
    $validate->addRule($subjectid['id'],'','Subject',true);
	
	
	if($validate->validate() && count($stat)==0)
	{
		foreach($_POST['student_id'] as $key=>$val)
		{
			if($_POST['inpgradescore']=='1')
				{
					$iScore 		= $_POST['score'][$key];
					$iScoreGrade 	= '';
				}
			else {
					$iScore = 0;
					$iScoreGrade 	= $_POST['score_grade'][$key];
			}
			
			$randomId=randomFix(15);
			$randomIdNew=randomFix(15);			
			$aryData = array(
							'session_id'					=>	$sessionId['id'],
							'term_id'		     			=>	$term_id['id'],
							'class_id'						=>	$aryList['id'],
							'subject_id'					=>	$subjectid['id'],
							'assesment_id'					=>	$assesmentId['id'],
							
							'offering'				    	=>	0,
							'student_id'					=>	$_POST['student_id'][$key],
 							'inpgradescore'					=>	$_POST['inpgradescore'],
							
							'score'							=>	$iScore,
							'score_grade'					=>	$iScoreGrade,
							
							
							'usertype'     	 	         	=>	$_SESSION['usertype'],
							'userid'						=>	$_SESSION['userid'],
							'create_by_usertype'			=>	$create_by_usertype,
							'create_by_userid'				=>	$create_by_userid,
							'randomid'						=>	$randomId,   
							);
			$flgIn1 = $db->delete("input_score_class_teacher", "where student_id='".$_POST['student_id'][$key]."' and class_id='".$aryList['id']."' and subject_id='".$subjectid['id']."' and assesment_id='".$assesmentId['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."'");
	        $flgIn2 = $db->insertAry("input_score_class_teacher", $aryData);				
			
			$iGetVal=$db->getVal("select id from result_total where session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");			
			$iSum=$db->getVal("select sum(score) from result_total where session_id='".$sessionId['id']."'  and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");
			
			if($iGetVal=='')
			{
				$aryData = array(
								'session_id'					=>	$sessionId['id'],
								'term_id'				    	=>	$term_id['id'],
								'class_id'						=>	$aryList['id'],
								'student_id'					=>	$_POST['student_id'][$key],
								'total'							=>	$iSum,
								'usertype'     	 	         	=>	$_SESSION['usertype'],
								'userid'						=>	$_SESSION['userid'],
								'create_by_usertype'			=>	$create_by_usertype,
								'create_by_userid'				=>	$create_by_userid,
								'randomid'						=>	$randomIdNew,   
								);
			        $flgIn2 = $db->insertAry("result_total", $aryData);
			}
			else 
			{
				$aryData = array(
								'total'				=>	$iSum,
								);
					$flgIn2 = $db->updateAry("result_total", $aryData,"where session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");
			}
		}
		$_SESSION['success'] = " Score Submitted Successfully";

	}
	else    
	{
		$stat['error'] = $validate->errors();
	}
	//redirect($FileName.'?action=input_score&randomid='.$_GET['randomid'].'&subject='.$_GET['subject'].'&new_randomid='.$_GET['randomid'].'&assesment='.$_GET['assesment']);
	//redirect($FileName.'?action=input_score&randomid='.$_GET['randomid'].'&subject='.$_GET['subject'].'&new_randomid='.$_GET['randomid'].'&assesment='.$_GET['assesment']);

}
if(isset($_POST['edit_score']))  
{  
	
	$flgIn1 = $db->delete("input_score_class_teacher", "where class_id='".$aryList['id']."' and subject_id='".$subjectid['id']."' and assesment_id='".$assesmentId['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."'");
	
// 	$msg = '-- ';
// 	$iii = 0;
	foreach($_POST['student_id'] as $key=>$val)
	{
		$randomId=randomFix(15);
		$randomIdNew=randomFix(15);
		
		
			if($_POST['inpgradescore']=='1')
				{
					$iScore 		= $_POST['score'][$key];
					$iScoreGrade 	= '';
					//$msg .= '<br> student_id = '.$_POST['student_id'][$key].' score = '.$iScore;
				}
			else {
					$iScore = 0;
					$iScoreGrade 	= $_POST['score_grade'][$key];
			}
		
		
		
		$aryData = array(
						'session_id'					=>	$sessionId['id'],
						'term_id'				    	=>	$term_id['id'],
						'class_id	'					=>	$aryList['id'],
						'subject_id'					=>	$subjectid['id'],
						'student_id'					=>	$_POST['student_id'][$key],
						'assesment_id'					=>	$assesmentId['id'],
						'inpgradescore'					=>	$_POST['inpgradescore'],
						'score'							=>	$iScore,
						'score_grade'					=>	$iScoreGrade,

						'usertype'     	 	         	=>	$_SESSION['usertype'],
						'userid'						=>	$_SESSION['userid'],
						'create_by_usertype'			=>	$create_by_usertype,
						'create_by_userid'				=>	$create_by_userid,
						'randomid'						=>	$randomId,
						);
			$flgIn1 = $db->delete("input_score_class_teacher", "where student_id='".$_POST['student_id'][$key]."' and class_id='".$aryList['id']."' and subject_id='".$subjectid['id']."' and assesment_id='".$assesmentId['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."'");
	        $flgIn2 = $db->insertAry("input_score_class_teacher", $aryData);
// 			if($iii == 0){
// 			    $msg = "check student_id='".$_POST['student_id'][$key]."' and class_id='".$aryList['id']."' and subject_id='".$subjectid['id']."' and assesment_id='".$assesmentId['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."'";
// 			}
// 			$iii = $iii + 1;
			$iGetVal=$db->getVal("select id from result_total where session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");
			
			$iSum=$db->getVal("select sum(score) from result_total where session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");
			
			if($iGetVal=='')
			{
				$aryData = array(
								'session_id'					=>	$sessionId['id'],
								'term_id'				    	=>	$term_id['id'],
								'class_id'						=>	$aryList['id'],
								'student_id'					=>	$_POST['student_id'][$key],
								'total'							=>	$iSum,
								'usertype'     	 	         	=>	$_SESSION['usertype'],
								'userid'						=>	$_SESSION['userid'],
								'create_by_usertype'			=>	$create_by_usertype,
								'create_by_userid'				=>	$create_by_userid,
								'randomid'						=>	$randomIdNew,   
								);
					$flgIn2 = $db->insertAry("result_total", $aryData);
			}
			else 
			{
				$aryData = array(
								'total'				=>	$iSum,
								);
					$flgIn2 = $db->updateAry("result_total", $aryData,"where session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' and class_id='".$aryList['id']."' and student_id='".$_POST['student_id'][$key]."'");
			}
	}
	$_SESSION['success'] = " Score Updated Successfully";
	//redirect($FileName.'?action=input_score&randomid='.$_GET['randomid'].'&subject='.$_GET['subject'].'&new_randomid='.$_GET['randomid'].'&assesment='.$_GET['assesment'].'&class_id='.$aryList['id']);
}


	
?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif" />
<style>
body, label, span, a, .gwt-Button {
	font-family: 'Droid Serif' !important; 
}
.ddshgcfh 
{
	position: absolute;
    right: 170px;
    top: 77px;
    font-size: 50px;
}
.sectionza input[type=submit] {
    background: #1B3058;
    color: white;
    border: none;
}
.sectionza label {
	font-size: 17px;
    font-weight: 600;
}
.sectionza input,.sectionza select {
    color: inherit;
    font: inherit;
    margin: 0;
    width: 100px;
    margin-left: 10px;
	margin-top: 5px;
    height: 30px;
}

.page-title {
	font-size: 20px;
	margin-bottom: 0;
	margin-top: 7px;
	text-align: center;
	background: white;
	padding: 23px 0 30px 0px;
	border-bottom: 5px solid gainsboro;
}

.zasw {
	border: 1px solid gainsboro;
	height: 1000px;
	margin-top: 18px;
}

.zasw1 {
	height: auto;
	margin-top: 18px;
}

.sectionza {
	background: white;
	height: 1000px;
}


.top-serche input {
	padding: 5px 49px 5px 14px;
	border: 2px solid gainsboro;
	border-radius: 4px;
	position: relative;
}

.top-serche {
	padding: 32px 0 9px 30px;
}

.content-page>.content {
	margin-bottom: 60px;
	margin-top: 60px;
	padding: 20px 30px 15px 78px;
	background: white;
}

.zswqas ul {
	list-style: none;
}

.zswqas li a span i {
	font-size: 29px;
	padding-top: 9px;
}

.zswqas li a span {
	padding-right: 16px;
}

.zswqas li a {
	width: 239px;
	display: block;
	padding: 16px 14px 14px 18px;
	border-bottom: 2px solid gainsboro;
}

.topside-section ul {
	display: inline-flex;
	list-style: none;
}

.topside-section li {
	padding: 0 11px 0 0;
}

.topside-section {
	padding-top: 8px;
	border: 1px solid gainsboro;
	box-shadow: 1px 6px 4px gainsboro;
	padding: 14px 8px 11px 1px;
}

.zqw22 .panel-success>.panel-heading {
background: white;
}

.zqw22 .nav.nav-tabs>li>a:hover, .nav.tabs-vertical>li>a:hover {
    color:black!important;
	 font-weight: 700;
 
}


.zqw22 .nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
  
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    font-size: 10px;
    height: 38px;
    margin-top: 0;
}

div.dataTables_filter label {
    font-weight: 400;
    white-space: nowrap;
    text-align: left;
    border: 1px solid gainsboro;
    padding: 4px 13px 4px 0px;
    border-radius: 5px;
    color: black;
}


#example .active {
    background: #1B3058;
    color: white;
}
.zqw22 .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .tabs-vertical>li.active>a, .tabs-vertical>li.active>a:focus, .tabs-vertical>li.active>a:hover {
    color: black!important;
    font-weight: 700;
	    line-height: 38px;

    background: gainsboro;

}

.zqw22 .panel-success>.panel-heading {
    background: white;
    padding: 0;
} 
.zqw22 .panel .panel-body {
    border-right: none!important;
    border: 1px solid gainsboro;
}
.gwt-Label {
    padding: 8px;
}
.zqw22  input {
    padding: 8px 3px 10px 0;
    border: 1px solid gainsboro;
    background: #dcdcdc45;
    border-radius: 5px;
    margin-right: 8px;
	    margin-bottom: 5px;
}
.zqw22 button {
    border: 1px solid #1B3058;
    padding: 4px 3px 4px 3px;
    margin-right: 7px;
    background: transparent;
    color: #1B3058;
}
.zqw22 select {
    padding: 5px 0 8px 0;
    background: #dcdcdc2e;
}
.zqw22 .nav-tabs>li {
  
    padding: 0 4px 0 0;
}
#tab3success ,#tab4success .middleCenterInner{
    border: 1px solid gainsboro;
    padding: 17px 11px 51px 19px;
}
#tab3success  .middleCenterInner{
    border: 1px solid gainsboro;
    padding: 17px 11px 51px 19px;
}
#tab3success ,#tab4success .BFOGCKB-c-h{
    border-bottom: 3px solid;
    width: 300px;
}
#tab3success  .BFOGCKB-c-h{
    border-bottom: 3px solid;
    width: 300px;
}
#tab3success ,#tab4success  {
    border: 1px solid gainsboro;
    padding: 14px 4px 42px 11px;
    width: 361px;
}
#tab3success ,#tab4success .gwt-DecoratorPanel {
   
    padding: 21px 21px 43px 4px;
}
#tab3success .gwt-DecoratorPanel {
  
    padding: 21px 21px 43px 4px;
}
.zqw22 .panel .panel-body {

    border-bottom: 3px solid gainsboro!important;
}
.zqw22 .nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
    
    background: #dcdcdc4f!important;
}
.zqw22 .nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
    color: black!important;
    font-weight: 700;
	    line-height: 38px;

    background: gainsboro;
   
}
.xza{margin: 0;
    width: 294px;
    border-bottom: 1px solid;

}
.dataTables_paginate a {
    background-color: transparent;
    margin: 0 0px 0;
    padding: 8px 15px 9px;
    color: white;
    cursor: pointer;
    border: none;
}
.zqw22 .nav-tabs>li.active, .nav-tabs>li.active:focus, .nav-tabs>li.active:hover, .tabs-vertical>li.active, .tabs-vertical>li.active:focus, .tabs-vertical>li.active:hover {
    color: black!important;
    font-weight: 700;
	
   
}
.zswqas .activate a {
    width: 239px;
    display: block;
    padding: 16px 14px 14px 18px;
    border-bottom: 2px solid gainsboro;
    background: #1B3058;
    color: white;
}
.zqw22 .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .tabs-vertical>li.active>a, .tabs-vertical>li.active>a:focus, .tabs-vertical>li.active>a:hover {
      border-bottom: 3px solid #1B3058;
}
.topside-section li a {
	border: 1px solid #1B3058;
	padding: 5px 5px 4px 5px;
	display: block;
}

.zswqas li a:hover {
	width: 239px;
	display: block;
	padding: 16px 14px 14px 18px;
	border-bottom: 2px solid gainsboro;
	background: #1B3058;
	color: white;
}

.zswqas .active {
	width: 239px;
	display: block;
	padding: 16px 14px 14px 18px;
	border-bottom: 2px solid gainsboro;
	background: #1B3058;
	color: white;
}
.Wizard-a1 #example_length  {
  
	display:none;
}		
div.dataTables_filter label {
    font-weight: 400;
    white-space: nowrap;
    text-align: left;
    
}
div.dataTables_filter input {
    margin-left: .5em;
    display: inline-block;
    float: right;
    border: none;

}


div.dataTables_filter label {
    padding: 10px;
}
div.dataTables_filter input {
    margin-left: .5em;
    display: inline-block;
    float: right;
}
div.dataTables_filter {
    text-align: center;
}		
.Wizard-a1 .zwq img {
    width: 50px;
}			
.Wizard-a1 .zwq {
    padding-right: 8px;
	float:left;
}
.Wizard-a1 .setting {
    display: none;
}			
.Wizard-a1 .dataTables_info {
    margin: 0 auto !important;
    text-align: center;
    font-size: 12px;
    float: initial;
    position: absolute;
    bottom: 11px;
    left: 0;
    right: 0;
}			
#example {
    width: 85%!important;
    margin:0 auto;
}	

div.dataTables_filter input {
    width: 70%;
}	

div.dataTables_filter label {

    line-height: 23px;
}

.dataTables_paginate #example_previous:before {
	content: "";
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-right: 12px solid #555;
    border-bottom: 6px solid transparent;
    position: absolute;
    z-index: 999999;
    left: 15px;
    bottom: 3px;
}
.Wizard-a1 .dataTables_info {
    position: sticky!important;
}
div.dataTables_paginate {
    position: relative;
    top: -47px;
}
	.dataTables_paginate a {
    background-color: transparent;
    margin: 0 0px 0;
    padding: 8px 15px 9px;
    color: white;
    cursor: pointer;
    border: none;
      position: static;
}
.dataTables_paginate .next {
    background: none;
    border: navajowhite;
    position: relative;
    color: white!important;
    position: relative;
  
}
div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: center!important;
    padding-top: 27px;
}
.dataTables_paginate .disabled {
       background: none;
    color: white;
    border: none!important;
    padding: unset;
    display: block;
    width: 90%;
    color: transparent !important;
    margin: 0 auto;
}
div.dataTables_info {
    white-space: nowrap;
 padding-top: 0px;
}
.dataTables_paginate #example_next:before {
    content: "";
    width: 0;
    height: 0;
    border-top: 6px solid transparent;
    border-left: 12px solid #555;
    border-bottom: 6px solid transparent;
    position: absolute;
    z-index: 999999;
    right: 0;
    bottom: 9px;
    top: 4px;
}

div.dataTables_paginate {
    margin: 0;
    white-space: nowrap;
    text-align: center!important;
}
 .paging_simple_numbers span{
    /* display: none; */
    opacity: 0;
}
	#example td {
    padding: 15px 11px 18px 13px;
    border-bottom: 3px solid;
    margin: 0 0 0;
}
#example .active:hover {
    background: #1B3058;
    color: white;
}
		.Wizard-a1	.sorting_1 {
    display: none;
}	
.dataTables_filter label:before {
    position: absolute;
    /* left: 0; */
    right: 46px;
    top: 62px!important;
    /* bottom: 0; */
    border: 1px solid #1B3058;
}
.dataTables_filter:before{
	content:'';
	position:absolute;
}
      
div.dataTables_filter label {
	position: relative;
    width: 85%;
    text-align: left;
}
	  
div.dataTables_filter {
    margin-top: 20px;
}

.sectsab li {
	
	list-style:none;
}


div.dataTables_paginate {
  

    margin: 0 auto;
}

.btnselected {
	color: white;
	background: #1b3058;
}
.btn.focus, .btn:focus, .btn:hover {
		color: #fff;
		text-decoration: none;
}
.txtgrade {text-transform:capitalize; }
</style>
<script>
 function inputscoregrade(gid)
	{
		
		document.getElementById("inpgradescore").value=gid;
		if(gid==1)
			{
				document.getElementById("scrgrd_1").classList.add("btnselected");
				document.getElementById("scrgrd_2").classList.remove("btnselected");
				$('.txtscore').attr('required', true);
				$('.txtgrade').attr('required', false);
				
				
				$('.txtscore').css('display','block');
				$('.txtgrade').css('display','none');
			
			
			}
		else {
				document.getElementById("scrgrd_2").classList.add("btnselected");
				document.getElementById("scrgrd_1").classList.remove("btnselected");
				$('.txtscore').attr('required', false);
				$('.txtgrade').attr('required', true);
				
				$('.txtscore').css('display','none');
				$('.txtgrade').css('display','block');
			}
			
			
	}
</script>
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
            <h4 class="page-title"><?php echo $PageTitle; ?></h4>
          </div>
        </div>
        <span> <?php echo msg($stat) ?></span>
        <div class="row">
          <div class="sectionza" style="overflow:scroll;">
            <div class="col-md-12  col-xm-12">
              <div class="col-md-4  col-xm-12">
                <div class="zasw ">
                  <div class="zawq Wizard-a1">
                    <table id="example" class="display" >
                      <thead class="setting">
                        <tr>
                          <th>Position</th>
                          <th>Position</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
							if($_SESSION['usertype']=='1')
							{
									$iSchoolRegisterStaffid=$db->getVal("select username from school_register where id='".$_SESSION['userid']."' order by id desc");
									$iStaffManageId=$db->getVal("select id from staff_manage where staff_id ='".$iSchoolRegisterStaffid."'");	
									$iConCatScholCls = $db->getVal("select GROUP_CONCAT(school_class) from class_teacher where staff_id='".$iStaffManageId."'");
									$aryDetail = $db->getRows("select * from school_class where create_by_userid='".$create_by_userid."' and id IN ($iConCatScholCls)");
							}
						else {
									$aryDetail = $db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
							} 
							foreach($aryDetail as $iList) 
							{
							?>
                        <tr>
                          <td style="padding:0px;"></td>
                          <td class="sectsab <?php if($_GET['randomid']==$iList['randomid']) { echo "active"; }?>"><a href="<?php echo $FileName; ?>?action=input_score&randomid=<?php echo $iList['randomid']?>">
                            <ul>
                              <li> <span class="zwq"> <img class="table-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbRnETjp3LR55_QTrkge0ZW1VZwhnBGrZuDDM4DSh6dQSMFG21"></span> <?php echo $iList['name'];?><br>
                                <?php echo $db->getVal("select session from school_session where id='".$iList['session_id']."'");?><br>
                              </li>
                            </ul>
                            </a></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                      <thead>
                        <tr class="setting">
                          <th>Name</th>
                          <th>Position</th>
                        </tr>
                      </thead>
                        </tfoot>
                      
                    </table>
                  </div>
                </div>
              </div>
               <div class="col-md-8 col-xm-12">
              <form method="GET" action="" required>
                <select name="session" id="session"  required>
                  <option value=""> Session</option>
                  <?php $aryDetail=$db->getRows("select * from  school_session  where create_by_userid='".$create_by_userid."'");

					foreach($aryDetail as $iList)
					{	$i=$i+1;?>
                  <option value="<?php echo $iList['id']; ?>" <?php  if($_GET['session']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['session']; ?></option>
                  <?php }?>
                </select>
                <select name="term_id" id="term_id" required>
                  <option value=""> Term</option>
                  <?php $aryDetail=$db->getRows("select * from  school_term where create_by_userid='".$create_by_userid."'");
					foreach($aryDetail as $iList)
					{	$i=$i+1;?>
                  <option value="<?php echo $iList['id']; ?>" <?php  if($_GET['term_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['term']; ?></option>
                  <?php }?>
                </select>
                <input type="hidden" value="<?php  echo $_GET['randomid']; ?>" name="randomid">
                <input type="hidden" value="<?php  echo $_GET['action']; ?>" name="action">
                <select name="assesment" required>
                  <option value=""> Assesment</option>
                  <?php $assesment=$db->getRows("select * from  school_assessment where create_by_userid='".$create_by_userid."' and class_id='".$aryList['id']."'  "); 
					foreach($assesment as $iList) { ?>
                  <option value="<?php echo $iList['id']; ?>"<?php if($iList['id']==$_GET['assesment']) { echo "selected"; } ?> ><?php echo $iList['assesment']; ?></option>
                  <?php } ?>
                </select>
                <select name="subject" required>
                  <option value=""> Subject </option>
                  <?php  
				  
				  
				  
				 /* if($_SESSION['usertype']=='1')
							{
									$iSchoolRegisterStaffid=$db->getVal("select username from school_register where id='".$_SESSION['userid']."' order by id desc");
									$iStaffManageId=$db->getVal("select id from staff_manage where staff_id ='".$iSchoolRegisterStaffid."'");	
									$iConCatScholCls = $db->getVal("select GROUP_CONCAT(school_subject) from subject_teacher where staff_id='".$iStaffManageId."'");
								 
									
									$subjectdetail=$db->getRows("select * from school_subject where class_id='".$aryList['id']."' and create_by_userid='".$create_by_userid."'  and id IN ($iConCatScholCls)");
							}
						else {
									$subjectdetail=$db->getRows("select * from school_subject where class_id='".$aryList['id']."' and create_by_userid='".$create_by_userid."'");
							}*/
				  
				  $subjectdetail=$db->getRows("select * from school_subject where class_id='".$aryList['id']."' and create_by_userid='".$create_by_userid."'");

					foreach ($subjectdetail as $Ilist) { 
					?>
                  <option value="<?php echo $Ilist['randomid']; ?>" <?php if($Ilist['randomid']==$_GET['subject']) { echo "selected"; } ?> > <?php echo $Ilist['subject']; ?> </option>
                  <?php } ?>
                </select>
                <input type="submit" value="Click Here" name="" />
              </form>
              <?php 
			$scoreentry=$db->getRow("select * from score_entry_time_frame where session='".$_GET['session']."' and term_id='".$_GET['term_id']."' and class='".$aryList['id']."' and assesment_id='".$_GET['assesment']."' "); 
			if($scoreentry['end_date'] <date("Y-m-d"))
			{ 
				echo "<span class='ddshgcfh' style='color:red;'> Score Entry Closed</span>";
			}
			else 
			{
				echo "<span style='color:green;'>Score Entry Open From(".$scoreentry['start_date'].")To(".$scoreentry['end_date'].")</span>";
			
			?>
              <?php 
			$subjectassesment=$db->getRow("select * from input_score_class_teacher where subject_id='".$subjectid['id']."' and assesment_id='".$assesmentId['id']."' and create_by_userid='".$create_by_userid."'"); 
			?>
              <?php if($_GET['action']=='input_score') { 
   $assesment=$db->getRow("select * from school_assessment where id='".$_GET['assesment']."' and create_by_userid='".$create_by_userid."'"); 
  $iPercentage=$db->getVal("select percentage from score_entry_time_frame where assesment_id='".$assesment['id']."'");
  $scoredetail=$db->getRow("select * from input_score_class_teacher where assesment_id='".$assesmentId['id']."' and subject_id='".$subjectid['id']."' and create_by_userid='".$create_by_userid."' and class_id='".$aryList['id']."' order by id desc");

			if($scoredetail['id']=='') { ?>    
                <div class="zasw1" style="width:100%; float:left;">
                  <table width="200" style="float:right;">
                  <tr>
                  <td><button onClick="inputscoregrade('1')" type="button" id="scrgrd_1"  class="btn btnselected"  style="border: 1px solid #00000033;">Input Score</button></td>
                  <td><button onClick="inputscoregrade('2')" type="button" id="scrgrd_2" class="btn " style="border: 1px solid #00000033;" >Input Grade</button></td>
                  </tr>
                  </table>
                  </div>
                   <div class="zasw1">
                  <div class="card-box table-responsive tablthisresponsive">
                    <table  class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Student id</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th><?php echo $assesment['assesment'].'('.$iPercentage.')'; ?></th>
                        </tr>
                      </thead>

                        <form method="post" action="">
                         <input type="hidden" id="inpgradescore" name="inpgradescore" value="1" >
                      <tbody>
                          
                   <?php $i=0;					
$aryList11=$db->getRows("select * from manage_student  where class='".$aryList['id']."' and session='".$_GET['session']."' and term_id='".$_GET['term_id']."' and create_by_userid='".$create_by_userid."'");
				 foreach($aryList11 as $iList)
						{ ?>
                        <tr>
                          <td><?php echo $iList['student_id']; ?>
                            <input type="hidden" name="student_id[]" value="<?php echo $iList['id']; ?>"></td>
                          <td><?php echo $iList['first_name']; ?></td>
                          <td><?php echo $iList['last_name']; ?></td>
                          <td><input type="number" class="form-control txtscore" value="<?php echo $_POST['score']; ?>" name="score[]" max="<?php echo $svevalue = trim($iPercentage,'%'); ?>" min="0"  step="any" required placeholder="Score">
                              <input type="text" class="form-control txtgrade" value="<?php echo $_POST['score_grade']; ?>" name="score_grade[]"   placeholder="Grade" style="display:none;">
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    <input type="submit" name="add_score" value="SAVE" class="btn btn-primary"  style="color:white;">
                    </form>
                    </table>
                    <?php } else { 
$scoredetail=$db->getRow("select * from input_score_class_teacher where assesment_id='".$assesmentId['id']."' and subject_id='".$subjectid['id']."' and create_by_userid='".$create_by_userid."' and class_id='".$aryList['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."' order by id desc ");
$assesment=$db->getRow("select * from input_score_class_teacher  where assesment_id	='".$assesmentId['id']."' and create_by_userid='".$create_by_userid."'"); 
					?>
            <div class="zasw1" style="width:100%; float:left;">
                  <table width="200" style="float:right;">
                  <tr>
                  <td><button onClick="inputscoregrade('1')" type="button" id="scrgrd_1"  class="btn <?php if($scoredetail['inpgradescore']==1) { echo 'btnselected'; } ?>"  style="border: 1px solid #00000033;">Input Score</button></td>
                  <td><button onClick="inputscoregrade('2')" type="button" id="scrgrd_2"  class="btn <?php if($scoredetail['inpgradescore']==2) { echo 'btnselected'; } ?>" style="border: 1px solid #00000033;" >Input Grade</button></td>
                  </tr>
                  </table>
                 
                  </div>
                   <div class="zasw1">
                  <div class="card-box table-responsive tablthisresponsive">
                   <form method="post" action="">    
                    <table  class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Student id</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th><?php echo $assesment['assesment'].'('.$iPercentage.')'; ?></th>
                        </tr>
                      </thead>
                     <input type="hidden" id="inpgradescore" name="inpgradescore" value="<?php echo $scoredetail['inpgradescore']; ?>" >
                      <tbody>
                        <?php $i=0;
					$aryList11=$db->getRows("select * from manage_student  where class='".$aryList['id']."' and session='".$_GET['session']."' and term_id='".$_GET['term_id']."' and create_by_userid='".$create_by_userid."'");

					foreach($aryList11 as $iList)

					{
					$scoredetaill=$db->getRow("select * from input_score_class_teacher where assesment_id='".$assesmentId['id']."' and subject_id='".$subjectid['id']."' and create_by_userid='".$create_by_userid."' and class_id='".$aryList['id']."' and student_id='".$iList['id']."' and session_id='".$sessionId['id']."' and term_id='".$term_id['id']."'");
					?>
                        <tr>
                          <td><?php echo $iList['student_id']; ?>
                            <input type="hidden" name="student_id[]" value="<?php echo $iList['id']; ?>"></td>
                          <td><?php echo $iList['first_name']; ?></td>
                          <td><?php echo $iList['last_name']; ?></td>
                          <td>
<input type="number" class="form-control txtscore" value="<?php echo $scoredetaill['score']; ?>" name="score[]" max="<?php echo $upvalue = trim($iPercentage,'%'); ?>" min="0"  step="any"  <?php if($scoredetail['inpgradescore']==2) { echo 'style="display:none;"'; }  else { echo 'required'; } ?> >
<input type="text" class="form-control txtgrade" value="<?php echo $scoredetaill['score_grade']; ?>" name="score_grade[]"   placeholder="Grade" <?php if($scoredetail['inpgradescore']==1) { echo 'style="display:none;"'; } else { echo 'required'; }  ?>></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                      </table>
                      <input type="submit" name="edit_score" value="UPDATE" class="btn btn-primary"  style="color:white;">
                    </form>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('inc.footer.php'); ?>
  </div>
  </div>
  <?php }
	?>
  <?php include('inc.js.php'); ?>
  <script>
		(function() {
		$(function() {
		var toggle;
		return toggle = new Toggle('.zswqas');
		});

		this.Toggle = (function() {
		class Toggle {
		constructor(toggleClass) {
		this.el = $(toggleClass);
		this.tabs = this.el.find(".xz");
		this.panels = this.el.find(".panel");
		this.bind();
		}

		show(index) {
		var activePanel, activeTab;
		//update tabs
		this.tabs.removeClass('activate');
		activeTab = this.tabs.get(index);
		$(activeTab).addClass('activate');
		//update panels
		this.panels.hide();
		activePanel = this.panels.get(index);
		return $(activePanel).show();
		}

		bind() {
		return this.tabs.unbind('click').bind('click', (e) => {
		return this.show($(e.currentTarget).index());
		});
		}

		};

		Toggle.prototype.el = null;

		Toggle.prototype.tabs = null;

		Toggle.prototype.panels = null;

		return Toggle;

		}).call(this);

		}).call(this);
		</script> 
  <script>
		// Add active class to the current button (highlight it)
		var header = document.getElementById("example");
		var btns = header.getElementsByClassName("sectsab");
		for (var i = 0; i < btns.length; i++) {
		btns[i].addEventListener("click", function() {
		var current = document.getElementsByClassName("active");
		current[0].className = current[0].className.replace(" active", "");
		this.className += " active";
		});
		}
		</script> 
  <script>		

		$(document).ready(function() {
		$('#example').DataTable();
		} );
		</script> 
  <script>
$('#example').dataTable( {
    "pageLength": 5
});
</script>
</body>
</html>