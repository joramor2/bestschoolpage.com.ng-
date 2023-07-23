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
    <div class="form-group clearfix ">
        <div class="col-lg-4" style="margin-bottom: 5px;"> Session : <?= $studentSessionPdf ?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Class : <?= $studentClassPdf ?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Terms : <?= $studentTermPdf ?>
        </div>
        <div class="col-lg-4" style="margin-bottom: 5px;"> Payment Type : <?php $PType = ($iStudentFeeDetailsPdf['PType'] == 1) ? 'Fixed' : 'Flexible' ; echo $PType;?>
        </div>
        <!-- <br> -->
    </div>
    <div class="form-group clearfix plims">
        <div class="col-lg-4" style="margin-bottom: 5px;"> Roll No. : <?= $iStudentFeeDetailsPdf['rollno']; ?>
        </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Student Name : <?php echo ucfirst($iStudentNamePdf['first_name']) . ' ' . ucfirst($iStudentNamePdf['last_name']); ?> </div>
        <!-- <br> -->
        <div class="col-lg-4" style="margin-bottom: 5px;"> Student Status : <?php if ($iStudentFeeDetailsPdf['student_status'] == '1') {
                                                                                echo 'Returning';
                                                                            } elseif($iStudentFeeDetailsPdf['student_status'] == '2') {
                                                                                echo "New";
                                                                            } elseif($iStudentFeeDetailsPdf['student_status'] == '3') { echo "Scholarship";}?>
        </div>
        <!-- <br> -->
    </div>
    <!-- <br> -->
    <hr>


    <div class="form-group clearfix plims">
        <div class="col-lg-12">

            <?php
            $i = 0;

            foreach ($ifeeSturcturePdf as $iFeeList) {
                $i = $i + 1;
                $iStudentFeeSturcturePdfPdf = $db->getRow("select * from student_fee_sturcture where fee_sturcture_id = '" . $iFeeList['id'] . "' and student_fee_id= '" . $iStudentFeeDetailsPdf['id'] . "'");
            ?>
               
               <div class="form-group clearfix plims" style="display:list-item;padding:20px;">
                    <div class="col-lg-2" style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?>
                        <span>= <?php echo $iStudentFeeSturcturePdfPdf['fee']; ?> </span>
                    </div>
                    
                    <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Discount
                                
                        <span>= <?php echo $iStudentFeeSturcturePdfPdf['fees_disccount']; ?> </span>         
                    </div>
                    <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Amount Paid
                                
                        <span>= <?php echo $iStudentFeeSturcturePdfPdf['fees_amount']; ?> </span>         
                    </div>
                    <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Outstanding
                                
                        <span>= <?php echo $iStudentFeeSturcturePdfPdf['fees_outstanding']; ?> </span>         
                    </div>
                    <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> <?php echo $iFeeList['title']; ?> Payment Date
                                
                        <span>= <?php echo $iStudentFeeSturcturePdfPdf['fees_date']; ?> </span>         
                    </div>

                    <div class="col-lg-2"  style="display: <?php if($iStudentFeeSturcturePdfPdf['fees_amount'] == 0) { echo 'none';} ?>;"> Payment Mode
                        <?php if( $iStudentFeeSturcturePdfPdf['payment_mode'] == '1'){ ?>
                        <span> = Bank </span>
                        <?php }elseif($iStudentFeeSturcturePdfPdf['payment_mode'] == '2'){?>
                            <span> = Cash </span>
                        <?php }elseif($iStudentFeeSturcturePdfPdf['payment_mode'] == '3'){?>
                            <span> POS </span>
                        <?php }elseif($iStudentFeeSturcturePdfPdf['payment_mode'] == '4'){?>
                            <span> = Bank Transfer </span>
                        <?php }elseif($iStudentFeeSturcturePdfPdf['payment_mode'] == '5'){?>
                            <span> = Scholarship </span>
                        <?php }?>    
                    </div>
                </div>

                <?php } ?>
                <!-- </table> -->
                </div>
        </div>

        <hr>

        <div class="form-group clearfix plims">

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