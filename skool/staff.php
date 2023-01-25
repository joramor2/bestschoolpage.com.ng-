<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Manage Staff";
$FileName = 'staff.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}

$staffid=$db->getrow("select * from staff_manage where randomid='".$_GET['randomid']."'");	

if(isset($_POST['add_staff_detail']))
{
	$validate->addRule($_POST['staff_id'],'','Staff Id',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['phone'],'','Phone',true);
	$validate->addRule($_POST['email'],'email','Email',true);
			
	if($validate->validate() && count($stat)==0)
	{
		$iAlreadyStaffId=$db->getVal("select id from staff_manage where staff_id='".$_POST['staff_id']."'");
					
		if($iAlreadyStaffId=='')
		{ 
			if(isset($_FILES["picture"]["name"]) && !empty($_FILES["picture"]["name"]))
			{
				$filename = basename($_FILES['picture']['name']);
				$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
				if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
				{ 	  
					$newfile1=md5(time())."_".$filename;
					move_uploaded_file($_FILES['picture']['tmp_name'],"../uploads/".$newfile1);
				}				
			}
			if(isset($_FILES["signature"]["name"]) && !empty($_FILES["signature"]["name"]))
			{
				$filename = basename($_FILES['signature']['name']);
				$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
				if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
				{ 	  
					$newfile=md5(time())."_".$filename;
					move_uploaded_file($_FILES['signature']['tmp_name'],"../uploads/".$newfile);
				}				
			}					
			
			$iLastId=$db->getVal("select id from staff_manage order by id desc")+1;		
			$randomId=randomFix(15).'-'.$iLastId;
			
			$aryData=array(	
							'usertype'                    =>	$_SESSION['usertype'],
							'userid'                      =>	$_SESSION['userid'],
							'staff_id'                    =>	$_POST['staff_id'],
							'gender'                      =>	$_POST['gender'],
							'title'                   	  =>	$_POST['title'],
							'date_of_birth'  			  =>	$_POST['date_of_birth'],
							'last_name'                   =>	$_POST['last_name'],	
							'first_name'                  =>	$_POST['first_name'],
							'date_of_appointment'         =>	$_POST['date_of_appointment'], 
							'state_of_origin'             =>	$_POST['state_of_origin'],
							'other_name'                  =>	$_POST['other_name'],
							'lga_of_origin'               =>	$_POST['lga_of_origin'],
							'marrital_status'  			  =>	$_POST['marrital_status'],		
							'religion'  			      =>	$_POST['religion'],	
							'nationality'  			      =>	$_POST['nationality'],	   
							'denomination'  			  =>	$_POST['denomination'],	
							'no_of_children'              =>	$_POST['no_of_children'],
							'branch'  			          =>	$_POST['branch'],	
							'blood_group'  			      =>	$_POST['blood_group'],
							'genotype'  			      =>	$_POST['genotype'],				
							'address_1'                   =>	$_POST['address_1'],
							'address_2'  			      =>	$_POST['address_2'],		
							'state'  			          =>	$_POST['state'],
							'city'                        =>	$_POST['city'],				
							'p_o_box'                     =>	$_POST['p_o_box'],
							'email'  			          =>	$_POST['email'],	
							'phone'                    	  =>	$_POST['phone'],
							'initials'  			      =>	$_POST['initials'],
							'picture'                     =>	$newfile1,
							'signature'                   =>	$newfile,
							'create_by_usertype'          =>	$create_by_usertype,
							'create_by_userid'  		  =>	$create_by_userid,
							'randomid'  			      =>	$randomId,	 
							);  
					$flgIn = $db->insertAry("staff_manage",$aryData);
					
			$aryData=array(	
							'username'			=>	$_POST['staff_id'],
							'name'				=>	$_POST['first_name'].' '.$_POST['last_name'],
							'email'				=>	$_POST['email'],
							'contact_no'		=>	$_POST['phone'],
							'password'			=>	randomFix(6),
							'status'			=>	0,
							'walletamount'		=>	0,
							'usertype'			=>	1,	
							'create_by_usertype'=>	$create_by_usertype,
							'create_by_userid'  =>	$create_by_userid,	
							);  
					$flgIn1 = $db->insertAry("school_register",$aryData);
						
                    $_SESSION['success'] = "Submitted Successfully";	
					redirect($FileName.'?action=basic_info&randomid='.$randomId);	
		}
		else 
		{
			$stat['error'] = "This Staff ID is already exist.";
		}
	}
	else    
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_staff_detail']))
{        
	$validate->addRule($_POST['staff_id'],'','Staff Id',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['phone'],'','Phone',true);
	$validate->addRule($_POST['email'],'email','Email',true);
	
	if($validate->validate() && count($stat)==0)
	{
		$iAlreadyStaffId=$db->getVal("select id from staff_manage where staff_id='".$_POST['staff_id']."' and randomid!='".$_GET['randomid']."'");
					
		if($iAlreadyStaffId=='')
		{
		if(isset($_FILES["picture"]["name"]) && !empty($_FILES["picture"]["name"]))
		{
			$filename = basename($_FILES['picture']['name']);
			$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
			if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
			{ 	  
				$newfile1=md5(time())."_".$filename;
				move_uploaded_file($_FILES['picture']['tmp_name'],"../uploads/".$newfile1);
			}				
		}
		else { $newfile1 =$_POST['picture_old']; }
		
		if(isset($_FILES["signature"]["name"]) && !empty($_FILES["signature"]["name"]))
		{
			$filename = basename($_FILES['signature']['name']);
			$ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
			if(in_array($ext1,array('jpg','png', 'gif','jpeg')))
			{ 	  
				$newfile=md5(time())."_".$filename;
				move_uploaded_file($_FILES['signature']['tmp_name'],"../uploads/".$newfile);
			}				
		}	
		else { $newfile =$_POST['signature_old']; }	
		
		$staffidDetasss=$db->getrow("select * from staff_manage where randomid='".$_GET['randomid']."'");			

		$aryData=array(	
						'staff_id'							=>	$_POST['staff_id'],
						'gender'							=>	$_POST['gender'],
						'title'								=>	$_POST['title'],
						'date_of_birth'						=>	$_POST['date_of_birth'],
						'last_name'							=>	$_POST['last_name'],	
						'first_name'						=>	$_POST['first_name'],
						'date_of_appointment'				=>	$_POST['date_of_appointment'], 
						'state_of_origin'					=>	$_POST['state_of_origin'],
						'other_name'						=>  $_POST['other_name'],
						'lga_of_origin'						=>	$_POST['lga_of_origin'],
						'marrital_status'					=>	$_POST['marrital_status'],		
						'religion'							=>	$_POST['religion'],	
						'nationality'						=>	$_POST['nationality'],	   
						'denomination'						=>  $_POST['denomination'],	
						'no_of_children'					=>	$_POST['no_of_children'],
						'branch'							=>	$_POST['branch'],	
						'blood_group'						=>	$_POST['blood_group'],
						'genotype'							=>	$_POST['genotype'],				
						'address_1'							=>	$_POST['address_1'],
						'address_2'							=>	$_POST['address_2'],		
						'state'								=>	$_POST['state'],
						'city'								=>	$_POST['city'],				
						'p_o_box'							=>	$_POST['p_o_box'],
						'email'								=>	$_POST['email'],	
						'phone'								=>	$_POST['phone'],
						'mobile'							=> 	$_POST['mobile'],
						'picture'							=>	$newfile1,
						'signature'							=>	$newfile,
						);  
			$flgIn1 = $db->updateAry("staff_manage",$aryData, "where randomid='".$_GET['randomid']."'");
			
				
			
			$aryData=array(	
					'username'			=>	$_POST['staff_id'],
					'name'				=>	$_POST['first_name'].' '.$_POST['last_name'],
					'email'				=>	$_POST['email'],
					'contact_no'		=>	$_POST['phone'],
					 
					);  
			$flgIn1 = $db->updateAry("school_register",$aryData, "where username='".$staffidDetasss['staff_id']."'");
				 
			$_SESSION['success'] = "Updated Successfully";			
			redirect($FileName.'?action=basic_info&randomid='.$_GET['randomid']);		
		}
		else 
		{
			$stat['error'] = "This Staff ID is already exist.";
		}
	}
	else    
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['add_next_of_kin_details']))
{                
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['phone'],'','Phone',true);

	if($validate->validate() && count($stat)==0)
	{
		$iLastId=$db->getVal("select id from staff_manage_kin_details order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;	  	 
				
		$aryData=array(	
						'usertype'                   	=>	$_SESSION['usertype'],
						'userid'                      	=>	$_SESSION['userid'],
						'staff_manage_id'				=>	$staffid['id'],
						'first_name'					=>	$_POST['first_name'],     
						'last_name'						=>	$_POST['last_name'],
						'relationship'					=>	$_POST['relationship'],
						'phone'							=>	$_POST['phone'],
						'email'							=>	$_POST['email'],
						'other_name'					=>	$_POST['other_name'],
						'address_1'						=>	$_POST['address_1'],
						'address_2'						=>	$_POST['address_2'],
						'create_by_usertype'			=>	$create_by_usertype,
						'create_by_userid'				=>	$create_by_userid,
						'randomid'						=>	$randomId,
             			);  
			$flgIn1 = $db->insertAry("staff_manage_kin_details",$aryData);

			$_SESSION['success'] = "Submitted Successfully"; 
			unset($_POST);	
			redirect($FileName.'?action=add_next_of_kin_details&randomid='.$_GET['randomid']); 
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_next_of_kin_details']))
{                
	$validate->addRule($_POST['first_name'],'','First Name',true);
	$validate->addRule($_POST['last_name'],'','Last Name',true);
	$validate->addRule($_POST['phone'],'','Phone',true);
	
	if($validate->validate() && count($stat)==0)
	{
		$aryData=array(	
						'first_name'					=>	$_POST['first_name'],     
						'last_name'						=>	$_POST['last_name'],
						'relationship'					=>	$_POST['relationship'],
						'phone'							=>	$_POST['phone'],
						'email'							=>	$_POST['email'],
						'other_name'					=>	$_POST['other_name'],
						'address_1'						=>	$_POST['address_1'],
						'address_2'						=>	$_POST['address_2'],
						'create_by_usertype'			=>	$create_by_usertype,
						'create_by_userid'				=>	$create_by_userid,
						'randomid'						=>	$_GET['randomid'],
						);  
			$flgIn1 = $db->updateAry("staff_manage_kin_details",$aryData,"where staff_manage_id='".$staffid['id']."'");
		
			$_SESSION['success']="Updated Successfully";
			unset($_POST);
			redirect($FileName.'?action=add_next_of_kin_details&randomid='.$_GET['randomid']); 
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['add_staff_qualification']))
{                
	$validate->addRule($_POST['qualification'],'','Qualification',true);
	$validate->addRule($_POST['issueing_body'],'','Issuing Body',true);
	$validate->addRule($_POST['date_issued'],'','Issuing Body',true);
	
	if($validate->validate() && count($stat)==0)
	{
		$iLastId=$db->getVal("select id from staff_qualification order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;
			
		$aryData=array(	
						'userid'							=>	$_SESSION['userid'],
						'usertype'							=>	$_SESSION['usertype'],
						'staff_manage_id'					=>	$staffid['id'],
						'qualification'						=>	$_POST['qualification'],     
						'issueing_body'						=>	$_POST['issueing_body'],
						'date_issued'						=>	$_POST['date_issued'],
						'create_by_userid'					=> 	$create_by_userid,
						'create_by_usertype'				=> 	$create_by_usertype,
						'randomid'							=> 	$randomId ,
						);  
				$flgIn1 = $db->insertAry("staff_qualification",$aryData);
			
				$_SESSION['success']="Submitted Successfully";
				unset($_POST);
				redirect($FileName.'?action=add_staff_educational&randomid='.$_GET['randomid']);
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_staff_qualification']))
{                
	$validate->addRule($_POST['qualification'],'','Qualification',true);
	$validate->addRule($_POST['issueing_body'],'','Issuing Body',true);
	$validate->addRule($_POST['date_issued'],'','Issuing Body',true);
				
	if($validate->validate() && count($stat)==0)
	{
		$aryData=array(	
						'qualification'					=>	$_POST['qualification'],     
						'issueing_body'					=>	$_POST['issueing_body'],
						'date_issued'					=>	$_POST['date_issued'],
						);  
			$flgIn1 = $db->updateAry("staff_qualification",$aryData, "where randomid='".$_GET['token']."'");
			
			$_SESSION['success']="Submitted Successfully";	
			unset($_POST);
			redirect($FileName.'?action=add_staff_educational&randomid='.$_GET['randomid']);
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(($_GET['action']=='delete_staff_educational')) 
{
    $flgIn1 = $db->delete("staff_qualification", "where randomid='".$_GET['token']."'");
	$_SESSION['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=add_staff_educational&randomid='.$_GET['randomid']);
}
if(isset($_POST['add_previous_employment']))
{                
	//$validate->addRule($_POST['previous_id'],'','previous_id',true);
	$validate->addRule($_POST['organization'],'','Organization',true);
	$validate->addRule($_POST['reason_for_leaving'],'','Reason For Leaving',true);
	$validate->addRule($_POST['date_left'],'','Date Left',true);
							
	if($validate->validate() && count($stat)==0)
	{
		$iLastId=$db->getVal("select id from staff_previous_employment order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;
		
		$aryData=array(	
						'userid'						=>	$_SESSION['userid'],
						'usertype'						=>	$_SESSION['usertype'],
						'staff_manage_id'				=>	$staffid['id'], 
						//'previous_id'					=>	$_POST['previous_id'],     
						'organization'					=>	$_POST['organization'],
						'reason_for_leaving'			=>	$_POST['reason_for_leaving'],
						'date_left'						=>	$_POST['date_left'],
						'create_by_usertype'			=>	$create_by_usertype,
						'create_by_usertype'			=>	$create_by_usertype,
						'randomid'						=>	$randomId,	
						);  
			$flgIn1 = $db->insertAry("staff_previous_employment",$aryData);
			
			$_SESSION['success']="Submitted Successfully";	
			unset($_POST);		
			redirect($FileName.'?action=add_previous_employment&randomid='.$_GET['randomid']);
	}
	else
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_previous_employment']))
{                
	$validate->addRule($_POST['organization'],'','Organization',true);
	$validate->addRule($_POST['reason_for_leaving'],'','Reason For Leaving',true);
	$validate->addRule($_POST['date_left'],'','Date Left',true);
							
	if($validate->validate() && count($stat)==0)
	{
		$aryData=array(	
						'organization'						=>	$_POST['organization'],
						'reason_for_leaving'				=>	$_POST['reason_for_leaving'],
						'date_left'							=>	$_POST['date_left'],
						);  
			$flgIn1 = $db->updateAry("staff_previous_employment",$aryData, "where randomid='".$_GET['token']."'");
			
			$_SESSION['success']="Submitted Successfully";	
			unset($_POST);
			redirect($FileName.'?action=add_previous_employment&randomid='.$_GET['randomid']);
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(($_GET['action']=='delete_previous_employment')) 
{
    $flgIn1 = $db->delete("staff_previous_employment", "where randomid='".$_GET['token']."'");
	$_SESSION['success'] = 'Deleted Successfully';
    redirect($FileName.'?action=add_previous_employment&randomid='.$_GET['randomid']);
}
if(isset($_POST['add_refree']))
{                
	$validate->addRule($_POST['name'],'','Name',true);
	$validate->addRule($_POST['occupation'],'','Occupation',true);
	$validate->addRule($_POST['home_address'],'','Home Address',true);
	$validate->addRule($_POST['office_address'],'','Office Address',true);
	$validate->addRule($_POST['phone'],'','Phone',true);
							
	if($validate->validate() && count($stat)==0)
	{
		$iLastId=$db->getVal("select id from staff_refree order by id desc")+1;		
		$randomId=randomFix(15).'-'.$iLastId;
		
		$aryData=array(
						'usertype'					=>	$_SESSION['usertype'],
						'userid'					=>	$_SESSION['userid'],
						'staff_manage_id'			=>	$staffid['id'], 
						'name'						=>	$_POST['name'],     
						'occupation'				=>	$_POST['occupation'],
						'home_address'				=>	$_POST['home_address'],
						'office_address'			=>	$_POST['office_address'],
						'phone'						=>	$_POST['phone'],
						'any_aligment'				=>	$_POST['any_aligment'],
						'create_by_userid'			=>	$create_by_userid,
						'create_by_usertype'		=>	$create_by_usertype,
						'randomid'					=>	$_GET['randomid'],	
						);  
			$flgIn1 = $db->insertAry("staff_refree",$aryData);
			
			$_SESSION['success']="Submitted Successfully";
			unset($_POST);
			redirect($FileName.'?action=add_Referee&randomid='.$_GET['randomid']);
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if(isset($_POST['edit_refree']))
{                
	$validate->addRule($_POST['name'],'','Name',true);
	$validate->addRule($_POST['occupation'],'','Occupation',true);
	$validate->addRule($_POST['home_address'],'','Home Address',true);
	$validate->addRule($_POST['office_address'],'','Office Address',true);
	$validate->addRule($_POST['phone'],'','Phone',true);
							
	if($validate->validate() && count($stat)==0)
	{
		$aryData=array(	
						'name'						=>	$_POST['name'],     
						'occupation'				=>	$_POST['occupation'],
						'home_address'				=>	$_POST['home_address'],
						'office_address'			=>	$_POST['office_address'],
						'phone'						=>	$_POST['phone'],
						'any_aligment'				=>	$_POST['any_aligment'],	
						);  
			$flgIn1 = $db->updateAry("staff_refree",$aryData, "where staff_manage_id='".$staffid['id']."'");
			
			$_SESSION['success']="Updated Successfully";
			unset($_POST);
			redirect($FileName.'?action=add_Referee&randomid='.$_GET['randomid']);
	}
	else 
	{
		$stat['error'] = $validate->errors();
	}
}
if($_GET['action']=='delete')
{
    $flgIn = $db->delete("staff_manage", "where randomid='".$_GET['randomid']."'");
    $flgIn1 = $db->delete("school_register", "where username='".$staffid['staff_id']."'");
    $flgIn2 = $db->delete("staff_manage_kin_details", "where staff_manage_id='".$staffid['id']."'");
    $flgIn3 = $db->delete("staff_qualification", "where staff_manage_id='".$staffid['id']."'");
    $flgIn4 = $db->delete("staff_previous_employment", "where staff_manage_id='".$staffid['id']."'");
    $flgIn5 = $db->delete("staff_refree", "where staff_manage_id='".$staffid['id']."'");
	$_SESSION['success'] = 'Staff deleted successfully';
    redirect($Filename.'?action=basic_info');
}
?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
<style>
.gwt-DecoratorPanel #example1_wrapper .dataTables_length{
	float: left;
    margin-bottom: 20px;
    margin-left: 10px;
}
#example1_filter.dataTables_filter label {
width: 30% !important;
}
.gwt-Label {
    width: 35%;
	padding-left: 0px !important;
}
.zqw22 button {
    margin-top: 19px;
}
.contacts-ListContainer.contacts-ListMenu {
	padding-top: 0;
	padding: 20px;
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
	height: 930px;
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
    background: #1565c0;
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
.gwt-Label {    color: black;
    font-weight: 600;
    padding: 8px;
}
.zqw22  input {
padding: 8px 3px 10px 0;
    border: 1px solid gainsboro;
    background: #dcdcdc45;
    border-radius: 5px;
    margin-right: 0px;
    width:156px;
    margin: 8px 0 11px 0;
    margin-bottom: 5px;
}
.sectsab a ul {
	padding:0px;
}
.sectsab.active li {
	color:white;
	font-weight:600;	
}
.zqw22 button {
    border: 1px solid #1565c0;
    padding: 4px 5px 4px 5px;
    margin-right: 7px;
    background: transparent;
    color: #1565c0;
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
	overflow-x:auto;
    border-bottom: 3px solid gainsboro!important;
}
.zqw22 .nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
    background: #dcdcdc4f!important;
}
div.dataTables_info {
    margin-left: 7px;
}
table.dataTable {
    margin-top: 0px!important;
    margin-bottom: 0px!important;
}
.zqw22 .nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
    color: black!important;
    font-weight: 700;
	line-height: 38px;
    background: gainsboro;
}
.nav.nav-tabs>li>a, .nav.tabs-vertical>li>a {
    padding-left: 15px!important;
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
.zqw22 .nav-tabs>li.active, .nav-tabs>li.active:focus, .nav-tabs>li.active:hover, .tabs-vertical>li.active, .tabs-vertical>li.active:focus, .tabs-vertical>li.active:hover {
    color: black!important;
    font-weight: 700;
}
.zswqas .activate a {
    width: 239px;
    display: block;
    padding: 16px 14px 14px 18px;
    border-bottom: 2px solid gainsboro;
    background: #1565c0;
    color: white;
}
.zqw22 .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover, .tabs-vertical>li.active>a, .tabs-vertical>li.active>a:focus, .tabs-vertical>li.active>a:hover {
	border-bottom: 3px solid #1565c0;
}
.topside-section li a {
	border: 1px solid #1565c0;
	padding: 5px 5px 4px 5px;
	display: block;
}
.zswqas li a:hover {
	width: 239px;
	display: block;
	padding: 16px 14px 14px 18px;
	border-bottom: 2px solid gainsboro;
	background: #1565c0;
	color: white;
}
.zswqas .active {
	width: 239px;
	display: block;
	padding: 16px 14px 14px 18px;
	border-bottom: 2px solid gainsboro;
	background: #1565c0;
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
    width: 85%!important;
    margin:0 auto;
}	
div.dataTables_filter input {
    width: 67%;
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
    top: -20px;
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
    color: transparent !important;
}
.paginate_button.previous.disabled{
	width: 10%;
	float:left;
}
.paginate_button.previous.disabled{
	width: 10%;
	float:right;
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
    text-align: center!important;
}
 .paging_simple_numbers span{
    /* display: none; */
    opacity: 0;
}
	#example td {
    padding: 4px 11px 4px 13px;
    border-bottom: 3px solid;
    margin: 0 0 0;
}
#example .active:hover {
    background: #1565c0;
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
    border: 1px solid #1565c0;
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
.gridTable{
margin-bottom:15px;		
}
.gwt-Label{
	color: #000000de;
    font-weight: 600;
	float:left;
	font-size: 13px;
}
#setB input {
    width: 15%;
}
.gwt-ListBox{
	width:60%
}
.beddy img{
	width:100%;
}
.bedd{
	color:black;
}
.beddy-b input{
    height: 50px;
    width: 100%;
}
.hhf button{
	margin-top:10px;
	margin-bottom:20px;
}
.desh{
	border-bottom: 2px solid;
    border-bottom-style: dashed;
	margin: 20px 0 20px 0px;
}
.ssd{
	text-align: center;
	margin:10px 0 0 0;
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
	display:none;
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
    right: 10px;
    bottom: 9px;
    top: 4px;
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
	float:right;
	margin-right:10px;

}
#example2_filter.dataTables_filter input, #example1_filter.dataTables_filter input {
	position: relative;
    bottom: 27px;
    height: 29px;
	color:black;
}
#example1 div.dataTables_filter, #example2 div.dataTables_filter, #example div.dataTables_filter{
    text-align: left;
    margin-bottom: 10px;
    margin-left: 12px;
}
#example1 tbody input, #example2 tbody input, #example tbody input{
	width:100% !important;
}
.middleCenterInner .gwt-DecoratorPanel, .middleCenterInner table:first-child {
	width:100% !important;
}
#example1_filter div.dataTables_filter {
    text-align: LEFT !IMPORTANT;
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
	<div class="row">
	<div class="sectionza">
	<div class="col-md-12">
		<div class="col-md-3">
			<div class="zasw">
			<div class="zawq Wizard-a1">
			<table id="example" class="display">
			<thead class="setting">
			<tr>
				<th>Position</th>
				<th>Position</th>
			</tr>
			</thead>
			<tbody>
			<?php $aryDetail=$db->getRows("select * from staff_manage where create_by_userid='".$create_by_userid."'"); 
				foreach($aryDetail as $iList) 
				{ 
				?>
			<tr>
				<td style="padding:0px;"></td>
				<td class="sectsab <?php if($_GET['randomid']==$iList['randomid']) { echo " active "; }?>">
					<a href="<?php echo $FileName; ?>?action=basic_info&randomid=<?php echo $iList['randomid']?>">
						<ul>
							<li>
								<span class="zwq">
									<img class="table-img" src="../uploads/<?php echo $iList['picture']; ?>">
								</span>
								( <?php echo $iList['staff_id']; ?> )
								<?php echo $iList['first_name'].' '.$iList['last_name']; ?>
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
		<div class="col-md-9">
			<div class="zasw1">
				<?php echo msg($stat);?>
				<div class="topside-section">
					<ul>
						<li><a href="javascript:del('<?php echo $FileName; ?>?action=delete&randomid=<?php echo $_GET['randomid']; ?>')">Delete New Staff</a></li>
						<li><a href="<?php echo SKOOL_URL ?>staff_profile_pdf.php?randomid=<?php echo $_GET['randomid']; ?>">Print Staff Profile</a></li>
						<li><a href="<?php echo SKOOL_URL ?>staff_full_profile_pdf.php?randomid=<?php echo $_GET['randomid']; ?>">Print Staff Full Profile</a></li>
					</ul>
				</div>
				
<div class="zqw22">
	<div class="panel with-nav-tabs panel-success">
<div class="panel-heading">
	<ul class="nav nav-tabs">
		<li class="<?php if($_GET['action']=='basic_info' || $_GET['action']=='') { echo "active"; } ?>">
			<a href="<?php echo $FileName; ?>?action=basic_info&randomid=<?php echo $_GET['randomid']; ?>">Basic Info</a>
		</li>
		<li class="<?php if($_GET['action']=='add_next_of_kin_details') {	echo "active"; } ?>">
			<a href="<?php echo $FileName; ?>?action=add_next_of_kin_details&randomid=<?php echo $_GET['randomid']; ?>">Next of  Kin Details</a>
		</li>
		<li class="<?php if($_GET['action']=='add_staff_educational') { echo "active"; } ?>">
			<a href="<?php echo $FileName; ?>?action=add_staff_educational&randomid=<?php echo $_GET['randomid']; ?>">Educational Qualification</a>
		</li>
		<li class="<?php if($_GET['action']=='add_previous_employment') { echo "active"; } ?>">
			<a href="<?php echo $FileName; ?>?action=add_previous_employment&randomid=<?php echo $_GET['randomid']; ?>">Previous Employment</a>
		</li>
		<li class="<?php if($_GET['action']=='add_Referee') {echo "active"; } ?>">
			<a href="<?php echo $FileName; ?>?action=add_Referee&randomid=<?php echo $_GET['randomid']; ?>">Referee</a>
		</li>
	</ul>
</div>
<div class="panel-body">
<div class="tab-content">
	<div class="tab-pane fade in active" id="tab1success">
	<div class="gwt-TabPanelBottom" role="tabpanel">
	<?php if($_GET['action']=='basic_info' || $_GET['action']=='') { ?>
	<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;">
	<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%;">
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
<?php if($_GET['randomid']=="") { ?>
<form action="" method="post" enctype="multipart/form-data">
<td class="middleCenter">
	<div class="zqw22">
	<div class="panel with-nav-tabs panel-success">
<div class="row ">
<div class="col-md-5">
	<div class="col-md-12">
		<div class="gwt-Label">Staff ID: *</div>
		<input type="text" name="staff_id" value="<?php echo $_POST['staff_id']; ?>" class="nnh">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Title</div>
		<select class="gwt-ListBox" name="title">
			<option value="Mr." <?php if($_POST['title']=='mr.') { echo "selected"; } ?>>Mr.</option>
			<option value="Mrs." <?php if($_POST['title']=='Mrs.') { echo "selected"; } ?>>Mrs.</option>
			<option value="Miss." <?php if($_POST['title']=='Miss.') { echo "selected"; } ?>>Miss.</option>
			<option value="Dr." <?php if($_POST['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
			<option value="Prof." <?php if($_POST['title']=='Prof.') { echo "selected"; } ?>>Prof.</option>
			<option value="Alh." <?php if($_POST['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
			<option value="Malam." <?php if($_POST['title']=='Malam.') { echo "selected"; } ?>>Malam.</option>
			<option value="Hajia." <?php if($_POST['title']=='Hajia.') { echo "selected"; } ?>>Hajia.</option>
			<option value="Pst." <?php if($_POST['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
			<option value="Sen." <?php if($_POST['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
			<option value="Barr." <?php if($_POST['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
		</select>
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Last Name</div>
		<input type="text" name="last_name" value="<?php echo $_POST['last_name']; ?>">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">First Name</div>
		<input type="text" name="first_name" value="<?php echo $_POST['first_name']; ?>" />
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Other Names</div>
		<input type="text" name="other_name" value="<?php echo $_POST['other_name']; ?>">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Marital Status:</div>
		<select class="gwt-ListBox" name="marrital_status">
			<option value="SINGLE" <?php if($_POST['marrital_status']=='SINGLE') { echo "selected"; } ?>>SINGLE</option>
			<option value="MARRIED" <?php if($_POST['marrital_status']=='MARRIED' ) { echo "selected"; } ?>>MARRIED</option>
			<option value="WIDOWED" <?php if($_POST['marrital_status']=='WIDOWED') { echo "selected"; } ?>>WIDOWED</option>
			<option value="DIVORCED" <?php if($_POST['marrital_status']=='DIVORCED') { echo "selected"; } ?>>DIVORCED</option>
		</select>
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Nationality:</div>
		<select class="gwt-ListBox" name="nationality">
			<option value="">Select Nationality</option>
			<?php $aryDetail=$db->getRows("select * from  nationality");
			foreach($aryDetail as $iList)
			{ $i=$i+1;?>
			<option value="<?php echo $iList['id']; ?>" <?php if($_POST['nationality']==$iList['id']) { echo "selected"; } ?>>
			<?php echo $iList['country_name']; ?>
			</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">No of children:</div>
		<input type="text" name="no_of_children" value="<?php echo $_POST['no_of_children']; ?>" class="nnh">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">BloodGroup:</div>
		<input type="text" name="blood_group" value="<?php echo $_POST['blood_group']; ?>" class="nnh">
	</div>
</div>
<div class="col-md-5">
	<div class="col-md-12">
		<div class="gwt-Label">Gender: *</div>
		<fieldset id="setB">
			<input id="setB_male" type="radio" name="gender" value="male" <?php if($_POST['gender']=="male" ) { echo "checked"; } ?>/>
			<label for="setB_male">Male</label>
			<input id="setB_female" type="radio" name="gender" value="female" <?php if($_POST['gender']=="female" ) { echo "checked"; } ?>>
			<label for="setB_female">Female</label>
		</fieldset>
	</div>

	<div class="col-md-12">
		<div class="gwt-Label"> Date of Birth:</div>
		<input type="text" name="date_of_birth" value="<?php echo $_POST['date_of_birth']; ?>" class="gwt-DateBox datepicker" autocomplete="off">
	</div>

	<div class="col-md-12">
		<div class="gwt-Label">State of Origin:</div>
		<input type="text" name="state_of_origin" value="<?php echo $_POST['state_of_origin']; ?>">
	</div>

	<div class="col-md-12">
		<div class="gwt-Label">LGA of Origin:</div>
		<select class="gwt-ListBox" name="lga_of_origin">
			<option value="">Select LGA Origin</option>
			<?php $aryDetail=$db->getRows("select * from  local_government ");
			foreach($aryDetail as $iList)
			{ $i=$i+1;?>
			<option value="<?php echo $iList['id']; ?>" <?php if($_POST['lga_of_origin']==$iList[ 'id']) { echo "selected"; } ?>>
			<?php echo $iList['title']; ?>
			</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Date of Appointment:</div>
		<input type="text" class="datepicker" name="date_of_appointment" value="<?php echo $_POST['date_of_appointment']; ?>">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Religion:</div>
		<select class="gwt-ListBox" name="religion">
			<option value="">Select Religion</option>
			<?php $aryDetail=$db->getRows("select * from religion ");
			foreach($aryDetail as $iList)
			{ $i=$i+1;?>
			<option value="<?php echo $iList['id']; ?>" <?php if($_POST['religion']==$iList['id']) { echo "Selected"; } ?>>
			<?php echo $iList['title'];?>
			</option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Denomination:</div>
		<input type="text" name="denomination" value="<?php $_POST['denomination'];?>">
	</div>
	<div class="col-md-12">
		<div class="gwt-Label">Branch:</div>
		<input type="text" name="branch" value="<?php echo $_POST['branch']; ?>" class="nnh">
	</div>

	<div class="col-md-12">
		<div class="gwt-Label"> Genotype:</div>
		<input type="text" name="genotype" value="<?php echo $_POST['genotype']; ?>">
	</div>
</div>
<div class="col-md-2 hhf">
	<div class="beddy">
		<center><span class="bedd"> Picture</span></center>
		<img src="../uploads/<?php echo $_POST['picture']; ?>" style="height:50px;">
	</div>
	<div>
		<input type="file" name="picture" style="width: 95px;">
	</div>
	<div class="beddy">
		<center><span class="bedd"> Signature</span></center>
		<img src="../uploads/<?php echo $_POST['signature']; ?>" style="height:50px;">
	</div>
	<div>
		<input type="file" name="signature" style="width: 95px;">
	</div>
</div>
</div>
<div class="row desh"></div>
<div class="row">
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">Address Line 1:</div>
			<input type="text" name="address_1" value="<?php echo $_POST['address_1']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Address Line 2:</div>
			<input type="text" name="address_2" value="<?php echo $_POST['address_2']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">City:</div>
			<input type="text" name="city" value="<?php echo $_POST['city']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Initials:</div>
			<input type="text" name="initials" value="<?php echo $_POST['initials']; ?>" />
		</div>
	</div>
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">P.O.Box:</div>
			<input type="text" name="p_o_box" value="<?php echo $_POST['p_o_box']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">State:</div>
			<select class="gwt-ListBox" name="state">
				<option>Select state</option>
				<?php $aryDetail=$db->getRows("select * from  state ");
				foreach($aryDetail as $iList)
				{ $i=$i+1;?>
				<option value="<?php echo $iList['id']; ?>" <?php if($_POST['state']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['title']; ?>
				</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Phone:</div>
			<input type="text" name="phone" value="<?php echo $_POST['phone']; ?>" />
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Email:</div>
			<input type="text" name="email" value="<?php echo $_POST['email']; ?>" />
		</div>
	</div>
</div>
<div class="row ssd">
	<button type="submit" name="add_staff_detail" class="gwt-Button">Save Staff Details</button>
	<button type="" class="gwt-Button"><a href="staff.php?action=basic_info"> Add New Staff </a></button>
</div>
</div>
</div>
</td>
</form>
<?php } else { 
$staffDetail=$db->getRow("select* from staff_manage where randomid='".$_GET['randomid']."'"); ?>
<form action="" method="post" enctype="multipart/form-data">
<td class="middleCenter">
<div class="zqw22">
	<div class="panel with-nav-tabs panel-success">
	<div class="row ">
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">Staff ID: *</div>
			<input type="text" name="staff_id" value="<?php echo $staffDetail['staff_id']; ?>" class="nnh">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Title</div>
			<select class="gwt-ListBox" name="title">
				<option value="Mr." <?php if($staffDetail['title']=='mr.') { echo "selected"; } ?>>Mr.</option>
				<option value="Mrs." <?php if($staffDetail['title']=='Mrs.') { echo "selected"; } ?>>Mrs.</option>
				<option value="Miss." <?php if($staffDetail['title']=='Miss.') { echo "selected"; } ?>>Miss.</option>
				<option value="Dr." <?php if($staffDetail['title']=='Dr.') { echo "selected"; } ?>>Dr.</option>
				<option value="Prof." <?php if($staffDetail['title']=='Prof.') { echo "selected"; } ?>>Prof.</option>
				<option value="Alh." <?php if($staffDetail['title']=='Alh.') { echo "selected"; } ?>>Alh.</option>
				<option value="Malam." <?php if($staffDetail['title']=='Malam.') { echo "selected"; } ?>>Malam.</option>
				<option value="Hajia." <?php if($staffDetail['title']=='Hajia.') { echo "selected"; } ?>>Hajia.</option>
				<option value="Pst." <?php if($staffDetail['title']=='Pst.') { echo "selected"; } ?>>Pst.</option>
				<option value="Sen." <?php if($staffDetail['title']=='Sen.') { echo "selected"; } ?>>Sen.</option>
				<option value="Barr." <?php if($staffDetail['title']=='Barr.') { echo "selected"; } ?>>Barr.</option>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Last Name</div>
			<input type="text" name="last_name" value="<?php echo $staffDetail['last_name']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">First Name</div>
			<input type="text" name="first_name" value="<?php echo $staffDetail['first_name']; ?>" />
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Other Names</div>
			<input type="text" name="other_name" value="<?php echo $staffDetail['other_name']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Marital Status:</div>
			<select class="gwt-ListBox" name="marrital_status">
				<option value="SINGLE" <?php if($staffDetail['marrital_status']=='SINGLE') { echo "selected"; } ?>>SINGLE</option>
				<option value="MARRIED" <?php if($staffDetail['marrital_status']=='MARRIED') { echo "selected"; } ?>>MARRIED</option>
				<option value="WIDOWED" <?php if($staffDetail['marrital_status']=='WIDOWED') { echo "selected"; } ?>>WIDOWED</option>
				<option value="DIVORCED" <?php if($staffDetail['marrital_status']=='DIVORCED') { echo "selected"; } ?>>DIVORCED</option>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Nationality:</div>
			<select class="gwt-ListBox" name="nationality">
				<option value="">Select Nationality</option>
				<?php $aryDetail=$db->getRows("select * from  nationality ");
				foreach($aryDetail as $iList)
				{ $i=$i+1;?>
				<option value="<?php echo $iList['id']; ?>" <?php if($staffDetail['nationality']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['country_name']; ?>
				</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">No of children:</div>
			<input type="text" name="no_of_children" value="<?php echo $staffDetail['no_of_children']; ?>" class="nnh">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">BloodGroup:</div>
			<input type="text" name="blood_group" value="<?php echo $staffDetail['blood_group']; ?>" class="nnh">
		</div>
	</div>
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">Gender: *</div>
			<fieldset id="setB">
				<input id="setB_male" type="radio" name="gender" value="male" <?php if($staffDetail[ 'gender']=="male" ) { echo "checked"; } ?>/>
				<label for="setB_male">Male</label>
				<input id="setB_female" type="radio" name="gender" value="female" <?php if($staffDetail[ 'gender']=="female" ) { echo "checked"; } ?>>
				<label for="setB_female">Female</label>
			</fieldset>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label"> Date of Birth:</div>
			<input type="text" name="date_of_birth" value="<?php echo $staffDetail['date_of_birth']; ?>" class="gwt-DateBox datepicker">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">State of Origin:</div>
			<input type="text" name="state_of_origin" value="<?php echo $staffDetail['state_of_origin']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">LGA of Origin:</div>
			<select class="gwt-ListBox" name="lga_of_origin">
				<option value="">Select LGA Origin</option>
				<?php $aryDetail=$db->getRows("select * from  local_government ");
				foreach($aryDetail as $iList)
				{ $i=$i+1;?>
				<option value="<?php echo $iList['id']; ?>" <?php if($staffDetail['lga_of_origin']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['title']; ?>
				</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Date of Appointment:</div>
			<input type="text" name="date_of_appointment" class="datepicker" value="<?php echo $staffDetail['date_of_appointment']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Religion:</div>
			<select class="gwt-ListBox" name="religion">
				<option value="">Select Religion</option>
				<?php $aryDetail=$db->getRows("select * from religion");
				foreach($aryDetail as $iList)
				{ $i=$i+1;?>
				<option value="<?php echo $iList['id']; ?>" <?php if($staffDetail['religion']==$iList[ 'id']) { echo "Selected"; } ?>>
				<?php echo $iList['title'];?>
				</option>
				<?php } ?>
			</select>
		</div>	
		<div class="col-md-12">
			<div class="gwt-Label">Denomination:</div>
			<input type="text" name="denomination" value="<?php echo $staffDetail['denomination'];?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Branch:</div>
			<input type="text" name="branch" value="<?php echo $staffDetail['branch']; ?>" class="nnh">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label"> Genotype:</div>
			<input type="text" name="genotype" value="<?php echo $staffDetail['genotype']; ?>">
		</div>
	</div>
	<div class="col-md-2 hhf">
		<div class="beddy">
			<center><span class="bedd"> Picture</span></center>
			<img src="../uploads/<?php echo $staffDetail['picture']; ?>" style="height:100px;">
		</div>
		<div>
			<input type="file" name="picture" style="width: 95px;">
			<input type="hidden" class="form-control required" id="picture_old" name="picture_old" value="<?php echo $staffDetail['picture'] ?>">
		</div>
		<div class="beddy">
			<center><span class="bedd">Signature</span></center>
			<img src="../uploads/<?php echo $staffDetail['signature']; ?>" style="height:100px;">
		</div>
		<div>
			<input type="file" name="signature" style="width: 95px;">
			<input type="hidden" class="form-control required" id="signature_old" name="signature_old" value="<?php echo $staffDetail['signature'] ?>">	
		</div>
	</div>
	</div>
	<div class="row desh"></div>
	<div class="row">
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">Address Line 1:</div>
			<input type="text" name="address_1" value="<?php echo $staffDetail['address_1']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Address Line 2:</div>
			<input type="text" name="address_2" value="<?php echo $staffDetail['address_2']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">City:</div>
			<input type="text" name="city" value="<?php echo $staffDetail['city']; ?>">
		</div>

		<div class="col-md-12">
			<div class="gwt-Label">Email:</div>
			<input type="text" name="email" value="<?php echo $staffDetail['email']; ?>" />
		</div>
	</div>
	<div class="col-md-5">
		<div class="col-md-12">
			<div class="gwt-Label">P.O.Box:</div>
			<input type="text" name="p_o_box" value="<?php echo $staffDetail['p_o_box']; ?>">
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">State:</div>
			<select class="gwt-ListBox" name="state">
				<option>Select state</option>
				<?php $aryDetail=$db->getRows("select * from  state ");
				foreach($aryDetail as $iList)
				{ $i=$i+1;?>
				<option value="<?php echo $iList['id']; ?>" <?php if($staffDetail['state']==$iList['id']) { echo "selected"; } ?>>
				<?php echo $iList['title']; ?>
				</option>
				<?php } ?>
			</select>
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Phone:</div>
			<input type="text" name="phone" value="<?php echo $staffDetail['phone']; ?>" />
		</div>
		<div class="col-md-12">
			<div class="gwt-Label">Mobile:</div>
			<input type="text" name="mobile" value="<?php echo $staffDetail['mobile']; ?>" />
		</div>
	</div>
	</div>
	<div class="row ssd">
		<button type="submit" name="edit_staff_detail" class="gwt-Button">Update Staff Details</button>
		<button type="" class="gwt-Button"><a href="staff.php?action=basic_info"> Add New Staff </a></button>
	</div>
	</div>
</div>
</td>
</form>
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
<?php } elseif($_GET['action']=='add_next_of_kin_details') { ?>
<div style="width: 100%; height: 100%; padding: 0px; margin: 0px;" aria-hidden="true">
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
	<?php  $nextDetail=$db->getRow("select * from staff_manage_kin_details where staff_manage_id='".$staffid['id']."'"); ?>
	<form action="" method="post">
	<div class="middleCenterInner">
	<table cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td align="center" style="vertical-align: top;">
			<table cellpadding="4">
			<colgroup><col></colgroup>
			<tbody>
				<tr>
					<td>
						<div class="gwt-Label">First Name:*</div>
					</td>
					<td>
						<input type="text" name="first_name" value="<?php echo $nextDetail['first_name'];?>" class="gwt-TextBox">
					</td>
					<td>
						<div class="gwt-Label">Address 1:*</div>
					</td>
					<td>
						<input type="text" name="address_1" value="<?php echo $nextDetail['address_1'];?>" class="gwt-TextBox">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Last Name:*</div>
					</td>
					<td>
						<input type="text" name="last_name" value="<?php echo $nextDetail['last_name'];?>" class="gwt-TextBox">
					</td>
					<td>
						<div class="gwt-Label">Address 2:</div>
					</td>
					<td>
						<input type="text" name="address_2" value="<?php echo $nextDetail['address_2'];?>" class="gwt-TextBox">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Other Name:</div>
					</td>
					<td>
						<input type="text" name="other_name" value="<?php echo $nextDetail['other_name'];?>" class="gwt-TextBox">
					</td>
					<td>
						<div class="gwt-Label">Relationship:*</div>
					</td>
					<td>
						<input type="text" name="relationship" value="<?php echo $nextDetail['relationship'];?>" class="gwt-TextBox">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Phone:</div>
					</td>
					<td>
						<input type="text" name="phone" value="<?php echo $nextDetail['phone'];?>" class="gwt-TextBox">
					</td>
					<td>
						<div class="gwt-Label">Email:</div>
					</td>
					<td>
						<input type="text" name="email" value="<?php echo $nextDetail['email'];?>" class="gwt-TextBox">
					</td>
				</tr>
			</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td align="center" style="vertical-align: top;">
				<table cellspacing="0" cellpadding="0" style="height: 30px;">
				<tbody>
					<tr>
						<td align="left" style="vertical-align: bottom;">
						<?php if($nextDetail['id']=='') { ?>
							<button type="submit" name="add_next_of_kin_details" class="gwt-Button">Save Next of Kin Details</button>
						<?php } else { ?>
							<button type="submit" name="edit_next_of_kin_details" class="gwt-Button">Save Next of Kin Details</button>
						<?php } ?>	
						</td>
					</tr>
				</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	</table>
	</div>
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
</div>
<?php } elseif($_GET['action']=='add_staff_educational') {  ?>
<div style="width: 100%; height: 100%; padding: 0px; margin: 0px; " aria-hidden="true">
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
		<div class="middleCenterInner">
		<table cellspacing="0" cellpadding="0">
		<tbody>
		<tr>
			<td align="center" style="vertical-align: top;">
			<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel">
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
					<div class="middleCenterInner">
					<table class="gridTable" style="width: 475px;border:1px solid gainsboro;">
					<colgroup><col></colgroup>
					<tbody>
					<tr>
						<td class="contacts-ListContainer contacts-ListMenu" style="vertical-align: top;">
						<table cellspacing="0" cellpadding="0" style="width: 100%;">
						<tbody>
						<tr>
							<td align="left" style="vertical-align: top;padding:7px;">
							<table cellspacing="2" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td align="left" style="vertical-align: top;">
										<table cellspacing="0" cellpadding="0" border="0">
											<tbody></tbody>
										</table>
									</td>
								</tr>
								<tr>
									<td align="left" style="vertical-align: top;">
										<table cellspacing="0" cellpadding="0" border="0">
											<tbody></tbody>
										</table>
									</td>
								</tr>
							</tbody>
							</table>
							</td>
						</tr>
						</tbody>
						</table>
						<table cellspacing="2" cellpadding="0" border="0">
						<tbody>
						<form action="" method="post">
						<tr>
							<td>
								<div class="gwt-Label">Qualification:*</div>
							</td>
							<td>
								<input type="text" class="gwt-TextBox" name="qualification" value="<?php echo $_POST['qualification'];?>">
							</td>
						</tr>
						<tr>
							<td>
								<div class="gwt-Label">Issuing Body:*</div>
							</td>
							<td>
								<input type="text" class="gwt-TextBox" name="issueing_body" value="<?php echo $_POST['issueing_body'];?>">
							</td>
						</tr>
						<tr>
							<td>
								<div class="gwt-Label">Dated Issued:*</div>
							</td>
							<td>
								<input type="text" class="gwt TextBox datepicker" name="date_issued" value="<?php echo $_POST['date_issued'];?>" autocomplete="off">
							</td>
						</tr>
						<tr>
							<td>
								<button type="submit" name="add_staff_qualification" class="gwt-Button" style="margin-left: 107px;margin-top:10px;margin-bottom: 6px;">SAVE STAFF QUALIFICATION</button>
							</td>
							<td></td>
						</tr>
						</form>
						<tr>
							<td align="left" style="vertical-align: top;">
								<table cellspacing="0" cellpadding="0" border="0">
								<tbody>
									<tr></tr>
								</tbody>
								</table>
							</td>
						</tr>
						</tbody>
						</table>
						</td>
						<td align="right" style="vertical-align: top;">
							<table cellspacing="0" cellpadding="0">
							<tbody>
								<tr>
									<td align="left" style="vertical-align: top;">
										<button type="button" class="gwt-Button" aria-hidden="true" style="display: none;">&lt;&lt;</button>
									</td>
								</tr>
							</tbody>
							</table>
						</td>
					</tr>
					</tbody>
					</table>
					<form action="" method="post">
					<table id="example1" class="table table-striped table-bordered" style="width:100%">
					<thead>
						<tr>
							<th>Qualification</th>
							<th>Issuing Body</th>
							<th>Date Issued</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php  
					$aryDetail=$db->getRows("select * from staff_qualification where staff_manage_id='".$staffid['id']."'"); 
					foreach($aryDetail as $iList)  
					{  ?>
					<tbody>
					<tr>
						<td>
							<?php if($iList['randomid']==$_GET['token']) { ?>
							<input type="text" name="qualification" value="<?php echo $iList['qualification']; ?>">
							<?php } else {  echo $iList['qualification']; } ?>
						</td>
						<td>
							<?php if($iList['randomid']==$_GET['token']) { ?>
							<input type="text" name="issueing_body" value="<?php echo $iList['issueing_body']; ?>">
							<?php } else {  echo $iList['issueing_body']; } ?>
						</td>
						<td>
							<?php if($iList['randomid']==$_GET['token']) { ?>
							<input type="text" name="date_issued" value="<?php echo $iList['date_issued']; ?>" class="datepicker">
							<?php } else {  echo $iList['date_issued']; } ?>
						</td>
						<td>
							<?php if($iList['randomid']==$_GET['token']) { ?>
							<input type="submit" name="edit_staff_qualification" value="SAVE" class="btn btn-primary">
							<?php } else { ?>
							<a href="<?php echo $FileName; ?>?action=add_staff_educational&randomid=<?php echo $_GET['randomid']; ?>&token=<?php echo $iList['randomid']; ?>" class="table-action-btn"><i class="fa fa-pencil"></i></a>
							<a href="javascript:del('<?php echo $FileName; ?>?action=delete_staff_educational&randomid=<?php echo $_GET['randomid']; ?>&token=<?php echo $iList['randomid']; ?>')" class="table-action-btn"> 
								<i class="fa fa-times"></i> 
							</a>
							<?php } ?>
						</td>
					</tr>
					</tbody>
					<?php } ?>
					</table>
					</form>
			</tbody>
			</table>
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
		</td>
		</tr>
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
</div>
<?php } elseif($_GET['action']=='add_previous_employment') {  ?>
<div style="width: 100%; height: 100%; padding: 0px; margin: 0px; " aria-hidden=" true ">
<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width:100%;height:100%;" aria-hidden="true">
<tbody>
	<tr class="top ">
		<td class="topLeft ">
			<div class="topLeftInner "></div>
		</td>
		<td class="topCenter ">
			<div class="topCenterInner "></div>
		</td>
		<td class="topRight ">
			<div class="topRightInner "></div>
		</td>
	</tr>
	<tr class="middle ">
		<td class="middleLeft ">
			<div class="middleLeftInner"></div>
		</td>
		<td class="middleCenter ">
			<div class="middleCenterInner ">
			<table cellspacing="0 " cellpadding="0 ">
			<tbody>
				<tr>
					<td align="center " style="vertical-align: top; ">
					<table cellspacing="0 " cellpadding="0 " class="gwt-DecoratorPanel ">
					<tbody>
						<tr class="top ">
							<td class="topLeft ">
								<div class="topLeftInner "></div>
							</td>
							<td class="topCenter ">
								<div class="topCenterInner "></div>
							</td>
							<td class="topRight ">
								<div class="topRightInner "></div>
							</td>
						</tr>
						<tr class="middle ">
							<td class="middleLeft ">
								<div class="middleLeftInner "></div>
							</td>
							<td class="middleCenter ">
							<div class="middleCenterInner ">
							<table class="gridTable " style="width: 475px;border:1px solid gainsboro; ">
							<colgroup><col></colgroup>
							<tbody>
								<tr>
									<td class="contacts-ListContainer contacts-ListMenu " style="vertical-align: top; ">
									<table class="gridTable " style="width: 475px;border:1px solid gainsboro; ">
									<colgroup><col></colgroup>
									<tbody>
										<tr>
											<td class="contacts-ListContainer contacts-ListMenu " style="vertical-align: top; ">
											<table cellspacing="0 " cellpadding="0 " style="width: 100%; ">
											<tbody>
												<tr>
													<td align="left " style="vertical-align: top;padding:7px; ">
													<table cellspacing="2 " cellpadding="0 " border="0 ">
													<tbody>
													<tr>
														<td align="left " style="vertical-align: top; ">
															<table cellspacing="0 " cellpadding="0 " border="0 ">
																<tbody></tbody>
															</table>
														</td>
													</tr>
													<tr>
														<td align="left " style="vertical-align: top; ">
															<table cellspacing="0 " cellpadding="0 " border="0 ">
																<tbody></tbody>
															</table>
														</td>
													</tr>
													</tbody>
													</table>
													</td>
												</tr>
											</tbody>
											</table>
											<table cellspacing="2 " cellpadding="0 " border="0 ">
											<form action="" method="post">
											<tbody>
											<!--
											<tr>
												<td><div class="gwt-Label">ID:*</div></td>
												<td>
													<input type="text " name="previous_id " value="<?php echo $_POST[ 'previous_id	']; ?>" class="gwt-TextBox">
												</td>
											</tr>
											--->
											<tr>
												<td>
													<div class="gwt-Label">Organization:*</div>
												</td>
												<td>
													<input type="text" name="organization" value="<?php echo $_POST['organization']; ?>" class="gwt-TextBox">
												</td>
											</tr>
											<tr>
												<td>
													<div class="gwt-Label">Reason For Leaving:*</div>
												</td>
												<td>
													<input type="text" name="reason_for_leaving" value="<?php echo $_POST['reason_for_leaving']; ?>" class="gwt-TextBox">
												</td>
											</tr>
											<tr>
												<td>
													<div class="gwt-Label">Date Left*</div>
												</td>
												<td>
													<input type="text" name="date_left" value="<?php echo $_POST['date_left']; ?>" class="gwt-TextBox datepicker" autocomplete="off">
												</td>
											</tr>
											<tr>
												<td>
													<button type="submit" name="add_previous_employment" class="gwt-Button" style="margin-left: 107px;margin-top:10px;margin-bottom: 6px;">Save Previous Employment</button>
												</td>
												<td>
													<!--
													<button type="button" class="gwt-Button" style="margin-left: 5px;margin-top:10px;margin-bottom: 6px;">Cancel</button>
													--->
												</td>
											</tr>
											</tbody>
											</form>
											</table>
											</td>
											<td align="right" style="vertical-align: top;">
												<table cellspacing="0" cellpadding="0">
												<tbody>
														<tr>
														<td align="left" style="vertical-align: top;">
															<button type="button" class="gwt-Button" aria-hidden="true" style="display: none;">&lt;&lt;</button>
														</td>
													</tr>
												</tbody>
												</table>
											</td>
										</tr>
									</tbody>
									</table>
									<form action="" method="post">
									<table id="example1" class="table table-striped table-bordered" style="width:100%">
									<thead>
									<tr>
										<!--<th>ID:</</th>--->
										<th>Organization</th>
										<th>Reason For Leaving:</th>
										<th>Date Left*</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
									<?php  
									$aryDetail=$db->getRows("select * from staff_previous_employment where staff_manage_id='".$staffid['id']."'"); 
									foreach($aryDetail as $iList) 
									{
									?>
									<tr>
										<!--
										<td>
											<?php if($iList['randomid']==$_GET['randomid'] && $iList['token']==$_GET['token']) { ?>
											<input type="text" name="previous_id" value="<?php echo $iList['previous_id']; ?>">
											<?php } else {  echo $iList['previous_id']; } ?>
										</td>
										-->
										<td>
											<?php  if($iList['randomid']==$_GET['token']) { ?>
											<input type="text" name="organization" value="<?php echo $iList['organization']; ?>">
											<?php } else { echo $iList['organization']; } ?>
										</td>
										<td>
											<?php if($iList['randomid']==$_GET['token']) { ?>
											<input type="text" name="reason_for_leaving" value="<?php echo $iList['reason_for_leaving']; ?>">
											<?php } else {echo $iList['reason_for_leaving']; } ?>
										</td>
										<td>
											<?php  if($iList['randomid']==$_GET['token']) { ?>
											<input type="text" name="date_left" value="<?php echo $iList['date_left']; ?>" class="datepicker">
											<?php } else { echo $iList['date_left']; } ?>
										</td>
										<td>
											<?php if($iList['randomid']==$_GET['token']) { ?>
											<input type="submit" name="edit_previous_employment" value="SAVE" class="btn btn-primary">
											<?php } else { ?>
											<a href="<?php echo $FileName; ?>?action=add_previous_employment&randomid=<?php echo $_GET['randomid']; ?>&token=<?php echo $iList['randomid']; ?>" class="table-action-btn"><i class="fa fa-pencil"></i></a>
											<a href="javascript:del('<?php echo $FileName; ?>?action=delete_previous_employment&randomid=<?php echo $_GET['randomid']; ?>&token=<?php echo $iList['randomid']; ?>')" class="table-action-btn"><i class="fa fa-times"></i></a>
										</td>
										<?php } ?>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</form>
									</td>
								</tr>
							</tbody>
							</table>
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
					</td>
				</tr>
			</tbody>
			</table>
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
</div>
<?php } elseif($_GET['action']='add_Referee') { ?>
<div style="width: 100%; height: 100%; padding: 0px; margin: 0px; " aria-hidden="true">
<table cellspacing="0" cellpadding="0" class="gwt-DecoratorPanel" style="width: 100%; height: 100%; " aria-hidden="true">
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
<div class="middleCenterInner">
<table cellspacing="0" cellpadding="0">
<?php $refreeDetail=$db->getRow("select * from staff_refree where staff_manage_id='".$staffid['id']."'"); ?>
<form action="" method="post">
<tbody>
	<tr>
		<td align="center" style="vertical-align: top;">
			<table cellpadding="4">
			<colgroup><col></colgroup>
			<tbody>
				<tr>
					<td>
						<div class="gwt-Label">Name:*</div>
					</td>
					<td>
						<input type="text" class="gwt-TextBox" name="name" value="<?php echo $refreeDetail['name']; ?>" style="width: 500px;">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Occupation:*</div>
					</td>
					<td>
						<input type="text" class="gwt-TextBox" name="occupation" value="<?php echo $refreeDetail['occupation']; ?>" style="width: 500px;">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Home Address:</div>
					</td>
					<td>
						<input type="text" class="gwt-TextBox" name="home_address" value="<?php echo $refreeDetail['home_address']; ?>" style="width: 500px;">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Office Address:</div>
					</td>
					<td>
						<input type="text" class="gwt-TextBox" name="office_address" value="<?php echo $refreeDetail['office_address']; ?>" style="width: 500px;">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Phone:</div>
					</td>
					<td>
						<input type="text" class="gwt-TextBox" name="phone" value="<?php echo $refreeDetail['phone']; ?>" style="width: 500px;">
					</td>
				</tr>
				<tr>
					<td>
						<div class="gwt-Label">Any Ailment:</div>
					</td>
					<td>
						<input type="checkbox" class="gwt-TextBox" name="any_aligment" value="1" <?php if($refreeDetail['any_aligment']=='1') { echo "checked"; } ?>>
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center" style="vertical-align: top;">
			<table cellspacing="0" cellpadding="0" style="height: 30px;">
			<tbody>
				<tr>
					<td align="left" style="vertical-align: bottom;">
					<?php if($refreeDetail['id']=='') { ?>
						<button type="submit" name="add_refree" class="gwt-Button">Save Referee Details</button>
					<?php } else { ?>
						<button type="submit" name="edit_refree" class="gwt-Button">Save Referee Details</button>
					<?php } ?>	
					</td>
				</tr>
			</tbody>
			</table>
		</td>
	</tr>
</tbody>
</form>
</table>
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
</div>
</div>
<?php include('inc.footer.php'); ?>
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
	$('#example1').DataTable();
});
</script>
<script>
$(document).ready(function() {
	$('#example').DataTable();
});
</script>
<script>
$(document).ready(function() {
	$('#example2').DataTable();
});
</script>
</body>
</html>