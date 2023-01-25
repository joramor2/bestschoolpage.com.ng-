<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="section";
$FileName = 'section.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
	if(isset($_POST['add']))
		{ 

			$figIn=$db->getVal("select * from school_section where section='".$_POST['section']."' and userid='0'");
	         
			
			if($figIn['id']!='')
			{
			$stat['error']="section exists";
			}
			else
			{
		 
			$validate->addRule($_POST['section'],'','section',true);
			
			if($validate->validate() && count($stat)==0)
				{
	
					$aryData=array(	
					
					'section'     	 	         		=>	$_POST['section'],
					'short_name'								=> $_POST['short_name'],
                     'sid'     	 	         		 =>	0,
					'userid'     	 	         	=>	0,
					);  
						
					$flgIn1 = $db->insertAry("school_section",$aryData);
					echo $flgIn1 = $db->getLastQuery();exit;
					$_SESSION['success']="Submited Successfully";
					redirect($FileName);
					unset($_POST);
				}
					 
			
			else {
					$stat['error'] = $validate->errors();
				}
			}
			
		}
	elseif(isset($_POST['update']))
		{ 
		$validate->addRule($_POST['editsection'],'','section',true);
		if($validate->validate() && count($stat)==0)
		{ 

					$aryData=array(	
					'section'        	 => $_POST['editsection'],

					);  
					
					$flgIn = $db->updateAry("school_section", $aryData , "where id='".$_POST['section_id']."' ");
					//echo $flgIn = $db->getLastQuery();exit;
					$_SESSION['success']="Update Successfully";
					unset($_POST);
					redirect($FileName);
 			 	
			}	  
			else {
				$stat['error'] = $validate->errors();
			}
		}
		elseif(($_REQUEST['action']=='delete'))
		{
		
			$flgIn1 = $db->delete("school_section","where id='".$_GET['id']."' ");			
			$_SESSION['success'] = 'Deleted Successfully';
			redirect($FileName);
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
		<div class="row">
          <div class="col-md-12">
            <div class="card-box aplhanewclass">
              <div class="row">
                <div class="col-md-9"> <?php echo msg($stat); ?> </div>
                <div class="col-md-3">
			
				</div>
              </div>
            </div>
        <!-- Basic Form Wizard -->
		
        
			<div class="card-box">
              <form role="form" action="" method="post">
                <div>
                  <section>
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="session">Session</label>
                      <div class="col-lg-10">
                        
		  <select class="required form-control" id="section" name="section" onchange="showtextbox(this.value);">
		  <option value="CRECHE">CRECHE</option>
		  <option value="NURSERY">NURSERY</option>
		  <option  value="OTHERS">OTHERS</option>
		  <option value="PRIMARY">PRIMARY</option>
		  <option value="SECONDARY">SECONDARY</option>
		  </select>
                      </div>
                    </div>
                    <div class="form-group clearfix" id="otherstext" style="display:none;">
                      <label class="col-lg-2 control-label " for="category">Others Name</label>
                      <div class="col-lg-10" >
                        <input type="text" class="form-control" id="short_name" name="short_name" value="<?php echo $_POST['short_name']; ?>">
                      </div>
                    </div>
					
                    <button type="submit" name="add" class="btn btn-default">Add</button>
                    
					</section>
                </div>
              </form>
            </div>
		   </div>
		</div>
		          <div class="card-box">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
				  <th>Section Name</th>
                  <th>others Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
		$aryList=$db->getRows("select * from school_section  where userid='0' and sid='0'");
		foreach($aryList as $iList)
			{	
			$i=$i+1;
		$aryPgAct["id"]=$iList['id'];
		 
			 ?>
                <tr>
				<form action="" method="post">
                  <td><?php echo $i ;?></td>
				  <td> <input type="text" name="editsection" style="border:none" value="<?php echo $iList['section']; ?>" /></td>
                  <td><input type="text" name="short_name" style="border:none" value="<?php echo $iList['short_name']; ?>" /></td>
                  <input type="hidden" name="section_id" value="<?php echo $iList['id'];?>">
                  <td> 
				  <input type="submit" name="update" style="border:none" value="update" />
				  <a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                   </td>
				</form>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
         
		
    </div>
  </div>
  <?php include('inc.footer.php'); ?>
</div>
</div>
<script>
function showtextbox(val){
	
	if(val=="OTHERS"){
		document.getElementById("otherstext").style.display = "block";
		
	}
	
}

</script>
<?php include('inc.js.php'); ?>
</body>
</html>
