<?php include('../config.php'); 
//include('inc.session-create.php'); 
$PageTitle="manage Parent";
$FileName = 'manage_parent.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
if(isset($_POST['add_father_submit']))
{                
				$validate->addRule($_POST['parent_id'],'','Parent Id',true);
				$validate->addRule($_POST['occupation'],'','Occupation',true);
				$validate->addRule($_POST['title'],'','Title',true);
				$validate->addRule($_POST['last_name'],'','Last Name',true);
				$validate->addRule($_POST['first_name'],'','First Name',true);
				$validate->addRule($_POST['phone'],'','Phone',true);
				$validate->addRule($_POST['email'],'','Email',true);
			    if($validate->validate() && count($stat)==0)
				  {
				  	 
				
					$aryData=array(	
				'student_id'                                   => $_POST['student_id'],
				'parent_id'                                   => $_POST['parent_id'],
				'occupation'                                  => $_POST['occupation'],
				'title'                                       => $_POST['title'],
				'last_name'                                   => $_POST['last_name'],     
				'first_name'                                  => $_POST['first_name'],
			    'phone'                                       => $_POST['phone'],
				'email'                                       => $_POST['email'],
				'mobile'                                       => $_POST['mobile'],
				'home_address_1'  			                  => $_POST['home_address_1'],	
				'home_address_2'  			                  => $_POST['home_address_2'],	
				'home_city'  			                      => $_POST['home_city'],	
			     'home_state'  			                      =>  $_POST['home_state'],
				 
				'office_address_1'  			              => $_POST['office_address_1'],	
				'office_address_2'                            => $_POST['office_address_2'],
				'office_city'  			                      => $_POST['office_city'],	
				'office_state'  			                  => $_POST['office_state'],	
			    'randomid'  			                      => randomFix(10),	
				
				         );  
					$flgIn1 = $db->insertAry("manage_parent",$aryData);
			
					//echo $flgIn1 = $db->getLastQuery();
					//exit;
					
					
				
					
					$stat['success']="Submited Successfully";
                   
					unset($_POST);
					 
				}
			else {
					$stat['error'] = $validate->errors();
				}
			}
			
			
			elseif(isset($_POST['edit_father_data']))
{                
				$validate->addRule($_POST['parent_id'],'','Parent Id',true);
				$validate->addRule($_POST['occupation'],'','Occupation',true);
				$validate->addRule($_POST['title'],'','Title',true);
				$validate->addRule($_POST['last_name'],'','Last Name',true);
				$validate->addRule($_POST['first_name'],'','First Name',true);
				$validate->addRule($_POST['phone'],'','Phone',true);
				$validate->addRule($_POST['email'],'','Email',true);
				
				
									
			    if($validate->validate() && count($stat)==0)
				  {
				  	  
				
					$aryData=array(	
				'student_id'                                   => $_POST['student_id'],	
				'parent_id'                                   => $_POST['parent_id'],
				'occupation'                                  => $_POST['occupation'],
				'title'                                       => $_POST['title'],
				'last_name'                                   => $_POST['last_name'],     
				'first_name'                                  => $_POST['first_name'],
			    'phone'                                       => $_POST['phone'],
				'email'                                       => $_POST['email'],
				'mobile'                                       => $_POST['mobile'],
				'home_address_1'  			                  => $_POST['home_address_1'],	
				'home_address_2'  			                  => $_POST['home_address_2'],	
				'home_city'  			                      => $_POST['home_city'],	
			     'home_state'  			                      =>  $_POST['home_state'],
				 
				'office_address_1'  			              => $_POST['office_address_1'],	
				'office_address_2'                            => $_POST['office_address_2'],
				'office_city'  			                      => $_POST['office_city'],	
				'office_state'  			                  => $_POST['office_state'],	
			    'randomid'  			                      => randomFix(10),	
				
				         );  
					$flgIn1 = $db->updateAry("manage_parent",$aryData, "where randomid='".$_GET['randomid']."'");
					//echo $flgIn1 = $db->getLastQuery();
					//exit;
					
					
				
					
					$stat['success']="Submited Successfully";
                   
					unset($_POST);
					 
				}
			else {
					$stat['error'] = $validate->errors();
				}
			}
			
			
			 	
				elseif(($_GET['action']=='delete_student_father'))
                {
                  $flgIn1 = $db->delete("manage_parent","where randomid='".$_GET['randomid']."'");
                  $_SESSION['success'] = 'Deleted Successfully';
                }
				
				
			
?>
<!DOCTYPE html>
<html>
<head>
<?php include('inc.meta.php'); ?>
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

        <div class="row">
          <div class="col-sm-12">
            <h4 class="page-title licat">MANAGE PARENT</h4>
            <ol class="breadcrumb">
              <li class="dippi"> <a href="<?php echo $iClassName; ?>">Create, edit and design application forms</a> </li>
              <?php echo msg($stat); ?>
            </ol>
          </div>
        </div>
		
        <!-- Basic Form Wizard -->
        <div class="row">
          <div class="col-md-12">
              <div class="row">
                <div class="col-md-1">  </div>
                
			  
			  <div class="col-md-11">
				<div class="gokul">
				<a href="<?php echo $FileName; ?>?action=add_parent_data"  class="btn btn-default" style="float:right">Manage parent<i class="fa fa-plus" aria-hidden="true"></i></a>
				</div>
              </div>
			  
			  			  
			  
			  
            </div>
			</div>
			 <div class="col-md-12 ">
            
			
			
			
			
			
			
			
			
			<?php if($_GET['action']=='add_parent_data') { ?>
			
			<div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
				  
				  <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="employee_id">Student Id</label>
											<div class="col-lg-10">
											
                                            <select  class="required form-control" name="student_id" id="student_id" >
			  <option>Select Student Id</option>
			  <?php $aryDetail=$db->getRows("select * from  manage_student order by id desc");
					   foreach($aryDetail as $iList)
									{	$i=$i+1;?>
             <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['student_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['student_id']; ?></option>
									<?php }?>
            </select>
                                        </div></div>
				  
				  <div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Parent Id/Guardian*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="parent_id" value="<?php echo $_POST['parent_id'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">Occupation*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="occupation" value="<?php echo $_POST['occupation'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Title:*</label>
		<div class="col-lg-4">
			<select name="title" class=form-control> 
			<option>Slelect Title</option>
			<option value="1" <?php if($_POST['title']=='1') {echo "selected";}?>>Mrs.</option>
			<option value="2"  <?php if($_POST['title']=='2') {echo "selected";}?>>Miss.</option>
			<option value="3"  <?php if($_POST['title']=='3') {echo "selected";}?>>Dr</option>
			<option value="4"  <?php if($_POST['title']=='4') {echo "selected";}?>>Prof</option>
			<option value="5"  <?php if($_POST['title']=='5') {echo "selected";}?>>AIh</option>
			<option value="6"  <?php if($_POST['title']=='6') {echo "selected";}?>>Malam</option>
			<option value="7"  <?php if($_POST['title']=='7') {echo "selected";}?>>Hajia </option>
			</select>
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Last Name</label>
		<div class="col-lg-4">
	<input type="text" class="form-control"  name="last_name" value="<?php echo $_POST['last_name'];?>" />
		</div>
	</div>
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">First Name*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="first_name" value="<?php echo $_POST['first_name'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Phone:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="phone" value="<?php echo $_POST['phone'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Email:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="email" value="<?php echo $_POST['email'];?>" />
		</div>
	
	
		<label class="col-lg-2 control-label " for="price">	Mobile </label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="mobile" value="<?php echo $_POST['mobile'];?>" />
		</div>
	</div>
	
	
	
	
	
		
	
	
	
	
	<h4>HOME ADDRESS</h4>
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Address Line 1:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_address_1" value="<?php echo $_POST['home_address_1'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Address Line 2:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_address_2" value="<?php echo $_POST['home_address_2'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">State*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_state" value="<?php echo $_POST['home_state'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	City</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_city" value="<?php echo $_POST['home_city'];?>" />
		</div>
	</div>
	
	
	
	<h4>OFFICE ADDRESS</h4>
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Address Line 1:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_address_1" value="<?php echo $_POST['office_address_1'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Address Line 2:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_address_2" value="<?php echo $_POST['office_address_2'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">State*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_state" value="<?php echo $_POST['office_state'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	City</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_city" value="<?php echo $_POST['office_city'];?>" />
		</div>
	</div>
	
	
	
	
					<div class="form-group clearfix bfrcs ">
                      <div class="col-lg-12 sgot">
					   <div class="row">
                    <div class="savdtls"><button type="submit" name="add_father_submit" class="btn btn-default">Save details</button></div>
					</div>
					</div>
					</div>
                </div>
              </form>
          
			  </div>
			  
			  
			   <div class="card-box">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
                <th>#</th>
				<th>Student ID</th>
 				<th>Parent ID</th>
 				<th> First Name</th>
 				<th> Last Name</th>
				<th>Occupation</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>
            </tr>
		</thead>
		<tbody>
		<?php $i=0;
			$aryList=$db->getRows("select *from  manage_parent order by id desc");
					foreach($aryList as $iList)
					{	$i=$i+1;
					
							 ?>       
			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $db->getval("select student_id from manage_student where id='".$iList['student_id']."'"); ?></td>
				<td><?php echo $iList['parent_id']; ?></td>
					<td><?php echo $iList['first_name']; ?></td>
				
					<td><?php echo $iList['last_name']; ?></td>
				
				
 				
 				<td><?php echo $iList['occupation']; ?></td>
				<td><?php echo $iList['email']; ?></td>
				<td><?php echo $iList['phone']; ?></td>
				
				<td>
					<a href="<?php echo $FileName; ?>?action=edit_student_father&randomid=<?php echo $iList['randomid']?>"  class="table-action-btn" >
					<i class="fa fa-pencil"></i> </a>
					<a href="javascript:del('<?php echo $FileName; ?>?action=delete_student_father&randomid=<?php echo $iList['randomid']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
               </td>
            </tr>
				  <?php } ?>
        </tbody>
	</table>
</div>
		<?php } elseif($_GET['action']=='edit_student_father') { 
		
		$aryetail=$db->getRow("select * from  manage_parent where randomid='".$_GET['randomid']."'");?>
			
			<div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
				  
				  <div class="form-group clearfix">
                                            <label class="col-lg-2 control-label" for="employee_id">Student Id</label>
											<div class="col-lg-10">
											
                                            <select  class="required form-control" name="student_id" id="student_id" >
			  <option>Select Student Id</option>
			  <?php $aryDetail=$db->getRows("select * from  manage_student order by id desc");
					   foreach($aryDetail as $iList)
									{	$i=$i+1;?>
             <option value="<?php echo $iList['id']; ?>" <?php  if($aryetail['student_id']==$iList['id']) { echo "selected"; }  ?>><?php echo $iList['student_id']; ?></option>
									<?php }?>
            </select>
                                        </div></div>
				  
				  <div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Parent Id/Guardian*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="parent_id" value="<?php echo $aryetail['parent_id'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">Occupation*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="occupation" value="<?php echo $aryetail['occupation'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Title:*</label>
		<div class="col-lg-4">
			<select name="title" class=form-control> 
			<option>Slelect Title</option>
			<option value="1" <?php if($aryetail['title']=='1') {echo "selected";}?>>Mrs.</option>
			<option value="2"  <?php if($aryetail['title']=='2') {echo "selected";}?>>Miss.</option>
			<option value="3"  <?php if($aryetail['title']=='3') {echo "selected";}?>>Dr</option>
			<option value="4"  <?php if($aryetail['title']=='4') {echo "selected";}?>>Prof</option>
			<option value="5"  <?php if($aryetail['title']=='5') {echo "selected";}?>>AIh</option>
			<option value="6"  <?php if($aryetail['title']=='6') {echo "selected";}?>>Malam</option>
			<option value="7"  <?php if($aryetail['title']=='7') {echo "selected";}?>>Hajia </option>
			</select>
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Last Name</label>
		<div class="col-lg-4">
	<input type="text" class="form-control"  name="last_name" value="<?php echo $aryetail['last_name'];?>" />
		</div>
	</div>
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">First Name*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="first_name" value="<?php echo $aryetail['first_name'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Phone:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="phone" value="<?php echo $aryetail['phone'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Email:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="email" value="<?php echo $aryetail['email'];?>" />
		</div>
	
	
		<label class="col-lg-2 control-label " for="price">	Mobile </label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="mobile" value="<?php echo $aryetail['mobile'];?>" />
		</div>
	</div>
	
	
	
	
	
		
	
	
	
	
	<h4>HOME ADDRESS</h4>
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Address Line 1:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_address_1" value="<?php echo $aryetail['home_address_1'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Address Line 2:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_address_2" value="<?php echo $aryetail['home_address_2'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">State*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_state" value="<?php echo $aryetail['home_state'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	City</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="home_city" value="<?php echo $aryetail['home_city'];?>" />
		</div>
	</div>
	
	
	
	<h4>OFFICE ADDRESS</h4>
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">Address Line 1:*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_address_1" value="<?php echo $aryetail['office_address_1'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	Address Line 2:</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_address_2" value="<?php echo $aryetail['office_address_2'];?>" />
		</div>
	</div>
	
	
	<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="price">State*</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_state" value="<?php echo $aryetail['office_state'];?>" />
		</div>
	
		<label class="col-lg-2 control-label " for="price">	City</label>
		<div class="col-lg-4">
			<input type="text" class="form-control"  name="office_city" value="<?php echo $aryetail['office_city'];?>" />
		</div>
	</div>
	
	
	
	
					<div class="form-group clearfix bfrcs ">
                      <div class="col-lg-12 sgot">
					   <div class="row">
                    <div class="savdtls"><button type="submit" name="edit_father_data" class="btn btn-default">Save details</button></div>
					</div>
					</div>
					</div>
                </div>
              </form>
          
			  </div>	
			
			
			
			
			<?php } ?>
		
		
		
		</div>
    </div>
  </div>
  <?php include('inc.footer.php'); ?>
</div>
</div>
<?php include('inc.js.php'); ?>
<script>

function getguardian(){
	document.getElementById("guardianno").style.display = "block";
	 
	 
}
</script>

  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
  <script>
  $( function() {
    $( "#datepicker1" ).datepicker();
  } );
  </script>
</body>
</html>
