<?php  
if($_SESSION['userid']=='')
{
	redirect(PARENT_URL);	
}
$iLoginUserDetail=$db->getRow("select * from student_guardian where id='".$_SESSION['userid']."'");

$create_by_usertype = $iLoginUserDetail['create_by_usertype'];

if($iLoginUserDetail['create_by_userid']=='0')
{
	$create_by_userid = $_SESSION['userid'];
}
else
{
	$create_by_userid = $iLoginUserDetail['create_by_userid'];
}


$iCurrentskoolnameDetails=$db->getRow("select * from  school_register where id='".$create_by_userid."'");
?>