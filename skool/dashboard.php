<?php include('../config.php');
include('inc.session-create.php');
?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
<link rel="stylesheet" href="http://www.daterangepicker.com/daterangepicker.css">
<style>
.gender .btn.active {
	background-color: #1B3058 !important;
	border: 1px solid #1B3058;
	color: white;
}
.gender .btn {
	background: unset;
	border: 1px solid #ddd;
}
</style>
</head>
<body class="fixed-left">
<div id="wrapper">
  <?php include('inc.header.php'); ?>
  <?php include('inc.sideleft.php');
if($iPackageJsoneDecodeAllowFile['dashboard']!='1') {
	redirect(SKOOL_URL);
}
?>
  <div class="content-page">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h4 class="page-title-3">Dashboard</h4>
            <p class="text-muted page-title-3-alt">Statistic's and Summary</p>
          </div>
        </div>
        <div class="row tile_count dashnewnn">
          <div class="col-md-12">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-user"></i> Academic session </span>
              <?php 
 $aryList = $db->getRow("select * from school_session where create_by_userid='".$create_by_userid."' order by session desc");
 
 $ICurrentSchoolSession = $aryList['id'];
 
  $iCurrentSessionDetail = $db->getRow("select * from school_session where create_by_userid='".$create_by_userid."' order by id desc");
?>
              <div class="count">
                <?php  echo $aryList['session']; ?>
              </div>
              <!--  <span class="count_bottom"><i class="green">4% </i> From last Week</span>--> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-clock-o"></i> Active year </span>
              <div class="count"><?php echo date("Y");?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>--> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-commenting-o"></i> Total SMS Balance</span>
              <div class="count green"><?php //echo $db->getVal("select SUM(admission_fee) from app_personalinfo where  create_by_userid='".$create_by_userid."' ");; 
			  echo $db->getVal("select sum(no_of_sms) from sms_payment where create_by_userid='".$create_by_userid."' and status = '1'  " );
			  
			  ?></div>
              <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--> 
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-user"></i> Total Applicant</span>
              <div class="count"><?php echo $db->getVal("select count(*) from app_personalinfo where  create_by_userid='".$create_by_userid."'");; ?></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-balance-scale"></i> Available Balance</span>
              <div class="count"><?php echo $db->getVal("select walletamount from school_register where id='".$create_by_userid."' order by id desc");  ?></div>
              
            </div>
         <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> <span class="count_top"><i class="fa fa-paper-plane-o"></i> Plan Expiry</span>  
          <div class="count"> 
        <?php
		$iPlanExpDate=$db->getVal("select exp_date from  school_purchased_pacakage where userid='".$create_by_userid."' and status ='1' and exp_date>'".date("Y-m-d")."' order by exp_date desc");
         $iCurrentDate = date("Y-m-d");   
        $start = strtotime($iCurrentDate);
        $end = strtotime($iPlanExpDate);
		$days_between = ceil(abs($end - $start) / 86400);
		if($iPlanExpDate=='') { echo 'Plan Expired'; } else { if($days_between>0) { echo $days_between; echo ' Days'; } else { echo 'Plan Expired'; } }
		
        ?> </div>
              <!--  <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>--> 
       </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="maleee">
              <div class="col-md-6">
                <div class="form-group">
                  <h3>Current student </h3>
                  <?php
		$totalstudentMale = $db->getVal("select count(DISTINCT(student_id)) from manage_student where  create_by_userid='".$create_by_userid."' and gender='Male'");
		$totalstudentFemale = $db->getVal("select count(DISTINCT(student_id)) from manage_student where  create_by_userid='".$create_by_userid."' and gender='Female'");
		?>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="gender" class="gender btn-group" data-toggle="buttons">
                      <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" onclick="getstudent('1');">
                        <input type="radio" checked="checked" name="gender" value="male" data-parsley-multiple="gender" data-parsley-id="12">
                        &nbsp; Male &nbsp; </label>
                      <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default"onclick="getstudent('2');" >
                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender" >
                        Female </label>
                    </div>
                  </div>
                  <h1><span id="toatalStudent"> <?php echo $totalstudentMale; ?></span> : <span id="toatalStudent"> <?php echo $totalstudentFemale; ?></span></h1>
                </div>
              </div>
              <?php 
					$staffMale	=$db->getVal("select count(*) from staff_manage where create_by_userid='".$create_by_userid."'  and gender='male'"); 
					$staffFeMale=$db->getVal("select count(*) from staff_manage where create_by_userid='".$create_by_userid."' 	and gender='female'"); 
                        ?>
              <div class="col-md-6">
                <div class="form-group">
                  <h3>Employee </h3>
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <div id="gender" class="gender btn-group" data-toggle="buttons">
                      <label class="btn btn-default active" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default" onclick="getstaff('1');">
                        <input type="radio" checked="checked" name="gender" value="male" data-parsley-multiple="gender" data-parsley-id="12">
                        &nbsp; Male &nbsp; </label>
                      <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default"onclick="getstaff('2');">
                        <input type="radio" name="gender" value="female" data-parsley-multiple="gender">
                        Female </label>
                    </div>
                  </div>
                  <h1><span id="totalstaff"><?php echo $staffMale; ?></span> : <span id="totalstaff"><?php echo $staffFeMale; ?></span></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
<script>
	function getstudentAbc(getvalue)
	{
		if(getvalue==1){
			document.getElementById("toatalStudent").innerHTML=<?php echo $totalstudentMale ; ?>;
		}
		if(getvalue==2){
			document.getElementById("toatalStudent").innerHTML=<?php echo $totalstudentFemale ; ?>;
		}
	}
</script> 
<script>
	function getstaffAbc(gettid)
	{
		if(gettid==1){
		//	document.getElementById("totalstaff").innerHTML=<?php echo $staffMale ; ?>;
		}
		if(gettid==2){
			//document.getElementById("totalstaff").innerHTML=<?php echo $staffFeMale ; ?>;
		}
	}
</script> 
        <br>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">
              <div class="row x_title">
                <div class="col-md-6">
                  <h3>Monthly Financial Summary <small>( income/expenditure )</small></h3>
                </div>
                <div class="col-md-6">
                  
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="chartContainer" style="height: 300px; width: 100%;"></div>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-7 col-sm-7 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2> Distribution of users</h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div id="chartContainerpai" style="height: 300px; width: 100%;"></div>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-12">
            <div class="x_panel tile fixed_height_320">
              <div class="x_title">
                <h2> Distribution Of Student Per Classes </h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <div id="chartContainerterm" style="height: 300px; width: 100%;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr style="border: 1px solid lightgray;">
      <!-- Table -->
      <div class="card-box table-responsive">
        <table class="table table-striped table-bordered" id="datatable" style="overflow:auto;">
          <thead>
            <tr>
              <th>#</th>
              <th>Session</th>
              <th>Class</th>
              <th>Class</th>
              <th>Terms</th>
              <th>Total fees (sum)</th>
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

            // $aryList = $db->getRows("select student_id, first_name ,last_name, session, class, term_id, id from manage_student where create_by_userid='" . $create_by_userid . "' $iSearchCont order by id desc");
            // foreach ($aryList as $iList) {
            //   $i = $i + 1;

            ?>



              <tr>
                <td></td>
                <td></td>
                <td> </td>
                <td> </td>
                <td></td>
                <td></td>
              </tr>
            <?php  ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php include('inc.footer.php'); ?>
  </div>
</div>
<?php include('inc.js.php'); ?>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js" async></script> 
<script type="text/javascript">
      $(document).ready(function() {
        $('#config-text').keyup(function() {
          eval($(this).val());
        });
        $('.configurator input, .configurator select').change(function() {
          updateConfig();
        });
        $('.demo i').click(function() {
          $(this).parent().find('input').click();
        });
        $('#startDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment().subtract(6, 'days')
        });
        $('#endDate').daterangepicker({
          singleDatePicker: true,
          startDate: moment()
        });
        updateConfig();
        function updateConfig() {
          var options = {};
          if ($('#singleDatePicker').is(':checked'))
            options.singleDatePicker = true;
          if ($('#showDropdowns').is(':checked'))
            options.showDropdowns = true;
          if ($('#showWeekNumbers').is(':checked'))
            options.showWeekNumbers = true;
          if ($('#showISOWeekNumbers').is(':checked'))
            options.showISOWeekNumbers = true;
          if ($('#timePicker').is(':checked'))
            options.timePicker = true;
          if ($('#timePicker24Hour').is(':checked'))
            options.timePicker24Hour = true;
          if ($('#timePickerIncrement').val().length && $('#timePickerIncrement').val() != 1)
            options.timePickerIncrement = parseInt($('#timePickerIncrement').val(), 10);
          if ($('#timePickerSeconds').is(':checked'))
            options.timePickerSeconds = true;
          if ($('#autoApply').is(':checked'))
            options.autoApply = true;
          if ($('#dateLimit').is(':checked'))
            options.dateLimit = { days: 7 };
          if ($('#ranges').is(':checked')) {
            options.ranges = {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            };
          }
          if ($('#locale').is(':checked')) {
            $('#rtl-wrap').show();
            options.locale = {
              direction: $('#rtl').is(':checked') ? 'rtl' : 'ltr',
              format: 'MM/DD/YYYY HH:mm',
              separator: ' - ',
              applyLabel: 'Apply',
              cancelLabel: 'Cancel',
              fromLabel: 'From',
              toLabel: 'To',
              customRangeLabel: 'Custom',
              daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
              monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
              firstDay: 1
            };
          } else {
            $('#rtl-wrap').hide();
          }
          if (!$('#linkedCalendars').is(':checked'))
            options.linkedCalendars = false;
          if (!$('#autoUpdateInput').is(':checked'))
            options.autoUpdateInput = false;
          if (!$('#showCustomRangeLabel').is(':checked'))
            options.showCustomRangeLabel = false;
          if ($('#alwaysShowCalendars').is(':checked'))
            options.alwaysShowCalendars = true;
          if ($('#parentEl').val().length)
            options.parentEl = $('#parentEl').val();
          if ($('#startDate').val().length) 
            options.startDate = $('#startDate').val();
          if ($('#endDate').val().length)
            options.endDate = $('#endDate').val();
          if ($('#minDate').val().length)
            options.minDate = $('#minDate').val();
          if ($('#maxDate').val().length)
            options.maxDate = $('#maxDate').val();
          if ($('#opens').val().length && $('#opens').val() != 'right')
            options.opens = $('#opens').val();
          if ($('#drops').val().length && $('#drops').val() != 'down')
            options.drops = $('#drops').val();
          if ($('#buttonClasses').val().length && $('#buttonClasses').val() != 'btn btn-sm')
            options.buttonClasses = $('#buttonClasses').val();
          if ($('#applyClass').val().length && $('#applyClass').val() != 'btn-success')
            options.applyClass = $('#applyClass').val();
          if ($('#cancelClass').val().length && $('#cancelClass').val() != 'btn-default')
            options.cancelClass = $('#cancelClass').val();
          $('#config-text').val("$('#demo').daterangepicker(" + JSON.stringify(options, null, '    ') + ", function(start, end, label) {\n  console.log(\"New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')\");\n});");
          $('#config-demo').daterangepicker(options, function(start, end, label) { console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')'); }).click();;
        }
      });
</script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script> 
<script src="http://www.daterangepicker.com/daterangepicker.js"></script> 









<script>
window.onload = function () {
var options = {
	animationEnabled: true,
	theme: "light2",
	title:{
	},
	axisY: {
		title: "Revenue (in Naira Sterling)",
		valueFormatString: "#0",
		suffix: "",
		prefix: "₦"
	},
	legend: {
		cursor: "pointer",
		itemclick: toogleDataSeries
	},
	toolTip: {
		shared: true
    },
	data: [{
		type: "area",
		name: "SMS Payment",
		markerSize: 5,
		showInLegend: true,
		xValueFormatString: "MMMM",
		yValueFormatString: "₦ #0 ",
		dataPoints: 
		[
		
		<?php	for ($i = -1; $i <= 11; $i++) {	?>
			{ x: new Date(<?php	 echo $iThisYears = date("Y", strtotime( date( 'Y-m-01' )." -$i months"));	?>, <?php	 echo $iThisMonths = date("m", strtotime( date( 'Y-m-01' )." -$i months"));	?>), y: <?php  $iTHisSmsAddFee = $db->getVal("select SUM(price) from sms_payment where create_by_userid='".$create_by_userid."'  and Year(create_at) = '".$iThisYears."'  and Month(create_at) = '".$iThisMonths."'"); if($iTHisSmsAddFee=='') { echo '0'; } else { echo $iTHisSmsAddFee; } ?> },
		<?php	}	?>	
			
		]
	}, {
		type: "area",
		name: "Plan Payment",
		markerSize: 5,
		showInLegend: true,
		yValueFormatString: "₦ #0 ",
		dataPoints: [
			 		<?php	for ($i = -1; $i <= 11; $i++) {	?>
			{ x: new Date(<?php	 echo $iThisYears = date("Y", strtotime( date( 'Y-m-01' )." -$i months"));	?>, <?php	 echo $iThisMonths = date("m", strtotime( date( 'Y-m-01' )." -$i months"));	?>), y: <?php  $iTHisAddFee =  $db->getVal("select SUM(price) from school_purchased_pacakage where  userid='".$create_by_userid."'  and  status = '1'  and Year(create_at) = '".$iThisYears."'  and Month(create_at) = '".$iThisMonths."'"); if($iTHisAddFee=='') { echo '0'; } else { echo $iTHisAddFee; }   ?> },
		<?php	}	?>	

		]
	}]
};
$("#chartContainer").CanvasJSChart(options);
function toogleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
var options = {
	animationEnabled: true,
	title: {
	},
	data: [{
		type: "doughnut",
		innerRadius: "40%",
		showInLegend: true,
		legendText: "{label}",
		indexLabel: "{label}: #percent%",
		dataPoints: [
		
   <?php
	$aryList=$db->getRows("select * from school_class where create_by_userid='".$create_by_userid."' order by id asc");
    foreach($aryList as $iList)  { 
	
$iTotalClassDetail=$db->getVal("select count(DISTINCT(student_id)) from manage_student where  session = '".$ICurrentSchoolSession."'  and  class = '".$iList['id']."' and  create_by_userid='".$create_by_userid."' order by id asc");
	
	?>		
			{ label: "<?php echo $iList['name'];?>", y: <?php if($iTotalClassDetail=='') { echo '0';  } else { echo $iTotalClassDetail;  } ?> },
	 <?php } ?>
		]
	}]
};
$("#chartContainerterm").CanvasJSChart(options);
var chart = new CanvasJS.Chart("chartContainerpai", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		
	},
	axisY: {
		title: "Growth Rate (in Number)",
		suffix: "",
		includeZero: false
	},
	axisX: {
		title: ""
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.0#\"\"",
		dataPoints: [
			{ label: "Total Student", y: <?php echo $db->getVal("select count(DISTINCT(student_id)) from manage_student where   create_by_userid='".$create_by_userid."'"); ?>},	
			{ label: "Total Staff", y: <?php echo $db->getVal("select count(*) from school_register where usertype='1' and create_by_userid='".$create_by_userid."'"); ?> },	
			{ label: "Total Parent", y: <?php  $iStudentGuard=$db->getRows("select DISTINCT parent_id  from student_guardian where create_by_userid='".$create_by_userid."' order by id asc"); 
												echo count($iStudentGuard); ?> },
		]
	}]
});
chart.render();
}
</script> 

<script>
</script>
</body>
</html>