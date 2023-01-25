<?php include('../config.php');
include('inc.session-create.php'); 
$validate = new Validation();

 
if($_POST['action']=="Action_changepass")
{
	$validate->addRule($_POST['old_password'],'','Old Password',true);
	$validate->addRule($_POST['new_password'],'','New Password',true);  
	$validate->addRule($_POST['confirm_password'],'','Confirm Password',true);  
	
	if($validate->validate() && count($stat)==0) 
	{	
		$iRecord=$db->getRow("select * from student_guardian where id='".$_SESSION['userid']."'");
	
		if($iRecord['password']==$_POST['old_password'])
		{
			if($_POST['new_password']==$_POST['confirm_password'])
			{
				$aryData=array(
								'password'		=>	$_POST['new_password'],
								);
					$flgIn1 = $db->updateAry("student_guardian",$aryData, "where id ='".$_SESSION['userid']."'");
					echo "1";
					exit;
		    }
			else
			{
				$stat['error'] = "Confirm password do not match";	
			}
		}
		else
		{
			$stat['error'] = "Incorrect old password";
		}
	}	
	else
	{
		$stat['error'] = $validate->errors();
	}
	echo msg($stat);
}	
?>