<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="session";
$FileName = 'school_session.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
	if(isset($_POST['submit']))
		{    
	
			$figIn=$db->getVal("select * from school_session where session='".$_POST['session']."'");
	         
			
			if($figIn['id']!='')
			{
				$stat['error']="session exists";
			}
			else
			{
			$validate->addRule($_POST['session'],'','session',true);

			if($validate->validate() && count($stat)==0)
				{
	
					$aryData=array(	
					'session'     	 	         		=>	$_POST['session'],
					'sid'     	 	         		=>	0,
					'userid'     	 	         		=>	0,

					);  
					$flgIn1 = $db->insertAry("school_session",$aryData);
					
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
		$validate->addRule($_POST['edit_session'],'','edit_session',true);
		
		
		if($validate->validate() && count($stat)==0)
			{ 

			$aryData1 = array(	
			           'session'     	 	         		=>	$_POST['edit_session']

			);  

			$flgIn = $db->updateAry("school_session", $aryData1 , "where id='".$_POST['id']."' ");
			$stat['success']="Update Successfully";
			unset($_POST);
			redirect($FileName);
 			 	
			}
			
			else 
			{
				$stat['error'] = $validate->errors();
			}
		}
		elseif(($_REQUEST['action']=='delete'))
		{
			$flgIn1 = $db->delete("school_session","where id='".$_GET['id']."' ");			
			$stat['success'] = 'Deleted Successfully';
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
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="session">Session Name</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="session" name="session" placeholder="2019-20" value="<?php echo $_POST['session']; ?>">
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Save</button>
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
                  <th>session Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
				$i=0;
		$aryList=$db->getRows("select * from school_session  order by id desc");
		foreach($aryList as $iList)
			{	
			$i++;
			 ?>
                <tr>
				<form action="" method="post">
                  <td><?php echo $i ;?></td>
				  
                  <td><input type="text" name="edit_session" style="border:none" value="<?php echo $iList['session']; ?>" /></td>
                  <input type="hidden" name="id" value="<?php echo $iList['id'];?>">
                  <td>
					<input type="submit" name="update" value="update" style="border:none" />
					<a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"
					class="table-action-btn" > <i class="fa fa-times"></i> </a>
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
<?php include('inc.js.php'); ?>
</body>
</html>
