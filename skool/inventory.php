<?php include('../config.php');
include('inc.session-create.php');
$PageTitle = "Inventory";
$FileName = 'inventory.php';
$validate = new Validation();
if($_SESSION['success']!="")
{
	$stat['success'] = $_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['addnewrecord']))
{

  if($validate->validate() && count($stat) == 0)
    {
		
        $iLastId=$db->getVal("select id from student_fee order by id desc")+1;
		$iRandomId=randomFix(15).$iLastId;

        $aryData = array(
						'item_description'	 				=>	$_POST['item_description'],
						'location'	 						=>	$_POST['location'],
						'unit'	 							=>	$_POST['unit'],
						'quantity'	 						=>	$_POST['quantity'],
						'quantity_picked'	 				=>	$_POST['quantity_picked'],
						'quantity_available'	 			=>	$_POST['quantity_available'],
						'recorded_quantity'	 				=>	$_POST['recorded_quantity'],
						'unit_cost'	 						=>	$_POST['unit_cost'],
 						
						
						
						'userid'							=>	$_SESSION['userid'],
						'usertype'							=>	$_SESSION['usertype'],

						
						'create_by_usertype' 				=>	$create_by_usertype,
						'create_by_userid' 					=>	$create_by_userid,
						'randomid' 							=>	$iRandomId,
						 
						'create_at' 						=>	date("Y-m-d H:i:s"),
						'update_at' 						=>	date("Y-m-d H:i:s"),
						);
				$flgIn = $db->insertAry("school_inventory", $aryData);

				
				$_SESSION['success']="Submit successfully.";
				redirect($FileName);
			 
	}
    else
	{
		$stat['error'] = $validate->errors();
	}
}

if(isset($_POST['updaterecord']))
{ }


elseif($_GET['action']=='delete') 
{ }
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
</style>
</head>
<body class="fixed-left">
<div id="wrapper">
<?php include('inc.header.php'); ?>
<?php include('inc.sideleft.php'); ?>
  <div class="content-page"> 
    <!-- Start content -->
    <div class="content">
      <div class="container"> 
        <!-- Page-Title -->
         
        <!-- Basic Form Wizard -->
        <div class="abhi">
          <div class="container">
            <div class="row">
              <div class="col-md-12"> 
                <!-- Nav tabs -->
                <div class="card">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php if($_GET['action']=='' ) { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=verification_status"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Inventory Details</span> </a> </li>
                    <li role="presentation" class="<?php if($_GET['action']=='add') { echo "active"; } ?>"> <a href="<?php echo $Filename; ?>?action=add"> <i class="fa fa-line-chart" aria-hidden="true"></i><span>Add Inventory</span> </a> </li>
                  </ul>
                  <div class="tab-content">
                    <?php if($_GET['action']=='add' ) { ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                      <div class="abhish">
                        <div class="card-box">
                          
                          <form action="" method="POST">
                             
                            <div class="form-group clearfix plims">
                              <div class="col-lg-4 ">
                                <input autocomplete="off" name="item_description" required class="form-control" value="" placeholder="Item Description " type="text">
                              </div>
                              <div class="col-lg-4 ">
                                 <input autocomplete="off" name="location" required class="form-control" value="" placeholder="Location " type="text">
                              </div>
                              <div class="col-lg-4 ">
                                 <input autocomplete="off" name="unit" required class="form-control" value="" placeholder="Unit " type="text">
                              </div>
                            </div>
                            
                            
                            <div class="form-group clearfix plims">
                              <div class="col-lg-4 ">
                                <input autocomplete="off" name="quantity" required class="form-control" value="" placeholder="Quantity" type="text">
                              </div>
                              <div class="col-lg-4 ">
                                 <input autocomplete="off" name="quantity_picked" required class="form-control" value="" placeholder="Quantity Picked " type="text">
                              </div>
                              <div class="col-lg-4 ">
                                 <input autocomplete="off" name="quantity_available" required class="form-control" value="" placeholder="Quantity Available " type="text">
                              </div>
                            </div>
                            
                            
                             <div class="form-group clearfix plims">
                              <div class="col-lg-4 ">
                                <input autocomplete="off" name="recorded_quantity" required class="form-control" value="" placeholder="Recorded Quantity" type="text">
                              </div>
                              <div class="col-lg-4 ">
                                 <input autocomplete="off" name="unit_cost" required class="form-control" value="" placeholder="Unit Cost" type="text">
                              </div>
                              
                            </div>
                            
                            
                             <div class="form-group clearfix plims">
                              <div class="col-lg-4  pull-left">
                                <button type="submit" name="addnewrecord" class="btn pull-left btn-default">Submit</button>
                              </div>
                            </div>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <?php }
					  else{ ?>
                    <div role="tabpanel" class="tab-pane active" id="profilxe">
                     
                      <div class="abhish">
                        <div class="card-box">
                          <table class="table table-striped table-bordered"  id="datatable">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Item Description</th>
                                
                                <th>Location</th>
                                <th>Unit</th>
                                <th>QTY</th>
                                
                                <th>QTY Picked</th>
                                <th>QTY Available</th>
                                <th>Recorded QTY</th>
                                
                                <th>Unit Cost</th>
                                <th>Inventory Value</th>
                              
                                <th>Create at</th>
                              
                              </tr>
                            </thead>
                            <tbody>
                              <?php $i=0;
							$aryList = $db->getRows("select * from school_inventory where create_by_userid='".$create_by_userid."' order by update_at desc");
							foreach($aryList as $iList) 
							{ 
							$i=$i+1;
							
							$iStuentName=$db->getRow("select first_name , last_name from manage_student where id='".$iList['student_id']."' ");
							?>
                              <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $iList['item_description'];?></td>
                                <td><?php echo $iList['location'];?></td>
                                <td><?php echo $iList['unit'];?></td>
                                <td><?php echo $iList['quantity'];?></td>
                                <td><?php echo $iList['quantity_picked'];?></td>
                                <td><?php echo $iList['quantity_available'];?></td>
                                <td><?php echo $iList['recorded_quantity'];?></td>
                                <td><?php echo $iList['unit_cost'];?></td>
                                <td><?php echo $iList['quantity']*$iList['unit_cost'];?></td>
                                 <td><?php echo $iList['create_at'];?></td>
                               
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
function finalfeetopay()
	{
		var school_fees	 						=				document.getElementById("school_fees").value;
		if(school_fees=='') { 
								school_fees = 0; 				 document.getElementById("school_fees").value = 0; 			 
							}
		
		
		var school_fees_disccount	 			=				document.getElementById("school_fees_disccount").value;
		if(school_fees_disccount=='') { 
										school_fees_disccount = 0;  		document.getElementById("school_fees_disccount").value = 0; 
									  }
		
		var school_fees_amount = parseInt(school_fees)-parseInt(school_fees_disccount);
		
		
		document.getElementById("school_fees_amount").value=school_fees_amount;
		
		
		var uniform_fees	 					=				document.getElementById("uniform_fees").value;
		if(uniform_fees=='') { 
					uniform_fees = 0; 					 document.getElementById("uniform_fees").value = 0; 
							}
		
		
		var uniform_fees_disccount	 			=				document.getElementById("uniform_fees_disccount").value;
		if(uniform_fees_disccount=='') { 
							uniform_fees_disccount = 0;        document.getElementById("uniform_fees_disccount").value = 0; 
							}
		
		var uniform_fees_amount = parseInt(uniform_fees)-parseInt(uniform_fees_disccount);
		
		document.getElementById("uniform_fees_amount").value=uniform_fees_amount;
		
		
		var book_fees	 						=				document.getElementById("book_fees").value;
		if(book_fees=='') { 
					book_fees = 0;  				document.getElementById("book_fees").value = 0; 
							}
		
		
		var book_fees_disccount	 				=				document.getElementById("book_fees_disccount").value;
		if(book_fees_disccount=='') { 
						book_fees_disccount = 0;  					document.getElementById("book_fees_disccount").value = 0;	
						}
 
 		var book_fees_amount = parseInt(book_fees)-parseInt(book_fees_disccount);
		
		document.getElementById("book_fees_amount").value=book_fees_amount;
 
 
 		var total_amount_to_pay = parseInt(school_fees_amount)+parseInt(uniform_fees_amount)+parseInt(book_fees_amount);
 		document.getElementById("total_amount_to_pay").value=total_amount_to_pay;
		
		
		
		var currently_paying_amount	 				=				document.getElementById("currently_paying_amount").value;
		if(currently_paying_amount=='') {
					 currently_paying_amount = 0;  						document.getElementById("currently_paying_amount").value = 0;
					 			}
 
 
 
 		var remain_amount =  parseInt(total_amount_to_pay) - parseInt(currently_paying_amount);
		document.getElementById("remain_amount").value = remain_amount;
 
	}
</script>
</body>
</html>