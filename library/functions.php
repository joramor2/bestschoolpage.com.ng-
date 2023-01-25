<?php



function __autoload($strClass)



{



	$strFile="class.".strtolower($strClass).".php";



	require_once(PATH_CLASS.$strFile);



}


function showcurrency()
	{
		echo "₹";	
	}
	
function productdetail($pid)
{	
	global $db;
	$getThis=$db->getVal("select att_value from pro_att where pid='".$pid."' ");
	$iPagelurl=$db->getVal("select pageurl from products where id='".$pid."' ");
	return SITE_URL.'product-detail.php?productname='.$iPagelurl.'&att1='.$getThis;
}


function PageUrl($iPageUrl)
{  
	
	
    $iGetstring = preg_replace("/[^ \w]+/", "", $iPageUrl);
	$replace = array(",","'", "!","@","#","$", "%", "^", "&", "*", "(", ")" , "+" , "=", "â", "’","?","&","+","~"," ");
  	$makeurl= str_replace($replace,"-",$iGetstring);
	$iRmoveHypn = array("------","------","-----","-----","-----","----","---","--");
	$blog_url= str_replace($iRmoveHypn,"-",$makeurl);
	return $iMakeLetter = strtolower($blog_url);

}





function get_client_ip() {



    $ipaddress = '';



    if (getenv('HTTP_CLIENT_IP'))



        $ipaddress = getenv('HTTP_CLIENT_IP');



    else if(getenv('HTTP_X_FORWARDED_FOR'))



        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');



    else if(getenv('HTTP_X_FORWARDED'))



        $ipaddress = getenv('HTTP_X_FORWARDED');



    else if(getenv('HTTP_FORWARDED_FOR'))



        $ipaddress = getenv('HTTP_FORWARDED_FOR');



    else if(getenv('HTTP_FORWARDED'))



       $ipaddress = getenv('HTTP_FORWARDED');



    else if(getenv('REMOTE_ADDR'))



        $ipaddress = getenv('REMOTE_ADDR');



    else



        $ipaddress = 'UNKNOWN';



    return $ipaddress;



}















function createbyuser($iUserid)



		{



			global $db;



		$iCreateUserID=$db->getVal("select   create_by from  admin_login where id='".$iUserid."'");	



		return $iCreateUserID;



		



		}


























function dt($val) { 







    $arrWeek = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");



    return $arrWeek[$val];



}







function redirect($url=NULL)



{



	if(is_null($url)) $url=curPageURL();



	if(headers_sent())



	{



		echo "<script>window.location='".$url."'</script>";



	}



	else



	{



		header("Location:".$url);



	}



	exit;



}











 







function msg($msg)



{



	if(count($msg))



	foreach($msg as $type => $content)



	if($msg[$type]!='')



	{



	 return '<div class="alert alert-'.$type.' alert-dismissable" style="height:40px; margin-top: -5px;">



                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.$content.'</div>';



	}



} 























function curPageURL() 



{



	$pageURL = 'http';



 	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}



 	$pageURL .= "://";



 	if ($_SERVER["SERVER_PORT"] != "80") 



	{



  		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];



 	} 



	else 



	{



  		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];



 	}



 	return $pageURL;



}











 















 







 















 















function getPaging($refUrl,$aryOpts,$pgCnt,$curPg)







{







 	$return='';







	$return.='<ul class="pagination">';







	if($curPg>1)







	{







		$aryOpts['pg']=1;







		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">First</a></li>';







		







		$aryOpts['pg']=$curPg-1;







		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Prev</a></li>';







	}







	







	







	







	







		$i=$pgCnt;







 		$upto=$_GET['pg']+1;







 		$downto=$_GET['pg']-1;







		







 		if($upto>$pgCnt)







 		{







 			$upto=$pgCnt;







 		}







 		if($downto<=0)







  		{







 			$downto=1;







 		}







 		if($pgCnt>1)







		{ 







			 







			for($i=$downto;$i<=$upto;$i++)







			{







				if($i==$curPg)







 				{







 				$return.= '<li >'."<a class='selected' href=\"$refUrl?pg=$i\">".$i.'</a><li>';







 				}







 				else







 				{







 				$return.= "<li><a href=\"$refUrl?pg=$i\">".$i."</a></li>";







 				}







 			}







 		}







	







 	







	 







	if($curPg<$pgCnt)







	{







		$aryOpts['pg']=$curPg+1;







		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Next</a></li>';







		$aryOpts['pg']=$pgCnt;







		$return.='<li><a href="'.$refUrl.getQueryString($aryOpts).'">Last</a></li>';







	}







	$return.='<div class="clearfix"></div></ul>';







	return $return;







}















 



 











 















function getStatusImg($status)







{







	$aryImg=array(







				  '0'=>"status_inactive.png",







				  '2'=>"status_reject.png",







				  '1'=>"status_active.png"







				  );







	return '<img src="'.URL_ADMIN_IMG.$aryImg[$status].'" title="'.getStatusStr($status).'" />';







}















function getOptionImg($status)







{







	$aryImg=array(







				  '0'=>"cross.png",







				  '1'=>"tick.png"







				  );







	return '<img src="'.URL_ADMIN_IMG."icons/".$aryImg[$status].'" />';







}















function getStatusStr($val)



{



	if($val==0)



	{



		return "Inactive";



	}



	elseif($val==1)



	{



		return "Active";



	}



	else



	{



		return "Pending";	



	}



}







 















 











 







function randomFixnew($length)



{



	$random= "";



	srand((double)microtime()*1000000);



	$data = "1234567890";



	for($i = 0; $i < $length; $i++)



	{



		$random .= substr($data, (rand()%(strlen($data))), 1);



	}



	return $random;



}















 











 







 







 















function randomFix($length)







{







	$random= "";







	







	srand((double)microtime()*1000000);







	







	$data = "AbcDE123IJKLMN67QRSTUVWXYZ";







	$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";







	$data .= "0FGH45OP89";







	







	for($i = 0; $i < $length; $i++)







	{







		$random .= substr($data, (rand()%(strlen($data))), 1);







	}







	return $random;







}















 















 







function addtocart($pid,$qty)







{







	if(!isset($_SESSION['cart']))







	{







		$_SESSION['cart'][$pid] = $qty;







	}







	else







	{







			if(array_key_exists($pid,$_SESSION['cart']))







			{







				$_SESSION['cart'][$pid] =$_SESSION['cart'][$pid]+ $qty;







			}







			else







			{







				$_SESSION['cart'][$pid] =$qty;







			}







	}







	







}







function updatecart($pid,$qty)







{







if($qty ==0 or empty($qty))







	{







		unset($_SESSION['cart'][$pid]);







	}







	else







	{







		$_SESSION['cart'][$pid] = $qty;







	}







}











 















class Paging







{







	var $rowsPerPage =4;















	var $pageNum = 1;















	var $numrows = 0;















	var $maxPage = 0;















	var $offset = 0;















	function sql($fields="*",$table,$cond='')















	{  















	  $this->pageNum = isset($_REQUEST['gotopage'])?$_REQUEST['gotopage']:1;















	  $this->offset = ($this->pageNum - 1) * $this->rowsPerPage;







		







		$query = "select $fields from $table $cond LIMIT ".$this->offset.", ".$this->rowsPerPage;







		







		//echo $query;







		







		//echo "<br />";















	  $q = mysql_query($query);















		$query2 = "select $fields from $table $cond  ";







		







		//echo $query2;







		







		//echo "<br />";















	  $q2 = mysql_query($query2);		















	  $this->numrows = mysql_num_rows($q2);















 	  $this->maxPage = ceil($this->numrows/$this->rowsPerPage);  















	  return $q;















	}







	























 







	function navigations($param='ser=')















	{















		















	//	$self = basename($_SERVER['PHP_SELF']);	







    $self = $_SERVER['PHP_SELF']."?"; // edited	







		















		//$self = $self ."?".$param;







          $self = $self ."".$param;  // edited	















		if ($this->pageNum > 1)















		{















			$gotopage = $this->pageNum - 1;















			$prev = "<li class=\"text\" ><a  href=\"$self&gotopage=$gotopage\">Prev</a></li>";















			//$first = "<li class=\"text\"><a  href=\"$self&gotopage=1\">First</a><li>";















		} 















		else















		{















			$prev  = '';       // we're on page one, don't enable 'previous' link















			$first = ''; // nor 'first page' link















		}















		if ($this->pageNum < $this->maxPage)















		{















			$gotopage = $this->pageNum + 1;















			$next = "<li class=\"text\"><a  href=\"$self&gotopage=$gotopage\">Next</a><li>";















			//$last = "<li class=\"text\"><a  href=\"$self&gotopage=".$this->maxPage."\">Last</a></li>";















		} 















		else















		{















			$next = '';      // we're on the last page, don't enable 'next' link















			$last = ''; // nor 'last page' link















		}	















		$i=$this->pageNum;















		$upto=$i+3;















		$downto=$i-3;















		if($upto>$this->maxPage)















		{















			$upto=$this->maxPage;















		}















		















		if($downto<=0)















		















		{















			$downto=1;















		}















		















		if($this->maxPage>1)















		{















			for($i=$downto;$i<=$upto;$i++)















			{















				if($i==$this->pageNum)















				{















				$pages .= '<li >'."<a class='selected' href=\"$self&gotopage=$i\">".$i.'</a><li>';















				}















				else















				{















				$pages .= "<li><a href=\"$self&gotopage=$i\">$i</a></li>";















				}















			















			}















		}















		return '<div class="paging"><ul>'.$first . $prev."&nbsp;&nbsp;$pages&nbsp;&nbsp;".$next . $last.'</ul></div>';	















	}































}











 



























function sendmailfromlocal($to,  $subject, $message)



{  







include(PATH_LIB."class.phpmailer.php");



$mail = new PHPMailer;



$mail->IsSMTP();                                      // Set mailer to use SMTP



$mail->Host = 'localhost';                 // Specify main and backup server



$mail->Port = 587;                                    // Set the SMTP port



$mail->SMTPAuth = true;                               // Enable SMTP authentication



$mail->Username = 'noreply@gopartee.com';                // SMTP username



$mail->Password = 'L)zJl0eswD#2';                  // SMTP password



$mail->SMTPSecure = '';                            // Enable encryption, 'ssl' also accepted



$mail->From = 'noreply@gopartee.com';



$mail->FromName = 'gopartee.com';



//$mail->AddAddress('test@trivedieffect.com', 'Trivedi Effect');  // Add a recipient



$mail->AddAddress($to);               // Name is optional



$mail->IsHTML(true);                                  // Set email format to HTML



$mail->Subject = $subject;



$mail->Body    = $message;



$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';



if(!$mail->Send()) {



   echo 'Message could not be sent.';



   echo 'Mailer Error: ' . $mail->ErrorInfo;



   exit;



}



return 'Message has been sent';



}







function smart_resize_image( $file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false )







 {}














function getPagingNews($refUrl,$aryOpts,$pgCnt,$curPg)
{
 	$return='';
	$return.='<ul class="pagination">';
	if($curPg>1)
 	{
 		$iPrevPage=$curPg-1;
 		$return.='<li><a href="'.$refUrl.'pg=1">First</a></li>';
 		$aryOpts['pg']=$curPg-1;
 		$return.='<li><a href="'.$refUrl.'pg='.$iPrevPage.'">Prev</a></li>';

	}
 		$i=$pgCnt;
  		$upto=$_GET['pg']+1;
  		$downto=$_GET['pg']-1;
  		if($upto>$pgCnt)
  		{
  			$upto=$pgCnt;
  		}
  		if($downto<=0)
   		{
  			$downto=1;
  		}
  		if($pgCnt>1)
 		{ 
  			for($i=$downto;$i<=$upto;$i++)
 			{
 				if($i==$curPg)
  				{
  				$return.= '<li >'.'<a class="selected" href="'.$refUrl.'pg='.$i.'">'.$i.'</a></a><li>';
  				}
  				else
  				{
  				$return.= '<li><a href="'.$refUrl.'pg='.$i.'">'.$i.'</a></li>';
  				}
  			}
  		}

 	if($curPg<$pgCnt)
 	{
 		$iNext=$curPg+1;
 		$return.='<li><a href="'.$refUrl.'pg='.$iNext.'">Next</a></li>';
 		$aryOpts['pg']=$pgCnt;
 		$return.='<li><a href="'.$refUrl.'pg='.$pgCnt.'">Last</a></li>';
 	}
 	$return.='<div class="clearfix"></div></ul>';
 	return $return;

}

function emailOTP($length)

{

	$random= "";

	$data .= "0987654321";
	$data .= "1234567890";

	

	for($i = 0; $i < $length; $i++)

	{

		$random .= substr($data, (rand()%(strlen($data))), 1);

	}

	return $random;

}
?>