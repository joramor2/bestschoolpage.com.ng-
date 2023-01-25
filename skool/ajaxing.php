<?php include('../config.php');
include('inc.session-create.php'); 
$validate = new Validation();

if($_POST['action']=='getstusubj')
 {  
 
 $iStudentDetails = $db->getRow("select id, student_id, first_name,last_name , session, class, term_id , randomid from  manage_student where create_by_userid='".$create_by_userid."' and  randomid='".$_POST['randomid']."'");

 
  ?>

<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>#</th>
      <th>Subject</th>
      <th>Select To Remove</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=0;
	$aryList = $db->getRows("select * from school_subject where create_by_userid='".$create_by_userid."' and class_id='".$iStudentDetails['class']."' order by id desc");
	foreach($aryList as $iList) 
	{ $i=$i+1;
	
	 $iAlreadyRemoved = $db->getRow("select id from  student_subject_remove where create_by_userid='".$create_by_userid."' and subjectid='".$iList['id']."' and  randomid='".$_POST['randomid']."' and studentid='".$iStudentDetails['id']."'");
	 ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $iList['subject']; ?></td>
      <td><input type="checkbox"  name="subjectlist[]" value="<?php echo $iList['id']; ?>" <?php if($iAlreadyRemoved['id']!='') { echo 'checked'; } ?>/></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<?php }elseif($_POST['action']=='updatesubject')
 {  
 
 

			 $iStudentDetails = $db->getRow("select id from  manage_student where create_by_userid='".$create_by_userid."' and  randomid='".$_POST['randomid']."'");
 
			$flgIn1 = $db->delete("student_subject_remove", "where randomid='".$_POST['randomid']."' and studentid='".$iStudentDetails['id']."'");
			$iSubjectId = explode(',', $_POST['subjectid']);			
			foreach($iSubjectId as $key => $val)
				{
							
					$aryData = array(
									'studentid'	 						=>	$iStudentDetails['id'],
									'randomid'	 						=>	$_POST['randomid'] ,
									'subjectid'	 						=>	$val,
									'create_by_userid'	 				=>	$create_by_userid,
									
							);
					$BflgIn = $db->insertAry("student_subject_remove", $aryData);
					 
					
					
				} 
				 $stat['success']='Record updated successfully';
				 echo msg($stat);
 
 
 exit;
 } ?>
