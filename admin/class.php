<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="School Class";
$FileName = 'class.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
	if(isset($_POST['add']))
		{ 
			$iRecord1=$db->getRow("select * from  school_class where name = '".$_POST['name']."' ");
		
 		if($iRecord1['id']==''){
 
				$aryData1=array(	
					'section_id'     	 	        =>	$_POST['selectedsection'],
					'name'     	 	         		=>	$_POST['name'],
					'short_name'     	 	         =>	$_POST['short_name'],
					'sid'     	 	         		 =>	0,
					'userid'     	 	         	=>	0,
					
					);  
					
					$flgIn2 = $db->insertAry("school_class", $aryData1 );
				echo $flgIn2 = $db->getLastQuery();
		}
		else 
		{
				
				echo "You Cannot Add Same Classes Repeatedly!!";
			}
			
			} 
	elseif(isset($_POST['update']))
		{
				$validate->addRule($_POST['editname'],'','Name',true);
			$validate->addRule($_POST['editsname'],'','short_name',true);
	
		 
		 if($validate->validate() && count($stat)==0)
				{
			 
				$aryData=array(
								'name'        	 => $_POST['editname'],
								'short_name'        	 => $_POST['editsname'],
								 
								);
					$flgIn1 = $db->updateAry("school_class",$aryData, "where id ='".$_POST['classid']."'");
					echo $flgIn1 = $db->getLastQuery(); 
		 
		
				}
				
			else 
		    {
				
				echo "You Cannot Add Same Name Repeatedly!!";
			}
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
            <h4 class="page-title"><?php echo $PageTitle; ?></h4>
            <ol class="breadcrumb">
              <li> <a href="<?php echo $iClassName; ?>">Home</a> </li>
              <li class="active"> <?php echo $PageTitle; ?> </li>
            </ol>
          </div>
        </div>
        <!-- Basic Form Wizard -->
        <div class="row">
          <div class="col-md-12">
            <div class="card-box aplhanewclass">
              <div class="row">
                <div class="col-md-9"> <?php echo msg($stat); ?> </div>
                <!--<div class="col-md-3">
				<a href="<?php echo $FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a>
				</div>-->
              </div>
            </div>
          
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                     
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Section</label>
                      <div class="col-lg-10">
                        <select class="form-control" id="section_id" name="section_id">
						<option value="">Select Section</option>
						<?php
						$aryList=$db->getRows("select * from  school_section  where userid='0' and sid='0'");
						foreach($aryList as $iList)
						{	
						?>
						
						<option value="<?php echo $iList['id']; ?>"><?php echo $iList['section']; ?></option>
						<?php } ?>
						</select>
                      </div>
                    </div>

					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Name</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control " id="name" name="name" value="<?php echo $_POST['name']; ?>">
                      </div>
                    </div>
					
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Short Name</label>
                      <div class="col-lg-10">
                      <input type="text" class="form-control " id="short_name" name="short_name" value="<?php echo $_POST['short_name']; ?>">
                      </div>
                    </div>
                      <button type="submit" name="add" class="btn btn-default" style="float:right;">+  Add</button>
                    <a  href="#"  class="btn btn-default" style="visibility:hidden;">Back</a>
				</section>
                </div>
              </form>
            </div>
			
			<div class="card-box">
            <table  class="table table-striped table-bordered">
              <thead>
                <tr>
                 			
                  <th>Name</th>
                  <th>Short Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
		$aryList=$db->getRows("select * from  school_class  where userid='0' and sid='0'");
		foreach($aryList as $iList)
			{	
			
			 ?>
                <tr>
                 
                  <td><input type="text" name="editname" value="<?php echo $iList['name']; ?>" style="border: none;width: 100%;"></td>
				  <td><input type="text" name="editsname" value="<?php echo $iList['short_name']; ?>"style="border: none;width: 100%;"></td>
                  <td>
				  <input type="hidden" name="classid" value="<?php echo $iList['id']; ?>"style="border: none;">
				  <input type="hidden" name="section_id" value="<?php echo $iList['section_id']; ?>"style="border: none;">
                  <input type="submit" name="update" value="update" style="border:none;" class="table-action-btn" >
				  
    
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
  <?php include('inc.footer.php'); ?>
</div>
</div>
<?php include('inc.js.php'); ?>



</body>
</html>
