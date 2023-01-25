<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="SUBJECT SPECIFIC COMMENT";
$FileName = 'subject_specific_comment.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
$classDetail=$db->getRow("select * from school_subject where randomid='".$_GET['randomid']."'  and create_by_userid='".$create_by_userid."'");
$sessionDetail=$db->getRow("select * from school_session where id='".$_GET['session']."'  and create_by_userid='".$create_by_userid."'");
$term_id=$db->getRow("select * from school_term where id='".$_GET['term_id']."'  and create_by_userid='".$create_by_userid."'");



if(isset($_POST['add_subject_specific_comment']))
{       
				
				$studetdetail=$db->getRow("select * from manage_student where class='".$classDetail['class_id']."'  and create_by_userid='".$create_by_userid."'");				
			    if($validate->validate() && count($stat)==0)
				{			  
				  	  
				$randomId=randomFix(15);
				$aryData=array(	
				'session_id'                                        => $sessionDetail['id'],
				'term_id'                                           => $term_id['id'],
				'class_id'                                          => $classDetail['class_id'],
				'subject_id'                                        => $_POST['subject_id'],
				'student_id'                                        => $_POST['student_id'],
				'learning_strengths'  			                    => $_POST['learning_strengths'],
				'learning_targets'                                  => $_POST['learning_targets'],	
				 'subject_specific_strengths'                       => $_POST['subject_specific_strengths'],
				'subject_specific_target'                           => $_POST['subject_specific_target'], 
			    'attendance'                                        => $_POST['attendance'],
				'punctuality'                                       =>  $_POST['punctuality'],
				'behaviour'                                         => $_POST['behaviour'],
				'effort'  			                                => $_POST['effort'],		
				'academic_progress'  			                    => $_POST['academic_progress'],	
				'curriculum_achievement'  			                => $_POST['curriculum_achievement'],	   
				'userid'  			                                =>  $_SESSION['userid'],	
				'usertype'                                          => $_SESSION['usertype'],
				'create_by_userid'  			                    => $create_by_userid,	
				'create_by_usertype'  			                    => $create_by_usertype,
                'randomid'  			                            => $_GET['randomid'],				
				 );  
					$flgIn1 = $db->insertAry("subject_specific_comments",$aryData);
					//echo $flgIn1 = $db->getLastQuery();
					//exit;
					
					//redirect($FileName.'?action=subject_specific_comment&randomid='.$_GET['randomid']);
                    $_SESSION['success']="Submited Successfully";					
					//unset($_POST);
				}


		else    
		        {
					$stat['error'] = $validate->errors();
				}
			}
			
			
			if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}


elseif(isset($_POST['edit_subject_specific_comment']))
{        
				
					 $studetdetail=$db->getRow("select * from manage_student where class='".$classDetail['class_id']."'  and create_by_userid='".$create_by_userid."'");				
			    if($validate->validate() && count($stat)==0)
				  {
					  
				  	  
				$randomId=randomFix(15);
					$aryData=array(	
				'session_id'                                        => $sessionDetail['id'],
				'term_id'                                           => $term_id['id'],
				'class_id'                                          => $classDetail['class_id'],
				'subject_id'                                        => $_POST['subject_id'],
				'learning_strengths'  			                    => $_POST['learning_strengths'],
				'learning_targets'                                  => $_POST['learning_targets'],	
				 'subject_specific_strengths'                       => $_POST['subject_specific_strengths'],
				'subject_specific_target'                           => $_POST['subject_specific_target'], 
			    'attendance'                                        => $_POST['attendance'],
				'punctuality'                                       =>  $_POST['punctuality'],
				'behaviour'                                         => $_POST['behaviour'],
				'effort'  			                                => $_POST['effort'],		
				'academic_progress'  			                    => $_POST['academic_progress'],	
				'curriculum_achievement'  			                => $_POST['curriculum_achievement'],	   
				'userid'  			                                =>  $_SESSION['userid'],	
				'usertype'                                          => $_SESSION['usertype'],
				'create_by_userid'  			                    => $create_by_userid,	
				'create_by_usertype'  			                    => $create_by_usertype,
                'randomid'  			                            => $_GET['randomid'],				
					 
				
					            );  
					$flgIn1 = $db->updateAry("subject_specific_comments",$aryData,"where student_id='".$_POST['student_id']."' and session_id='".$sessionDetail['id']."' and term_id='".$term_id['id']."'  and class_id='".$classDetail['class_id']."'");
					//echo $flgIn1 = $db->getLastQuery();
					//exit;
					
					//redirect($FileName.'?action=subject_specific_comment&randomid='.$_GET['randomid']);
                    $_SESSION['success']="UPDATED Successfully";					
					//unset($_POST);
				}


		else    
		        {
					$stat['error'] = $validate->errors();
				}
			}
			
			
			if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
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

.sectsab  ul {
	
	padding:0px;
}

	#example td {
    padding: 10px 11px 10px 13px;
    border-bottom: 3px solid;
    margin: 0 0 0;
}

.Wizard-a1 .zwq {
    padding-right: 8px;
    float: left;
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
                    height: fit-content;
                    margin-top: 18px;
                }
                
                .zasw1 {
                    height: 1000px;
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
    width:66%;
}	

.wd-sec {

    overflow: hidden;
}

div.dataTables_filter label {

    line-height: 23px;
}

	.dataTables_paginate #example_previous:before{
	
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

.sectionza{
overflow: auto;	
}

.tokiyo h4{
	border-bottom: 2px solid gray;
    padding-bottom: 10px;
}
.sputb{

    padding: 15px;

}
.dowt{
    border: 1px solid #80808063;
	padding: 10px;

}


.tokiyo h4 {
    border-bottom: 2px solid gray;
    padding-bottom: 10px;
    font-size: 16px;
    font-weight: 600;
}

.honr h4{
background: #8d89897a;
    padding: 8px;
    text-align: center;
    color: #0a3360;
    font-size: 14px;
}
.onor h4{
background: #c5c1c169;
   padding: 19px;
    text-align: center;
    color: #0a3360;
    font-size: 14px;
}
.gwt-TextArea{width: 100%;
    height: 70px;
    border-radius: 3px;
	margin-top:4px;
}
.vitra{
	text-align: left;
    padding-top: 8px;
    padding-bottom: 12px;
    color: #0a3360;
    font-size: 12px;
}


.finacil{
	margin-top: 2px;
}

.xpect{
margin-top: 8px;
    font-size: 13px;
    color: #0a3360;
}
.premim{
overflow: auto;
    height: 798px;	
}
.intx{
background: #c5c1c169;
    padding: 4px;	
}
.gwt-ListBox {
    margin: 3px 0;
    padding: 6px 12px;
    font-size: 12px;
    line-height: 1.42857;
    color: #555555;
    vertical-align: middle;
    /* background-color: #fbfbfb; */
    background-image: none;
    border: 1px solid #ddd;
    border-radius: 3px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}


.wd-sec {
	    padding: 10px;
	width:100%;
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
<h4 class="page-title"><?php echo $PageTitle; ?></h4>

</div>
</div>
<!-- Basic Form Wizard -->
<?php echo msg($stat); ?>
<div class="stknd">
<div class="row">
<div class="sectionza">
<div class="cutyr">

<div class="col-md-3">
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
<?php $aryDetail=$db->getRows("select * from school_subject  where create_by_userid='".$create_by_userid."'"); 
 
foreach($aryDetail as $iList) {

   
	?>
<tr> 
	<td style="padding:0px;"></td>
	<td class="sectsab <?php if($_GET['randomid']==$iList['randomid']) { echo "active"; }?>">
	
	
	<a href="<?php echo $FileName; ?>?randomid=<?php echo $iList['randomid']?>">
	 <ul><li>
	<span class="zwq"> <img class="table-img" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTbRnETjp3LR55_QTrkge0ZW1VZwhnBGrZuDDM4DSh6dQSMFG21"></span><?php echo $iList['subject']; ?><br>
	<?php echo $db->getVal("select name from school_class where id='".$iList['class_id']."'");?><br>
<?php //echo $db->getVal("select session from school_session where id='".$_POST['session']."'");?>	</li>
	</ul>
	</a>
	
	
	</td>
   	</tr>
		
<?php } ?>			
</tbody>

<tfoot>
<tr class="setting">
<th>Name</th>
<th>Position</th>


</tr>
</tfoot>
</table>

</div>

</div>
</div>
<div class="col-md-8">
<div class="zasw1">
            <form method="GET" action="">
					<label>Session:</label> 
					<select name="session" id="session"  required>
					<option value="">Select Session</option>
					<?php $aryDetail=$db->getRows("select * from  school_session  where create_by_userid='".$create_by_userid."'");

					foreach($aryDetail as $iList)
					{	$i=$i+1;?>
					<option value="<?php echo $iList['id']; ?>" <?php  if($_GET['session']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['session']; ?></option>
					<?php }?>
					</select>
                   <label>Term:</label> 
					<select name="term_id" id="term_id" required>
					<option value="">Select Term</option>
					<?php $aryDetail=$db->getRows("select * from  school_term where create_by_userid='".$create_by_userid."'");
					foreach($aryDetail as $iList)
					{	$i=$i+1;?>
					<option value="<?php echo $iList['id']; ?>" <?php  if($_GET['term_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['term']; ?></option>
					<?php }?>
					</select>
					<input type="hidden" value="<?php echo $_GET['randomid']; ?>" name="randomid">
					<input type="hidden" value="<?php echo $_GET['action']; ?>" name="action">
					<input type="hidden" value="<?php echo $iList['randomid']; ?>" name="new_randomid">
					<input type="submit" value="Click here" name="" style="background-color: #1b3058;color: white;">
			</form>


<div class="card-box">
                         
                                <table  class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                       
                                        <th>Student id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Other Name</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
									 
                                    <tbody>
                                    <?php  
									  $aryDetailss=$db->getRows("select * from manage_student where class='".$classDetail['class_id']."' and session='".$sessionDetail['id']."'and term_id='".$term_id['id']."' and create_by_userid='".$create_by_userid."' "); 
									 							  
						   
						   foreach($aryDetailss as $iList) {
						   
						   ?>
                                        <tr>
                                      <td><?php echo $iList['student_id']; ?></td>
									    <td><?php echo $iList['first_name']; ?></td>
										  <td><?php echo $iList['last_name']; ?></td>
										    <td><?php echo $iList['other_name']; ?></td>
											<!-- <td><a href="<?php echo $FileName; ?>?randomid=<?php echo $_GET['randomid']?>&action=comment">comment </a></td>-->
											 <td>
											 <button type="button"  data-toggle="modal" data-target="#myModal<?php echo $iList['id']; ?>">comment</button>
											 </td>
                                        </tr>
<div id="myModal<?php echo $iList['id']; ?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div  class="wd-sec" style="background: white;">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<div class="sputb">
<div class="dowt">
<div class="row premim">	
<div class="col-md-12">	

<?php 
$subjecttt=$db->getRow("select * from school_subject  where randomid='".$_GET['randomid']."'");  
$commentDetail=$db->getRow("select * from subject_specific_comments where class_id='".$classDetail['class_id']."' and session_id='".$sessionDetail['id']."'and term_id='".$term_id['id']."'and student_id='".$iList['student_id']."'and subject_id='".$subjecttt['id']."' and create_by_userid='".$create_by_userid."' "); 
if($commentDetail['id']=="") { ?>
<form action="" method="post">
<div class="row">	
<div class="col-md-12 tokiyo">
<h4>Subject Specific Comments</h4>
</div>
</div>
<div class="row">	
<div class="col-md-4 honr">
<h4>Subject Comment Groups</h4>
</div>
<div class="col-md-8 onor">
<h4>Comments</h4>
</div>
</div>
<div class="row">	
<div class="col-md-4">
<h4 class="vitra ghfgh">Learning Strengths</h4>
</div>
<div class="col-md-8">
<textarea class="gwt-TextArea" name="learning_strengths" value="<?php echo $_POST['learning_strengths']; ?>" rows="5" ></textarea>
<!--<textarea class="gwt-TextArea" name="learning_strengths" value="<?php echo $_POST['learning_strengths']; ?>" rows="5" ></textarea>-->
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="vitra">Learning Targets</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<textarea class="gwt-TextArea" name="learning_targets" value="<?php echo $_POST['learning_targets']; ?>" rows="5" ></textarea>
<!--<textarea class="gwt-TextArea" name="learning_targets" value="<?php echo $_POST['learning_targets']; ?>" rows="5" ></textarea>-->
</div>
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<h4 class="vitra-a hjg">Subject Specific Strengths</h4>
</div>
<div class="col-md-8">
<textarea class="gwt-TextArea" name="subject_specific_strengths" value="<?php echo $_POST['subject_specific_strengths']; ?>" rows="5" ></textarea>
<!--<textarea class="gwt-TextArea"  name="subject_specific_strengths" value="<?php echo $_POST['subject_specific_strengths']; ?>"rows="5" ></textarea>--->
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="vitra">Subject Specific Target</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<textarea class="gwt-TextArea"  name="subject_specific_target" value="<?php echo $_POST['subject_specific_target']; ?>" rows="5" ></textarea>
<!--<textarea class="gwt-TextArea" name="subject_specific_target" value="<?php echo $_POST['subject_specific_target']; ?>"  rows="5" ></textarea>--->
</div>
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Attendance</h4>
</div>
<div class="col-md-8">
<div class="finacil" >
<select class="gwt-ListBox" name="attendance" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>


</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="xpect">Punctuality</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
<select class="gwt-ListBox" name="punctuality" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option></select>
</div>

</div>
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Behaviour</h4>
</div>
<div class="col-md-8">
<div class="finacil">
<select class="gwt-ListBox" name="behaviour" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>

</div>
</div>


<div class="row">	
<div class="col-md-4">
<div class="intx">
<h4 class="xpect">Effort</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
<select class="gwt-ListBox" name="effort">
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>

</div>
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Academic Progress</h4>
</div>
<div class="col-md-8">
<div class="finacil">
<select class="gwt-ListBox" name="academic_progress" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>

</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="xpect">Curriculum Achievement</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
<select class="gwt-ListBox" name="curriculum_achievement" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>

</div>
</div>
</div>
<input type="hidden" value="<?php echo $iList['student_id']; ?>" name="student_id">
<input type="hidden" value="<?php echo $subjecttt['id']; ?>" name="subject_id">
<input type="submit" class="form-control" value="ADD COMMENT" name="add_subject_specific_comment">
</form>

<?php } else  { 
$commentDetail=$db->getRow("select * from subject_specific_comments where randomid='".$_GET['randomid']."' and student_id='".$iList['student_id']."'");

$subjectt=$db->getRow("select * from school_subject  where randomid='".$_GET['randomid']."'"); 


?>

<form action="" method="post">
<div class="row">	
<div class="col-md-12 tokiyo">
<h4>Subject Specific Comments</h4>
</div>
</div>
<div class="row">	
<div class="col-md-4 honr">
<h4>Subject Comment Groups</h4>
</div>
<div class="col-md-8 onor">
<h4>Comments</h4>
</div>
</div>
<div class="row">	
<div class="col-md-4 ">
<h4 class="vitra">Learning Strengths</h4>
</div>
<div class="col-md-8">
<textarea class="gwt-TextArea" name="learning_strengths" value="" rows="5" ><?php echo $commentDetail['learning_strengths']; ?></textarea>
<!--<textarea class="gwt-TextArea" name="learning_strengths" value="" rows="5" ><?php echo $commentDetail['learning_strengths']; ?></textarea>-->
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="vitra">Learning Targets</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<textarea class="gwt-TextArea" name="learning_targets" value="" rows="5" ><?php echo $commentDetail['learning_targets']; ?></textarea>
<!--<textarea class="gwt-TextArea" name="learning_targets" value="" rows="5" ><?php echo $commentDetail['learning_targets']; ?></textarea>-->
</div>
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<h4 class="vitra">Subject Specific Strengths</h4>
</div>
<div class="col-md-8">
<textarea class="gwt-TextArea" name="subject_specific_strengths" value="" rows="5" ><?php echo $commentDetail['subject_specific_strengths']; ?></textarea>
<!--<textarea class="gwt-TextArea"  name="subject_specific_strengths" value=""rows="5" ><?php echo $commentDetail['subject_specific_strengths']; ?></textarea>--->
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="vitra">Subject Specific Target</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<textarea class="gwt-TextArea"  name="subject_specific_target" value="" rows="5" ><?php echo $commentDetail['subject_specific_target']; ?></textarea>
<!--<textarea class="gwt-TextArea" name="subject_specific_target" value=""  rows="5" ><?php echo $commentDetail['subject_specific_target']; ?></textarea>--->
</div>
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Attendance</h4>
</div>
<div class="col-md-8">
<div class="finacil" >
   <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>

<!--
<div class="finacil">
<select class="gwt-ListBox" name="attendance" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option></select>
</div>--->
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="xpect">Punctuality</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
  <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php  if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>

<!--
<div class="finacil">
<select class="gwt-ListBox" name="punctuality" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option></select>
</div>--->
</div>
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Behaviour</h4>
</div>
<div class="col-md-8">
<div class="finacil">
  <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php  if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php  if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>
<!--
<div class="finacil">
<select class="gwt-ListBox" name="behaviour" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>---->
</div>
</div>


<div class="row">	
<div class="col-md-4">
<div class="intx">
<h4 class="xpect">Effort</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
   <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php  if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php  if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>

<!--
<div class="finacil">
<select class="gwt-ListBox"name="effort" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>

--->
</div>
</div>
</div>

<div class="row">	
<div class="col-md-4 ">
<h4 class="xpect">Academic Progress</h4>
</div>
<div class="col-md-8">
<div class="finacil">
 <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php  if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php  if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>

<!--
<div class="finacil">
<select class="gwt-ListBox" name="academic_progress" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>-->
</div>
</div>


<div class="row">	
<div class="col-md-4 ">
<div class="intx">
<h4 class="xpect">Curriculum Achievement</h4>
</div>
</div>
<div class="col-md-8">
<div class="intx">
<div class="finacil">
 <select class="gwt-ListBox" name="attendance" >
<option value="Poor" <?php  if($commentDetail['attendance']=="Poor") { echo "selected"; } ?> >Poor</option>
<option value="Satisfactory" <?php  if($commentDetail['attendance']=="Satisfactory") { echo "selected"; } ?> >Satisfactory</option>
<option value="Excellent" <?php  if($commentDetail['attendance']=="Excellent") { echo "selected"; } ?> >Excellent</option>
</select>
</div>

<!--
<div class="finacil">
<select class="gwt-ListBox" name="curriculum_achievement" >
<option value="Poor">Poor</option>
<option value="Satisfactory">Satisfactory</option>
<option value="Excellent">Excellent</option>
</select>
</div>
--->
</div>
</div>
</div>

<input type="hidden" value="<?php echo $iList['student_id']; ?>" name="student_id">
<input type="hidden" value="<?php echo $subjectt['id']; ?>" name="subject_id">
<input type="submit" class="form-control" value="UPDATE COMMENT" name="edit_subject_specific_comment">
</form>
<?php } ?>
  </div>
</div>
		
</div>
</div>
</div>
</div>		
</div>
			<?php } ?>
                                    </tbody>
									 
                                </table>
						  
                            </div>

	

		</div>
		
		</div>
		</div>
		<?php include('inc.footer.php'); ?>
		</div>
		</div>
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

		</body>

		</html>