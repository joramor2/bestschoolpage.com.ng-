<?php
$iCurrentFileName = basename($_SERVER['PHP_SELF']); 
$currentfie = basename($_SERVER["SCRIPT_FILENAME"], '.php').".php"; 
if($_SESSION['usertype']!='0') 
{
	$iStaffCheck=$db->getRow("select * from assign_role where staff_id='".$_SESSION['userid']."' and create_by_userid='".$create_by_userid."'");

	if($currentfie!='home.php')
	{
	    $_currentfileName = $currentfie;
	    if($_currentfileName == 'class_teacher_roll_call_bulk.php')
	    $_currentfileName = 'class_teacher_roll_call.php';
	    
		$iFileRedirect=$db->getVal("select * from role_permission where role_id = '".$iStaffCheck['role_id']."' and file_name='".$_currentfileName."'");
		
		if($iFileRedirect=='') 
		{ 
			redirect('home.php');
		}
	}
	
	$iFileDetails=$db->getRows("select * from role_permission where role_id = '".$iStaffCheck['role_id']."' ");
	foreach($iFileDetails as $iFilesList)
	{
		$iSelectFile=$db->getVal("select file_name from school_filename where file_name = '".$iFilesList['file_name']."'");
		$ret[] = $iSelectFile;
	}
}
$skoolLogo=$db->getRow("select * from  school_register where id='".$create_by_userid."'");

$iPackageAllowFile=$db->getRow("select file_allow from  school_purchased_pacakage where userid='".$create_by_userid."' and status ='1' order by id desc");
//$iPackageAllowFile=$db->getRow("select file_allow from  school_purchased_pacakage where userid='".$create_by_userid."' and status ='1' and exp_date>'".date("Y-m-d")."' order by exp_date desc");
$iPackageJsoneDecodeAllowFile = json_decode($iPackageAllowFile['file_allow'], true);
?>

<div class="left side-menu" style="z-index: 9999999999999999999999999999999;">
<div class="sidebar-inner slimscrollleft">
<div class="user-details">
  <div class="pull-left raju"> <img src="../uploads/<?php echo $skoolLogo['logo']; ?>" style="height:50px;"> </div>
  <div class="user-info">
    <div class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo $skoolname['name']; ?> </a>
     
    <!-- <span class="caret"></span>
      <ul class="dropdown-menu">
        <li> <a href="<?php echo SKOOL_URL; ?>login_profile.php"><i class="md md-face-unlock"></i> Profile
          <div class="ripple-wrapper"></div>
          </a> </li>
        <li><a href="<?php echo SKOOL_URL; ?>settings.php"><i class="md md-settings"></i> Settings</a></li>
        <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
      </ul>-->
    </div>
  </div>
</div>
<div id="sidebar-menu">
<ul>
<?php  if(in_array('home.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li><a href="<?php echo SKOOL_URL; ?>home.php" class="waves-effect <?php if($iCurrentFileName=='home.php') { echo "active"; } ?>"><i class="fa fa-university" aria-hidden="true"></i><span> Home </span> </a></li>
<?php } ?>
<?php if(true) { ?>
<?php  if(in_array('dashboard.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li><a href="<?php echo SKOOL_URL; ?>dashboard.php" class="waves-effect <?php if($iCurrentFileName=='dashboard.php') { echo "active"; } ?>"><i class="fa fa-area-chart" aria-hidden="true"></i><span> Dashboard </span> </a></li>
<?php } ?>
<?php } ?>

<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES -------------------------------------------------------->

<?php if(true) { ?>
<?php if(in_array('princple_remark.php', $ret) || in_array('principal_sign_term.php', $ret)  || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Principal</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php if(in_array('princple_remark.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="princple_remark.php" class="waves-effect <?php if($iCurrentFileName=='princple_remark.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Principle Remarks</span> </a></li>
    <?php } ?>
    <?php if(in_array('principal_sign_term.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="principal_sign_term.php" class="waves-effect <?php if($iCurrentFileName=='principal_sign_term.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Principle Signature</span> </a></li>
    <?php } ?>
    <?php if(in_array('principal_set_termdate.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="principal_set_termdate.php" class="waves-effect <?php if($iCurrentFileName=='principal_set_termdate.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Set Next-Term Date</span> </a></li>
    <?php } ?>
  </ul>
</li>
<?php } ?>
<?php } ?>

<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES -------------------------------------------------------->

<?php if(in_array('login_profile.php', $ret) || in_array('configuration.php', $ret) || in_array('manage_role.php', $ret) || in_array('manage_user.php', $ret) || in_array('manage_class_teacher.php', $ret) ||in_array('manage_subject_teacher.php', $ret) || in_array('score_entry_time_frame.php', $ret) || in_array('update_parent_phone_emails.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect aactivee"><i class="fa fa-folder-open" aria-hidden="true"></i> <span> Admin </span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php  if(in_array('login_profile.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="login_profile.php" class="waves-effect <?php if($iCurrentFileName=='login_profile.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Profile</span> </a></li>
    <?php } ?>
    <?php if(in_array('configuration.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <!--<li class=""> <a href="configuration.php" class="waves-effect <?php if($iCurrentFileName=='configuration.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Configuration </span> </a></li>-->
    <?php } ?>
    <?php if(in_array('manage_traits_phycomotor.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_traits_phycomotor.php" class="waves-effect <?php if($iCurrentFileName=='manage_traits_phycomotor.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Traits Phycomotor </span> </a></li>
    <?php } ?>
    <?php if(in_array('manage_role.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_role.php" class="waves-effect <?php if($iCurrentFileName=='manage_role.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Role </span> </a></li>
    <?php } ?>
    <?php if(in_array('manage_user.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_user.php" class="waves-effect <?php if($iCurrentFileName=='manage_user.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage User</span> </a></li>
    <?php } ?>
    <?php if(in_array('manage_class_teacher.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_class_teacher.php" class="waves-effect <?php if($iCurrentFileName=='manage_class_teacher.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Class Teacher </span> </a></li>
    <?php } ?>
    <?php if(in_array('manage_subject_teacher.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_subject_teacher.php" class="waves-effect <?php if($iCurrentFileName=='manage_subject_teacher.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Subject Teacher </span> </a></li>
    <?php } ?>
    <?php if(in_array('score_entry_time_frame.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="score_entry_time_frame.php" class="waves-effect <?php if($iCurrentFileName=='score_entry_time_frame.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Score Entry Time Frame</span> </a></li>
    <?php } ?>
    
    <!---<li class=""> <a href="manageformteacher.php" class="waves-effect <?php if($iCurrentFileName=='manageformteacher.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Form Teacher </span> </a></li>
						
					    <li class=""> <a href="update_student_status.php" class="waves-effect <?php if($iCurrentFileName=='update_student_status.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Update Student Status </span> </a></li>----> 
    
    <!---<li class=""> <a href="view_generated_reports.php" class="waves-effect <?php if($iCurrentFileName=='view_generated_reports.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>View Report </span> </a></li>
						
						li class=""> <a href="application.php" class="waves-effect <?php if($iCurrentFileName=='application.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Applications </span> </a></li>
						
						<li class=""> <a href="applicants.php" class="waves-effect <?php if($iCurrentFileName=='Applicants.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Applicants </span> </a></li>
						
						<li class=""> <a href="view_admission.php" class="waves-effect <?php if($iCurrentFileName=='view_admission.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>View Admission </span> </a></li>--->
    <?php // if(in_array('update_parent_phone_emails.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <!---<li class=""> <a href="update_parent_phone_emails.php" class="waves-effect <?php if($iCurrentFileName=='view_admission.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Update Parents Phone/Emails </span> </a></li>-->
					<?php // } ?>	
						<!--<li class=""> <a href="view_admission.php" class="waves-effect <?php if($iCurrentFileName=='view_admission.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Import Configuration </span> </a></li>
						
						<li class=""> <a href="update_parent_phone_emails.php" class="waves-effect <?php if($iCurrentFileName=='view_admission.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Backup database</span> </a></li>--->
    
    <li class=""> <a href="slider.php" class="waves-effect <?php if($iCurrentFileName=='slider.php') { echo "active"; } ?>"> <i class=" ti-arrow-right"></i> <span>Configurations </span> </a> </li>
    <li class=""> <a href="gallery.php" class="waves-effect <?php if($iCurrentFileName=='gallery.php') { echo "active"; } ?>"> <i class=" ti-arrow-right"></i> <span>Gallery </span> </a> </li>
    <li class=""> <a href="upcoming_event.php" class="waves-effect <?php if($iCurrentFileName=='upcoming_event.php') { echo "active"; } ?>"> <i class=" ti-arrow-right"></i> <span>Upcoming Event </span> </a> </li>
    <li class=""> <a href="blog.php" class="waves-effect <?php if($iCurrentFileName=='blog.php') { echo "active"; } ?>"> <i class=" ti-arrow-right"></i> <span>Blog </span> </a> </li>
    <li class=""> <a href="about_school.php" class="waves-effect <?php if($iCurrentFileName=='about_school.php') { echo "active"; } ?>"> <i class=" ti-arrow-right"></i> <span>About School </span> </a> </li>
  </ul>
</li>
<?php } ?>
<?php if((in_array('staff.php', $ret) || in_array('manage_class_member.php', $ret)) && (in_array('manage_class_member.php', $ret) && in_array('student.php', $ret)) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-suitcase" aria-hidden="true"></i> <span> Enrollment Officer</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php if(in_array('staff.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="staff.php" class="waves-effect <?php if($iCurrentFileName=='staff.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Staff</span> </a></li>
    <?php } ?>
    <?php if(in_array('manage_parents.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="manage_parents.php" class="waves-effect <?php if($iCurrentFileName=='manage_parents.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Parent </span> </a></li>
    <?php } ?>
    <?php 	/* if(in_array('manage_parents_accounts.php', $ret) || $_SESSION['usertype']=='0') { ?>
            <li class=""> <a href="manage_parents_accounts.php" class="waves-effect <?php if($iCurrentFileName=='manage_parents_accounts.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Parent Accounts </span> </a></li>
            <?php } */	 ?>
    <?php if(in_array('student.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="student.php" class="waves-effect <?php if($iCurrentFileName=='student.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Student </span> </a></li>
    <?php } ?>
    <?php if(in_array('move_student_to_nextTerm.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="move_student_to_nextTerm.php" class="waves-effect <?php if($iCurrentFileName=='move_student_to_nextTerm.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Transfer Student To Next Term </span> </a></li>
    <?php } ?>
    <?php // if(in_array('update_parent_phone_emails.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <!---<li class=""> <a href="upload_staff.php?action=add_staff" class="waves-effect <?php if($iCurrentFileName=='upload_staff.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Upload Staff </span> </a></li>----->
    <?php // } ?>
    <?php // if(in_array('manage_class_member.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <!---<li class=""> <a href="manage_class_member.php" class="waves-effect <?php if($iCurrentFileName=='manage_class_member.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Class Member  </span> </a></li>----->
    <?php // } ?>
  </ul>
</li>
<?php } ?>

<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EXAM FEATURES -------------------------------------------------------->

<?php if(true) { ?>
<?php if(in_array('class_teacher_roll_call.php', $ret) || in_array('input_score_class_teacher.php', $ret) || in_array('class_teacher_subject_result.php', $ret) || in_array('class_teacher_make_comment.php', $ret) || in_array('board_sheet.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-male" aria-hidden="true"></i> <span> Class Teacher</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
   
    <?php if(in_array('student.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="student.php" class="waves-effect <?php if($iCurrentFileName=='student.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Student </span> </a></li>
    <?php } ?>
    <?php if(in_array('removesubject.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="removesubject.php" class="waves-effect <?php if($iCurrentFileName=='removesubject.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Remove Subject</span> </a> </li>
    <?php } ?>
   
    <?php if(in_array('class_teacher_roll_call.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="class_teacher_roll_call.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_roll_call.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Make Roll Call</span> </a> </li>
    <?php } ?>
    <?php if(in_array('class_teacher_roll_call.php', $ret) || $_SESSION['usertype']=='0') { ?>
     <li class=""> <a href="class_teacher_roll_call_bulk.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_roll_call_bulk.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Attendance (Bulk Entry)</span> </a> </li>
    <?php } ?>
    <?php if(in_array('input_score_class_teacher.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="input_score_class_teacher.php" class="waves-effect <?php if($iCurrentFileName=='input_score_class_teacher.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Input Score</span> </a> </li>
    <?php } ?>
    <?php if(in_array('class_teacher_subject_result.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="class_teacher_subject_result.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_subject_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Subject Result</span> </a> </li>
    <?php } ?>
    <?php if(in_array('class_teacher_make_comment.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="class_teacher_make_comment.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_make_comment.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Make Comment</span> </a></li>
    <?php } ?>
    <?php if(in_array('board_sheet.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="board_sheet.php" class="waves-effect <?php if($iCurrentFileName=='board_sheet.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Board Sheet</span> </a></li>
    <?php } ?>
    <?php if(in_array('cumulative_board_sheet.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="cumulative_board_sheet.php" class="waves-effect <?php if($iCurrentFileName=='cumulative_board_sheet.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Cumulative Board Sheet</span> </a></li>
    <?php } ?>
    <?php if(in_array('class_teacher_pyschomotor.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="class_teacher_pyschomotor.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_pyschomotor.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Phycomotor</span> </a></li>
    <?php } ?>
    <?php if(in_array('class_teacher_traits.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="class_teacher_traits.php" class="waves-effect <?php if($iCurrentFileName=='class_teacher_traits.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Affective Traits</span> </a></li>
    <?php } ?>
    <!---<li class=""> <a href="cumulative_subject_results.php" class="waves-effect <?php if($iCurrentFileName=='cumulative_subject_results.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Cumulative Subject Results</span> </a></li>--->
  </ul>
</li>
<?php } ?>
<?php if(in_array('subject_specific_comment.php', $ret) || in_array('input_scores_subject.php', $ret) || in_array('input_score_for_all_cas_subject.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-flask" aria-hidden="true"></i> <span> Subject Teacher</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php if(in_array('subject_specific_comment.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="subject_specific_comment.php" class="waves-effect <?php if($iCurrentFileName=='subject_specific_comment.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Subject Specific comment</span> </a></li>
    <?php } ?>
    <?php if(in_array('input_scores_subject.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="input_scores_subject.php" class="waves-effect <?php if($iCurrentFileName=='input_scores_subject.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Input Score</span> </a></li>
    <?php } ?>
    <?php if(in_array('input_score_for_all_cas_subject.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="input_score_for_all_cas_subject.php" class="waves-effect <?php if($iCurrentFileName=='input_score_for_all_cas_subject.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Input Score for All CAs</span> </a></li>
    <?php } ?>
    
    <!---<li class=""> <a href="assignments_and_submissions.php" class="waves-effect <?php if($iCurrentFileName=='assignments_and_submissions.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Make Subject Comment</span> </a></li>
					
						<li class=""> <a href="assignments_and_submissions.php" class="waves-effect <?php if($iCurrentFileName=='assignments_and_submissions.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Assignment</span> </a></li>--->
  </ul>
</li>
<?php } ?>
<?php } ?>

<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EXAM FEATURES --------------------------------------------------------> 

<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 

<!--------------------------------------------------------STARTING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF SMS NOTIFICATION -------------------------------------------------------->

<?php if(true) { ?>
<?php if(in_array('sms_plan.php', $ret) || in_array('send_sms.php', $ret)  || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-envelope" aria-hidden="true"></i> <span>SMS Manager</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php if(in_array('sms_plan.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="sms_plan.php" class="waves-effect <?php if($iCurrentFileName=='sms_plan.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Sms Plan</span> </a></li>
    <?php } ?>
    <?php if(in_array('send_sms.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="send_sms.php" class="waves-effect <?php if($iCurrentFileName=='send_sms.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Send Sms</span> </a></li>
    <?php } ?>
  </ul>
</li>
<?php } ?>
<?php } ?>

<!--------------------------------------------------------ENDING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF SMS NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF SMS NOTIFICATION --------------------------------------------------------> 

<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 

<!--------------------------------------------------------STARTING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF EMAIL NOTIFICATION -------------------------------------------------------->

<?php if(true) { ?>

 <?php if(in_array('send_email.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-th-list"></i> <span>Email Manager</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <li class=""> <a href="send_mail.php" class="waves-effect <?php if($iCurrentFileName=='send_email.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Send Email</span> </a></li>
  </ul>
</li>
<?php } ?>


<?php } ?>

<!--------------------------------------------------------ENDING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EMAIL NOTIFICATION --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF EMAIL NOTIFICATION --------------------------------------------------------> 

<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 

<!--------------------------------------------------------STARTING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF ONLINE AND BANK PAYMENT -------------------------------------------------------->

<?php if(true) { ?>
<?php if(in_array('transcation.php', $ret) || in_array('withdrawal_request.php', $ret)  || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-envelope" aria-hidden="true"></i> <span>Payment Detail</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
    <?php if(in_array('withdrawal_request.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="withdrawal_request.php" class="waves-effect <?php if($iCurrentFileName=='withdrawal_request.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Withdrawal Request</span> </a></li>
    <?php } ?>
    <?php if(in_array('transcation.php', $ret) || $_SESSION['usertype']=='0') { ?>
    <li class=""> <a href="transcation.php" class="waves-effect <?php if($iCurrentFileName=='transcation.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span> Transcation History</span> </a></li>
    <?php } ?>
  </ul>
</li>
<?php } ?>
<?php } ?>

<!--------------------------------------------------------ENDING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 
<!--------------------------------------------------------ENDING OF ONLINE AND BANK PAYMENT --------------------------------------------------------> 

<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 
<!------------------------------------**************************************************************---------------------------------------> 

<!--------------------------------------------------------STARTING OF REPORT TEMPLATES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF REPORT TEMPLATES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF REPORT TEMPLATES --------------------------------------------------------> 
<!--------------------------------------------------------STARTING OF REPORT TEMPLATES -------------------------------------------------------->

<?php if(true) { ?>
<?php if(in_array('view_result_subject_result.php', $ret) || in_array('view_result_board_sheet.php', $ret) || in_array('view_result_cumulative_board_sheet.php', $ret) || in_array('view_result_student_cumulative_result.php', $ret) || in_array('view_result_class_level_cumulative_board_sheet.php', $ret) || in_array('view_result_class_level_subject_grade_analysis.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect "><i class="fa fa-binoculars" aria-hidden="true"></i> <span> View Result</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
  <?php if(in_array('view_result_subject_result.php', $ret) || $_SESSION['usertype']=='0') { ?>
  <li class=""> <a href="view_result_subject_result.php" class="waves-effect <?php if($iCurrentFileName=='view_result_subject_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Subject Result</span> </a></li>
  <?php } ?>
  <?php if(in_array('view_result_board_sheet.php', $ret) || $_SESSION['usertype']=='0') { ?>
  <li class=""> <a href="view_result_board_sheet.php" class="waves-effect <?php if($iCurrentFileName=='view_result_board_sheet.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Broad Sheet</span> </a></li>
  <?php } ?>
  <?php if(in_array('view_result_cumulative_board_sheet.php', $ret) || $_SESSION['usertype']=='0') { ?>
  <li class=""> <a href="view_result_cumulative_board_sheet.php" class="waves-effect <?php if($iCurrentFileName=='view_result_cumulative_board_sheet.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Cumulative Broad Sheet</span> </a></li>
  <?php } ?>
  <?php if(in_array('view_result_student_cumulative_result.php', $ret) || $_SESSION['usertype']=='0') { ?>
  <li class=""> <a href="view_result_student_cumulative_result.php" class="waves-effect <?php if($iCurrentFileName=='view_result_student_cumulative_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Student cumulative Result </span> </a></li>
  <?php } ?>
  <?php if(in_array('view_result_class_level_subject_grade_analysis.php', $ret) || $_SESSION['usertype']=='0') { ?>
  <li class=""> <a href="view_result_class_level_subject_grade_analysis.php" class="waves-effect <?php if($iCurrentFileName=='view_result_class_level_subject_grade_analysis.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Class Level Subject Grade Analysis</span> </a></li>
  <?php } ?>
  <!---<li class=""> <a href="view_result_student_grade_comparison.php" class="waves-effect <?php if($iCurrentFileName=='view_result_student_grade_comparison.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Student Grade Comparison</span> </a></li>-->
          </ul>
        </li>
        <?php } ?>
   
 <?php } ?>   
 <!--$create_by_userid=='8'-->
 <?php if(true) { ?>
 <li class="has_sub"> <a href="javascript:void(0);" class="waves-effect <?php if($iCurrentFileName=='term_result.php') { echo "active"; } ?>"><i class="fa fa-th"></i> <span> Staff Assessment </span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
  
    <li class=""> <a href="staff_assessment.php" class="waves-effect <?php if($iCurrentFileName=='staff_assessment.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Assessment</span> </a></li>
    <li class=""> <a href="personal_assessment.php" class="waves-effect <?php if($iCurrentFileName=='personal_assessment.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Personal Assessment</span> </a></li>
    <li class=""> <a href="manage_assessment.php?action=list" class="waves-effect <?php if($iCurrentFileName=='manage_assessment.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Assign Assessment</span> </a></li>
    <li class=""> <a href="manage_assessment-my.php" class="waves-effect <?php if($iCurrentFileName=='manage_assessment-my.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>My Assessment</span> </a></li>
  </ul>
</li>



 <li class="has_sub"> <a href="javascript:void(0);" class="waves-effect <?php if($iCurrentFileName=='term_result.php') { echo "active"; } ?>"><i class="fa fa-th"></i> <span> Student Fee</span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
  
	    <li class=""> <a href="takefeesturcture.php" class="waves-effect <?php if($iCurrentFileName=='takefeesturcture.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Fee Structure</span> </a></li>

    <li class=""> <a href="takefee.php" class="waves-effect <?php if(!$iCurrentFileName=='takefee.php') { echo "active"; }else{} ?>"><i class=" ti-arrow-right"></i> <span>Take Fee</span> </a></li>
    <li class=""> <a href="inventory.php" class="waves-effect <?php if($iCurrentFileName=='inventory.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Manage Inventory</span> </a></li>
    <li class=""> <a href="expenses.php" class="waves-effect <?php if($iCurrentFileName=='expenses.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Income-Expendicture</span> </a></li>
  </ul>
</li>

<?php } ?>
 
<!--------------------------------------------------------ENDING OF REPORT TEMPLATES -------------------------------------------------------->          
<!--------------------------------------------------------ENDING OF REPORT TEMPLATES -------------------------------------------------------->          
<!--------------------------------------------------------ENDING OF REPORT TEMPLATES -------------------------------------------------------->          
<!--------------------------------------------------------ENDING OF REPORT TEMPLATES -------------------------------------------------------->          
 <?php if(in_array('term_result.php', $ret) || $_SESSION['usertype']=='0') { ?>
<li class="has_sub"> <a href="javascript:void(0);" class="waves-effect <?php if($iCurrentFileName=='term_result.php') { echo "active"; } ?>"><i class="fa fa-th"></i> <span> Result </span> <span class="menu-arrow"></span> </a>
  <ul class="list-unstyled">
  
    <li class=""> <a href="term_result.php" class="waves-effect <?php if($iCurrentFileName=='term_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Term Result</span> </a></li>
    
    <!---<li class=""> <a href="cumulative_result.php" class="waves-effect <?php if($iCurrentFileName=='cumulative_result.php') { echo "active"; } ?>"><i class=" ti-arrow-right"></i> <span>Cumulative Result</span> </a></li>--->
  </ul>
</li>
<?php } ?>       
        <!--<li><a href="managesubjectteacher.php" class="waves-effect <?php if($iCurrentFileName=='managesubjectteacher.php') { echo "active"; } ?>"><i class="fa fa-cog" aria-hidden="true"></i> <span> Manage Subject Teacher </span> </a></li>--> 
        
        <!---<li><a href="douments.php" class="waves-effect <?php if($iCurrentFileName=='douments.php') { echo "active"; } ?>"><i class="fa fa-folder" aria-hidden="true"></i> <span>Document</span> </a></li>
				-->
        
        <li class=""> <a href="logout.php" class="waves-effect <?php if($iCurrentFileName=='logout.php') { echo "active"; } ?>"><i class="fa fa-sign-out"></i> <span>Logout</span> </a></li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
