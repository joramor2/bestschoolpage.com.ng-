<?php  
if($_SESSION['userid']=='')
{
	redirect(SITE_URL."login.php");	
}
$iLoginUserDetail=$db->getRow("select * from school_register where id='".$_SESSION['userid']."'");
$create_by_usertype = $iLoginUserDetail['create_by_usertype'];
if($iLoginUserDetail['create_by_userid']=='0')
{
	$create_by_userid = $_SESSION['userid'];
}
else
{
	$create_by_userid = $iLoginUserDetail['create_by_userid'];
}


?>