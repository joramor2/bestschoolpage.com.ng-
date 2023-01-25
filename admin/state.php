<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="State";
$FileName = 'state.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
  $stat['success']=$_SESSION['success'];
  unset($_SESSION['success']);
}
if(isset($_POST['addnewrecord']))
 	{ 
				$validate->addRule($_POST['title'],'',"Title ",true);
        $validate->addRule($_POST['status'],'',"");

        if($validate->validate() && count($stat)==0)
          {
            $aryData=array(						
												'title'     	 	     			=>	$_POST['title'],
												'status'     	 	     			=>	$_POST['status'],
                      );
            $flgIn1 = $db->insertAry("state",$aryData);
 					  $_SESSION['success']="Submited Successfully";
  					redirect($iClassName.$FileName);
 					  unset($_POST);
          }
          else {$stat['error'] = $validate->errors();}
        }
        elseif(isset($_POST['udpaterecord']))
          {
            if($validate->validate() && count($stat)==0)
              {
                $aryData=array(
                  'title'     	 	     			=>	$_POST['title'],
									'status'     	 	     			=>	$_POST['status'],
                );
                $flgIn = $db->updateAry("state", $aryData , "where id='".$_GET['id']."'");
                $_SESSION['success']="Update Successfully";
				        unset($_POST);
              }
                else {$stat['error'] = $validate->errors();}
              }
              elseif(($_GET['action']=='delete'))
                {
                  $flgIn1 = $db->delete("state","where id='".$_GET['id']."'");
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
                <div class="col-md-3"> <a href="<?php echo $iClassName.$FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a> </div>
              </div>
            </div>
            <?php if($_GET['action']=='add') { ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Title  </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="title" value="<?php echo $_POST['title']; ?>" >
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Status </label>
                      <div class="col-lg-10">
                        <select name="status" class="form-control required">
                          <option value="1">Active</option>
						              <option value="0">Inactive</option>
						            </select>
                      </div>
                    </div>
					
                    <button type="submit" name="addnewrecord" class="btn btn-default">Submit</button>
                    <a href="<?php echo $iClassName.$FileName; ?>" class="btn btn-default" >Back</a> 
                  </section>
                </div>
              </form>
            </div>
            <?php } 

            elseif($_GET['action']=='edit') { 
					    $aryDetail=$db->getRow("select * from state where id='".$_GET['id']."'");
					   ?>
            <div class="card-box">
              <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Title </label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control required" name="title" value="<?php echo $aryDetail['title']; ?>" required>
                      </div>
                    </div>

                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="userName">Status </label>
                      <div class="col-lg-10">
                        <select name="status" class="form-control required" >
                          <option value="1" <?php  if($aryDetail['status']=='1') { echo "selected"; }  ?>>Active</option>
			                    <option value="0" <?php  if($aryDetail['status']=='0') { echo "selected"; }  ?>>InActive</option>
                        </select>
                      </div>
                    </div>

                    <button type="submit" name="udpaterecord" class="btn btn-default">Submit</button>
                    <a  href="<?php echo $iClassName.$FileName; ?>"  class="btn btn-default" >Back</a> </section>
                </div>
              </form>
            </div>
            <?php  }  

            else { ?>
            <div class="card-box">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
					           <th>Status</th>
                     <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $aryList=$db->getRows("select * from state order by id desc");
							 foreach($aryList as $iList)
									{	$i=$i+1;
							 ?>
                  <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $iList['title']; ?></td>
					<td><?php  if($iList['status']=='1') { echo "active" ; } else { echo "Inactive" ; }   ?></td>
					

                    
                    <td><a href="<?php echo $iClassName.$FileName; ?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a>
                     <a href="javascript:del('<?php echo $iClassName.$FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a></td>
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