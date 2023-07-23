<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Student Fee";
$FileName = 'takefee.php';
$validate = new Validation();
if ($_SESSION['success'] != "") {
  $stat['success'] = $_SESSION['success'];
  unset($_SESSION['success']);
}
if (isset($_POST['addnewrecord']) || isset($_POST['addnewrecordFix']) ) {
  
  if ($validate->validate() && count($stat) == 0) {

    $iLastId = $db->getVal("select id from student_fee order by id desc") + 1;
    $iRandomId = randomFix(15) . $iLastId;

    $aryData = array(
      'student_id'             =>  $_POST['student_id'],
      'session'               =>  $_POST['session'],
      'class'                 =>  $_POST['class'],
      'term_id'               =>  $_POST['term_id'],
      'rollno'               =>  $_POST['rollno'],
      'student_status'           =>  $_POST['student_status'],
      'PType'                 => $_POST['PType'],

      'total_amount_to_pay'         =>  $_POST['total_amount_to_pay'],
      'currently_paying_amount'       =>  $_POST['currently_paying_amount'],
      'remain_amount'             =>  $_POST['remain_amount'],
      'discount_amount'           =>  $_POST['discount_amount'],

      'invoiceno'              =>  $_POST['invoiceno'],

      'userid'              =>  $_SESSION['userid'],
      'usertype'              =>  $_SESSION['usertype'],

      'create_by_usertype'         =>  $create_by_usertype,
      'create_by_userid'           =>  $create_by_userid,
      'randomid'               =>  $iRandomId,

      'create_at'             =>  date("Y-m-d H:i:s"),
      'update_at'             =>  date("Y-m-d H:i:s"),
    );

    $flgIn = $db->insertAry("student_fee", $aryData);

    $iLastInsertId = $flgIn;

    foreach ($_POST['fee_sturcture_id'] as $key => $val) {

      $aryData = array(
        'student_fee_id'           =>  $iLastInsertId,
        'fee_sturcture_id'           =>  $_POST['fee_sturcture_id'][$key],
        'fee'                 =>  $_POST['fee'][$key],
        'fees_disccount'           =>  $_POST['fees_disccount'][$key],

        'fees_outstanding'           =>  $_POST['fees_outstanding'][$key],
        'fees_date'               =>  $_POST['fees_date'][$key],

        'fees_amount'             =>  $_POST['fees_amount'][$key],
        'payment_mode'             =>  $_POST['payment_mode'][$key],
      );
      $BflgIn = $db->insertAry("student_fee_sturcture", $aryData);
    }
  //  die(print_r($aryData));

    $aryData = array(
      'student_fee_id'           =>  $iLastInsertId,
      'student_id'             =>  $_POST['student_id'],
      'session'             =>  $_POST['session'],
      'class'             =>  $_POST['class'],
      'term_id'             =>  $_POST['term_id'],
      'fullname'             =>  $_POST['fullname'],
      'invoiceno'              =>  $_POST['invoiceno'],



      'total_amount_to_pay'         =>  $_POST['total_amount_to_pay'],
      'currently_paying_amount'       =>  $_POST['currently_paying_amount'],
      'remain_amount'             =>  $_POST['remain_amount'],
      'discount_amount'           =>  $_POST['discount_amount'],

      'userid'              =>  $_SESSION['userid'],
      'usertype'              =>  $_SESSION['usertype'],

      'create_by_usertype'         =>  $create_by_usertype,
      'create_by_userid'           =>  $create_by_userid,

      'create_at'             =>  date("Y-m-d H:i:s"),
    );

    $BflgIn = $db->insertAry("student_fee_transcation", $aryData);

    $_SESSION['success'] = "Submit successfully.";
    redirect($FileName . '?action=view&token=' . $iRandomId);
  } else {
    $stat['error'] = $validate->errors();
  }
} elseif (isset($_POST['updaterecord'])) {

  $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and randomid= '" . $_GET['token'] . "' and create_by_userid='" . $create_by_userid . "'");
  $iTotalAMountPaid = $iStudentFeeDetails['currently_paying_amount'] + $_POST['currently_paying_amount'];
  $iRemainAmount = $iStudentFeeDetails['total_amount_to_pay'] - $iTotalAMountPaid;

  $aryData = array(




    'total_amount_to_pay'         =>  $_POST['total_amount_to_pay'],
    'currently_paying_amount'       =>  $_POST['currently_paying_amount'],
    'remain_amount'             =>  $_POST['remain_amount'],
    'discount_amount'           =>  $_POST['discount_amount'],
    'update_at'             =>  date("Y-m-d H:i:s"),



  );
  $flgIn = $db->updateAry("student_fee", $aryData, "where randomid= '" . $iStudentFeeDetails['randomid'] . "'");

  $flgIn1 = $db->delete("student_fee_sturcture", "where student_fee_id='" . $iStudentFeeDetails['id'] . "'");

  foreach ($_POST['fee_sturcture_id'] as $key => $val) {

    $aryData = array(
      'student_fee_id'           =>  $iStudentFeeDetails['id'],
      'fee_sturcture_id'           =>  $_POST['fee_sturcture_id'][$key],
      'fee'                 =>  $_POST['fee'][$key],
      'fees_disccount'           =>  $_POST['fees_disccount'][$key],

      'fees_outstanding'           =>  $_POST['fees_outstanding'][$key],
      'fees_date'               =>  $_POST['fees_date'][$key],

      'fees_amount'             =>  $_POST['fees_amount'][$key],
      'payment_mode'             =>  $_POST['payment_mode'][$key],
    );
    $BflgIn = $db->insertAry("student_fee_sturcture", $aryData);
  }

  $aryData = array(
    'student_fee_id'           =>  $iStudentFeeDetails['id'],
    'student_id'             =>  $iStudentFeeDetails['student_id'],
    'session'             =>  $_POST['session'],
    'class'             =>  $_POST['class'],
    'term_id'             =>  $_POST['term_id'],
    'fullname'             =>  $_POST['fullname'],
    'invoiceno'              =>  $_POST['invoiceno'],



    'total_amount_to_pay'         =>  $_POST['total_amount_to_pay'],
    'currently_paying_amount'       =>  $_POST['currently_paying_amount'],
    'remain_amount'             =>  $_POST['remain_amount'],
    'discount_amount'           =>  $_POST['discount_amount'],

    'userid'              =>  $iStudentFeeDetails['userid'],
    'usertype'              =>  $iStudentFeeDetails['usertype'],

    'create_by_usertype'    =>  $iStudentFeeDetails['create_by_usertype'],
    'create_by_userid'        =>  $iStudentFeeDetails['create_by_userid'],

    'create_at'             =>  date("Y-m-d H:i:s"),
  );
  $BflgIn = $db->insertAry("student_fee_transcation", $aryData);


  redirect($FileName . '?action=view&token=' . $iStudentFeeDetails['randomid']);
} elseif ($_GET['action'] == 'delete') {
  $flgIn1 = $db->delete("withdrawal_request", "where randomid='" . $_GET['randomid'] . "'");
  $_SESSION['success'] = 'Deleted Successfully';
  redirect($FileName);
}
?>
<!DOCTYPE html>
<html>

<head>
  <?php include('inc.meta.php'); ?>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif" />
  <style>
    body,
    label,
    span,
    a,
    .gwt-Button {
      font-family: 'Droid Serif' !important;
    }

    .abhi .nav-tabs {
      border-bottom: 2px solid #DDD;
    }

    .abhi .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover {
      border-width: 0;
    }

    .abhi .nav.nav-tabs>li>a:hover,
    .nav.tabs-vertical>li>a:hover {
      color: #1B3058 !important;
    }

    .abhi .nav-tabs>li>a {
      border: none;
      color: #1B3058 !important;
    }

    .abhi .nav-tabs>li.active>a,
    .nav-tabs>li.active>a:focus,
    .nav-tabs>li.active>a:hover,
    .tabs-vertical>li.active>a,
    .tabs-vertical>li.active>a:focus,
    .tabs-vertical>li.active>a:hover {
      color: #1B3058 !important;
    }

    .abhi .nav>li>a i {
      font-size: 16px;
      padding-right: 5px;
    }

    .abhi .nav-tabs>li>a::after {
      content: "";
      background: #1B3058;
      height: 2px;
      position: absolute;
      width: 100%;
      left: 0px;
      bottom: -1px;
      transition: all 250ms ease 0s;
      transform: scale(0);
    }

    .abhi .nav-tabs>li.active>a::after,
    .nav-tabs>a::after {
      transform: scale(1);
    }

    .abhi .tab-nav>li>a::after {
      background: #5a4080 none repeat scroll 0% 0%;
      color: #fff;
    }

    .abhi .tab-pane {
      padding: 25px 0;
    }

    .abhi .tab-content {
      padding: 20px;
    }

    .abhi .nav-tabs>li {
      width: 30%;
      text-align: center;
    }

    .abhi .card {
      background: #FFF none repeat scroll 0% 0%;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      margin-bottom: 30px;
    }

    .abhi body {
      background: #EDECEC;
      padding: 50px;
    }

    .abhi .ass .select-hide {
      display: none;
    }

    .abhi .ass .custom-select select {
      display: none;
    }

    .abhi .ass .select-selected {
      border-bottom: 1px solid #9e9e9e;
    }

    .abhi .ass .ytr {
      margin-top: 22px;
    }

    .abhi .fdg {
      border-bottom: 1px solid #9e9e9e2b;
    }

    .abhi .shg p {
      color: #1B3058;
    }

    .abhi .ass .bgb i {
      color: #1B3058;
      font-size: 19px;
    }

    .abhi .ass .col-md-4 i {
      background: #F44336;
      padding: 8px;
      border-radius: 50%;
      color: #fff;
      font-size: 14px;
    }

    .abhi .ass .shg {
      padding-top: 29px;
    }

    .abhi .ass .select-items {
      border: 1px solid #ddd;
      padding: 9px;
      position: relative;
      bottom: 20px;
      background: #fff;
    }

    .abhi .ass .select-items div {
      padding-bottom: 7px;
    }

    .abhi .ab-1 {
      text-align: center;
    }

    .abhi .icon i {
      color: #0b4587;
      background: #fff;
      font-size: 32px;
      border-radius: 50%;
      position: absolute;
      bottom: -25px;
      left: 0;
      right: 0;
      width: 100%;
      margin: 0 auto;
      padding: 15px 10px 15px 10px;
    }

    .abhi .icon input {
      position: absolute;
      left: 0;
      opacity: 0;
      width: 100%;
      right: 0;
      top: -18px;
    }

    .abhi .abhish .input-field {
      padding-bottom: 0;
    }

    .abhi .abh {
      margin-top: 35px;
    }

    .abhi .input-field input {
      background-color: transparent;
      border: none;
      border-bottom: 1px solid #9e9e9e;
      border-radius: 0;
      outline: none;
      width: 100%;
      margin: 0 0 15px 0;
      padding: 0;
      box-shadow: none;
      box-sizing: content-box;
      transition: all .3s;
    }

    .abhi .input-field label {
      color: #9e9e9e;
    }

    .abhi .icon {
      position: relative;
      left: 0;
      bottom: 0;
      width: 7%;
      margin: 0 auto;
      right: 0;
      height: 0;
      top: 0;
    }

    .abhi .ab-2 {
      background: #0b4587;
      color: #fff;
      width: 23%;
      padding: 28px;
      margin: 0 auto;
    }

    .abhi .imgage {
      padding-bottom: 13px;
    }

    .abhi .abb {
      text-align: center;
    }

    .abhi .ab-3 {
      margin-top: 30px;
    }

    .abhi .plp {
      margin-bottom: 80px;
    }

    .abhi .ab-3 .col-md-1 i {
      font-size: 17px;
      color: #000000d6;
    }

    .abhi .ab-3 .col-md-4 i {
      background: #F44336;
      padding: 8px;
      border-radius: 50%;
      color: #fff;
      font-size: 14px;
    }

    .abhi .ab-3 input {
      color: rgba(0, 0, 0, 0.26);
      border-bottom: 1px dotted rgba(0, 0, 0, 0.26);
    }

    .abhi button {
      cursor: pointer;
      float: right;
      background: #1B3058;
      color: #fff;
    }

    .abhi button:hover {
      background: #1B3058;
      color: #fff;
    }

    .abhi button i {
      padding-right: 45px;
      font-size: 13px;
    }

    .abhi .input-field {
      padding-bottom: 20px;
    }

    .abhi .assde {
      margin-top: 50px;
    }

    .abhi .ade {
      margin-top: 40px;
    }

    .abhi .bgb {
      text-align: center;
      padding-top: 3px;
    }

    .abhi .bgb i {
      color: #1B3058;
      font-size: 19px;
    }

    @media all and (max-width: 724px) {
      .abhi .nav-tabs>li>a>span {
        display: none;
      }

      .abhi .nav-tabs>li>a {
        padding: 5px 5px;
      }
    }

    .page-title {
      margin-bottom: 30px;
    }

    .tetable tr td {
      font-size: 17px;
    }

    .tetable tr td b {
      font-size: 16px;
    }

    .table {
      text-align: center;
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
          <div class="abhi">
            <div class="container">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="<?php if ($_GET['action'] == '') {
                                                        echo "active";
                                                      } ?>"> <a href="<?php echo $FileName; ?>"> <i class="fa fa-line-chart" aria-hidden="true"></i><span> SALES LEDGER</span> </a> </li>

                      <li role="presentation" class="<?php if ($_GET['action'] == 'add') {
                                                        echo "active";
                                                      } ?>"> <a href="<?php echo $FileName; ?>?action=add"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Invoice Register</span> </a> </li>
                      <li role="presentation" class="<?php if ($_GET['action'] == 'transaction') {
                                                        echo "active";
                                                      } ?>"> <a href="<?php echo $FileName; ?>?action=transaction"> <i class="fa fa-hourglass-start" aria-hidden="true"></i><span>All Transactions</span> </a> </li>
                    </ul>
                    <div class="tab-content">
                      <?php if ($_GET['action'] == 'add') { ?>
                        <div role="tabpanel" class="tab-pane active" id="profilxe">
                          <div class="form-group clearfix ">

                            <form action="" method="POST">
                              <div class="form-group clearfix ">
                                <div class="col-lg-2">
                                  <select class="form-control" name="session">
                                    <option value=""> Select Session </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from  school_session where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                      $i = $i + 1;
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['session']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="class">
                                    <option value=""> Select Class </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_class where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="term_id">
                                    <option value=""> Select Term </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_term where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['term']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>

                                <div class="col-lg-2 ">
                                  <input autocomplete="off" name="rollno" class="form-control" value="<?php echo $_POST['rollno']; ?>" placeholder="Enter Roll No. " type="text">
                                </div>
                                <div class="col-lg-2 ">
                                  <button type="submit" name="searchdetail" class="btn btn-default">Search Details</button>
                                </div>
                              </div>
                            </form>
                            <div class="card-box table-responsive">
                              <table class="table table-striped table-bordered" id="datatable" style="overflow:auto;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Roll No</th>
                                    <th>Session</th>
                                    <th>Class</th>
                                    <th>Terms</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $i = 0;
                                  $iSearchCont = '';
                                  if ($_POST['session'] != '') {
                                    $iSearchCont .= " and session = '" . $_POST['session'] . "'";
                                  }
                                  if ($_POST['class'] != '') {
                                    $iSearchCont .= " and class = '" . $_POST['class'] . "'";
                                  }
                                  if ($_POST['term_id'] != '') {
                                    $iSearchCont .= " and term_id = '" . $_POST['term_id'] . "'";
                                  }
                                  if ($_POST['rollno'] != '') {
                                    $iSearchCont .= " and student_id = '" . $_POST['rollno'] . "'";
                                  }

                                  $aryList = $db->getRows("select student_id, first_name ,last_name, session, class, term_id, id from manage_student where create_by_userid='" . $create_by_userid . "' $iSearchCont order by id desc");
                                  foreach ($aryList as $iList) {
                                    $i = $i + 1;

                                  ?>



                                    <tr>
                                      <td><?php echo $i ?></td>
                                      <td><?php echo $iList['student_id']; ?></td>
                                      <td> <?php echo $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['session'] . "'"); ?></td>
                                      <td> <?php echo $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['class'] . "'"); ?></td>
                                      <td> <?php echo $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['term_id'] . "'"); ?></td>
                                      <td><?php echo $iList['first_name'] . ' ' . $iList['last_name']; ?></td>
                                      <td>
                                        <a class="btn btn-info btn-xs" style="color:#fff;" href="<?php echo $FileName; ?>?action=studenttakefees&class=<?php echo $iList['class']; ?>&term_id=<?php echo $iList['term_id']; ?>&session=<?php echo $iList['session']; ?>&student_id=<?php echo $iList['id']; ?>">Flexable Payment</a>
                                      <!-- </td>
                                      <td> -->
                                        <a class="btn btn-primary btn-xs" style="color:#fff;" href="<?php echo $FileName; ?>?action=studentfixedtakefees&class=<?php echo $iList['class']; ?>&term_id=<?php echo $iList['term_id']; ?>&session=<?php echo $iList['session']; ?>&student_id=<?php echo $iList['id']; ?>">Fixed Payment</a>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>


                          </div>
                        </div>
                    </div>

                    <!-- @start StudentTakeFees -->
                  <?php } elseif ($_GET['action'] == 'studenttakefees') {

                        $iStudentName  = $db->getRow("select id, student_id, first_name,last_name from  manage_student where create_by_userid='" . $create_by_userid . "' and class = '" . $_GET['class'] . "' and term_id = '" . $_GET['term_id'] . "' and session = '" . $_GET['session'] . "' and id = '" . $_GET['student_id'] . "'");

                        $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and class = '" . $_GET['class'] . "' and term_id = '" . $_GET['term_id'] . "' and session = '" . $_GET['session'] . "' and student_id = '" . $_GET['student_id'] . "'");
                        if ($iStudentFeeDetails['id'] != '') {
                          redirect($FileName . '?action=takefees&token=' . $iStudentFeeDetails['randomid']);
                        }
                        // echo $iStudentFeeDetails['id'] ;
                        $iLastId = $db->getVal("select id from student_fee order by id desc") + 1;
                        $iInvoiceNo = randomFix(7) . $iLastId;             ?>
                    <form action="" method="POST">
                      <div class="form-group clearfix ">
                        <div class="col-lg-2">
                                  <select class="form-control" name="session" required>
                                    <option value=""> Select Session </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from  school_session where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                      $i = $i + 1;
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['session']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="class" required>
                                    <option value=""> Select Class </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_class where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="term_id" required>
                                    <option value=""> Select Term </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_term where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['term']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                        </div>
                      </div>
                      <div class="form-group clearfix plims">
                        <div class="col-lg-4"> Admission No. :
                          <input type="text" name="rollno" readonly value="<?php echo $iStudentName['student_id']; ?>">
                          <input type="hidden" name="student_id" readonly value="<?php echo $iStudentName['id']; ?>">
                        </div>
                        <div class="col-lg-4"> Student Name : <?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>
                          <input type="hidden" name="fullname" readonly value="<?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>">
                        </div>
                        <div class="col-lg-4"> Invoice No. :
                          <input type="text" name="invoiceno" readonly value="<?php echo $iInvoiceNo; ?>">
                        </div>
                      </div>
                      <div class="form-group clearfix plims">
                        <div class="col-lg-4">
                          <select class="form-control" name="student_status" required>
                            <option value="1">Returning</option>
                            <option value="2">New</option>
                            <option value="3">Scholarship</option>
                          </select>
                        </div>
                      </div>


                      <?php $i = 0;
                        $ifeeSturcture = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");
                        foreach ($ifeeSturcture as $iFeeList) {
                          $i = $i + 1;  ?>
                        <input type="hidden" name="fee_sturcture_id[]" value="<?php echo $iFeeList['id']; ?>">
                        <div class="form-group clearfix plims">

                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?>
                            <input name="fee[]" id="fee_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iFeeList['amount']; ?>" class="form-control makezero feetxt" type="text" autocomplete="off" required readonly>
                          </div>
                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Discount
                            <input name="fees_disccount[]" id="fees_disccount_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $_POST['school_fees_disccount']; ?>" class="form-control makezero feediscountxt" type="text" autocomplete="off" readonly>
                          </div>
                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Amount Paid
                            <input name="fees_amount[]" id="fees_amount_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $_POST['school_fees_amount']; ?>" class="form-control makezero feeamounttxt" type="text" autocomplete="off">
                          </div>


                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Outstanding
                            <input name="fees_outstanding[]" id="fees_outstanding_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $_POST['fees_outstanding']; ?>" readonly class="form-control makezero outstandingtxt" type="text" autocomplete="off">
                          </div>


                          <div class="col-lg-2"> Payment Date
                            <input name="fees_date[]" value="<?php echo $_POST['fees_date']; ?>" class="form-control  datepicker" type="text" autocomplete="off">
                          </div>

                          <div class="col-lg-2">
                            <select class="form-control" name="payment_mode[]">
                              <option value="0">Payment Mode</option>
                              <option value="1">Bank</option>
                              <option value="2">Cash</option>
                              <option value="3">POS</option>
                              <option value="4">Bank Transfer</option>
                              <option value="5">Scholarship</option>
                            </select>
                          </div>


                        </div>


                      <?php } ?>
                      <div class="form-group clearfix plims" >
                        <div class="col-lg-3" style="display: none;"> Tota fees
                          <input autocomplete="off" name="total_amount_to_pay" id="total_amount_to_pay" readonly class="form-control makezero" value="<?php echo $_POST['total_amount_to_pay']; ?>" placeholder="" type="text">
                        </div>
                        <!-- on display none -->
                        <div class="col-lg-3" > Discount Amount
                          <input autocomplete="off" name="discount_amount" id="discount_amount" readonly class="form-control makezero" value="<?php echo $_POST['discount_amount']; ?>" placeholder="" type="text">
                        </div>
                        <!--  -->
                        <div class="col-lg-3"> Amount Paid
                          <input autocomplete="off" name="currently_paying_amount" id="currently_paying_amount" readonly class="form-control makezero" value="<?php echo $_POST['book_fees_disccount']; ?>" placeholder=" " type="text">
                        </div>
                        <div class="col-lg-3"> Outstanding Balance
                          <input autocomplete="off" name="remain_amount" id="remain_amount" class="form-control makezero" readonly value="<?php echo $_POST['remain_amount']; ?>" placeholder="" type="text">
                        </div>
                      </div>
                      <input type="hidden" name="PType" value="1">
                      <div class="form-group clearfix plims">
                        <div class="col-lg-4">
                          <input type="submit" name="addnewrecord" class="btn btn-primary" value="Submit" style="color:#fff;">
                        </div>
                      </div>
                    </form>
                  <?php }
                  // fixed payment
                  elseif ($_GET['action'] == 'studentfixedtakefees') {
                    $iStudentName  = $db->getRow("select id, student_id, first_name,last_name from  manage_student where create_by_userid='" . $create_by_userid . "' and class = '" . $_GET['class'] . "' and term_id = '" . $_GET['term_id'] . "' and session = '" . $_GET['session'] . "' and id = '" . $_GET['student_id'] . "'");

                        $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and class = '" . $_GET['class'] . "' and term_id = '" . $_GET['term_id'] . "' and session = '" . $_GET['session'] . "' and student_id = '" . $_GET['student_id'] . "'");
                        if ($iStudentFeeDetails['id'] != '') {
                          redirect($FileName . '?action=takefees&token=' . $iStudentFeeDetails['randomid']);
                        }
                        // echo $iStudentFeeDetails['id'] ;
                        $iLastId = $db->getVal("select id from student_fee order by id desc") + 1;
                        $iInvoiceNo = randomFix(7) . $iLastId; ?>
                    
                        <form action="" method="POST">
                      <div class="form-group clearfix " >
                        <div class="col-lg-2">
                                  <select class="form-control" name="session" required>
                                    <option value=""> Select Session </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from  school_session where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                      $i = $i + 1;
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['session']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="class" required>
                                    <option value=""> Select Class </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_class where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['name']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="col-lg-2">
                                  <select class="form-control" name="term_id" required>
                                    <option value=""> Select Term </option>
                                    <?php
                                    $aryDetail = $db->getRows("select * from school_term where create_by_userid='" . $create_by_userid . "'");
                                    foreach ($aryDetail as $iList) {
                                    ?>
                                      <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id'] == $iList['id']) {
                                                                                    echo "selected";
                                                                                  } ?>><?php echo $iList['term']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                        </div>
                      </div>                                                         
                      <div class="form-group clearfix plims" style="background-color: aliceblue;">
                        <div class="col-lg-4"> Admission No. :
                          <input type="text" name="rollno" readonly value="<?php echo $iStudentName['student_id']; ?>">
                          <input type="hidden" name="student_id" readonly value="<?php echo $iStudentName['id']; ?>">
                        </div>
                        <div class="col-lg-4"> Student Name : <?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>
                          <input type="hidden" name="fullname" readonly value="<?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>">
                        </div>
                        <div class="col-lg-4"> Invoice No. :
                          <input type="text" name="invoiceno" readonly value="<?php echo $iInvoiceNo; ?>">
                        </div>
                      </div>
                      <div class="form-group clearfix plims" style="background-color: aliceblue;">
                        <div class="col-lg-4">
                          <select class="form-control" name="student_status" required>
                            <option value="1">Returning</option>
                            <option value="2">New</option>
                            <option value="3">Scholarship</option>
                          </select>
                        </div>
                      </div>


                      <?php $i = 0;
                        $ifeeSturcture = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");
                        foreach ($ifeeSturcture as $iFeeList) {
                          $i = $i + 1;  ?>
                        <input type="hidden" name="fee_sturcture_id[]" value="<?php echo $iFeeList['id']; ?>">
                        <div class="form-group clearfix plims" style="background-color: aliceblue;">

                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?>
                            <input name="fee[]" id="fee_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iFeeList['amount']; ?>" class="form-control makezero feetxt" type="text" autocomplete="off" required readonly>
                          </div>
                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Discount
                            <input name="fees_disccount[]" id="fees_disccount_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $_POST['school_fees_disccount']; ?>" class="form-control makezero feediscountxt" type="text" autocomplete="off" readonly>
                          </div>
                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Amount Paid
                            <select name="fees_amount[]" id="fees_amount_<?php echo $iFeeList['id']; ?>" onchange="finalfeetopay('<?php echo $iFeeList['id']; ?>',this)" class="makezero feeamounttxt">
                              <option value="0"></option>
                              <option value="<?php echo $iFeeList['amount']; ?>"><?php echo $iFeeList['amount']; ?></option>
                            </select>
                          </div>


                          <div class="col-lg-2"> <?php echo $iFeeList['title']; ?> Outstanding
                            <input name="fees_outstanding[]" id="fees_outstanding_<?php echo $iFeeList['id']; ?>" onkeyup="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $_POST['fees_outstanding']; ?>" readonly class="form-control makezero outstandingtxt" type="text" autocomplete="off">
                          </div>


                          <div class="col-lg-2"> Payment Date
                            <input name="fees_date[]" value="<?php echo $_POST['fees_date']; ?>" class="form-control  datepicker" type="text" autocomplete="off">
                          </div>

                          <div class="col-lg-2">
                            <select class="form-control" name="payment_mode[]">
                              <option value="0">Payment Mode</option>
                              <option value="1">Bank</option>
                              <option value="2">Cash</option>
                              <option value="3">POS</option>
                              <option value="4">Bank Transfer</option>
                              <option value="5">Scholarship</option>
                            </select>
                          </div>


                        </div>


                      <?php } ?>
                      <div class="form-group clearfix plims" style="background-color: aliceblue;">
                        <div class="col-lg-3" style="display: none;"> Total fees
                          <input autocomplete="off" name="total_amount_to_pay" id="total_amount_to_pay" readonly class="form-control makezero" value="<?php echo $_POST['total_amount_to_pay']; ?>" placeholder="" type="text">
                        </div>
                        <!-- on display none -->
                        <div class="col-lg-3" > Discount Amount
                          <input autocomplete="off" name="discount_amount" id="discount_amount" readonly class="form-control makezero" value="<?php echo $_POST['discount_amount']; ?>" placeholder="" type="text">
                        </div>
                        <!--  -->
                        <div class="col-lg-3"> Amount Paid
                          <input autocomplete="off" name="currently_paying_amount" id=""  class="form-control" value="<?php echo $_POST['book_fees_disccount']; ?>" placeholder="Enter Amount paid " type="text" required>
                        </div>
                        <div class="col-lg-3"> Outstanding Balance
                          <input autocomplete="off" name="remain_amount" id="remain_amount" class="form-control makezero" readonly value="<?php echo $_POST['remain_amount']; ?>" placeholder="" type="text">
                        </div>
                      </div>
                      <input type="hidden" name="PType" value="2">
                      <div class="form-group clearfix plims">
                        <div class="col-lg-4">
                          <input type="submit" name="addnewrecordFix" class="btn btn-primary" value="Submit" style="color:#fff;">
                        </div>
                      </div>
                    </form>
                  <?php }
                      // @start TakeFees
                      elseif ($_GET['action'] == 'takefees') { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish">
                        <div class="card-box">
                          <?php
                          $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and randomid= '" . $_GET['token'] . "' and create_by_userid='" . $create_by_userid . "'");
                          $iStudentName  = $db->getRow("select id, first_name,last_name from  manage_student where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['student_id'] . "'");
                          ?>

                          <form action="" method="POST">
                            <div class="form-group clearfix ">
                              <div class="col-lg-4"> Session : <?php echo $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['session'] . "'"); ?>
                                <input type="hidden" name="session" value="<?php echo $iStudentFeeDetails['session'] ?>">
                              </div>
                              <div class="col-lg-4"> Class : <?php echo $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['class'] . "'"); ?>
                                <input type="hidden" name="class" value="<?php echo $iStudentFeeDetails['class'] ?>">
                              </div>
                              <div class="col-lg-4"> Terms : <?php echo $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['term_id'] . "'"); ?>
                                <input type="hidden" name="term_id" value="<?php echo $iStudentFeeDetails['term_id'] ?>">
                              </div>
                            </div>
                            <div class="form-group clearfix plims">
                              <div class="col-lg-4"> Roll No. : <?php echo $iStudentFeeDetails['rollno']; ?>
                              </div>
                              <div class="col-lg-4"> Student Name : <?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>
                                <input type="hidden" name="fullname" readonly value="<?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?>">
                              </div>
                              <div class="col-lg-4">Invoice No. : <?php echo $iStudentFeeDetails['invoiceno']; ?>
                                <input type="hidden" name="invoiceno" readonly value="<?php echo $iStudentFeeDetails['invoiceno']; ?>">
                              </div>

                              <div class="col-lg-4"> Student Status : <?php if ($iStudentFeeDetails['student_status'] == '1') {
                                                                        echo 'Returning';
                                                                      } elseif($iStudentFeeDetails['student_status'] == '2') {
                                                                        echo "New";
                                                                      }elseif($iStudentFeeDetails['student_status'] == '3'){ echo "scholarship";} ?> </div>
                            </div>


                            <?php $i = 0;
                            $ifeeSturcture = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");
                            foreach ($ifeeSturcture as $iFeeList) {
                              $i = $i + 1;

                              $iStudentFeeSturcture = $db->getRow("select * from student_fee_sturcture where   fee_sturcture_id = '" . $iFeeList['id'] . "' and student_fee_id= '" . $iStudentFeeDetails['id'] . "'");
                            ?>
                              <input type="hidden" name="fee_sturcture_id[]" value="<?php echo $iFeeList['id']; ?>">
                              <div class="form-group clearfix plims" style="display:inline-block;">

                                <div class="col-lg-2" style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?>
                                  <input name="fee[]" id="fee_<?php echo $iFeeList['id']; ?>" onKeyUp="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iStudentFeeSturcture['fee']; ?>" class="form-control makezero feetxt" type="text" autocomplete="off" required <?php if($iStudentFeeSturcture['fees_amount'] > 1 && $iStudentFeeSturcture['fees_outstanding'] == 0){ echo "readonly ";} ?>>
                                </div>
                      
                                <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Discount
                                  <input name="fees_disccount[]" id="fees_disccount_<?php echo $iFeeList['id']; ?>" onKeyUp="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iStudentFeeSturcture['fees_disccount']; ?>" class="form-control makezero feediscountxt" type="text" autocomplete="off" readonly>
                                </div>


                                <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Amount Paid
                                  <input name="fees_amount[]" id="fees_amount_<?php echo $iFeeList['id']; ?>" onKeyUp="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iStudentFeeSturcture['fees_amount']; ?>" class="form-control makezero feeamounttxt" type="text" autocomplete="off" <?php if($iStudentFeeSturcture['fees_amount'] > 1 && $iStudentFeeSturcture['fees_outstanding'] == 0){ echo "readonly ";} ?>>
                                </div>



                                <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Outstanding
                                  <input name="fees_outstanding[]" id="fees_outstanding_<?php echo $iFeeList['id']; ?>" onKeyUp="finalfeetopay('<?php echo $iFeeList['id']; ?>')" value="<?php echo $iStudentFeeSturcture['fees_outstanding']; ?>" readonly class="form-control makezero outstandingtxt" type="text" autocomplete="off">
                                </div>


                                <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;"> Payment Date
                                  <input name="fees_date[]" value="<?php echo $iStudentFeeSturcture['fees_date']; ?>" class="form-control  datepicker" type="text" autocomplete="off" <?php if($iStudentFeeSturcture['fees_amount'] > 1 && $iStudentFeeSturcture['fees_outstanding'] == 0){ echo "disabled ";} ?>>
                                </div>
                                <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?>;">
                                  <select class="form-control" name="payment_mode[]" <?php if($iStudentFeeSturcture['fees_amount'] > 1 && $iStudentFeeSturcture['fees_outstanding'] == 0){ echo "disabled ";} ?>>
                                    <option value="0" <?php if ($iStudentFeeSturcture['payment_mode'] == '0') {
                                                        echo 'selected';
                                                      } ?>>Payment Mode</option>
                                    <option value="1" <?php if ($iStudentFeeSturcture['payment_mode'] == '1') {
                                                        echo 'selected';
                                                      } ?>>Bank</option>
                                    <option value="2" <?php if ($iStudentFeeSturcture['payment_mode'] == '2') {
                                                        echo 'selected';
                                                      } ?>>Cash</option>
                                    <option value="3" <?php if ($iStudentFeeSturcture['payment_mode'] == '3') {
                                                        echo 'selected';
                                                      } ?>>POS</option>
                                    <option value="4" <?php if ($iStudentFeeSturcture['payment_mode'] == '4') {
                                                        echo 'selected';
                                                      } ?>>Bank Transfer</option>
                                    <option value="5" <?php if ($iStudentFeeSturcture['payment_mode'] == '5') {
                                                        echo 'selected';
                                                      } ?>>Scholarship</option>
                                  </select>
                                </div>

                              </div>
                            <?php } ?>
                            <div class="form-group clearfix plims">
                              <div class="col-lg-3" style="display: none;"> Tota fees
                                <input autocomplete="off" name="total_amount_to_pay" id="total_amount_to_pay" readonly class="form-control makezero" value="<?php echo $iStudentFeeDetails['total_amount_to_pay']; ?>" placeholder="" type="text">
                              </div>
                              <div class="col-lg-3"> Discount Amount
                                <input autocomplete="off" name="discount_amount" id="discount_amount" readonly class="form-control makezero" value="<?php echo $iStudentFeeDetails['discount_amount']; ?>" placeholder="" type="text">
                              </div>
                              <div class="col-lg-3"> Amount Paid
                                <input autocomplete="off" name="currently_paying_amount" id="currently_paying_amount" readonly class="form-control makezero" value="<?php echo $iStudentFeeDetails['currently_paying_amount']; ?>" placeholder=" " type="text">
                              </div>
                              <div class="col-lg-3"> Outstanding Balance
                                <input autocomplete="off" name="remain_amount" id="remain_amount" class="form-control makezero" readonly value="<?php echo $iStudentFeeDetails['remain_amount']; ?>" placeholder="" type="text">
                              </div>
                            </div>







                            <div class="form-group clearfix plims">
                              <div class="col-lg-4">
                                <input type="submit" name="updaterecord" class="btn btn-primary" value="Submit" style="color:#fff;">
                                <a href="takefee.php" class="btn btn-primary" style="color:#fff;">Go Back </a>
                              </div>
                            </div>
                          </form>

                        </div>
                      </div>
                    </div>
                  <?php } elseif ($_GET['action'] == 'view') { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish">
                        <div class="card-box">
                          <?php
                          $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and randomid= '" . $_GET['token'] . "'");
                          $iStudentName  = $db->getRow("select id, first_name,last_name from  manage_student where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['student_id'] . "'");
                          $viewsession = $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['session'] . "'");
                          ?>
                          <!-- this where download pdf button is  -->
                          <div class="col-lg-4">
                            <a target="_blank" href="student_invoice_print_details_pdf.php?token=<?= $iStudentFeeDetails['randomid'] ?>" class="btn btn-primary" style="color:#fff;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Get Invoice </a>
                          </div>
                          


                          <form action="" method="POST">
                            <div class="form-group clearfix ">
                              <div class="col-lg-4"> Session : <?php echo $viewsession ?>
                              </div>
                              <div class="col-lg-4"> Class : <?php echo $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['class'] . "'"); ?>
                              </div>
                              <div class="col-lg-4"> Terms : <?php echo $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iStudentFeeDetails['term_id'] . "'"); ?>
                              </div>
                            </div>
                            <div class="form-group clearfix plims">
                              <div class="col-lg-4"> Roll No. : <?php echo $iStudentFeeDetails['rollno']; ?>
                              </div>
                              <div class="col-lg-4">Payment Type : <?php $PType = ($iStudentFeeDetails['PType'] == 2) ? "Flexible" : 'Fixed' ; echo $PType; ?>
                              </div>
                              <div class="col-lg-4"> Student Name : <?php echo $iStudentName['first_name'] . ' ' . $iStudentName['last_name']; ?> </div>
                              <div class="col-lg-4"> Invoice No. : <?php echo $iStudentFeeDetails['invoiceno'] ?> </div>

                              <div class="col-lg-4"> Student Status : <?php if ($iStudentFeeDetails['student_status'] == '1') {
                                                                        echo 'Returning';
                                                                      } elseif($iStudentFeeDetails['student_status'] == '2') {
                                                                        echo "New";
                                                                      }elseif($iStudentFeeDetails['student_status'] == '3'){ echo "scholarship";} ?> </div>
                            </div>



                            <div class="form-group clearfix plims">
                              <div class="col-lg-12">
                                <table class="table tetable">
                                  <?php $i = 0;
                                  $ifeeSturcture = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");
                                  foreach ($ifeeSturcture as $iFeeList) {
                                    $i = $i + 1;
                                    $iStudentFeeSturcture = $db->getRow("select * from student_fee_sturcture where   fee_sturcture_id = '" . $iFeeList['id'] . "' and student_fee_id= '" . $iStudentFeeDetails['id'] . "'");
                                  ?>
                                    <tr>
                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;" ><b><?php echo $iFeeList['title']; ?>: </b> <br> <?php echo $iStudentFeeSturcture['fee']; ?></td>

                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;"><b>Discount : </b> <br> <?php echo $iStudentFeeSturcture['fees_disccount']; ?></td>

                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;"><b>Amount Paid : </b> <br><?php echo $iStudentFeeSturcture['fees_amount']; ?></td>

                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;"><b>Outstanding : </b> <br> <?php echo $iStudentFeeSturcture['fees_outstanding']; ?></td>



                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;"><b>Date : </b> <br> <?php echo $iStudentFeeSturcture['fees_date']; ?></td>

                                      <td style="display: <?php if($iStudentFeeSturcture['fees_amount'] == 0) { echo 'none';} ?> ;"><b>Payment Mode : </b> <br> <?php if ($iStudentFeeSturcture['payment_mode'] == '1') {
                                                                        echo 'Bank';
                                                                      } ?>
                                        <?php if ($iStudentFeeSturcture['payment_mode'] == '2') {
                                          echo 'Cash';
                                        } ?>
                                        <?php if ($iStudentFeeSturcture['payment_mode'] == '3') {
                                          echo 'POS';
                                        } ?>
                                        <?php if ($iStudentFeeSturcture['payment_mode'] == '4') {
                                          echo 'Bank Transfer';
                                        } ?> 
                                        <?php if ($iStudentFeeSturcture['payment_mode'] == '5') {
                                          echo 'Scholarship';
                                        } ?> 
                                        </td>
                                    </tr>


                                  <?php } ?>
                                </table>
                              </div>
                            </div>


                            <div class="form-group clearfix plims">
                              <div class="col-lg-3" style="display: none;"><b> Total Fee : </b> <?php echo $iStudentFeeDetails['total_amount_to_pay']; ?>
                              </div>

                              <div class="col-lg-3"><b> Discount Amount : </b> <?php echo $iStudentFeeDetails['discount_amount']; ?>
                              </div>


                              <div class="col-lg-3"><b> Total Amount Paid : </b> <?php echo $iStudentFeeDetails['currently_paying_amount']; ?>
                              </div>
                              <div class="col-lg-3"><b> Outstanding Balance : </b> <?php echo $iStudentFeeDetails['remain_amount']; ?>
                              </div>
                            </div>

                            <!--<div class="form-group clearfix plims">
                        <h4>Transcation History</h4>
                         <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>#</th>
                                 <th>Total Amount To Pay</th>
                                <th>Current Paid</th>
                                <th>Remain Amount</th>
                                <th>Create at</th>
                              	<th>Fee Taken By</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 0;
                              $aryList = $db->getRows("select * from student_fee_transcation where student_fee_id='" . $iStudentFeeDetails['id'] . "' order by id desc");
                              foreach ($aryList as $iList) {
                                $i = $i + 1; ?>
                              <tr>
                                <td><?php echo $i ?></td>
                                 <td><?php echo $iList['total_amount_to_pay']; ?></td>
                                <td><?php echo $iList['currently_paying_amount']; ?></td>
                                <td><?php echo $iList['remain_amount']; ?></td>
                                <td><?php echo $iList['create_at']; ?></td>
                                <td><?php echo $db->getVal("select name from school_register where id='" . $iList['userid'] . "' "); ?>
                                
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                          </div>-->
                            <div class="form-group clearfix plims">
                              <div class="col-lg-4">
                                <a href="takefee.php" class="btn btn-primary" style="color:#fff;">Go Back </a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- @start last action -->
                  <?php } elseif ($_GET['action'] == 'transaction') { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="form-group clearfix ">
                        <form action="" method="POST">

                          <div class="col-lg-2">
                            <select class="form-control" name="session">
                              <option value=""> Select Session </option>
                              <?php
                              $aryDetail = $db->getRows("select * from  school_session where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                                $i = $i + 1;
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['session']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="class">
                              <option value=""> Select Class </option>
                              <?php
                              $aryDetail = $db->getRows("select * from school_class where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="term_id">
                              <option value=""> Select Term </option>
                              <?php
                              $aryDetail = $db->getRows("select * from school_term where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['term']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="col-lg-2">
                            
                          </div>

                          <div class="col-lg-2 ">
                            <input autocomplete="off" name="invoiceno" class="form-control" value="" placeholder="Enter invoice No. " type="text">
                          </div>
                          <div class="col-lg-2">
                            <button type="submit" name="resultdata" class="btn btn-default">Search Details</button>
                          </div>

                        </form>
                        <hr>
                          <!-- this where download csv button is  -->
                          <div style="border:1px solid gray;height:40px;padding:auto;display:flex;width:40%;">
                            <div style="color: white;margin:3px;">
                              <form action="csv_transaction.php?action=transaction_csv" method="post">
                                <button type="submit" name="submit" class="btn"> <i class="fa fa-file-csv" style="padding-right:0px!important; "></i> All Time Transactions </button>
                              </form>
                            </div>
                            <!-- <div style="color: white;margin:3px;">
                              <form action="csv_transaction.php?action=term_csv" method="post">
                                <button type="submit" name="submit" class="btn"> <i class="fa fa-file-csv" style="padding-right:0px!important; "></i> Term Transactions </button>
                              </form>
                            </div> -->
                            
                            <div style="color: white;margin:3px;">
                              <form action="csv_transaction.php?action=day_csv" method="post">
                                <button type="submit" name="submit" class="btn"> <i class="fa fa-file-csv" style="padding-right:0px!important; "></i> Daily transaction </button>
                              </form>
                            </div>
                          </div>
                          <!-- stop of csv -->
                      </div>
                      <div class="abhish">
                        <div class="card-box table-responsive">
                          <table class="table table-striped table-bordered" id="datatable" style="overflow:auto;">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Fullname</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Term</th>
                                <th>Invoice No</th>

                                <th>Outstanding Balance</th>
                                <th>Amount Paid</th>
                                <th>Payment type</th>
                                <th>Discount</th>

                                <th>Create at</th>
                                <th>Status</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 0;
                              $iSearchCont1 = '';
                              if ($_POST['session'] != '') {
                                $iSearchCont1 .= " and session = '" . $_POST['session'] . "'";
                              }
                              if ($_POST['class'] != '') {
                                $iSearchCont1 .= " and class = '" . $_POST['class'] . "'";
                              }
                              if ($_POST['term_id'] != '') {
                                $iSearchCont1 .= " and term_id = '" . $_POST['term_id'] . "'";
                              }
                              if ($_POST['invoiceno'] != '') {
                                $iSearchCont1 .= " and invoiceno = '" . $_POST['invoiceno'] . "'";
                              }

                              // $aryList = $db->getRows("select * from student_fee_transcation order by create_at desc");
                              $aryList = $db->getRows("select * from student_fee_transcation where create_by_userid='" . $create_by_userid . "' $iSearchCont1 order by create_at desc");
                           
                              foreach ($aryList as $iList) {
                                $i = $i + 1;

                                $iStudentFeeDetails = $db->getRow("select * from student_fee where create_by_userid='" . $create_by_userid . "' and id= '" . $iList['id'] . "'");
                              ?>



                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php echo ucfirst($iList['fullname']); ?></td>
                                  <td> <?php echo $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['session'] . "'"); ?></td>
                                  <td> <?php echo $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['class'] . "'"); ?></td>
                                  <td> <?php echo $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['term_id'] . "'"); ?></td>

                                  <td><?php echo $iList['invoiceno']; ?></td>
                                  
                                  <td><?php echo $iList['remain_amount']; ?></td>
                                  <td><?php echo $iList['currently_paying_amount']; ?></td>
                                  <td><?php $Ptype = ($iStudentFeeDetails['PType'] == 2) ? 'Fixed' : 'Flexible' ; echo $Ptype?></td>
                                  <td><?php echo $iList['discount_amount']; ?></td>
                                  <td><?php echo $iList['create_at']; ?></td>
                                  <td style="color: white;">
                                    <?php if($iStudentFeeDetails['student_status'] != 3 && $iList['currently_paying_amount'] > 1 && $iList['remain_amount'] == 0){ ?>
                                    <span class="btn btn-success">Paid</span>
                                    <?php }elseif($iStudentFeeDetails['student_status'] != 3 && $iList['currently_paying_amount'] > 1 && $iList['remain_amount'] != 0 ){?>
                                    <span class="btn btn-primary">Pending</span>
                                    <?php }elseif($iStudentFeeDetails['student_status'] == 3 &&  $iList['currently_paying_amount'] > 1 && $iList['remain_amount'] == 0){?>
                                    <span class="btn btn-info">Scholarship</span>
                                    <?php }?>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  <?php } else { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="form-group clearfix ">
                        <form action="" method="POST">

                          <div class="col-lg-2">
                            <select class="form-control" name="session">
                              <option value=""> Select Session </option>
                              <?php
                              $aryDetail = $db->getRows("select * from  school_session where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                                $i = $i + 1;
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['session']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="class">
                              <option value=""> Select Class </option>
                              <?php
                              $aryDetail = $db->getRows("select * from school_class where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="term_id">
                              <option value=""> Select Term </option>
                              <?php
                              $aryDetail = $db->getRows("select * from school_term where create_by_userid='" . $create_by_userid . "'");
                              foreach ($aryDetail as $iList) {
                              ?>
                                <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id'] == $iList['id']) {
                                                                              echo "selected";
                                                                            } ?>><?php echo $iList['term']; ?></option>
                              <?php } ?>
                            </select>
                          </div>

                          <div class="col-lg-2 ">
                            <input autocomplete="off" name="rollno" class="form-control" value="" placeholder="Enter Roll No. " type="text">
                          </div>
                          <div class="col-lg-2">
                            <button type="submit" name="resultdata" class="btn btn-default">Search Details</button>
                          </div>

                        </form>

                      </div>
                      <div class="abhish">
                        <div class="card-box table-responsive">
                          <table class="table table-striped table-bordered" id="datatable">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Admission No</th>
                                <th>Invoice No</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Terms</th>

                                <th>Student Name</th>
                                <th>Amount Paid </th>
                                <th>Outstanding Balance </th>

                                <th>Create at</th>
                                <th>Action</th>

                              </tr>
                            </thead>
                            <tbody>
                              <?php $i = 0;
                              $iSearchCont = '';
                              if ($_POST['session'] != '') {
                                $iSearchCont .= " and session = '" . $_POST['session'] . "'";
                              }
                              if ($_POST['class'] != '') {
                                $iSearchCont .= " and class = '" . $_POST['class'] . "'";
                              }
                              if ($_POST['term_id'] != '') {
                                $iSearchCont .= " and term_id = '" . $_POST['term_id'] . "'";
                              }
                              if ($_POST['rollno'] != '') {
                                $iSearchCont .= " and rollno = '" . $_POST['rollno'] . "'";
                              }

                              $aryList = $db->getRows("select * from student_fee where create_by_userid='" . $create_by_userid . "' $iSearchCont order by update_at desc");
                              foreach ($aryList as $iList) {
                                $i = $i + 1;

                                $iStuentName = $db->getRow("select first_name , last_name from manage_student where id='" . $iList['student_id'] . "' ");
                              ?>



                                <tr>
                                  <td><?php echo $i ?></td>
                                  <td><?php echo $iList['rollno']; ?></td>
                                  <td><?php echo $iList['invoiceno']; ?></td>
                                  <td> <?php echo $db->getVal("select session from  school_session where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['session'] . "'"); ?></td>
                                  <td> <?php echo $db->getVal("select name from  school_class where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['class'] . "'"); ?></td>
                                  <td> <?php echo $db->getVal("select term from  school_term where create_by_userid='" . $create_by_userid . "' and id = '" . $iList['term_id'] . "'"); ?></td>
                                  <td><?php echo $iStuentName['first_name'] . ' ' . $iStuentName['last_name']; ?></td>
                                  <td><?php echo $iList['currently_paying_amount']; ?></td>
                                  <td><?php echo $iList['remain_amount']; ?></td>
                                  <td><?php echo $iList['create_at']; ?></td>
                                  <td><a class="btn btn-success btn-xs" style="color:#fff;" href="<?php echo $FileName; ?>?action=view&token=<?php echo $iList['randomid']; ?>">View Detail </a>
                                    <a> | </a>
                                    <a class="btn btn-info btn-xs" style="color:#fff;" href="<?php echo $FileName; ?>?action=takefees&token=<?php echo $iList['randomid']; ?>"> Pending Fee</a>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
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
      <?php include('inc.footer.php'); ?>
    </div>
  </div>
  <?php include('inc.js.php'); ?>
  <script>
    function finalfeetopay(autoid) {

      var myClasses = document.querySelectorAll('.makezero'),
        i = 0;
      for (i; i < myClasses.length; i++) {
        if (myClasses[i].value == '') {
          myClasses[i].value = '0';
        }
      }

      if (autoid != 0) {
        var fee = document.getElementById("fee_" + autoid).value;
        var fees_disccount = document.getElementById("fees_disccount_" + autoid).value;
        var fees_amount = document.getElementById("fees_amount_" + autoid).value;

        //fee_amount = parseInt(fee)-parseInt(fees_disccount)
        //document.getElementById("fees_amount_"+autoid).value=fee_amount;
      }


      var fees_outstanding = parseInt(fee) - parseInt(fees_disccount) - parseInt(fees_amount);


      document.getElementById("fees_outstanding_" + autoid).value = fees_outstanding;




      var myClasses = document.querySelectorAll('.feetxt'),
        i = 0;
      var total_amount_to_pay = 0
      for (i; i < myClasses.length; i++) {
        total_amount_to_pay += parseInt(myClasses[i].value);
      }

      document.getElementById("total_amount_to_pay").value = total_amount_to_pay;




      var myClassesamt = document.querySelectorAll('.feeamounttxt'),
        i = 0;
      var currently_paying_amount = 0
      for (i; i < myClassesamt.length; i++) {
        currently_paying_amount += parseInt(myClassesamt[i].value);
      }

      document.getElementById("currently_paying_amount").value = currently_paying_amount;



      var myClassesremain = document.querySelectorAll('.outstandingtxt'),
        i = 0;
      var remain_amount = 0
      for (i; i < myClassesremain.length; i++) {
        remain_amount += parseInt(myClassesremain[i].value);
      }

      document.getElementById("remain_amount").value = remain_amount;




      var myClassesdiscount = document.querySelectorAll('.feediscountxt'),
        i = 0;
      var discount_amount = 0
      for (i; i < myClassesdiscount.length; i++) {
        discount_amount += parseInt(myClassesdiscount[i].value);
      }

      document.getElementById("discount_amount").value = discount_amount;







      /*		var currently_paying_amount	 				=				document.getElementById("currently_paying_amount").value;
      		if(currently_paying_amount=='') {
      					 currently_paying_amount = 0;  						document.getElementById("currently_paying_amount").value = 0;
      					 			}
       
       */




      ///        var remain_amount =  parseInt(total_amount_to_pay) - parseInt(currently_paying_amount);
      ///     document.getElementById("remain_amount").value = remain_amount;

    }
  </script>
</body>

</html>