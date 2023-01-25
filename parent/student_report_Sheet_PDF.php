<?php
namespace Dompdf;
require_once ('dompdf_New/autoload.inc.php');
ob_start();
include('../config.php');
include('inc.session-create.php');

$iupdatedetails = $db->getRow("select * from  school_register where id='".$_SESSION['userid']."'"); 

$schoolDetails = $db->getRow("select * from  school_register where create_by_userid='".$iupdatedetails['create_by_userid']."'"); 
$stae = $db->getRow("select * from state where id='".$schoolDetails['state']."'");
$statename=$stae['title'];
$currentStudent=$db->getRow("select * from manage_student where randomid='".$_GET['randomid']."'");

//-----------------------------------
$assesmentALL=$db->getVal("select GROUP_CONCAT(assesment_id) from score_entry_time_frame where create_by_userid='".$iupdatedetails['create_by_userid']."' and session='".$currentStudent['session']."' order by id desc "); 
										
$totalAssesment=explode(',',$assesmentALL)					
						 
?>


<html>
 <head>
  <title>REPORT SHEET</title>
  <body style="border: 1px solid; background: url(logo.jfif);
    background-repeat: no-repeat;
    background-size: contain;    background-position: 50% 200px;">
   <table style="width:100%;">
<tr>
<td colspan="2" style="width: 90px;"> 
  <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <img style="width:80%" src="../uploads/<?php echo $schoolDetails['logo']; ?>">
  </div>
</td>

<td colspan="3"> 
       <p style="font-size: 22px;color: #2196F3;font-weight: bolder;text-align: center;font-family: sans-serif;margin-bottom: 0;"><?php echo $schoolDetails['name']; ?> </p> 
       <p style="font-size: 22px;color: #2196F3;font-weight: bolder;text-align: center;font-family: sans-serif;margin-top:0px;margin-bottom:0px;"> </p>     
       <p style="font-size: 12px;font-weight:600;text-align:center;font-family: sans-serif;margin-top:0px;">Website:<?php echo $schoolDetails['website']; ?></p>
	   <p style="font-size: 12px;font-weight:600;text-align:center;font-family: sans-serif;margin-top:0px;"><?php echo $schoolDetails['location']; ?>, <?php echo $statename; ?>.</p>
	   <p style="font-size: 15px;text-align:center;font-family: sans-serif;margin-top:30px;margin-bottom:0px;">REPORT SHEET </p>
</td>
<p></p>
</tr>

<table cellspacing="0"; style="width: 100%;">
<hr>
 <tbody style="font-family: sans-serif;">
<tr>
<td style="width:100%;" >


<table style="width:100%;">


<tr>
<td style="" colspan="3"><b>NAME:</b><?php echo $currentStudent['first_name'].' '.$currentStudent['last_name']; ?></td>
<!--<td style="" colspan="3">Final Grade: B</td>-->
</tr>



<tr>
<td style=""><b>Class:</b><?php echo $db->getVal("select name from school_class where id='".$currentStudent['class']."'");?></td>
<td style=""></td>
<!--<td style=""><b>Final Position:</b></td>
<td style="">5th</td>-->
<td style=""></td>
<td style=""></td>
</tr>


<tr>
<td></td>
</tr>
<tr>
<td></td>
</tr>



<!--<tr>
<td style=""><b>Admission No:</b></td>
<td style="">18/4890</td>
<td style=""><b>Total Score:</b></td>

<td style="">1160.0</td>
<td style=""></td>
<td style=""></td>
</tr>--->



<!--<tr>
<td style=""><b>Session:</b></td>
<td style="">2018/2019</td>
<td style=""><b>Final Average:</b></td>

<td style="">56.21</td>
<td style="">ATTENDANCE</td>
<td style=""></td>
</tr>
<tr>
<td style=""><b>Term:<b></td>
<td style="">FIRST</td>
<td style=""><b>Final Position:</b></td>

<td style="">56.00</td>
<td style=""><b>Days School Open:</b></td>
<td style="">55.00</td>
</tr>


<tr>
<td style=""><b>No. in Class:</b></td>
<td style="">54</td>
<td style=""><b>Highest Ave. in Class:</b></td>

<td style="">89.00</td>
<td style=""><b>Day(s) Present:</b></td>
<td style="">130.00</td>
</tr>
<tr>
<td style=""></td>
<td style=""></td>
<td style=""><b>Lowest Ave. in Class:</b></td>
<td style="">26.00</td>
<td style=""><b>Day(s) Absent:</b></td>
<td style="">55.00</td>
</tr>-->
</table>
</td>
</table>
</td>
</tr>
</tbody>
</table>


<table cellspacing="0"; style="width: 100%;">
 <tbody style="font-size: 18px;font-weight: bolder;font-family: sans-serif;">
	<tr style="height: 50px;">
    
	
	
	<td style="  border: 1px solid #000000;text-align: center;">SUBJECT</td>
    <?php
	foreach($totalAssesment as $Val) 
	{
	?>
	<td style="  border: 1px solid #000000;text-align: center;">
	<?php
	echo $db->getVal("select assesment from school_assessment where id='".$Val."'").'('.$db->getVal("select percentage from score_entry_time_frame where assesment_id='".$Val."'").')'; 
	?>
	</td>
	<?php } ?>
	
	
	<td style="  border: 1px solid #000000;text-align: center;">TOTAL</td>
	<td style="  border: 1px solid #000000;text-align: center;">GRD</td>
    
	<td style="  border: 1px solid #000000;text-align: center;">AVG</td>
  
  </tr>
	<?php  
	$subjectdetail=$db->getRows("select * from school_subject where class_id = '" .$currentStudent['class']. "' and create_by_userid='".$iupdatedetails['create_by_userid']."'");
	$tSub=0;
	foreach ($subjectdetail as $Ilist) { 
	$tSub++;
	?>
<tr style="height: 35px;">
    <td style="  font-weight: 100; border: 1px solid #000000;"> <?php echo $Ilist['subject']; ?></td>
	
	<?php
										$count=0;
										foreach($totalAssesment as $Val) 
										{ 
										$count=$count+1;
										$score=$db->getRow("select * from input_score_class_teacher where assesment_id='".$Val."' and student_id='".$currentStudent['id']."' and subject_id='".$Ilist['id']."' and create_by_userid='".$iupdatedetails['create_by_userid']."'");
										?>
										<td style="  font-weight: 100; text-align: center;border: 1px solid #000000;">
										<?php echo $score['score']; ?>
										</td>
										<?php $sum=$score['score'];
										${"d" . $Ilist['id']}+=$sum;
										?>									  
										<?php } 
										$grandTotal = ${"d" . $Ilist['id']};
										?>
										<td style="  font-weight: 100; text-align: center;border: 1px solid #000000;">
										<?php
										$a=$Ilist['id'];
										echo round($grandTotal);
										$totalScore+=$grandTotal;
										?>
										</td>
										<td style="  font-weight: 100; text-align: center;border: 1px solid #000000;">
										<?php 
										echo  $gradding=$db->getVal("select grade from school_grade where maximum_number > ".$grandTotal." or maximum_number = ".$grandTotal."");
										?>
										</td>
									    <td style="  font-weight: 100; text-align: center;border: 1px solid #000000;">
										<?php
										$a=$Ilist['id'];
										echo $grandTotal/$count;
										?>
										</td>                                  
								
	
	
    
  </tr>
	<?php } ?>

  
  </tbody>
</table>
</table>
<!---------->

<table cellspacing="0" ;="" style="width: 100%;">
 <tbody style="font-family: sans-serif;">
<tr>
<td style="width:100%;">
<br><table style="width:100%;">



<tbody><tr>
<td style="
    padding: 0;
    vertical-align: baseline;
    width: 50%;
">


<table cellspacing="0" ;="" style="width: 95%;">
 <tbody style="font-size: 16px;font-family: sans-serif;">
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">AFFECTIVE TRAITS</td>
    <td style="  border: 1px solid #000000;text-align: center;">RATING</td>
  
  </tr>	
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>

  </tbody>
</table>

</td>


<td style="text-align: center;">


<table cellspacing="0" ;="" style="width: 100%;">
 <tbody style="font-size: 16px;font-family: sans-serif;">
 
 <tr>
 <td>
 <table cellspacing="0" ;="" style="width: 100%;">
 <tbody><tr>
 <td>
 
  </td></tr><tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">AFFECTIVE TRAITS</td>
    <td style="  border: 1px solid #000000;text-align: center;">RATING</td>
  
  </tr>	
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>



</tbody></table>

</td>
</tr>
 

 <tr>
 <td>
 <table cellspacing="0" ;="" style="width: 100%;margin-top: 60px;">
 <tbody><tr>
 <td>
 
  </td></tr><tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">AFFECTIVE TRAITS sdgdfgdf</td>
    <td style="  border: 1px solid #000000;text-align: center;">RATING</td>
  
  </tr>	
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>
  <tr style="height: 40px;">
    <td style="  border: 1px solid #000000;">PUNCTUALITY</td>
    <td style="  border: 1px solid #000000;text-align: center;">4</td>
  
  </tr>



</tbody></table>

</td>
</tr>
 




 </tbody>




</table>





</td>
</tr>

</tbody></table>
</td>
</tr>
</tbody>
</table>
<!---------->
<br><br><br>
<?php if($tSub!='') { ?>
			<table class="table table-striped table-bordered">
			    <tr>
				<td>
				<span>No. of Subjects: <?php echo $tSub; ?></span>
				</td>
				
				<td>
				<span>Total Score:<?php echo $totalScore; ?></span>
				</td>
				</tr>
				
				<tr>
				<td>
				<span>Final Average: <?php echo $avg=$totalScore/$tSub; ?></span>
				</td>
				
				<td>
				<span>Final Grade:
				<?php 
				echo $db->getVal("select grade from school_grade where maximum_number > ".$avg." or maximum_number = ".$avg."");
				?>
				</span>
				</td>
				</tr>
            
			</table>	
			<?php } ?>				
          
  
</body>
  
 </head>
</html>
<?php
$html = ob_get_clean();

$dompdf = new Dompdf();

$dompdf->setPaper('A4', 'portrait');
$dompdf->load_html($html);
$dompdf->render();
//For view
$dompdf->stream("",array("Attachment" => false));
// for download
//$dompdf->stream("REPORT_SHEET");
?>