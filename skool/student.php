<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Student Information Page";
$FileName = 'student.php';
$validate = new Validation();
if ($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}

$iStudent=$db->getRow("select * from manage_student where randomid='".$_GET['randomid']."'");
$showSelect = !($_GET['randomid']!='' || $_GET['action']=='student');
$showAdvanceEdit = $_GET['randomid']!='';
$studentName = '';

if($_GET['randomid']!=''){
    $iStudentBio=$db->getRow("select * from manage_student where randomid='".$_GET['randomid']."'");
    $studentName = $iStudentBio['first_name'] . ' ' . $iStudentBio['last_name'] . ' ' . $iStudentBio['other_name'];
}

if(isset($_POST['add_student']))
{
	$validate->addRule($_POST['student_id'],'','Student Id',true);
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['gender'],'','Gender',true);
	$validate->addRule($_POST['date_of_birth'],'','Date Of Birth',true);
	$validate->addRule($_POST['session'],'','Session',true);
	$validate->addRule($_POST['term_id'],'','Term',true);
	$validate->addRule($_POST['class'],'','Class',true);
	
	if($validate->validate() && count($stat)==0)
	{
		$iForSingleRow=$db->getVal("select id from manage_student where student_id='".$_POST['student_id']."'");
		if($iForSingleRow!='')
		{
			$stat['error'] = "Student Id is already Inserted";	
		}
		else	
		{
			if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
			{
				$filename = basename($_FILES['image']['name']);
				$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
				if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
				{ 	  
					$newfile=md5(time())."_".$filename;
					move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);
				}				
			}
			
			$iLastId=$db->getVal("select id from manage_student order by id desc")+1;		
			$randomId=randomFix(15).'-'.$iLastId;
			
			$aryData = array(
							'userid'							=>	$_SESSION['userid'],
							'usertype'							=>	$_SESSION['usertype'],
							'student_id'                        =>	$_POST['student_id'],
							'session'                   		=>	$_POST['session'],
							'term_id'                   		=>	$_POST['term_id'],
							'class'                             =>	$_POST['class'],
							'last_name'                         =>	$_POST['last_name'],
							'first_name'                        =>	$_POST['first_name'],
							'date_of_admission'                 =>	$_POST['date_of_admission'],
							'state_of_origin'                   =>	$_POST['state_of_origin'],
							'other_name'                        =>	$_POST['other_name'],
							'lga_of_origin'                     =>	$_POST['lga_of_origin'],
							'gender'                            =>	$_POST['gender'],
							'date_of_birth'                     =>	$_POST['date_of_birth'],
							'religion'                          =>	$_POST['religion'],
							'nationality'                       =>	$_POST['nationality'],
							'number_of_sibling'                 =>	$_POST['number_of_sibling'],
							'percentage'                        =>	$_POST['percentage'],
							'order_of_birth'                    =>	$_POST['order_of_birth'],
							'boarding'                          =>	$_POST['boarding'],
							'address_1'                         =>	$_POST['address_1'],
							'address_2'                        	=>	$_POST['address_2'],
							'state'                             =>	$_POST['state'],
							'city'                              =>	$_POST['city'],
							'p_o_box'							=>	$_POST['p_o_box'],
							'email'								=>	$_POST['email'],
							'phone'								=>	$_POST['phone'],
							'mobile'							=>	$_POST['mobile'],
							'picture'							=>	$newfile,
							'create_by_userid'					=>	$create_by_userid,
							'create_by_usertype'				=>	$create_by_usertype,
							'randomid'							=>	$randomId,
							);
				$flgIn = $db->insertAry("manage_student", $aryData);
				
				$_SESSION['success'] = "Submitted Successfully";
				redirect($FileName.'?action=student&randomid='.$randomId);
		}
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_student']))
{
	$validate->addRule($_POST['student_id'],'','Student Id',true);
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['gender'],'','Gender',true);
	$validate->addRule($_POST['date_of_birth'],'','Date Of Birth',true);
	$validate->addRule($_POST['session'],'','Session',true);
	$validate->addRule($_POST['term_id'],'','Term',true);
	$validate->addRule($_POST['class'],'','Class',true);
	
	if($validate->validate() && count($stat)==0)
	{
		$iForSingleRow=$db->getVal("select id from manage_student where student_id='".$_POST['student_id']."' and randomid!='".$_GET['randomid']."'");
		/*if($iForSingleRow!='')*/
		if(false)
		{
			$stat['error'] = "Student Id is already Inserted";	
		}
		else	
		{
			if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
			{
				$filename = basename($_FILES['image']['name']);
				$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
				if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
				{ 	  
					$newfile=md5(time())."_".$filename;
					move_uploaded_file($_FILES['image']['tmp_name'],"../uploads/".$newfile);
				}				
			} 
			else { $newfile = $_POST['image_old']; }

			$aryData = array(
							'student_id'                        =>	$_POST['student_id'],
							'session'                   		=>	$_POST['session'],
							'term_id'                   		=>	$_POST['term_id'],
							'class'                             =>	$_POST['class'],
							'last_name'                         =>	$_POST['last_name'],
							'first_name'                        =>	$_POST['first_name'],
							'date_of_admission'                 =>	$_POST['date_of_admission'],
							'state_of_origin'                   =>	$_POST['state_of_origin'],
							'other_name'                        =>	$_POST['other_name'],
							'lga_of_origin'                     =>	$_POST['lga_of_origin'],
							'gender'                            =>	$_POST['gender'],
							'date_of_birth'                     =>	$_POST['date_of_birth'],
							'religion'                          =>	$_POST['religion'],
							'nationality'                       =>	$_POST['nationality'],
							'number_of_sibling'                 =>	$_POST['number_of_sibling'],
							'percentage'                        =>	$_POST['percentage'],
							'order_of_birth'                    =>	$_POST['order_of_birth'],
							'boarding'                          =>	$_POST['boarding'],
							'address_1'                         =>	$_POST['address_1'],
							'address_2'                        	=>	$_POST['address_2'],
							'state'                             =>	$_POST['state'],
							'city'                              =>	$_POST['city'],
							'p_o_box'							=>	$_POST['p_o_box'],
							'email'								=>	$_POST['email'],
							'phone'								=>	$_POST['phone'],
							'mobile'							=>	$_POST['mobile'],
							'picture'							=>	$newfile,
							);
					$flgIn1 = $db->updateAry("manage_student", $aryData, "where randomid='".$_GET['randomid']."'");
					$_SESSION['success'] = "Updated Successfully";
					redirect($FileName.'?action=student&randomid='.$_GET['randomid']);
					
		}
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if($_GET['action']=='delete_student')
{
	$flgIn = $db->delete("manage_student", "where randomid='".$_GET['randomid']."'");
	
	$flgIn1 = $db->delete("student_guardian", "where student_id ='".$iStudent['id']."'");
	$_SESSION['success'] = 'Deleted Successfully';
	redirect($FileName.'?action=student');
	
}
if(isset($_POST['add_father'])) 
{
	if($validate->validate() && count($stat)==0) 
	{
		$iLastId=$db->getVal("select id from student_father order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;
		
		$aryData = array(
						'userid'   				=>	$_SESSION['userid'],
						'usertype'  			=>	$_SESSION['usertype'],
						'student_id' 			=>	$iStudent['id'],
						'parent_id' 			=>	$_POST['parent_id'],
						'password'				=>	randomFix(6),
						'occupation' 			=>	$_POST['occupation'],
						'title' 				=>	$_POST['title'],
						'last_name' 			=>	$_POST['last_name'],
						'first_name' 			=>	$_POST['first_name'],
						'phone' 				=>	$_POST['phone'],
						'email' 				=>	$_POST['email'],
						'other_name' 			=>	$_POST['other_name'],
						'home_address_1'		=>	$_POST['home_address_1'],
						'home_address_2' 		=>	$_POST['home_address_2'],
						'home_city' 			=>	$_POST['home_city'],
						'home_state' 			=>	$_POST['home_state'],
						'office_address_1' 		=>	$_POST['office_address_1'],
						'office_address_2' 		=>	$_POST['office_address_2'],
						'office_city' 			=>	$_POST['office_city'],
						'office_state' 			=>	$_POST['office_state'],
						'create_by_userid' 		=>	$create_by_userid,
						'create_by_usertype' 	=>	$create_by_usertype,
						'randomid' 				=>	$randomId,
						'type' 					=>	1,
						'status' 				=>	1,
						'create_at'				=>	date("Y-m-d H:i:s"),
						'student_id_str'		=>	$studentid['student_id'],
						);
			$flgIn1 = $db->insertAry("student_guardian", $aryData);
			$_SESSION['success'] = "Submitted Successfully";
			redirect($FileName.'?action=father&randomid='.$_GET['randomid']);
	} 
	else 
	{
		$stat['error'] = $validate->errors();
	}
} 
elseif(isset($_POST['edit_father'])) 
{
	if($validate->validate() && count($stat) == 0) 
	{
		$aryData = array(
						'parent_id' 			=>	$_POST['parent_id'],
						'occupation' 			=>	$_POST['occupation'],
						'title' 				=>	$_POST['title'],
						'last_name' 			=>	$_POST['last_name'],
						'first_name' 			=>	$_POST['first_name'],
						'phone' 				=>	$_POST['phone'],
						'email' 				=>	$_POST['email'],
						'other_name' 			=>	$_POST['other_name'],
						'home_address_1'		=>	$_POST['home_address_1'],
						'home_address_2' 		=>	$_POST['home_address_2'],
						'home_city' 			=>	$_POST['home_city'],
						'home_state' 			=>	$_POST['home_state'],
						'office_address_1' 		=>	$_POST['office_address_1'],
						'office_address_2' 		=>	$_POST['office_address_2'],
						'office_city' 			=>	$_POST['office_city'],
						'office_state' 			=>	$_POST['office_state'],
						);
			$flgIn1 = $db->updateAry("student_guardian", $aryData, "where id ='".$_POST['autoid']."' ");
		
			$_SESSION['success'] = "Updated Successfully";
			redirect($FileName.'?action=father&randomid='.$_GET['randomid']);
	} 
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if($_GET['action'] == 'delete_father') 
{
	$flgIn1 = $db->delete("student_guardian", "where randomid='" . $_GET['randomid'] . "'  and type='2'");
	redirect($FileName . '?action=father');
	$_SESSION['success'] = 'Deleted Successfully';
}
if(isset($_POST['add_mother'])) 
{
	if($validate->validate() && count($stat)==0) 
	{
		$iForSingleRow = $db->getRow("select * from student_mother where student_id = '".$_POST['student_id']."'");

		if($iForSingleRow['id']=='') 
		{
			$studentid = $db->getrow("select * from manage_student where randomid='" . $_GET['randomid'] . "'");
			$iLastId=$db->getVal("select id from student_mother order by id desc")+1;		
			$randomId=randomFix(15).'-'.$iLastId;
			
			$aryData = array(
							'userid'   					=>	$_SESSION['userid'],
							'usertype' 			 		=>	$_SESSION['usertype'],
							'student_id'				=>	$studentid['id'],
							'parent_id'					=>	$_POST['parent_id'],
							'password'					=>	randomFix(6),
							'occupation'				=>	$_POST['occupation'],
							'title' 					=>	$_POST['title'],
							'last_name' 				=>	$_POST['last_name'],
							'first_name' 				=>	$_POST['first_name'],
							'phone' 					=>	$_POST['phone'],
							'email' 					=>	$_POST['email'],
							'other_name' 				=>	$_POST['other_name'],
							'home_address_1' 			=>	$_POST['home_address_1'],
							'home_address_2'			=>	$_POST['home_address_2'],
							'home_city' 				=>	$_POST['home_city'],
							'home_state' 				=>	$_POST['home_state'],
							'office_address_1' 			=>	$_POST['office_address_1'],
							'office_address_2' 			=>	$_POST['office_address_2'],
							'office_city' 				=>	$_POST['office_city'],
							'office_state' 				=>	$_POST['office_state'],
							'create_by_userid' 			=>	$create_by_userid,
							'create_by_usertype' 		=>	$create_by_usertype,
							'randomid' 					=>	$randomId,
							'type' 						=>	2,
							'status' 					=>	1,
							'create_at'				    =>	date("Y-m-d H:i:s"),
							'student_id_str'			=>	$studentid['student_id'],
							);
				$flgIn1 = $db->insertAry("student_guardian", $aryData);
				$_SESSION['success'] = "Submited Successfully";
				redirect($FileName.'?action=mother&randomid=' . $_GET['randomid']);
		} 
		else 
		{
			$stat['error'] = "Parent are alerady inserted";
		}
	} 
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
elseif(isset($_POST['edit_mother'])) 
{
	if($validate->validate() && count($stat)==0) 
	{
		$studentid = $db->getrow("select * from manage_student where randomid='" . $_GET['randomid'] . "'");
		$aryData = array(
						'parent_id'				=>	$_POST['parent_id'],
						'occupation'			=>	$_POST['occupation'],
						'title' 				=>	$_POST['title'],
						'last_name' 			=>	$_POST['last_name'],
						'first_name' 			=>	$_POST['first_name'],
						'phone' 				=>	$_POST['phone'],
						'email' 				=>	$_POST['email'],
						'other_name' 			=>	$_POST['other_name'],
						'home_address_1' 		=>	$_POST['home_address_1'],
						'home_address_2' 		=>	$_POST['home_address_2'],
						'home_city' 			=>	$_POST['home_city'],
						'home_state' 			=>	$_POST['home_state'],
						'office_address_1' 		=>	$_POST['office_address_1'],
						'office_address_2'		=>	$_POST['office_address_2'],
						'office_city' 			=>	$_POST['office_city'],
						'office_state'			=>	$_POST['office_state'],
						);
			$flgIn1 = $db->updateAry("student_guardian", $aryData,  "where  id ='".$_POST['autoid']."' ");
			$_SESSION['success'] = "Updated Successfully";
			redirect($FileName.'?action=mother&randomid=' . $_GET['randomid']);
	} 
	else 
	{
		$stat['error'] = $validate->errors();
	}
} 
if($_GET['action'] == 'delete_mother') 
{
	$flgIn1 = $db->delete("student_guardian",  "where student_id ='".$iStudent['id']."' and type='2'");
	$_SESSION['success'] = 'Deleted Successfully';
	redirect($FileName . '?action=mother');
	
}
if(isset($_POST['add_guardian']))
{
	if($validate->validate() && count($stat)==0) 
	{
		$iForSingleRow = $db->getRow("select * from student_mother where student_id = '" . $_POST['student_id'] . "' ");

		if($iForSingleRow['id']=='') 
		{
			$studentid = $db->getrow("select * from manage_student where randomid='". $_GET['randomid']."'");
	$iLastId=$db->getVal("select id from student_guardian order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;
			$aryData = array(
							'userid'				=>	$_SESSION['userid'],
							'usertype'				=>	$_SESSION['usertype'],
							'student_id'			=>	$studentid['id'],
							'parent_id'				=>	$_POST['parent_id'],
							'password'				=>	randomFix(6),
							'occupation'			=>	$_POST['occupation'],
							'title'					=>	$_POST['title'],
							'last_name'				=>	$_POST['last_name'],
							'first_name'			=>	$_POST['first_name'],
							'phone'					=>	$_POST['phone'],
							'email'					=>	$_POST['email'],
							'other_name'			=>	$_POST['other_name'],
							'home_address_1'		=>	$_POST['home_address_1'],
							'home_address_2'		=>	$_POST['home_address_2'],
							'home_city'				=>	$_POST['home_city'],
							'home_state'			=>	$_POST['home_state'],
							'office_address_1'		=>	$_POST['office_address_1'],
							'office_address_2'		=>	$_POST['office_address_2'],
							'office_city'			=>	$_POST['office_city'],
							'office_state'			=>	$_POST['office_state'],
							'create_by_userid'		=>	$create_by_userid,
							'create_by_usertype'	=>	$create_by_usertype,
							'randomid'				=>	$randomId,
							'type' 					=>	3,
							'status' 				=>	1,
							'create_at'				=>	date("Y-m-d H:i:s"),
							'student_id_str'		=>	$studentid['student_id'],
							);
				$flgIn1 = $db->insertAry("student_guardian", $aryData);
				$_SESSION['success'] = "Submited Successfully";
				redirect($FileName.'?action=guardian&randomid=' . $_GET['randomid']);
			 
		} 
		else 
		{
			$stat['error'] = "Parent are already inserted";
		}
	} 
	else
	{
		$stat['error'] = $validate->errors();
	}
} 
elseif (isset($_POST['edit_guardian'])) 
{

	if($validate->validate() && count($stat)== 0) 
	{
		$studentid = $db->getrow("select * from manage_student where randomid='".$_GET['randomid']."'");
		
		$aryData = array(
						'user_id'  		 		=>	$_SESSION['userid'],
						'user_type'  			=>	$_SESSION['usertype'],
						'parent_id'				=>	$_POST['parent_id'],
						'occupation'			=>	$_POST['occupation'],
						'title'					=>	$_POST['title'],
						'last_name'				=>	$_POST['last_name'],
						'first_name'			=>	$_POST['first_name'],
						'phone'					=>	$_POST['phone'],
						'email'					=>	$_POST['email'],
						'other_name' 			=>	$_POST['other_name'],
						'home_address_1' 		=>	$_POST['home_address_1'],
						'home_address_2' 		=>	$_POST['home_address_2'],
						'home_city' 			=>	$_POST['home_city'],
						'home_state' 			=>	$_POST['home_state'],
						'office_address_1' 		=>	$_POST['office_address_1'],
						'office_address_2' 		=>	$_POST['office_address_2'],
						'office_city' 			=>	$_POST['office_city'],
						'office_state' 			=>	$_POST['office_state'],
						'create_by_userid' 		=>	$create_by_userid,
						'create_by_usertype' 	=>	$create_by_usertype,
						'randomid' 				=>	$_GET['randomid'],
						);
			$flgIn1 = $db->updateAry("student_guardian", $aryData, "where  randomid ='".$_POST['autoid']."' ");
			$_SESSION['success'] = "Updated Successfully";
			redirect($FileName.'?action=guardian&randomid=' . $_GET['randomid']);
	} 
	else
	{
		$stat['error'] = $validate->errors();
	}
} 
if($_GET['action'] == 'delete_guardian')
{
	$flgIn1 = $db->delete("student_guardian", "where student_id ='".$iStudent['id']."' and type='3'");
	redirect($FileName . '?action=guardian');
	$_SESSION['success'] = 'Deleted Successfully';
}
if(isset($_POST['add_medical'])) 
{
	if($validate->validate() && count($stat)==0) 
	{
		$studentid = $db->getrow("select * from manage_student where randomid='" . $_GET['randomid'] . "'");
		$iLastId=$db->getVal("select id from student_medical_info order by id desc")+1;$randomId=randomFix(15).'-'.$iLastId;
		$aryData = array(
						'userid'   							=>	$_SESSION['userid'],
						'usertype'  						=>	$_SESSION['usertype'],
						'student_id'						=>	$studentid['id'],
						'immunization_update'				=>	$_POST['immunization_update'],
						'any_allergy' 						=>	$_POST['any_allergy'],
						'medical_prescription_dosage' 		=> 	$_POST['medical_prescription_dosage'],
						'consent_non_prescription_medicine' => 	$_POST['consent_non_prescription_medicine'],
						'hospital_address' 					=>	$_POST['hospital_address'],
						'any_health_issue' 					=>	$_POST['any_health_issue'],
						'doctor_name' 						=>	$_POST['doctor_name'],
						'doctor_phone' 						=>	$_POST['doctor_phone'],
						'create_by_userid' 					=>	$create_by_userid,
						'create_by_usertype' 				=>	$create_by_usertype,
						'randomid' 							=>	$_GET['randomid'],
						);
			$flgIn1 = $db->insertAry("student_medical_info", $aryData);

			$_SESSION['success'] = "Submited Successfully";
			redirect($FileName.'?action=medical&randomid=' . $_GET['randomid']);
	} 
	else
	{
		$stat['error'] = $validate->errors();
	}
} 
if(isset($_POST['edit_medical'])) 
{
	if($validate->validate() && count($stat)==0) 
	{
		$studentid = $db->getrow("select * from manage_student where randomid='" . $_GET['randomid'] . "'");
		$aryData = array(
						'student_id'						=>	$studentid['id'],
						'immunization_update'				=>	$_POST['immunization_update'],
						'any_allergy' 						=>	$_POST['any_allergy'],
						'medical_prescription_dosage' 		=>	$_POST['medical_prescription_dosage'],
						'consent_non_prescription_medicine' =>	$_POST['consent_non_prescription_medicine'],
						'hospital_address' 					=>	$_POST['hospital_address'],
						'any_health_issue' 					=>	$_POST['any_health_issue'],
						'doctor_name' 						=>	$_POST['doctor_name'],
						'doctor_phone' 						=>	$_POST['doctor_phone'],
						);
				$flgIn1 = $db->updateAry("student_medical_info", $aryData, "where randomid = '" . $_GET['randomid'] . "'");
				$_SESSION['success'] = "Updated Successfully";
				redirect($FileName.'?action=medical&randomid=' . $_GET['randomid']);
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
<style>
.gwt-Label {
width: 35%;
padding-left: 0px !important;
}
.gardin button, input, optgroup, select, textarea {
float: right;
width: 63%;
}
.zqw22 button {
margin-top: 19px;
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
.content-page > .content {
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
.zqw22 .panel-success > .panel-heading {
background: white;
}
.zqw22 .nav.nav-tabs > li > a:hover, .nav.tabs-vertical > li > a:hover {
color: black !important;
font-weight: 700;
}
.zqw22 .nav.nav-tabs > li > a, .nav.tabs-vertical > li > a {
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
.zqw22 .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover, .tabs-vertical > li.active > a, .tabs-vertical > li.active > a:focus, .tabs-vertical > li.active > a:hover {
color: black !important;
font-weight: 700;
line-height: 38px;
background: gainsboro;
}
.zqw22 .panel-success > .panel-heading {
background: white;
padding: 0;
}
.zqw22 .panel .panel-body {
border-right: none !important;
border: 1px solid gainsboro;
}
.gwt-Label {
padding: 8px;
}
.zqw22 input {
padding: 8px 3px 10px 0;
border: 1px solid gainsboro;
background: #dcdcdc45;
border-radius: 5px;
margin-right: 0px;
width: 156px;
margin: 8px 0 11px 0;
margin-bottom: 5px;
}
.sectsab a ul {
padding: 0px;
}
.sectsab.active li {
color: white;
font-weight: 600;
}
.zqw22 button {
border: 1px solid #1B3058;
padding: 4px 5px 4px 5px;
margin-right: 7px;
background: transparent;
color: #1B3058;
}
.zqw22 select {
padding: 5px 0 8px 0;
background: #dcdcdc2e;
}
.zqw22 .nav-tabs > li {
padding: 0 4px 0 0;
}
#tab3success, #tab4success .middleCenterInner {
border: 1px solid gainsboro;
padding: 17px 11px 51px 19px;
}
#tab3success .middleCenterInner {
border: 1px solid gainsboro;
padding: 17px 11px 51px 19px;
}
#tab3success, #tab4success .BFOGCKB-c-h {
border-bottom: 3px solid;
width: 300px;
}
#tab3success .BFOGCKB-c-h {
border-bottom: 3px solid;
width: 300px;
}
#tab3success, #tab4success {
border: 1px solid gainsboro;
padding: 14px 4px 42px 11px;
width: 361px;
}
#tab3success, #tab4success .gwt-DecoratorPanel {
padding: 21px 21px 43px 4px;
}
#tab3success .gwt-DecoratorPanel {
padding: 21px 21px 43px 4px;
}
.zqw22 .panel .panel-body {
overflow-x: auto;
border-bottom: 3px solid gainsboro !important;
}
.zqw22 .nav.nav-tabs > li > a, .nav.tabs-vertical > li > a {
background: #dcdcdc4f !important;
}
.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
border: 1px solid #ebeff200;
}
div.dataTables_info {
margin-left: 7px;
}
table.dataTable {
margin-top: 0px !important;
margin-bottom: 0px !important;
}
.zqw22 .nav.nav-tabs > li > a, .nav.tabs-vertical > li > a {
color: black;
font-weight: 700;
line-height: 38px;
background: gainsboro;
}
.nav.nav-tabs > li > a, .nav.tabs-vertical > li > a {
padding-left: 15px !important;
padding-right: 15px !important;
}
.dataTables_paginate a {
background-color: transparent;
margin: 0 0px 0;
padding: 8px 15px 9px;
color: white;
cursor: pointer;
border: none;
}
.zqw22 .nav-tabs > li.active, .nav-tabs > li.active:focus, .nav-tabs > li.active:hover, .tabs-vertical > li.active, .tabs-vertical > li.active:focus, .tabs-vertical > li.active:hover {
color: black !important;
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
.zqw22 .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover, .tabs-vertical > li.active > a, .tabs-vertical > li.active > a:focus, .tabs-vertical > li.active > a:hover {
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
.Wizard-a1 #example_length {
display: none;
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
float: left;
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
width: 85% !important;
margin: 0 auto;
}
div.dataTables_filter input {
width: 67%;
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
position: sticky !important;
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
color: white !important;
position: relative;
}
div.dataTables_paginate {
margin: 0;
white-space: nowrap;
text-align: center !important;
padding-top: 27px;
}
.dataTables_paginate .disabled {
background: none;
color: white;
border: none !important;
padding: unset;
display: block;
color: transparent !important;
}
.tab-content .dataTables_paginate .disabled, .tab-content .paginate_button.previous.disabled {
bottom: -105px;
}

#example2_paginate .paginate_button.previous:before, #example1_paginate .paginate_button.previous:before {
bottom: -140px !Important;
}
.paginate_button.previous.disabled {
width: 10%;
float: left;
}
.paginate_button.previous.disabled {
width: 10%;
float: right;
}
div.dataTables_info {
white-space: nowrap;
padding-top: 0px;
}
.dataTables_paginate #example_next:before, .dataTables_paginate #example1_next:before, .dataTables_paginate #example2_next:before {
content: "";
width: 0;
height: 0;
border-top: 6px solid transparent;
border-left: 12px solid #555;
border-bottom: 6px solid transparent;
position: absolute;
z-index: 999999;
right: 15px;
bottom: 9px;
top: 4px;
}
div.dataTables_paginate {
margin: 0;
white-space: nowrap;
text-align: center !important;
}
.paging_simple_numbers span {
/* display: none; */
opacity: 0;
}
#example td {
padding: 4px 11px 4px 13px;
border-bottom: 3px solid;
margin: 0 0 0;
}
#example .active:hover {
background: #1B3058;
color: white;
}
.Wizard-a1 .sorting_1 {
display: none;
}
.dataTables_filter label:before {
position: absolute;
/* left: 0; */
right: 46px;
top: 62px !important;
/* bottom: 0; */
border: 1px solid #1B3058;
}
.dataTables_filter:before {
content: '';
position: absolute;
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
list-style: none;
}
div.dataTables_paginate {
margin: 0 auto;
}
.gridTable {
margin-bottom: 15px;
}
.gwt-Label {color: black;
font-weight: 600;
width: 90px;
float: left;
font-size: 13px;
}
.bedd{
color: black; 
}
#setB input {
width: 15%;
}
.gwt-ListBox {
width: 60%
}
.beddy img {
width: 100%;
}
.beddy-b input {
height: 50px;
width: 100%;
}
.hhf button {
margin-top: 10px;
margin-bottom: 20px;
}
.desh {
border-bottom: 2px solid;
border-bottom-style: dashed;
margin: 20px 0 20px 0px;
}
.ssd {
text-align: center;
margin: 10px 0 0 0;
padding-bottom: 10px;
}
#example2_paginate .paginate_button.previous:before, #example1_paginate .paginate_button.previous:before {
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
#example2_length {
display: none;
}
#example2_paginate .paginate_button.next:before, #example1_paginate .paginate_button.next:before {
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
#example2_paginate, #example1_paginate {
height: 10px !important;
}
#example2_filter.dataTables_filter input,
#example1_filter.dataTables_filter input, example1_filter.dataTables_filter input {
width: 95%;
float: left;
}
#example2_filter.dataTables_filter label, #example1_filter.dataTables_filter label {
position: relative;
width: 50%;
color: transparent;
padding: 0;
vertical-align: bottom;
}
#example2_filter.dataTables_filter label, #example1_filter.dataTables_filter label, #example_filter.dataTables_filter label {
min-height: 39px;
max-height: 22px;
}
#example2_filter.dataTables_filter input, #example1_filter.dataTables_filter input {
position: relative;
bottom: 27px;
height: 29px;
color: black;
}
#example1 div.dataTables_filter, #example2 div.dataTables_filter, #example div.dataTables_filter {
text-align: left;
margin-bottom: 10px;
margin-left: 12px;
}
#example1 tbody input, #example2 tbody input, #example tbody input {
width: 100% !important;
}
#example1_wrapper, #example2_wrapper {
position: relative;
padding-bottom: 15px;
}
#example1 thead, #example2 thead, #example thead {
position: absolute;
bottom: -61px;
width: 100%;
border: 1px solid #e4e1e175;
left: 0;
}
#example1_filter, #example2_filter {
Position: absolute;
bottom: 0px;
width: 100%;
margin-left: -13px;
text-align: right;
/* margin: 0; */
margin-top: 0;
}
.middleCenterInner .gwt-DecoratorPanel, .middleCenterInner table:first-child {
width: 100% !important;
}
#example1_filter div.dataTables_filter {
text-align: LEFT !IMPORTANT;
}
.zqw22 .panel .panel-body {
padding-bottom: 82px;
}
.beddy-b {
text-align:center;
}


</style>
<style>
#wrapper.enlarged .left.side-menu {
  display: none;
}
#wrapper.enlarged .content-page {
  margin-left: 0px;
}
</style>
<style>

.top-btn{
    margin-left: 40px;
}
.show-mobile{
    display: none;
}

@media only screen and (max-width: 768px){
.gwt-Label, .gwt-ListBox {
  width: 100%;
}
.gwt-ListBox {
  margin-bottom: 10px;
}
.with-nav-tabs .col-md-12 fieldset {
  margin-left: 8px !important;
  margin: 8px !important;
  width: 100%;
}
.zqw22 .with-nav-tabs input[type="text"] {
  width: 100%;
  display: block;
}
.gardin button, input, optgroup, select, textarea {
  width: 100%;
  padding: 10px;
  margin: 5px 0;
}
.filter-label{
  display:none;
}
.zasw1{
    height: inherit;
}
#wrapper:not(.forced) > .left.side-menu{
  display: none;
}
#wrapper:not(.forced) > .content-page {
  margin-left: 0px;
}
#example2_filter.dataTables_filter label, #example1_filter.dataTables_filter label, #example_filter.dataTables_filter label{
    max-height: initial;
    padding: 0;
}
.top-btn{
    margin-left: 10px;
}

.stu-name{
    font-size: 14px;
font-weight: 700;
}
.topside-section ul{
    margin: 0;
    padding-left: 0;
}
.topside-section li {
  padding: 5px;
}
.nav.nav-tabs > li > a, .nav.tabs-vertical > li > a{
    white-space: nowrap;
}
.nav.nav-tabs{
    display: flex;
    overflow-x: scroll;
    overflow-y: hidden;
}
.create-stu-btn{
    display:none;
}
.show-mobile{
    display: inherit;
}
.hide-mobile{
    display:none;
}
}
.bttn{
    margin-bottom: 30px;
     margin-left: 130px;
     margin-top: 10px;
     background-color: green;
     color: white;
     
}
</style>
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
        <div class="col-sm-12">
        <form action="csv_student.php" method="post" class="<?php if(!$showSelect) echo 'hide-mobile'; ?>">
            <div class="row">
                <button type="submit" name="submit" class="btn top-btn col-6" style="float: left;background: #1b3058;color: #fff;"> <i class="fa fa-file-excel-o" style="padding-right:0px!important; "></i> Download Excel </button>
                <a href="?action=student" class="btn top-btn col-6 show-mobile" style="float: left;background: #1b3058;color: #fff;"> <i class="fa fa-plus" style="padding-right:0px!important; "></i> Add New Student </a>
             </div>
            </form>
           <a href="?" class="btn top-btn <?php if($showSelect) echo 'hide-mobile'; ?> show-mobile" style="float: left;background: #1b3058;color: #fff;"> <i class="fa fa-arrow-left" style="padding-right:0px!important; "></i> Back to Student Selection </a>
        </div>
	</div>
	<!-- Basic Form Wizard -->
	
	     
	<div class="row">
	<div class="sectionza">
	<div class="col-md-12">
		<div class="col-md-3">
		<div class="zasw ">
			<div class="zawq Wizard-a1  <?php if(!$showSelect) echo 'hide-mobile'; ?>">
			
         </form>
         
         
          <form class="" action="student1.php" method="post"  enctype="multipart/form-data"
          >
            <input type="file"   name="file"><br>
            <button class="bttn" name="importSubmit">upload file</button><br>
            </form>
            
            
            
			<form method="GET" action="">
			   <label class="filter-label">Session:</label> 
			<select name="session" id="session"  required>
			<option value="">Select Session</option>
			<?php $aryDetail=$db->getRows("select * from  school_session  where create_by_userid='".$create_by_userid."'");

			foreach($aryDetail as $iList)
			{	$i=$i+1;?>
			<option value="<?php echo $iList['id']; ?>" <?php  if($_GET['session']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['session']; ?></option>
			<?php }?>
			</select> 
			
			<label class="filter-label">Term:</label> 
			<select name="term_id" id="term_id"  required>
			<option value="">Select Term</option>
			<?php $aryDetail=$db->getRows("select * from  school_term  where create_by_userid='".$create_by_userid."'");

			foreach($aryDetail as $iList)
			{	$i=$i+1;?>
			<option value="<?php echo $iList['id']; ?>" <?php  if($_GET['term_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['term']; ?></option>
			<?php }?>
			</select>     
			
			<input type="hidden" value="<?php echo $_GET['randomid']; ?>" name="randomid">
			<input type="hidden" value="<?php echo $_GET['action']; ?>" name="action">
			<input type="submit" value="Open" name="" style="background-color: #1b3058; color: white;">
			</form>
			<br>
			<table id="example" class="display">
			<thead class="setting">
				<tr>
					<th>Position</th>
					<th>Position</th>
				</tr>
			</thead>
			<tbody>
			   
         
			<?php 
			$search='';
			if($_GET['session']!=''){
				$search.="and session='".$_GET['session']."'";
			}
			if($_GET['term_id']!=''){
				$search.="and term_id='".$_GET['term_id']."'";
			}
			
			if($_SESSION['usertype']=='1')
				{
					$iSchoolRegisterStaffid=$db->getVal("select username from school_register where id='".$_SESSION['userid']."' order by id desc");
					$iStaffManageId=$db->getVal("select id from staff_manage where staff_id ='".$iSchoolRegisterStaffid."'");	
					$iConCatScholCls = $db->getVal("select GROUP_CONCAT(school_class) from class_teacher where staff_id='".$iStaffManageId."'");
		            $aryDetail = $db->getRows("select * from manage_student where  create_by_userid='".$create_by_userid."' and class IN ($iConCatScholCls) $search order by id desc");
				}else{
			        $aryDetail = $db->getRows("select * from manage_student where  create_by_userid='".$create_by_userid."' $search order by id desc");
				}
			foreach ($aryDetail as $iList) 
			{ 
			?>
			<tr>
				<td style="padding:0px;"></td>
				<td class="sectsab <?php if($_GET['randomid']==$iList['randomid']) { echo "active"; } ?>">
					<a href="<?php echo $FileName; ?>?action=student&randomid=<?php echo $iList['randomid'] ?>">
					<ul>
						<li>
						<span class="zwq">
						<img class="table-img" id="imagePreview1" src="../uploads/<?php echo $iList['picture']; ?>" onerror="this.src='https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'" style="background: url('https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'); width: 50px; height: 50px; background-size: contain; ">
								
						</span>
						<span class="stu-name"><?php echo $iList['first_name'].' '.$iList['last_name']; ?></span><br>
						( <?php echo $iList['student_id']; ?> )<br>
					<?php echo $db->getVal("select session from school_session where id='".$iList['session']."' and create_by_userid='".$create_by_userid."'"); ?><br>
					Term: <?php echo $db->getVal("select term from school_term where id='".$iList['term_id']."' and create_by_userid='".$create_by_userid."'"); ?> <br>
					Class: <?php echo $db->getVal("select short_name from school_class where id='".$iList['class']."' and create_by_userid='".$create_by_userid."'"); ?>

						</li>
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
		<div class="col-md-9" style="overflow: scroll;">
		<div class="zasw1">
		<div class="zqw22">
		<div class="panel with-nav-tabs panel-success">
		    <h4 class="text-center"><?php echo $studentName; ?></h4>
			<?php echo msg($stat); ?>
			<div class="topside-section">
				<ul>
					<li>
					<a style="<?php echo ($_SESSION['usertype']=='1' || $showSelect) ? 'display:none' : ''; ?>" href="javascript:del('<?php echo $FileName; ?>?action=delete_student&randomid=<?php echo $_GET['randomid']; ?>')">Delete Student</a>
					</li>
					<!--<li><a href="">Update Student Id</a>-->
					<!--</li>-->
					<li><a href="<?php SKOOL_URL;?>student_profile_pdf.php?randomid=<?php echo $_GET['randomid'];?>" class="<?php if($showSelect) echo 'hide-mobile'; ?>">Print Profile</a>
					</li>
					<li><a href="<?php SKOOL_URL;?>student_full_profile_pdf.php?randomid=<?php echo $_GET['randomid'];?>" class="<?php if($showSelect) echo 'hide-mobile'; ?>">Print Full Profile</a>
					</li>
				</ul>
			</div>
		<div class="panel-heading  <?php if($showSelect) echo 'hide-mobile'; ?>">
			<ul class="nav nav-tabs">
				<li class="<?php if($_GET['action']=='' || $_GET['action']=='student') { echo "active"; } ?>">
					<a href="<?php echo $FileName; ?>?action=student&randomid=<?php echo $_GET['randomid']; ?>">Student's Biodata</a>
				</li>
				<li class="<?php if($_GET['action']=='father') { echo "active"; } ?>" style="<?php if(!$showAdvanceEdit) echo 'color:#909090'; ?>">
					<a href="<?php echo $showAdvanceEdit ? ($FileName. '?action=father&randomid='. $_GET['randomid']) : '#'; ?>">Father's
					Info</a>
				</li>
				<li class="<?php if($_GET['action'] == 'mother') { echo "active"; } ?>" style="<?php if(!$showAdvanceEdit) echo 'color:#909090'; ?>">
					<a href="<?php echo $showAdvanceEdit ? ($FileName. '?action=mother&randomid='. $_GET['randomid']) : '#'; ?>">Mother's Info</a>
				</li>
				<li class="<?php if($_GET['action'] == 'guardian') { echo "active"; } ?>" style="<?php if(!$showAdvanceEdit) echo 'color:#909090'; ?>">
					<a href="<?php echo $showAdvanceEdit ? ($FileName. '?action=guardian&randomid='. $_GET['randomid']) : '#'; ?>">Guardian's Info</a>
				</li>
				<li class="<?php if($_GET['action'] == 'medical') { echo "active"; } ?>" style="<?php if(!$showAdvanceEdit) echo 'color:#909090'; ?>">
					<a href="<?php echo $showAdvanceEdit ? ($FileName. '?action=medical&randomid='. $_GET['randomid']) : '#'; ?>">Medical Information</a>
				</li>
			</ul>
		</div>
		<div class="panel-body  <?php if($showSelect) echo 'hide-mobile'; ?>">
		<div class="tab-content">
			<?php if($_GET['action']=='' || $_GET['action']=='student') { ?>
			<div class="tab-pane fade in active" id="tab1success">
				<div class="gwt-TabPanelBottom" role="tabpanel">
				<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
				<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;">
				<tbody>
				<tr class="top">
					<td class="topLeft"><div class="topLeftInner"></div></td>
					<td class="topCenter"><div class="topCenterInner"></div></td>
					<td class="topRight"><div class="topRightInner"></div></td>
				</tr>
				<tr class="middle">
					<td class="middleLeft"><div class="middleLeftInner"></div></td>
					<?php if($_GET['randomid']=='') { ?>
				
					<td class="middleCenter">
                    	<form action="" method="post" enctype="multipart/form-data">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Student ID* </div>
										<input type="text" class="gwt-TextBox" name="student_id" value="<?php echo $_POST['student_id']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name </div>
										<input type="text" class="form-control" name="last_name" value="<?php echo $_POST['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name </div>
										<input type="text" class="form-control" name="first_name" value="<?php echo $_POST['first_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Names </div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $_POST['other_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Gender: * </div>
										<fieldset id="setB">
											<label for="setB_male">Male</label>
											<input id="setB_male" type="radio" name="gender" value="Male" <?php if($_POST['gender']=='Male') { echo "checked"; } ?> />
										</fieldset>
										<fieldset id="setB">
											<label for="setB_female">Female</label>
											<input id="setB_female" type="radio" name="gender" value="Female" <?php if($_POST['gender']=='Female') { echo "checked"; } ?>/>
										</fieldset>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Date of Birth: </div>
										<input type="text" name="date_of_birth" class="gwt-DateBox datepicker" value="<?php echo $_POST['date_of_birth'] ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Nationality: </div>
										<select class="gwt-ListBox" name="nationality">
										<option value=""> Select Nationality </option>
										<?php 
										$aryDetail = $db->getRows("select * from  nationality order by id desc");
										foreach ($aryDetail as $iList) 
										{ $i=$i+1; 
										?>
										<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['nationality']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['country_name']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> No of Sibling: </div>
										<input type="text" name="number_of_sibling" value="<?php echo $_POST['number_of_sibling']; ?>" class="from-control">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Order Of Birth: </div>
										<input type="text" name="order_of_birth" value="<?php echo $_POST['order_of_birth']; ?>" class="from-control">
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Session Of Admission* </div>
										<select class="gwt-ListBox" name="session">
											<option value=""> Select Session </option>
											<?php 
											$aryDetail = $db->getRows("select * from  school_session where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ $i=$i+1; 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['session']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Class* </div>
										<select class="gwt-ListBox" name="class">
											<option value=""> Select Class </option>
											<?php 
											$aryDetail = $db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Term* </div>
										<select class="gwt-ListBox" name="term_id">
											<option value=""> Select Term </option>
											<?php 
											$aryDetail = $db->getRows("select * from school_term where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['term']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Date of Admission: </div>
										<input type="text" name="date_of_admission" class="gwt-DateBox datepicker" value="<?php echo $_POST['date_of_admission'] ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> State of Origin: </div>
										<select class="gwt-ListBox" name="state_of_origin">
											<option value=""> Select State Of Origin </option>
											<?php 
											$aryDetail = $db->getRows("select * from  state ");
											foreach ($aryDetail as $iList) 
											{ ?>
											<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['state_of_origin']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">LGA of Origin: </div>
										<select class="gwt-ListBox" name="lga_of_origin">
										<option value=""> Select LGA Origin </option>
										<?php 
										$aryDetail = $db->getRows("select * from  local_government order by id desc");
										foreach ($aryDetail as $iList) 
										{ ?>
										<option value="<?php echo $iList['id']; ?>" <?php if($_POST['lga_of_origin']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Religion: </div>
										<select class="gwt-ListBox" name="religion">
										<option value=""> SELECT RELIGION </option>
										<?php 
										$aryDetail = $db->getRows("select * from religion order by id desc");
										foreach ($aryDetail as $iList) 
										{
											?>
										<option value="<?php echo $iList['id']; ?>" <?php if($_POST['religion']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Percentage: </div>
										<input type="text" name="percentage" class="from-control" value="<?php echo $_POST['percentage']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Boarding </div>
										<input type="text" name="boarding" value="<?php echo $_POST['boarding'] ?>" class="from-control">
									</div>
								</div>
								<div class="col-md-2 hhf">
									<div class="beddy">
										<center><span class="bedd"> Picture</span> </center>
										<div style="text-align: center;">
										 	<img id="imagePreview2" src="../uploads/<?php echo $_POST['image']; ?>" onerror="this.src='https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'" style="background: url('https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'); width: 70px; height: 70px; background-size: contain; ">
									</div>
									</div>
									<div class="beddy-c">
										<input type="file" class="form-control" onchange="document.getElementById('imagePreview2').src = window.URL.createObjectURL(event.target.files[0]);" id="image" accept="image/png, image/jpeg, image/jpg" name="image" value="../uploads/<?php echo $_POST['image']; ?>">
									</div>
								</div>
							</div>
							<div class="row desh"></div>
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="gwt-Label"> Address Line 1: </div>
										<input type="text" class="from-control" name="address_1" value="<?php echo $_POST['address_1']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Address Line 2: </div>
										<input type="text" class="from-control" name="address_2" value="<?php echo $_POST['address_2']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> City: </div>
										<input type="text" class="from-control" name="city" value="<?php echo $_POST['city']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Mobile </div>
										<input type="text" class="from-control" name="mobile" value="<?php echo $_POST['mobile']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="gwt-Label"> P.O.Box: </div>
										<input type="text" class="from-control" name="p_o_box" value="<?php echo $_POST['p_o_box']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> State: </div>
										<select class="gwt-ListBox" name="state">
											<option value=""> Select State </option>
											<?php $aryDetail = $db->getRows("select * from state order by id desc");
											foreach ($aryDetail as $iList) 
											{
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if($_POST['state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Phone: </div>
										<input type="text" name="phone" class="from-control" value="<?php echo $_POST['phone']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Email: </div>
										<input type="text" name="email" class="from-control" value="<?php echo $_POST['email']; ?>"/>
									</div>
								</div>
							</div>
							<div class="row ssd">
								<button type="submit" name="add_student" class="gwt-Button"> Save basic Information </button>
							
							</div>
						</div>
					</div>
						</form>
                    </td>
					
					<?php } else { 
				//	$iStudentBio=$db->getRow("select * from manage_student where randomid='".$_GET['randomid']."'");
					?>
				
					<td class="middleCenter">
                    	<form action="" method="post" enctype="multipart/form-data">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Student ID* </div>
										<input type="text" class="gwt-TextBox" name="student_id" value="<?php echo $iStudentBio['student_id']; ?>" readonly  />
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name </div>
										<input type="text" class="form-control" name="last_name" value="<?php echo $iStudentBio['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name </div>
										<input type="text" class="form-control" name="first_name" value="<?php echo $iStudentBio['first_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Names </div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $iStudentBio['other_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Gender: * </div>
										<fieldset id="setB">
											<label for="setB_male">Male</label>
											<input id="setB_male" type="radio" name="gender" value="Male" <?php if($iStudentBio['gender']=='Male') { echo "checked"; } ?> />
										</fieldset>
										<fieldset id="setB">
											<label for="setB_female">Female</label>
											<input id="setB_female" type="radio" name="gender" value="Female" <?php if($iStudentBio['gender']=='Female') { echo "checked"; } ?>/>
										</fieldset>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Date of Birth: </div>
										<input type="text" name="date_of_birth" class="gwt-DateBox datepicker" value="<?php echo $iStudentBio['date_of_birth'] ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Nationality: </div>
										<select class="gwt-ListBox" name="nationality">
										<option value=""> Select Nationality </option>
										<?php 
										$aryDetail = $db->getRows("select * from  nationality order by id desc");
										foreach ($aryDetail as $iList) 
										{ $i=$i+1; 
										?>
										<option value="<?php echo $iList['id']; ?>" <?php if ($iStudentBio['nationality']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['country_name']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> No of Sibling: </div>
										<input type="text" name="number_of_sibling" value="<?php echo $iStudentBio['number_of_sibling']; ?>" class="from-control">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Order Of Birth: </div>
										<input type="text" name="order_of_birth" value="<?php echo $iStudentBio['order_of_birth']; ?>" class="from-control">
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Session Of Admission* </div>
										<select class="gwt-ListBox" name="session">
											<option value=""> Select Session </option>
											<?php 
											$aryDetail = $db->getRows("select * from  school_session where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ $i=$i+1; 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['session']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['session']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Term* </div>
										<select class="gwt-ListBox" name="term_id">
											<option value=""> Select Term </option>
											<?php 
											$aryDetail = $db->getRows("select * from school_term where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if ($iStudentBio['term_id']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['term']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12" style="<?php if($_SESSION['usertype']=='1') { echo "display:none"; } ?>" >
										<div class="gwt-Label">Class* </div>
										<select class="gwt-ListBox" name="class">
											<option value=""> Select Class </option>
											<?php 
											$aryDetail = $db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['class']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Date of Admission: </div>
										<input type="text" name="date_of_admission" class="gwt-DateBox datepicker" value="<?php echo $iStudentBio['date_of_admission'] ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> State of Origin: </div>
										<select class="gwt-ListBox" name="state_of_origin">
											<option value=""> Select State Of Origin </option>
											<?php 
											$aryDetail = $db->getRows("select * from  state ");
											foreach ($aryDetail as $iList) 
											{ ?>
											<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['state_of_origin']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">LGA of Origin: </div>
										<select class="gwt-ListBox" name="lga_of_origin">
										<option value=""> Select LGA Origin </option>
										<?php 
										$aryDetail = $db->getRows("select * from  local_government order by id desc");
										foreach ($aryDetail as $iList) 
										{ ?>
										<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['lga_of_origin']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Religion: </div>
										<select class="gwt-ListBox" name="religion">
										<option value=""> SELECT RELIGION </option>
										<?php 
										$aryDetail = $db->getRows("select * from religion order by id desc");
										foreach ($aryDetail as $iList) 
										{
											?>
										<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['religion']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Percentage: </div>
										<input type="text" name="percentage" class="from-control" value="<?php echo $iStudentBio['percentage']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Boarding </div>
										<input type="text" name="boarding" value="<?php echo $iStudentBio['boarding'] ?>" class="from-control">
									</div>
								</div>
								<div class="col-md-2 hhf">
									<div class="beddy">
										<center><span class="bedd">Picture</span> </center>
										<div style="text-align: center;">
										<img id="imagePreview3" src="../uploads/<?php echo $iStudentBio['picture']; ?>" onerror="this.src='https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'" style="background: url('https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1'); width: 70px; height: 70px; background-size: contain; ">
					            	    </div>
					            	</div>
									<div class="beddy-c">
										<input type="file" class="form-control" id="image" onchange="document.getElementById('imagePreview3').src = window.URL.createObjectURL(event.target.files[0]);" accept="image/png, image/jpeg, image/jpg" name="image" value="<?php echo $iStudentBio['picture']; ?>">
										<input type="hidden" class="form-control" id="image_old" name="image_old" value="<?php echo $iStudentBio['picture']; ?>">
									</div>
								</div>
							</div>
							<div class="row desh"></div>
							<div class="row">
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="gwt-Label"> Address Line 1: </div>
										<input type="text" class="from-control" name="address_1" value="<?php echo $iStudentBio['address_1']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Address Line 2: </div>
										<input type="text" class="from-control" name="address_2" value="<?php echo $iStudentBio['address_2']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> City: </div>
										<input type="text" class="from-control" name="city" value="<?php echo $iStudentBio['city']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Mobile </div>
										<input type="text" class="from-control" name="mobile" value="<?php echo $iStudentBio['mobile']; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="col-md-12">
										<div class="gwt-Label"> P.O.Box: </div>
										<input type="text" class="from-control" name="p_o_box" value="<?php echo $iStudentBio['p_o_box']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> State: </div>
										<select class="gwt-ListBox" name="state">
											<option value=""> Select State </option>
											<?php $aryDetail = $db->getRows("select * from state order by id desc");
											foreach ($aryDetail as $iList) 
											{
											?>
											<option value="<?php echo $iList['id']; ?>" <?php if($iStudentBio['state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Phone: </div>
										<input type="text" name="phone" class="from-control" value="<?php echo $iStudentBio['phone']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Email: </div>
										<input type="text" name="email" class="from-control" value="<?php echo $iStudentBio['email']; ?>"/>
									</div>
								</div>
							</div>
							<div class="row ssd">
								<button type="submit" name="edit_student" class="gwt-Button"> Save basic Information </button>
								<button type="" class="gwt-Button create-stu-btn"> 	
									<a href="student.php?action=student"> Create New Student </a>
								</button>
							</div>
						</div>
					</div>
                    </form>
					</td>
					
					<?php } ?>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
				</tbody>
				</table>
				</div>	
				</div>	
			</div>	
			<?php } 
			elseif($_GET['action']=='father') { 
			
			$iFatheDetsr=$db->getRow("select * from student_guardian where student_id='".$iStudent['id']."' and type=1 order by id asc");
			$iFather=$db->getRow("select * from student_guardian where student_id='".$iStudent['id']."' and type=1 order by id asc");
			?>
			<div class="tab-pane fade in active" id="tab1success">
			<div class="gwt-TabPanelBottom" role="tabpanel">
			<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;" aria-hidden="true">
			<?php if($iFather['id']=='') { ?>
			<form action="" method="post">
           
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width:100%;height:100%;" >
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
					<form action="" method="post">
						<td class="middleCenter">
						<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
						<div class="row ">
						<div class="col-md-5">
							<div class="col-md-12">
								<div class="gwt-Label"> Parent ID:* </div>
								<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $_POST['parent_id']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Title:* </div>
								<select class="gwt-ListBox" name="title">
									<option value=""> Select Title </option>
									<option value="Mr." <?php if($_POST['title']=='mr.') { echo "selected"; } ?>>Mr.</option>
									<option value="Mrs." <?php if($_POST['title']=='Mrs.') { echo "selected"; } ?>>Mrs.</option>
									<option value="Miss." <?php if($_POST['title']=='Miss.') { echo "selected"; } ?>>Miss</option>
									<option value="Dr." <?php if($_POST['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
									<option value="Prof." <?php if($_POST['title']=='Prof.') { echo "selected"; } ?>>Prof.</option>
									<option value="Alh." <?php if($_POST['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
									<option value="Malam." <?php if($_POST['title']=='Malam.') { echo "selected"; } ?>>Malam.</option>
									<option value="Hajia." <?php if($_POST['title']=='Hajia.') { echo "selected"; } ?>>Hajia.</option>
									<option value="Pst." <?php if($_POST['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
									<option value="Sen." <?php if ($_POST['title'] == 'Sen.') { echo "selected"; } ?>>Sen.</option>
									<option value="Barr." <?php if($_POST['title'] == 'Barr.') { echo "selected"; } ?>>Barr.</option>
								</select>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Last Name:* </div>
								<input type="text" class="from-control" name="last_name" value="<?php echo $_POST['last_name']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">Other Name:* </div>
								<input type="text" class="from-control" name="first_name" value="<?php echo $_POST['other_name']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">First Name:* </div>
								<input type="text" class="from-control" name="other_name" value="<?php echo $_POST['first_name']; ?>"/>
							</div>
						</div>
						<div class="col-md-5">
							<div class="col-md-12">
								<div class="gwt-Label"> Occupation:* </div>
								<input type="text" class="form-control" name="occupation" value="<?php echo $_POST['occupation']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"></div>
								<input type="hidden"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"></div>
								<input type="hidden"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Phone:* </div>
								<input type="text" class="form-control" name="phone" value="<?php echo $_POST['phone']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Email:* </div>
								<input type="text" class="form-control" name="email" value="<?php echo $_POST['email']; ?>"/>
							</div>
						</div>
						<div class="row desh"></div>
						<div class="row">
							<div class="col-md-5">
							<h5 class="address"> Home Address</h5>
							<div class="col-md-12">
								<div class="gwt-Label"> Address Line 1: </div>
								<input type="text" class="from-control" name="home_address_1" value="<?php echo $_POST['home_address_1']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">Address Line 2: </div>
								<input type="text" class="from-control" name="home_address_2" value="<?php echo $_POST['home_address_2']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">City:</div>
								<input type="text" class="from-control" name="home_city" value="<?php echo $_POST['home_city']; ?>">
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">State:</div>
								<select class="gwt-ListBox" name="home_state">
									<option value=""> Select State </option>
									<?php 
									$aryDetail = $db->getRows("select * from state order by id desc");
									foreach ($aryDetail as $iList) 
									{
									?>
									<option value="<?php echo $iList['id']; ?>" <?php if($_POST['home_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
									<?php } ?>
								</select>
							</div>
							</div>
							<div class="col-md-5">
								<h5 class="address"> Office Address</h5>
								<div class="col-md-12">
									<div class="gwt-Label"> Address Line 1: </div>
									<input type="text" class="from-control" name="office_address_1" value="<?php echo $_POST['office_address_1']; ?>"/>
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> Address Line 2: </div>
									<input type="text" class="from-control" name="office_address_2" value="<?php echo $_POST['office_address_2']; ?>"/>
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> City: </div>
									<input type="text" class="from-control" name="office_city" value="<?php echo $_POST['office_city']; ?>">
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> State: </div>
									<select class="gwt-ListBox" name="office_state">
										<option value=""> Select State </option>
										<?php 
										$aryDetail = $db->getRows("select * from state order by id desc");
										foreach ($aryDetail as $iList) 
										{
										?>
										<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['office_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						</div>
						</div>
						<button type="submit" name="add_father" class="gwt-Button"> Update </button>
						</div>
						</td>
					</form>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
			</form>
			<?php }  else { ?>
			<form action="" method="post">
             <input type="hidden" name="autoid" value="<?php echo $iFather['id']; ?>"  >
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
					<form action="" method="post">
						<td class="middleCenter">
						<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
						<div class="row ">
						<div class="col-md-5">
							<div class="col-md-12">
								<div class="gwt-Label"> Parent ID:* </div>
								<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $iFather['parent_id']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Title:* </div>
								<select class="gwt-ListBox" name="title">
									<option value=""> Select Title </option>
									<option value="Mr." <?php if($iFather['title']=='mr.') { echo "selected"; } ?>>Mr.</option>
									<option value="Mrs." <?php if($iFather['title']=='Mrs.') { echo "selected"; } ?>>Mrs.</option>
									<option value="Miss." <?php if($iFather['title']=='Miss.') { echo "selected"; } ?>>Miss</option>
									<option value="Dr." <?php if($iFather['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
									<option value="Prof." <?php if($iFather['title']=='Prof.') { echo "selected"; } ?>>Prof.</option>
									<option value="Alh." <?php if($iFather['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
									<option value="Malam." <?php if($iFather['title']=='Malam.') { echo "selected"; } ?>>Malam.</option>
									<option value="Hajia." <?php if($iFather['title']=='Hajia.') { echo "selected"; } ?>>Hajia.</option>
									<option value="Pst." <?php if($iFather['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
									<option value="Sen." <?php if ($iFather['title'] == 'Sen.') { echo "selected"; } ?>>Sen.</option>
									<option value="Barr." <?php if($iFather['title'] == 'Barr.') { echo "selected"; } ?>>Barr.</option>
								</select>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Last Name:* </div>
								<input type="text" class="from-control" name="last_name" value="<?php echo $iFather['last_name']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">Other Name:* </div>
								<input type="text" class="from-control" name="first_name" value="<?php echo $iFather['other_name']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">First Name:* </div>
								<input type="text" class="from-control" name="other_name" value="<?php echo $iFather['first_name']; ?>"/>
							</div>
						</div>
						<div class="col-md-5">
							<div class="col-md-12">
								<div class="gwt-Label"> Occupation:* </div>
								<input type="text" class="form-control" name="occupation" value="<?php echo $iFather['occupation']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"></div>
								<input type="hidden"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"></div>
								<input type="hidden"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Phone:* </div>
								<input type="text" class="form-control" name="phone" value="<?php echo $iFather['phone']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label"> Email:* </div>
								<input type="text" class="form-control" name="email" value="<?php echo $iFather['email']; ?>"/>
							</div>
						</div>
						<div class="row desh"></div>
						<div class="row">
							<div class="col-md-5">
							<h5 class="address"> Home Address</h5>
							<div class="col-md-12">
								<div class="gwt-Label"> Address Line 1: </div>
								<input type="text" class="from-control" name="home_address_1" value="<?php echo $iFather['home_address_1']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">Address Line 2: </div>
								<input type="text" class="from-control" name="home_address_2" value="<?php echo $iFather['home_address_2']; ?>"/>
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">City:</div>
								<input type="text" class="from-control" name="home_city" value="<?php echo $iFather['home_city']; ?>">
							</div>
							<div class="col-md-12">
								<div class="gwt-Label">State:</div>
								<select class="gwt-ListBox" name="home_state">
									<option value=""> Select State </option>
									<?php 
									$aryDetail = $db->getRows("select * from state order by id desc");
									foreach ($aryDetail as $iList) 
									{
									?>
									<option value="<?php echo $iList['id']; ?>" <?php if($iFather['home_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
									<?php } ?>
								</select>
							</div>
							</div>
							<div class="col-md-5">
								<h5 class="address"> Office Address</h5>
								<div class="col-md-12">
									<div class="gwt-Label"> Address Line 1: </div>
									<input type="text" class="from-control" name="office_address_1" value="<?php echo $iFather['office_address_1']; ?>"/>
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> Address Line 2: </div>
									<input type="text" class="from-control" name="office_address_2" value="<?php echo $iFather['office_address_2']; ?>"/>
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> City: </div>
									<input type="text" class="from-control" name="office_city" value="<?php echo $iFather['office_city']; ?>">
								</div>
								<div class="col-md-12">
									<div class="gwt-Label"> State: </div>
									<select class="gwt-ListBox" name="office_state">
										<option value=""> Select State </option>
										<?php 
										$aryDetail = $db->getRows("select * from state order by id desc");
										foreach ($aryDetail as $iList) 
										{
										?>
										<option value="<?php echo $iList['id']; ?>" <?php if($iFather['office_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						</div>
						</div>
						<button type="submit" name="edit_father" class="gwt-Button"> Update </button>
						</div>
						</td>
					</form>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
			</form>
			<?php } ?>
			
			</div>
			</div>
			</div>
			<?php } elseif($_GET['action']=='mother') 
					{ 
			$iMotherDetail=$db->getRow("select * from student_guardian where student_id='".$iStudent['id']."' and type=2 order by id asc");
			
			$iMother=$db->getRow("select * from student_guardian where student_id='".$iStudent['id']."' and type=2 order by id asc");
			?>
			<div class="tab-pane fade in active" id="tab1success">
			<div class="gwt-TabPanelBottom" role="tabpanel">
			<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;" aria-hidden="true">
			<?php if($iMother['id']=='') { ?>
			<form action="" method="POST">
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
			<tr class="top">
				<td class="topLeft">
					<div class="topLeftInner"></div>
				</td>
				<td class="topCenter">
					<div class="topCenterInner"></div>
				</td>
				<td class="topRight">
					<div class="topRightInner"></div>
				</td>
			</tr>
			<tr class="middle">
				<td class="middleLeft">
					<div class="middleLeftInner"></div>
				</td>
				<td class="middleCenter">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label">Parent ID:* </div>
										<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $_POST['parent_id']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Title:* </div>
										<select class="gwt-ListBox" name="title">
											<option value=""> Select Title </option>
											<option value="Mr." <?php if($_POST['title']=='mr.') { echo "selected"; } ?>> Mr. </option>
											<option value="Mrs."<?php if($_POST['title'] == 'Mrs.') { echo "selected"; } ?>> Mrs. </option>
											<option value="Miss."<?php if($_POST['title']=='Miss.') { echo "selected"; } ?>> Miss. </option>
											<option value="Dr."<?php if($_POST['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
											<option value="Prof." <?php if($_POST['title']=='Prof.') { echo "selected"; } ?>> Prof.</option>
											<option value="Alh." <?php if($_POST['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
											<option value="Malam." <?php if($_POST['title']=='Malam.') { echo "selected"; } ?>> Malam.</option>
											<option value="Hajia."<?php if($_POST['title']=='Hajia.') { echo "selected"; } ?>>
											Hajia. </option>
											<option value="Pst." <?php if($_POST['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
											<option value="Sen."<?php if($_POST['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
											<option value="Barr." <?php if($_POST['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name:* </div>
										<input type="text" class="from-control" name="last_name" value="<?php echo $_POST['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Name:* </div>
										<input type="text" class="from-control" name="first_name" value="<?php echo $_POST['other_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name:*</div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $_POST['first_name']; ?>"/>
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Occupation:* </div>
										<input type="text" class="form-control" name="occupation" value="<?php echo $_POST['occupation']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"></div>
										<input type="hidden"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"></div>
										<input type="hidden"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Phone:* </div>
										<input type="text" class="form-control" name="phone" value="<?php echo $_POST['phone']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Email:* </div>
										<input type="text" class="form-control" name="email" value="<?php echo $_POST['email']; ?>"/>
									</div>
								</div>
								<div class="row desh"></div>
								<div class="row">
									<div class="col-md-5">
										<h5 class="address"> Home Address</h5>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 1: </div>
											<input type="text" class="from-control" name="home_address_1" value="<?php echo $_POST['home_address_1']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 2: </div>
											<input type="text" class="from-control" name="home_address_2" value="<?php echo $_POST['home_address_2']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label">City:</div>
											<input type="text" class="from-control" name="home_city" value="<?php echo $_POST['home_city']; ?>">
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> State: </div>
											<select class="gwt-ListBox" name="home_state">
												<option value=""> Select State </option>
												<?php 
												$aryDetail = $db->getRows("select * from state ");
												foreach($aryDetail as $iList) 
												{
												?>
												<option value="<?php echo $iList['id']; ?>" <?php if ($_POST['home_state'] == $iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-5">
										<h5 class="address"> Office Address</h5>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 1: </div>
											<input type="text" class="from-control" name="office_address_1" value="<?php echo $_POST['office_address_1']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 2: </div>
											<input type="text" class="from-control" name="office_address_2" value="<?php echo $_POST['office_address_2']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label">City:</div>
											<input type="text" class="from-control" name="office_city" value="<?php echo $_POST['office_city']; ?>">
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> State: </div>
											<select class="gwt-ListBox" name="office_state">
												<option value=""> Select State </option>
												<?php 
												$aryDetail = $db->getRows("select * from state");
												foreach($aryDetail as $iList) 
												{
												?>
												<option value="<?php echo $iList['id']; ?>" <?php if($_POST['office_state']== $iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" name="add_mother" class="gwt-Button">Update</button>
					</div>
				</td>
				<td class="middleRight">
					<div class="middleRightInner"></div>
				</td>
			</tr>
			<tr class="bottom">
				<td class="bottomLeft">
					<div class="bottomLeftInner"></div>
				</td>
				<td class="bottomCenter">
					<div class="bottomCenterInner"></div>
				</td>
				<td class="bottomRight">
					<div class="bottomRightInner"></div>
				</td>
			</tr>
			</tbody>
			</table>
			</form>
			
			<?php } else { ?>
			
			<form action="" method="post">
             <input type="hidden" name="autoid" value="<?php echo $iMother['id']; ?>"  >
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
			<tr class="top">
				<td class="topLeft">
					<div class="topLeftInner"></div>
				</td>
				<td class="topCenter">
					<div class="topCenterInner"></div>
				</td>
				<td class="topRight">
					<div class="topRightInner"></div>
				</td>
			</tr>
			<tr class="middle">
				<td class="middleLeft">
					<div class="middleLeftInner"></div>
				</td>
				<td class="middleCenter">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label">Parent ID:* </div>
										<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $iMother['parent_id']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Title:* </div>
										<select class="gwt-ListBox" name="title">
											<option value=""> Select Title </option>
											<option value="Mr." <?php if($iMother['title']=='mr.') { echo "selected"; } ?>> Mr. </option>
											<option value="Mrs."<?php if($iMother['title'] == 'Mrs.') { echo "selected"; } ?>> Mrs. </option>
											<option value="Miss."<?php if($iMother['title']=='Miss.') { echo "selected"; } ?>> Miss. </option>
											<option value="Dr."<?php if($iMother['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
											<option value="Prof." <?php if($iMother['title']=='Prof.') { echo "selected"; } ?>> Prof.</option>
											<option value="Alh." <?php if($iMother['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
											<option value="Malam." <?php if($iMother['title']=='Malam.') { echo "selected"; } ?>> Malam.</option>
											<option value="Hajia."<?php if($iMother['title']=='Hajia.') { echo "selected"; } ?>>
											Hajia. </option>
											<option value="Pst." <?php if($iMother['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
											<option value="Sen."<?php if($iMother['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
											<option value="Barr." <?php if($iMother['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name:* </div>
										<input type="text" class="from-control" name="last_name" value="<?php echo $iMother['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Name:* </div>
										<input type="text" class="from-control" name="first_name" value="<?php echo $iMother['other_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name:*</div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $iMother['first_name']; ?>"/>
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Occupation:* </div>
										<input type="text" class="form-control" name="occupation" value="<?php echo $iMother['occupation']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"></div>
										<input type="hidden"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"></div>
										<input type="hidden"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Phone:* </div>
										<input type="text" class="form-control" name="phone" value="<?php echo $iMother['phone']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Email:* </div>
										<input type="text" class="form-control" name="email" value="<?php echo $iMother['email']; ?>"/>
									</div>
								</div>
								<div class="row desh"></div>
								<div class="row">
									<div class="col-md-5">
										<h5 class="address"> Home Address</h5>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 1: </div>
											<input type="text" class="from-control" name="home_address_1" value="<?php echo $iMother['home_address_1']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 2: </div>
											<input type="text" class="from-control" name="home_address_2" value="<?php echo $iMother['home_address_2']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label">City:</div>
											<input type="text" class="from-control" name="home_city" value="<?php echo $iMother['home_city']; ?>">
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> State: </div>
											<select class="gwt-ListBox" name="home_state">
												<option value=""> Select State </option>
												<?php 
												$aryDetail = $db->getRows("select * from state ");
												foreach($aryDetail as $iList) 
												{
												?>
												<option value="<?php echo $iList['id']; ?>" <?php if ($iMother['home_state'] == $iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-5">
										<h5 class="address"> Office Address</h5>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 1: </div>
											<input type="text" class="from-control" name="office_address_1" value="<?php echo $iMother['office_address_1']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Address Line 2: </div>
											<input type="text" class="from-control" name="office_address_2" value="<?php echo $iMother['office_address_2']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label">City:</div>
											<input type="text" class="from-control" name="office_city" value="<?php echo $iMother['office_city']; ?>">
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> State: </div>
											<select class="gwt-ListBox" name="office_state">
												<option value=""> Select State </option>
												<?php 
												$aryDetail = $db->getRows("select * from state");
												foreach($aryDetail as $iList) 
												{
												?>
												<option value="<?php echo $iList['id']; ?>" <?php if($iMother['office_state']== $iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
						<button type="submit" name="edit_mother" class="gwt-Button">Update</button>
					</div>
				</td>
				<td class="middleRight">
					<div class="middleRightInner"></div>
				</td>
			</tr>
			<tr class="bottom">
				<td class="bottomLeft">
					<div class="bottomLeftInner"></div>
				</td>
				<td class="bottomCenter">
					<div class="bottomCenterInner"></div>
				</td>
				<td class="bottomRight">
					<div class="bottomRightInner"></div>
				</td>
			</tr>
			</tbody>
			</table>
			</form>
			<?php } ?>
			
			
			
			</div>
			</div>
			</div>
			<?php }
			 		elseif($_GET['action']=='guardian')
					{ 
			$iGuardianDetail=$db->getRow("select * from student_guardian where student_id='".$iStudent['id']."' and type=3 order by id asc");
			
			$iGuardian=$db->getRow("select * from student_guardian where parent_id='".$iGuardianDetail['parent_id']."' and type=3 order by id asc");
			?>
			<div class="tab-pane fade in active" id="tab1success">
			<div class="gwt-TabPanelBottom" role="tabpanel">
			<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;" aria-hidden="true">
			<?php if($iGuardian['student_id']=='') { ?>
			<form action="" method="post">
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
						<div class="zqw22">
							<div class="panel with-nav-tabs panel-success">
								<div class="row ">
									<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Parent ID:* </div>
										<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $_POST['parent_id']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Title:* </div>
										<select class="gwt-ListBox" name="title">
											<option value=""> Select Title </option>
											<option value="Mr." <?php if($_POST['title']=='mr.') { echo "selected"; } ?>> Mr. </option>
											<option value="Mrs."<?php if($_POST['title'] == 'Mrs.') { echo "selected"; } ?>> Mrs. </option>
											<option value="Miss."<?php if($_POST['title']=='Miss.') { echo "selected"; } ?>> Miss. </option>
											<option value="Dr."<?php if($_POST['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
											<option value="Prof." <?php if($_POST['title']=='Prof.') { echo "selected"; } ?>> Prof.</option>
											<option value="Alh." <?php if($_POST['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
											<option value="Malam." <?php if($_POST['title']=='Malam.') { echo "selected"; } ?>> Malam.</option>
											<option value="Hajia."<?php if($_POST['title']=='Hajia.') { echo "selected"; } ?>>
											Hajia. </option>
											<option value="Pst." <?php if($_POST['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
											<option value="Sen."<?php if($_POST['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
											<option value="Barr." <?php if($_POST['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name:* </div>
										<input type="text" class="from-control" name="last_name" value="<?php echo $_POST['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Name:* </div>
										<input type="text" class="from-control" name="first_name" value="<?php echo $_POST['first_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name:* </div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $_POST['other_name']; ?>"/>
									</div>
									</div>
									<div class="col-md-5">
										<div class="col-md-12">
											<div class="gwt-Label"> Occupation:* </div>
											<input type="text" class="form-control" name="occupation" value="<?php echo $_POST['occupation']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"></div>
											<input type="hidden"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"></div>
											<input type="hidden"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Phone:* </div>
											<input type="text" class="form-control" name="phone" value="<?php echo $_POST['phone']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Email:* </div>
											<input type="text" class="form-control" name="email" value="<?php echo $_POST['email']; ?>"/>
										</div>
									</div>
									<div class="row desh"></div>
									<div class="row">
										<div class="col-md-5">
											<h5 class="address"> Home Address</h5>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 1: </div>
												<input type="text" class="from-control" name="home_address_1" value="<?php echo $_POST['home_address_1']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 2: </div>
												<input type="text" class="from-control" name="home_address_2" value="<?php echo $_POST['home_address_2']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> City: </div>
												<input type="text" class="from-control" name="home_city" value="<?php echo $_POST['home_city']; ?>">
											</div>
											<div class="col-md-12">
												<div class="gwt-Label">State:</div>
												<select class="gwt-ListBox" name="home_state">
													<option value="">Select State</option>
													<?php 
													$aryDetail = $db->getRows("select * from state ");
													foreach($aryDetail as $iList) 
													{
													 ?>
													<option value="<?php echo $iList['id']; ?>" <?php if($_POST['home_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-5">
											<h5 class="address">Office Address</h5>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 1: </div>
												<input type="text" class="from-control" name="office_address_1" value="<?php echo $_POST['office_address_1']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 2: </div>
												<input type="text" class="from-control" name="office_address_2" value="<?php echo $_POST['office_address_2']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> City: </div>
												<input type="text" class="from-control" name="office_city" value="<?php echo $_POST['office_city']; ?>">
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> State: </div>
												<select class="gwt-ListBox" name="office_state">
													<option value=""> Select State </option>
													<?php 
													$aryDetail = $db->getRows("select * from state ");
													foreach($aryDetail as $iList) 
													{
													?>
													<option value="<?php echo $iList['id']; ?>" <?php if($_POST['office_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" name="add_guardian" class="gwt-Button"> Update </button>
						</div>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
			</form>
			
			
				<?php } else { ?>
			
			<form action="" method="post">
             <input type="hidden" name="autoid" value="<?php echo $iGuardian['randomid']; ?>"  >
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
						<div class="zqw22">
							<div class="panel with-nav-tabs panel-success">
								<div class="row ">
									<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Parent ID:* </div>
										<input type="text" class="gwt-TextBox" name="parent_id" value="<?php echo $iGuardian['parent_id']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Title:* </div>
										<select class="gwt-ListBox" name="title">
											<option value=""> Select Title </option>
											<option value="Mr." <?php if($iGuardian['title']=='mr.') { echo "selected"; } ?>> Mr. </option>
											<option value="Mrs."<?php if($iGuardian['title'] == 'Mrs.') { echo "selected"; } ?>> Mrs. </option>
											<option value="Miss."<?php if($iGuardian['title']=='Miss.') { echo "selected"; } ?>> Miss. </option>
											<option value="Dr."<?php if($iGuardian['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
											<option value="Prof." <?php if($iGuardian['title']=='Prof.') { echo "selected"; } ?>> Prof.</option>
											<option value="Alh." <?php if($iGuardian['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
											<option value="Malam." <?php if($iGuardian['title']=='Malam.') { echo "selected"; } ?>> Malam.</option>
											<option value="Hajia."<?php if($iGuardian['title']=='Hajia.') { echo "selected"; } ?>>
											Hajia. </option>
											<option value="Pst." <?php if($iGuardian['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
											<option value="Sen."<?php if($iGuardian['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
											<option value="Barr." <?php if($iGuardian['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
										</select>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Last Name:* </div>
										<input type="text" class="from-control" name="last_name" value="<?php echo $iGuardian['last_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Other Name:* </div>
										<input type="text" class="from-control" name="first_name" value="<?php echo $iGuardian['first_name']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> First Name:* </div>
										<input type="text" class="from-control" name="other_name" value="<?php echo $iGuardian['other_name']; ?>"/>
									</div>
									</div>
									<div class="col-md-5">
										<div class="col-md-12">
											<div class="gwt-Label"> Occupation:* </div>
											<input type="text" class="form-control" name="occupation" value="<?php echo $iGuardian['occupation']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"></div>
											<input type="hidden"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"></div>
											<input type="hidden"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Phone:* </div>
											<input type="text" class="form-control" name="phone" value="<?php echo $iGuardian['phone']; ?>"/>
										</div>
										<div class="col-md-12">
											<div class="gwt-Label"> Email:* </div>
											<input type="text" class="form-control" name="email" value="<?php echo $iGuardian['email']; ?>"/>
										</div>
									</div>
									<div class="row desh"></div>
									<div class="row">
										<div class="col-md-5">
											<h5 class="address"> Home Address</h5>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 1: </div>
												<input type="text" class="from-control" name="home_address_1" value="<?php echo $iGuardian['home_address_1']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 2: </div>
												<input type="text" class="from-control" name="home_address_2" value="<?php echo $iGuardian['home_address_2']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> City: </div>
												<input type="text" class="from-control" name="home_city" value="<?php echo $iGuardian['home_city']; ?>">
											</div>
											<div class="col-md-12">
												<div class="gwt-Label">State:</div>
												<select class="gwt-ListBox" name="home_state">
													<option value="">Select State</option>
													<?php 
													$aryDetail = $db->getRows("select * from state ");
													foreach($aryDetail as $iList) 
													{
													 ?>
													<option value="<?php echo $iList['id']; ?>" <?php if($iGuardian['home_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-5">
											<h5 class="address">Office Address</h5>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 1: </div>
												<input type="text" class="from-control" name="office_address_1" value="<?php echo $iGuardian['office_address_1']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> Address Line 2: </div>
												<input type="text" class="from-control" name="office_address_2" value="<?php echo $iGuardian['office_address_2']; ?>"/>
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> City: </div>
												<input type="text" class="from-control" name="office_city" value="<?php echo $iGuardian['office_city']; ?>">
											</div>
											<div class="col-md-12">
												<div class="gwt-Label"> State: </div>
												<select class="gwt-ListBox" name="office_state">
													<option value=""> Select State </option>
													<?php 
													$aryDetail = $db->getRows("select * from state ");
													foreach($aryDetail as $iList) 
													{
													?>
													<option value="<?php echo $iList['id']; ?>" <?php if($iGuardian['office_state']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['title']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" name="edit_guardian" class="gwt-Button"> Update </button>
						</div>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
			</form>
			<?php } ?>
			</div>
			</div>
			</div>
			<?php } 
					elseif($_GET['action']=='medical') 
					{ 
			$iMedical=$db->getRow("select * from student_medical_info where student_id='".$iStudent['id']."'");
			
			?>
			<div class="tab-pane fade in active" id="tab1success">
			<div class="gwt-TabPanelBottom" role="tabpanel">
			<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;" aria-hidden="true">
				<?php if($iMedical['student_id']=='') { ?>
			<form action="" method="post">
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Immunization Update </div>
										<input type="text" class="gwt-TextBox" name="immunization_update" value="<?php echo $_POST['immunization_update']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Medical Prescription and Dosage </div>
										<textarea name="medical_prescription_dosage" value=""><?php echo $_POST['medical_prescription_dosage']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Hospital Address </div>
										<textarea name="hospital_address" value=""><?php echo $_POST['hospital_address']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Doctor's Name </div>
										<input type="text" class="gwt-TextBox" name="doctor_name" value="<?php echo $_POST['doctor_name']; ?>">
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label">Any Allergy</div>
										<input type="text" class="gwt-TextBox" name="any_allergy" value="<?php echo $_POST['any_allergy']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Consent non-prescription Medicine? </div>
										<input type="checkbox" class="gwt-TextBox" name="consent_non_prescription_medicine" value="1" <?php if ($_POST['consent_non_prescription_medicine']=='1') { echo "checked"; } ?>>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Any Health Issues </div>
										<textarea name="any_health_issue" value=""><?php echo $_POST['any_health_issue']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Doctor's Phone </div>
										<input type="text" class="form-control" name="doctor_phone" value="<?php echo $_POST['doctor_phone']; ?>"/>
									</div>
								</div>
								<button type="submit" name="add_medical" class="gwt-Button"> Save Medical Info </button>
							</div>
						</div>
					</div>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
			</form>
				<?php } else { ?>
			<form action="" method="post">
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;" aria-hidden="true">
			<tbody>
				<tr class="top">
					<td class="topLeft">
						<div class="topLeftInner"></div>
					</td>
					<td class="topCenter">
						<div class="topCenterInner"></div>
					</td>
					<td class="topRight">
						<div class="topRightInner"></div>
					</td>
				</tr>
				<tr class="middle">
					<td class="middleLeft">
						<div class="middleLeftInner"></div>
					</td>
					<td class="middleCenter">
					<div class="zqw22">
						<div class="panel with-nav-tabs panel-success">
							<div class="row ">
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label"> Immunization Update </div>
										<input type="text" class="gwt-TextBox" name="immunization_update" value="<?php echo $iMedical['immunization_update']; ?>"/>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label">Medical Prescription and Dosage </div>
										<textarea name="medical_prescription_dosage" value=""><?php echo $iMedical['medical_prescription_dosage']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Hospital Address </div>
										<textarea name="hospital_address" value=""><?php echo $iMedical['hospital_address']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Doctor's Name </div>
										<input type="text" class="gwt-TextBox" name="doctor_name" value="<?php echo $iMedical['doctor_name']; ?>">
									</div>
								</div>
								<div class="col-md-5">
									<div class="col-md-12">
										<div class="gwt-Label">Any Allergy</div>
										<input type="text" class="gwt-TextBox" name="any_allergy" value="<?php echo $iMedical['any_allergy']; ?>">
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Consent non-prescription Medicine? </div>
										<input type="checkbox" class="gwt-TextBox" name="consent_non_prescription_medicine" value="1" <?php if ($iMedical['consent_non_prescription_medicine']=='1') { echo "checked"; } ?>>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Any Health Issues </div>
										<textarea name="any_health_issue" value=""><?php echo $iMedical['any_health_issue']; ?></textarea>
									</div>
									<div class="col-md-12">
										<div class="gwt-Label"> Doctor's Phone </div>
										<input type="text" class="form-control" name="doctor_phone" value="<?php echo $iMedical['doctor_phone']; ?>"/>
									</div>
								</div>
								<button type="submit" name="add_medical" class="gwt-Button"> Save Medical Info </button>
							</div>
						</div>
					</div>
					</td>
					<td class="middleRight">
						<div class="middleRightInner"></div>
					</td>
				</tr>
				<tr class="bottom">
					<td class="bottomLeft">
						<div class="bottomLeftInner"></div>
					</td>
					<td class="bottomCenter">
						<div class="bottomCenterInner"></div>
					</td>
					<td class="bottomRight">
						<div class="bottomRightInner"></div>
					</td>
				</tr>
			</tbody>
			</table>
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
		</div>
	</div>
	</div>
	</div>
</div>
</div>
</div>
<?php include('inc.footer.php'); ?>
</div>

<?php include('inc.js.php'); ?>


<script>
(function () {
$(function () {
var toggle;
return toggle = new Toggle('.zswqas');
});

this.Toggle = (function () {
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
btns[i].addEventListener("click", function () {
var current = document.getElementsByClassName("active");
current[0].className = current[0].className.replace(" active", "");
this.className += " active";
});
}
</script>
<script>
$(document).ready(function () {
$('#example1').DataTable();
});
</script>
<script>
$(document).ready(function () {
$('#example').DataTable();
});
</script>
<script>
$(document).ready(function () {
$('#example2').DataTable();
});

$('#example').dataTable( {
    "pageLength": 5
});
</script>
</body>
</html>