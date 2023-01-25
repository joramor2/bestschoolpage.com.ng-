<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Role Register";
$FileName ='role_register.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
	$stat['success']=$_SESSION['success'];
	unset($_SESSION['success']);
}
if(isset($_POST['submit']))
{ 
	$validate->addRule($_POST['emailid'],'','emailid',true);
	$validate->addRule($_POST['fullname'],'','fullname',true);
	
	$validate->addRule($_POST['password'],'','password',true);
	$validate->addRule($_POST['usertype'],'','usertype',true);
 
      
		if($validate->validate() && count($stat)==0)
		{
				
			  $aryData=array(					
								'emailid'     	 	         			    =>	$_POST['emailid'],
								'fullname'     	 	         			    =>	$_POST['fullname'],
								'password'     	 	         			    =>	$_POST['password'],
								'usertype'     	 	         			    =>	$_POST['usertype'],
								'status'     	 	         		        =>	$_POST['status'],												
							);  
					$flgIn1 = $db->insertAry("admin_login",$aryData);
					
					$_SESSION['success']="Submitted Successfully";
 					redirect($iClassName.$FileName);
					unset($_POST);
 		}
		 else {
			$stat['error'] = $validate->errors();
			}
    } 
 elseif(isset($_POST['update']))
	{  	
	
	
if($validate->validate() && count($stat)==0)
	{			
		

		$aryData=array(	
										
								'emailid'     	 	         			    =>	$_POST['emailid'],
								'fullname'     	 	         			    =>	$_POST['fullname'],
								'password'     	 	         			    =>	$_POST['password'],
								'usertype'     	 	         			    =>	$_POST['usertype'],
								'status'     	 	         		        =>	$_POST['status'],
						);  

					$flgIn = $db->updateAry("admin_login", $aryData , "where id='".$_GET['id']."'");
					$_SESSION['success']="Update Successfully";
					unset($_POST);
					redirect($iClassName.$FileName);
							 
		}	  
		 else {
			$stat['error'] = $validate->errors();
			}
	}

	
	

elseif(($_REQUEST['action']=='delete'))
	{
				 $flgInd5 = $db->delete("admin_login","where id='".$_GET['id']."'");					   
			     $_SESSION['success'] = 'Deleted Successfully';
                 redirect(ADMIN_URL.$FileName);	
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
						<div class="row">
							<div class="col-sm-12">
								<h4 class="page-title"><?php echo $PageTitle; ?></h4>
								<ol class="breadcrumb">
									<li>
										<a href="<?php echo $iClassName; ?>">Home</a>
									</li>									
									<li class="active">
										<?php echo $PageTitle; ?>
									</li>
								</ol>
							</div>
						</div>
                        <!-- Basic Form Wizard -->
                        <div class="row">
                            <div class="col-md-12">                          
                            <div class="card-box aplhanewclass">
                            	<div class="row">
                            		<div class="col-md-9">
                                        <?php echo msg($stat); ?>
                                    </div>
                                    <div class="col-md-3">
										<a href="<?php echo $FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a>
                                 	</div>
                                </div>
							</div>
            <?php if($_GET['action']=='add') { ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="fullname">Fullname: </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="fullname" name="fullname" value="<?php echo $_POST['fullname']; ?>">
                      </div>
                    </div>
					
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="emailid">Email Id: </label>
                      <div class="col-lg-10">
                        <input type="email" class="form-control required" id="emailid" name="emailid" value="<?php echo $_POST['emailid']; ?>">
                      </div>
                    </div>
					
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="password">Password </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="password" name="password" value="<?php echo $_POST['password']; ?>">
                      </div>
                    </div>
					
					 
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="usertype">Usertype: </label>
                      <div class="col-lg-10">
                        
						
						
 <select  class="required form-control" name="usertype">
 <option> Select Role </option>
                                  <?php $i=0;
				$aryList=$db->getRows("select * from roles order by id desc");
						foreach($aryList as $iList)
							{	$i=$i+1;
								 
							 ?>
							 <option value=" <?php  echo $iList['usertype'] ;?>">
							 
							 <?php  echo $iList['role'] ;?>
							 </option>
							<?php } ?>
						</select>                      </div>
                    </div>
			
		
					<div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">Status </label>
                        <div class="col-lg-10">
                          <select  class="required form-control" name="status">
                            <option value="1" <?php if($_POST['status']=='1') { echo "selected"; } ?>>Active</option>
                            <option value="0" <?php if($_POST['status']=='0') { echo "selected"; } ?>>Inactive</option>
                          </select>
                        </div>
                    </div>

				       <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
                </div>
              </form>
            </div>
            <?php } elseif($_GET['action']=='edit') { 
					    $aryDetail=$db->getRow("select * from  admin_login where id='".$_GET['id']."'");
					   ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="fullname">Fullname: </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="fullname" name="fullname" value="<?php echo $aryDetail['fullname']; ?>">
                      </div>
                    </div>
					
					
					 <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="emailid">Email Id: </label>
                      <div class="col-lg-10">
                        <input type="email" class="form-control required" id="emailid" name="emailid" value="<?php echo $aryDetail['emailid']; ?>">
                      </div>
                    </div>
					
					
					 <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="password">Password: </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" id="password" name="password" value="<?php echo $aryDetail['password']; ?>">
                      </div>
                    </div>
					
					
					 
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="usertype">Usertype </label>
                      <div class="col-lg-10">
					  <select  class="required form-control" name="usertype">
					   <option> Select Role </option>

                                  <?php $i=0;
				$aryList=$db->getRows("select * from roles order by id desc");
						foreach($aryList as $iList)
							{	$i=$i+1;
								 
							 ?>
							 <option value=" <?php echo $iList['usertype'] ;?>"  <?php if($aryDetail['usertype']== $iList['usertype']) { echo "selected"; } ?>>
							 
							 <?php  echo $iList['role'] ;?>
							 </option>
							<?php } ?>
						</select>
						
                       </div>
                    </div>
			
                   
					<div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">Status </label>
                        <div class="col-lg-10">
                          <select  class="required form-control" name="status">
                            <option value="1" <?php if($aryDetail['status']=='1') { echo "selected"; } ?>>Active</option>
                            <option value="0" <?php if($aryDetail['status']=='0') { echo "selected"; } ?>>Inactive</option>
                          </select>
                        </div>
                      </div>
					
					
                    <button type="submit" name="update" class="btn btn-default">Submit</button>
                    <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
                </div>
              </form>
            </div>
          </div>
		   <?php  } 
	elseif($_GET['action']=='view') { 
	$GetEmailId=$db->getRow("select * from  roles where id='".$_GET['id']."'");

	?>
		 <div class="card-box">
              <section>
                 
                <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Role :</label>
                  <?php echo $GetEmailId['role']; ?> </div>
				  
				  <div class="form-group clearfix">
                  <label class="col-lg-2 control-label " for="userName">Usertype :</label>
                  <?php echo $GetEmailId['usertype']; ?> </div>
		
                  <label class="col-lg-2 control-label " for="userName">Status :</label>
                  <?php if($GetEmailId['status']=='1'){echo "Active";}if($GetEmailId['status']=='0'){echo "Inactive";} ?>
                </div>
                <a  href="<?php echo $FileName; ?>"  class="btn btn-default" >Back</a> </section>
            </div>
          </div>
		
          <?php } else { ?>
		  
          <div class="card-box">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Fullname </th>
				    <th>Email Id </th>
					  <th>Password </th>
				  <th>Usertype </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0;
				$aryList=$db->getRows("select * from admin_login order by id desc");
						foreach($aryList as $iList)
							{	$i=$i+1;
								$aryPgAct["id"]=$iList['id'];
							 ?>
                <tr>
                <td><?php echo $i; ?> </td>
                <td><?php echo $iList['fullname']; ?></td>
				 <td><?php echo $iList['emailid']; ?></td>
				  <td><?php echo $iList['password']; ?></td>
				<td><?php echo $iList['usertype']; ?></td>
			
				<td><?php if($iList['status']=='1') { echo "Active"; } 
						  else{ echo "Inactive";} ?> 
				</td>
                <td>
				<a href="<?php echo $FileName; ?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a>
                <a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a> 
			<a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')" class="table-action-btn" > <i class="fa fa-times"></i> </a>
			</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <?php include('inc.footer.php'); ?>
</div>
</div>
<?php include('inc.js.php'); ?>
</body>
</html>
