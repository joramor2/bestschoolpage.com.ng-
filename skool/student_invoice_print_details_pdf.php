<?php 
include('../config.php');
// require_once('takefee.php');
include('inc.session-create.php');
require 'dompdf_New/autoload.inc.php';

use Dompdf\Dompdf;

// getting values to use in details_pdf.php

$iStudentFeeDetailsPdf = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and randomid= '" . $_GET['token'] . "'");

$iStudentNamePdf  = $db->getRow("select id, first_name,last_name from  manage_student where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetailsPdf['student_id'] . "'");

$studentSessionPdf = $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetailsPdf['session'] . "'");

$studentClassPdf =  $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetailsPdf['class'] . "'");

$studentTermPdf = $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetailsPdf['term_id'] . "'");

$ifeeSturcturePdf = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");

$iupdatedetails = $db->getRow("select * from  school_register where id='".$_SESSION['userid']."'"); 


// instantiate and use the dompdf class
$dompdf = new Dompdf();
ob_start();
require('student_invoice_details_pdf.php');
$html =ob_get_contents();
ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('student_invoice_print_details.pdf',['Attachment'=>false]);
