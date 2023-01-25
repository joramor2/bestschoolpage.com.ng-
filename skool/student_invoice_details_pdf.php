<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Pdf</title>
</head>

<body style="color: black;background-color:aliceblue;padding: 18px;">
    <h3 style="text-align: center; color:orangered;"><?= ucfirst($iupdatedetails['name']); ?>'s Payment Invoice</h3>
    <div style="position:relative;left:280px;"> 
        <img style="width:90px; height:90px;" src="../uploads/<?php echo $iupdatedetails['logo']; ?>">
    </div>
    <div class="form-group clearfix " >
        <div class="col-lg-4" style="margin-bottom: 5px;"> Session : <?=$studentSessionPdf ?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Class : <?=$studentClassPdf?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Terms : <?=$studentTermPdf ?>
        </div>
        <!-- <br> -->
    </div>
    <div class="form-group clearfix plims">
        <div class="col-lg-4" style="margin-bottom: 5px;"> Roll No. : <?=$iStudentFeeDetailsPdf['rollno']; ?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Student Name : <?php echo ucfirst( $iStudentNamePdf['first_name']) . ' ' . ucfirst($iStudentNamePdf['last_name']); ?> </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Student Status : <?php if ($iStudentFeeDetailsPdf['student_status'] == '1') {
                                                    echo 'Returning';
                                                } else {
                                                    echo "New";
                                                } ?> 
        </div>
        <!-- <br> -->
    </div>
    <!-- <br> -->
    <hr>


    <div class="form-group clearfix plims">
        <div class="col-lg-12">
            <table class="table tetable" style="width: 100%;">
                <?php 
                $i = 0;
                
                // $ifeeSturcture = $db->getRows("select * from fee_sturcture where create_by_userid='" . $create_by_userid . "' and status !=2 order by id desc");
                foreach ($ifeeSturcturePdf as $iFeeList) {
                    $i = $i + 1;
                    $iStudentFeeSturcturePdf = $db->getRow("select * from student_fee_sturcture where fee_sturcture_id = '" . $iFeeList['id'] . "' and student_fee_id= '" . $iStudentFeeDetailsPdf['id'] . "'");
                ?>
                    <tr>
                        <td><b><?php echo $iFeeList['title']; ?>: </b> <br> <?php echo $iStudentFeeSturcturePdf['fee']; ?></td>
                        <br>

                        <td><b>Discount : </b> <br> <?php echo $iStudentFeeSturcturePdf['fees_disccount']; ?></td>

                        <td><b>Amount Paid : </b> <br><?php echo $iStudentFeeSturcturePdf['fees_amount']; ?></td>

                        <td><b>Outstanding : </b> <br> <?php echo $iStudentFeeSturcturePdf['fees_outstanding']; ?></td>

                        <td><b>Date : </b> <br> <?php echo $iStudentFeeSturcturePdf['fees_date']; ?></td>

                        <td><b>Payment Mode : </b> <br> <?php if ($iStudentFeeSturcturePdf['payment_mode'] == '1') {
                                                            echo 'Bank';
                                                        } ?>
                            <?php if ($iStudentFeeSturcturePdf['payment_mode'] == '2') {
                                echo 'Cash';
                            } ?>
                            <?php if ($iStudentFeeSturcturePdf['payment_mode'] == '3') {
                                echo 'POS';
                            } ?>
                            <?php if ($iStudentFeeSturcturePdf['payment_mode'] == '4') {
                                echo 'Bank Transfer';
                            } ?> </td>
                    </tr>


                <?php } ?>
            </table>
        </div>
    </div>

    <hr>

    <div class="form-group clearfix plims">
        <div class="col-lg-3"><b> Total Fee : </b> <?php echo $iStudentFeeDetailsPdf['total_amount_to_pay']; ?>
        </div>

        <div class="col-lg-3"><b> Discount Amount : </b> <?php echo $iStudentFeeDetailsPdf['discount_amount']; ?>
        </div>


        <div class="col-lg-3"><b> Total Amount Paid : </b> <?php echo $iStudentFeeDetailsPdf['currently_paying_amount']; ?>
        </div>
        <div class="col-lg-3"><b> Outstanding Balance : </b> <?php echo $iStudentFeeDetailsPdf['remain_amount']; ?>
        </div>
    </div>

    <!-- <div colspan="1" style="width:2%">  -->

    <!-- </div> -->

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
                                $aryList = $db->getRows("select * from student_fee_transcation where student_fee_id='" . $iStudentFeeDetailsPdf['id'] . "' order by id desc");
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
</body>

</html>