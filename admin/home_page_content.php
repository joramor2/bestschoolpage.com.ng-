<?php  
include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="Home_page_content";
$FileName = 'home_page_content.php';
$iClassName = ADMIN_URL;
$validate=new Validation();

if($_SESSION['success']!="")
{
   $stat['success']=$_SESSION['success'];
   unset($_SESSION['success']);
}
if(isset($_POST['update']))
{ 
	//$validate->addRule($_POST['title'],'','Title',true);
			  
	if($validate->validate() && count($stat)==0)
	{
		$aryData=array(	
						'heading'  	       		=>	$_POST['heading'],
						'title'  	        	=>	$_POST['title'],
						'description'           =>  $_POST['description'],
						'link'                	=>  $_POST['link'],
						'heading2'         	    =>  $_POST['heading2'],
						'heading3'         	    =>  $_POST['heading3'],
						'heading4'     	        =>  $_POST['heading4'],
						'heading5'      	        =>  $_POST['heading5'],
						'heading6'  	=>  $_POST['heading6'],
						'heading7'              =>  $_POST['heading7'],
						);  
						
						// Replace injection attacks
						foreach($aryData as $key => $value){
						    $value = str_ireplace('meta','_',$value);
						    $value = str_ireplace('script','_',$value);
						    $value = str_ireplace('drop','_',$value);
						    $aryData[$key] = $value;
                        }
				$flgIn = $db->updateAry("home_page_content", $aryData , "where id='1'");
				
				$_SESSION['success']="Update Successfully";
				unset($_POST);
				redirect($iClassName.$FileName);
	}
	else 
	{
		$stat['error'] = $validate->errors();
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
<div class="content">
<div class="container">
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
                <div class="col-md-9"><?php echo msg($stat); ?></div>
				<!--<div class="col-md-3"> <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a></div>-->
			</div>
        </div>
	<?php $aryDetail=$db->getRow("select * from home_page_content where id='1'"); ?>
    <div class="card-box">
    <form role="form" action="" method="post" enctype="multipart/form-data">
    <section>
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Heading 1</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading" value="<?php echo $aryDetail['heading'];?>">
		</div>
		</div>

		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Title</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="title" value="<?php echo $aryDetail['title'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm"> Description</label>
		<div class="col-lg-10">
		<textarea class="form-control required" name="description"><?php echo $aryDetail['description'];?></textarea>
		</div>
		</div>

		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Link</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="link" value="<?php echo $aryDetail['link'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm"> Heading 2</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading2" value="<?php echo $aryDetail['heading2'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm"> Heading 3</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading3" value="<?php echo $aryDetail['heading3'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Heading 4</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading4" value="<?php echo $aryDetail['heading4'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Heading 5 </label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading5"  value="<?php echo $aryDetail['heading5'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Heading 6</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading6" value="<?php echo $aryDetail['heading6'];?>">
		</div>
		</div>
		
		<div class="form-group clearfix">
		<label class="col-lg-2 control-label " for="confirm">Heading 7</label>
		<div class="col-lg-10">
		<input type="text" class="form-control required" name="heading7" value="<?php echo $aryDetail['heading7'];?>">
		</div>
		</div>
		
		<button type="submit" name="update" class="btn btn-default">update</button>
		<a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> 
	</section>
	</form>
    </div>
	</div>
	</div>
</div>
</div>
</div>
	<?php include('inc.footer.php'); ?>
</div>
	<?php include('inc.js.php'); ?>
</body>
</html>
