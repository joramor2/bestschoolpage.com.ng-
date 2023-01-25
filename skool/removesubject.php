<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Remove Subject";
$FileName = 'removesubject.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}

?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Droid+Serif" />
<style>
body, label, span, a, .gwt-Button {
	font-family: 'Droid Serif' !important;
}
.abhi .nav-tabs {
	border-bottom: 2px solid #DDD;
}
.abhi .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
	border-width: 0;
}
.abhi .nav.nav-tabs > li > a:hover, .nav.tabs-vertical > li > a:hover {
	color: #1B3058 !important;
}
.abhi .nav-tabs > li > a {
	border: none;
	color: #1B3058 !important;
}
.abhi .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover, .tabs-vertical > li.active > a, .tabs-vertical > li.active > a:focus, .tabs-vertical > li.active > a:hover {
	color: #1B3058 !important;
}
.abhi .nav > li > a i {
	font-size: 16px;
	padding-right: 5px;
}
.abhi .nav-tabs > li > a::after {
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
.abhi .nav-tabs > li.active > a::after, .nav-tabs > a::after {
	transform: scale(1);
}
.abhi .tab-nav > li > a::after {
 background: # #5a4080 none repeat scroll 0% 0%;
	color: #fff;
}
.abhi .tab-pane {
	padding: 25px 0;
}
.abhi .tab-content {
	padding: 20px;
}
.abhi .nav-tabs > li {
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
.abhi .nav-tabs > li > a > span {
	display: none;
}
.abhi .nav-tabs > li > a {
	padding: 5px 5px;
}
}
.page-title {
	margin-bottom: 30px;
}

.tetable tr td { font-size:17px; }
.tetable tr td b{ font-size:16px; }
.table { text-align:center; }
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
                    <li role="presentation" class="<?php if($_GET['action']=='' ) { echo "active"; } ?>"> <a href="<?php echo $FileName; ?>"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Remove Subject</span> </a> </li>
                  </ul>
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="form-group clearfix ">
                        <form action="" method="POST">
                          <div class="col-lg-2">
                            <select class="form-control" name="session">
                              <option value=""> Select Session </option>
                              <?php 
											$aryDetail = $db->getRows("select * from  school_session where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ $i=$i+1; 
											?>
                              <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['session']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['session']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="class">
                              <option value=""> Select Class </option>
                              <?php 
											$aryDetail = $db->getRows("select * from school_class where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
                              <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['class']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                          <div class="col-lg-2">
                            <select class="form-control" name="term_id">
                              <option value=""> Select Term </option>
                              <?php 
											$aryDetail = $db->getRows("select * from school_term where create_by_userid='".$create_by_userid."'");
											foreach ($aryDetail as $iList) 
											{ 
											?>
                              <option value="<?php echo $iList['id']; ?>" <?php if ($_POST['term_id']==$iList['id']) { echo "selected"; } ?>><?php echo $iList['term']; ?></option>
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
                          <table class="table table-striped table-bordered"  id="datatable">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Admission No</th>
                                <th>Session</th>
                                <th>Class</th>
                                <th>Terms</th>
                                <th>Student Name</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=0;
							  $iSearchCont = '';
							 if($_POST['session']!='')
							 	{
									$iSearchCont .= " and session = '".$_POST['session']."'";	
								}
							if($_POST['class']!='')
							 	{
									$iSearchCont .= " and class = '".$_POST['class']."'";	
								}
							if($_POST['term_id']!='')
							 	{
									$iSearchCont .= " and term_id = '".$_POST['term_id']."'";	
								}
							if($_POST['rollno']!='')
							 	{
									$iSearchCont .= " and rollno = '".$_POST['rollno']."'";	
								}
								
							 if($_POST['session']==''  && $_POST['class']==''  && $_POST['term_id']==''  && $_POST['rollno']=='')	
								{
									$iSearchCont .= " and id = ''";
								}
							  
$aryList = $db->getRows("select id, student_id, first_name,last_name , session, class, term_id , randomid from  manage_student where  id!='' $iSearchCont");
							foreach($aryList as $iList) 
							{ 
							$i=$i+1;
							?>
                              <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $iList['student_id'];?></td>
                                <td><?php echo $db->getVal("select session from  school_session where create_by_userid='".$create_by_userid."' and id = '".$iList['session']."'"); ?></td>
                                <td><?php echo $db->getVal("select name from  school_class where create_by_userid='".$create_by_userid."' and id = '".$iList['class']."'"); ?></td>
                                <td><?php echo $db->getVal("select term from  school_term where create_by_userid='".$create_by_userid."' and id = '".$iList['term_id']."'"); ?></td>
                                <td><?php echo $iList['first_name'].' '.$iList['last_name'];?></td>
                                <td><a onClick="checksubject('<?php echo $iList['randomid'] ; ?>')" class="btn btn-success btn-xs" style="color:#fff;"  data-toggle="modal" data-target="#myModal" >Check Subject </a> 
                                </td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Remove Subject</h4>
      </div>
      <div class="modal-body">
       <div id="pursub" ></div>
       <input type="hidden" id="randomid" >
      </div>
      <div class="modal-footer">
      <div id="showrec"></div>
        <button type="button" class="btn btn-success" onClick="updatesubjectrecord()" style="color:#fff;">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="color:#fff;">Close</button>
      </div>
    </div>
  </div>
</div>  
      
      
      
      <?php include('inc.footer.php'); ?>
    </div>
  </div>
  <?php include('inc.js.php'); ?>
<script>
function checksubject(randomid)
	{	document.getElementById("randomid").value=randomid;
		 var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						
						 
						document.getElementById('pursub').innerHTML=this.responseText;	 ///// Just change the name the id of HTML Tag, where you want to show data
					}
				  };
		xhttp.open("POST", 'ajaxing.php', true);									///// Just change the name of file, from which you want to take data												
	   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		var sendata   = 'randomid='+randomid;
			sendata  += '&action=getstusubj';
 		xhttp.send(sendata);
		
	}
function updatesubjectrecord()
	{	document.getElementById('showrec').innerHTML='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>';
	
	setTimeout(function(){
		
		var randomid = document.getElementById("randomid").value;
 		var subjectid = []
		var checkboxes = document.querySelectorAll('input[type="checkbox"]')
 		for (var i = 0; i < checkboxes.length; i++) {
			
				if(checkboxes[i].checked) {
					
		  subjectid.push(checkboxes[i].value);
		
				}
		}
		 var xhttp = new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						
						 
						document.getElementById('showrec').innerHTML=this.responseText;	 ///// Just change the name the id of HTML Tag, where you want to show data
					}
				  };
  	   xhttp.open("POST", 'ajaxing.php', true);									///// Just change the name of file, from which you want to take data												
	   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		var sendata   = 'randomid='+randomid;
			sendata  += '&subjectid='+subjectid;
			sendata  += '&action=updatesubject';
 		xhttp.send(sendata);
		
		}, 2000);
	}	
</script>
</body>
</html>