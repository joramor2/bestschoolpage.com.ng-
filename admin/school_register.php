<?php
include('../config.php');
include('inc.session-create.php'); 
$validate = new validation();
$pageTitle ='School Register';
$Filename ='school_register.php';
if (isset($_POST['Register']))
  {
      $validate->addRule($_POST['name'],'alpha','Full name',true);
      $validate->addRule($_POST['email'],'Email','Email',true);
      $validate->addRule($_POST['contact_no'],'Num','Mobile Number',true);
      $validate->addRule($_POST['username'],'','Username',true);
      $validate->addRule($_POST['password'],'','Password',true);
      $validate->addRule($_POST['location'],'','Location',true);
      $validate->addRule($_POST['about'],'','About',true);
      $validate->addRule($_POST['website'],'','Website Name',true);
      $validate->addRule($_POST['status'],'','Status',true);

      if($validate->validate() && count($stat) == 0)
				{
          $iEmailCheckId=$db->getRow("select * from school_register where email='".$_POST['email']."' ");
          if($iEmailCheckId['id'] == ''){
                    if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
                      {
                        $filename = basename($_FILES['image']['name']);
                        $ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
                        if(in_array($ext1,array('jpg','png','jpeg', 'gif')))
                          {
                            $newfile=md5(time())."_".$filename;
                            move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/'.$newfile);
                          }
                        }
                        else { $newfile =$_POST['image_old']; }
                        $iLastInsertid=$db->getVal("select id from school_register order by id DESC");
                        $iPageurl= PageUrl($_POST['name']).'-'.$$iLastInsertid;
                        $aryData = array(
                          'name'                 => $_POST['name'],
                          'email'                => $_POST['email'],
                          'contact_no'           => $_POST['contact_no'],
                          'username'             => $_POST['username'],
                          'password'             => $_POST['password'],
                          'location'             => $_POST['location'],
                          'state'                => $_POST['stateid'],
                          'about'                => $_POST['about'],
                          'website'              => $_POST['website'],
                          'verifyid'             => randomFix(12),
                          'pageurl'              => $iPageurl,
                          'status'               => $_POST['status'],
                          'create_at'            => date('Y-m-d H:m:s'),
                          'logo'                 => $newfile,
                        );
                        $flgIn2 = $db->insertAry("school_register",$aryData);
                        $stat['success']="Submited successfully";
                        unset($_POST);
						redirect('school_register.php');
                      }
                    
                    else{
                      $stat['error']="Email are alerady registerd.";
                    }
                    }
            else {
              $stat['error'] = $validate->errors();
            }
          }

      // Update Details for The User// 
	     elseif(isset($_POST['update']))
        {
          $validate->addRule($_POST['email'],'Email','Email',true);
          $validate->addRule($_POST['contact_no'],'Num','Mobile Number',true);
          $validate->addRule($_POST['username'],'','Username',true);
          $validate->addRule($_POST['password'],'','Password',true);
          $validate->addRule($_POST['location'],'','Location',true);
          $validate->addRule($_POST['about'],'','About',true);
          $validate->addRule($_POST['website'],'','Website Name',true);
          $validate->addRule($_POST['status'],'','Status',true);

          if($validate->validate() && count($stat) == 0)
            {
              if(isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"]))
                {
                  $filename = basename($_FILES['image']['name']);
                  $ext1 = strtolower(substr($filename, strrpos($filename, '.')+1));
                  if(in_array($ext1,array('jpg','png','jpeg', 'gif')))
                    {
                      $newfile=md5(time())."_".$filename;
                      move_uploaded_file($_FILES['image']['tmp_name'],'../uploads/'.$newfile);
                    }
                  }
                  else { $newfile =$_POST['image_old']; }

                  $aryData = array(
                    'name'                 => $_POST['name'],
                    'email'                => $_POST['email'],
                    'contact_no'           => $_POST['contact_no'],
                    'username'             => $_POST['username'],
                    'password'             => $_POST['password'],
                    'location'             => $_POST['location'],
                    'state'                => $_POST['stateid'],
                    'about'                => $_POST['about'],
                    'website'              => $_POST['website'],
                  
                   
                    'status'               => $_POST['status'],
                    'logo'                 => $newfile,
                  );

                  $flgIn1 = $db->updateAry("school_register", $aryData, "where id='".$_GET['id']."' ");
				  
				$Stat['success']="Update Successfully";
				unset($_POST);
				redirect('school_register.php');
                }
                else {
                  $stat['error'] = $validate->errors();
                }
              }
    
		            elseif(($_REQUEST['action']=='delete'))
                  {
                    $flgIn1 = $db->delete("school_register","where id='".$_GET['id']."' ");			
			              $stat['success'] = 'Deleted Successfully';
                  }
				  
				   elseif(($_REQUEST['action']=='deletesession'))
                  {
                    $flgIn1 = $db->delete("school_session","where id='".$_GET['id']."' ");			
			              $stat['success'] = 'Deleted Successfully';
                  }


 elseif(($_REQUEST['action']=='deletesection'))
                  {
                    $flgIn1 = $db->delete("school_section","where id='".$_GET['id']."' ");			
			              $stat['success'] = 'Deleted Successfully';
                  } 

 elseif(($_REQUEST['action']=='deleteclass'))
                  {
                    $flgIn1 = $db->delete("school_class","where id='".$_GET['id']."' ");			
			              $stat['success'] = 'Deleted Successfully';
                  }

 elseif(($_REQUEST['action']=='deletesubject'))
                  {
                    $flgIn1 = $db->delete("school_subject","where id='".$_GET['id']."' ");			
			              $stat['success'] = 'Deleted Successfully';
                  }				  ?>
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
                <li> <a href="<?php echo $PageTitle;?>">Home</a> </li>
                <li class="active"><?php echo $pageTitle;?></li>
              </ol>
            </div>
          </div>

          <!-- Basic Form Wizard -->

          <div class="row">
            <div class="col-md-12">
              <div class="card-box aplhanewclass">
                <div class="row">
                  <div class="col-md-9">
                    <?php echo msg($stat);?>
                  </div>
                  <div class="col-md-3">
                    <a href="<?php echo $Filename;?>?action=add" class="btn btn-default" style="float:right">Add New Record</a>
                  </div>
                </div>
              </div>

                <!-- add section start -->
                <?php if($_GET['action']=='add') { ?>
                  <div class="card-box">
                    <form action="" method="POST" enctype="multipart/form-data"/>
                  <div>
                    <section>
                      
                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">School Name</label>
                        <div class="col-lg-10">
                          <input name="name" class="form-control" id="title" value="<?php echo $_POST['name']?>" placeholder="Enter your Name" type="text" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Email</label>
                        <div class="col-lg-10">
                          <input name="email" class="form-control" id="email" value="<?php echo $_POST['email']; ?>" placeholder="Enter your Email" type="email" /> 
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Contact Number </label>
                        <div class="col-lg-10">
                          <input name="contact_no" class="form-control" id="title" value="<?php echo $_POST['contact_no']; ?>" placeholder="Enter your Contact Number" type="text" />
                        </div>
                      </div>
                    
                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Username</label>
                        <div class="col-lg-10">
                            <input name="username" class="form-control" id="title" value="<?php echo $_POST['username']?>" placeholder="Enter your Username" type="text"/>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Password</label>
                        <div class="col-lg-10">
                          <input name="password" class="form-control" id="title" value="<?php echo $_POST['password']?>" placeholder="Enter your password" type="password" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Location</label>
                        <div class="col-lg-10">
                          <input name="location" class="form-control" id="title" value="<?php echo $_POST['location']?>" placeholder="Enter your Location" type="location" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">State Name :</label>
                        <div class="col-lg-10">
                          <select  class="required form-control" name="stateid">
                            <option>Select State</option>
                            <?php $aryDetail=$db->getRows("select * from  state order by id desc");
                            foreach($aryDetail as $iList)
                              { $i=$i+1;?>
                                <option value="<?php echo $iList['id']; ?>" <?php  if($_POST['stateid']==$iList['id']) { echo "selected";}?>><?php echo $iList['title']; ?></option>
                                <?php }?>
                              </select>
                            </div>
                          </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Website Name</label>
                        <div class="col-lg-10">
                          <input name="website" class="form-control" id="title" value="<?php echo $_POST['website']?>" placeholder="Enter your website name" type="text" />
                        </div>
                      </div>


                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="adout"> About the school</label>
                        <div class="col-lg-10">
                          <textarea name="about" class="form-control" placeholder="Enter your about"/> </textarea>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="image">Image </label>
                        <div class="col-lg-10">
                          <input type="file" name="image"  class="form-control" id="image" value="<?php echo $_POST['image']; ?>">
                        </div>
                      </div>    

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">Status </label>
                        <div class="col-lg-10">
                          <select  class=" form-control" name="status">
                           
                            <option name="status" value="1" <?php if($_POST['status']=='1') { echo "active" ; } else { echo "Inactive" ; } ?>>Active</option>
                            <option name="status" value="0" <?php if($_POST['status']=='0') { echo "active" ; } else { echo "Inactive" ; } ?>>Inactive</option>
                          </select>
                        </div>
                      </div>

                    <button type="submit" name="Register" class="btn btn-default">Submit</button>
                    <a href="<?php echo $Filename; ?>" class="btn btn-default" >Back</a> 
                  </section>
                </div>
              </form>
            </div>
          <?php }

                            // Update User for admin //
            elseif($_GET['action']=='edit') { 
			       $aryDetail=$db->getRow("select * from  school_register where id='".$_GET['id']."'");	
					     ?>
                <div class="card-box">
                  <form role="form" action="" method="post" enctype="multipart/form-data">
                <div>
                  <section>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">School Name</label>
                        <div class="col-lg-10">
                          <input name="name" class="form-control" id="title" value="<?php echo $aryDetail['name']?>" placeholder="Enter your Name" type="text" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Email</label>
                        <div class="col-lg-10">
                          <input name="email" class="form-control" id="title" value="<?php echo $aryDetail['email']; ?>" placeholder="Enter your Email" type="email" /> 
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Contact Number </label>
                        <div class="col-lg-10">
                          <input name="contact_no" class="form-control" id="title" value="<?php echo $aryDetail['contact_no'];?>" placeholder="Enter your Contact Number" type="text" />
                        </div>
                      </div>
                    
                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Username</label>
                        <div class="col-lg-10">
                            <input name="username" class="form-control" id="title" value="<?php echo $aryDetail['username']; ?>" placeholder="Enter your Username" type="text"/>
                        </div>
                      </div>


                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Password</label>
                        <div class="col-lg-10">
                          <input name="password" class="form-control" id="title" value="<?php echo $aryDetail['password']; ?>" placeholder="Enter your password" type="password" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Location</label>
                        <div class="col-lg-10">
                          <input name="location" class="form-control" id="title" value="<?php echo $aryDetail['location']; ?>" placeholder="Enter your Location" type="location" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">State Name :</label>
                        <div class="col-lg-10">
                          <select  class="required form-control" name="stateid">
                            <option>Select State</option>
                            <?php $aryDetails=$db->getRows("select * from  state order by id desc");
                            foreach($aryDetails as $iList)
                              { $i=$i+1;?>
                                <option value="<?php echo $aryDetail['id']; ?>" <?php if($aryDetail['state']==$iList['id']) {echo "selected";}?>><?php echo $iList['title']; ?></option>
                                <?php }?>
                              </select>
                            </div>
                          </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Website Name</label>
                        <div class="col-lg-10">
                           <input name="website" class="form-control" id="title" value="<?php echo $aryDetail['website']?>" placeholder="Enter your website name" type="text" />
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> About </label>
                        <div class="col-lg-10">
                          <textarea name="about" class="form-control"/> <?php echo $aryDetail['about']; ?> </textarea>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="image">Image </label>
                        <div class="col-lg-10">
                          <input type="file" name="image" class="form-control" id="image" value="<?php echo $aryDetail['logo'];?>">
                          <input type="hidden" class="form-control" id="image_old" name="image_old" value="<?php echo $aryDetail['logo'] ?>">
                          <img src="../uploads/<?php echo $aryDetail['logo']; ?>" style="height:50px;">
                        </div>
                      </div>    

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="confirm">Status </label>
                        <div class="col-lg-10">
                          <select  class=" form-control" name="status">
                            <option name="status" value="1" <?php if($aryDetail['status']=='1') { echo "selected"; } ?>>Active</option>
                            <option name="status" value="0" <?php if($aryDetail['status']=='0') { echo "selected"; } ?>>Inactive</option>
                          </select>
                        </div>
                      </div>

                    <button type="submit" name="update" class="btn btn-default">Submit</button>
                    <a  href="<?php echo $Filename; ?>"  class="btn btn-default" >Back</a> 
                  </section>
                </div>
              </form>
            </div>
            <?php  }

                    // View User for admin // 
	             elseif($_GET['action']=='view') {
                $GetEmailId=$db->getRow("select * from  school_register where id='".$_GET['id']."'");
	               ?>
                 <div class="card-box">
                  <form method="POST" action="" role="form" enctype="multipart/form-data">
                    <div>
                  <section>
                    
                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">School Name</label>
                        <div class="col-lg-10">
                          <?php echo $GetEmailId['name']?>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Email</label>
                        <div class="col-lg-10">
                          <?php echo $GetEmailId['email']?> 
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Contact Number </label>
                        <div class="col-lg-10">
                          <?php echo $GetEmailId['contact_no']?>
                        </div>
                      </div>
                    
                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Username</label>
                        <div class="col-lg-10">
                            <?php echo $GetEmailId['username']?>
                        </div>
                      </div>


                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Password</label>
                        <div class="col-lg-10">
                          <?php echo $GetEmailId['password']?>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Location</label>
                        <div class="col-lg-10">
                          <?php echo $GetEmailId['location']?>
                        </div>
                      </div>

                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label" for="employee_id">Website Name</label>
                        <div class="col-lg-10">
                           <?php echo $GetEmailId['website']?>
                        </div>
                      </div>


                      <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> About </label>
                        <div class="col-lg-10">
                        <?php echo $GetEmailId['about']?>
                        </div>
                      </div>

					<div class="form-group clearfix">
					<label class="col-lg-2 control-label " for="image">Image </label>
					<div class="col-lg-10">

					<input type="hidden" class="form-control "  id="image_old" name="image_old"  value="<?php echo $GetEmailId['logo'] ?>" >
					<img src="../uploads/<?php echo $GetEmailId['logo'] ?>" style="height:50px;">
					</div>
					</div>    

					
				                       <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> Session </label>
                        <div class="col-lg-10">
                        <table  class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Session</th>			
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $aryList=$db->getRows("select * from school_session where userid='".$_GET['id']."' and sid='".$_GET['id']."'");
                          foreach($aryList as $iList)
                            {
                              $i=$i+1;
                              $aryPgAct["id"]=$iList['id'];
                            //  $aryState=$db->getRow("select * from state where id='".$iList['state']."' ");
                              ?>
                              <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $iList['session'];?></td>
                            
                                
                              
                                
                                <td>  
                                
                                <a href="javascript:del('<?php echo $Filename;?>?action=deletesession&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                        </div>
                      </div>
                      
          
					     					 <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> Section </label>
                        <div class="col-lg-10">
                        <table  class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Section</th>
                         <th>Others Name </th>							
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $aryList=$db->getRows("select * from school_section where userid='".$_GET['id']."' and sid='".$_GET['id']."'");
                          foreach($aryList as $iList)
                            {
                              $j=$j+1;
                              $aryPgAct["id"]=$iList['id'];
                            //  $aryState=$db->getRow("select * from state where id='".$iList['state']."' ");
                              ?>
                              <tr>
                                <td><?php echo $j ?></td>
                                <td><?php echo $iList['section'];?></td>
								  <td><?php echo $iList['short_name'];?></td>
                                <td>  
                                
                                <a href="javascript:del('<?php echo $Filename;?>?action=deletesection&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                        </div>
                      </div>
					        
					     					 <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> Class </label>
                        <div class="col-lg-10">
                        <table  class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Class Name</th>	
                             <th>Short Name</th>								
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $aryList=$db->getRows("select * from school_class where userid='".$_GET['id']."' and sid='".$_GET['id']."'");
                          foreach($aryList as $iList)
                            {
                              $j=$j+1;
                              $aryPgAct["id"]=$iList['id'];
                            //  $aryState=$db->getRow("select * from state where id='".$iList['state']."' ");
                              ?>
                              <tr>
                                <td><?php echo $j ?></td>
                                <td><?php echo $iList['name'];?></td>
								 <td><?php echo $iList['short_name'];?></td>
                                <td>  
                                
                                <a href="javascript:del('<?php echo $Filename;?>?action=deleteclass&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                        </div>
                      </div>
					  
					  
					     					 <div class="form-group clearfix">
                        <label class="col-lg-2 control-label " for="address"> Subject </label>
                        <div class="col-lg-10">
                        <table  class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
							<th>Session</th>
							<th>Section</th>
							<th>Class</th>	
                            <th>Subject</th>			
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $aryList=$db->getRows("select * from school_subject where userid='".$_GET['id']."' and sid='".$_GET['id']."'");
                          foreach($aryList as $iList)
                            {
                              $k=$k+1;
                              $aryPgAct["id"]=$iList['id'];
                            $aryState=$db->getRow("select * from school_session where id='".$iList['session_id']."' ");
							 $aryState1=$db->getRow("select * from school_section where id='".$iList['section_id']."' ");
							  $aryState2=$db->getRow("select * from school_class where id='".$iList['class_id']."' ");
                              ?>
                              <tr>
                                <td><?php echo $k ?></td>
                                <td>
								<?php echo $aryState['session'];?>
								</td>
								<td><?php echo $aryState1['section'];?></td>
								<td><?php echo $aryState2['name'];?></td>
								<td><?php echo $iList['subject'];?></td>
                                <td>  
                                
                                <a href="javascript:del('<?php echo $Filename;?>?action=deletesubject&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                              </td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                        </div>
                      </div>
					   
                    <a href="school_register.php"  class="btn btn-default" >Back</a>
					        </section>
                </div>
              </form>
            </div>
                  <?php } else { ?>
                    <div class="card-box">
                      <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>			
                            <th>Contact</th>
                            <th>Username</th>
                            <th>location</th>
                            
                            <th>Status</th>
                            <th>Create At</th> 
							<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $aryList=$db->getRows("select * from school_register WHERE usertype=0 order by id desc");
                          foreach($aryList as $iList)
                            {
                              $i=$i+1;
                              $aryPgAct["id"]=$iList['id'];
                              $aryState=$db->getRow("select * from state where id='".$iList['state']."' ");
                              ?>
                              <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $iList['name'];?></td>
                                <td><?php echo $iList['contact_no'];?></td>
                                <td><?php echo $iList['username'];?></td>
                                <td><?php echo $iList['location'];?></td>
                                
                                <td><?php  if($iList['status']=='1') { echo "active" ; } else { echo "Inactive" ; }?></td>
                                <td><?php echo $iList['create_at'];?></td>
                                <td><a href="<?php echo $Filename;?>?action=view&id=<?php echo $iList['id']; ?>" class="table-action-btn"> <i class="fa fa-search"></i></a> 
                                <a href="<?php echo $Filename;?>?action=edit&id=<?php echo $iList['id']; ?>"  class="table-action-btn" > <i class="fa fa-pencil"></i> </a> 
                                <a href="javascript:del('<?php echo $Filename;?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
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
		
        </div>
      </div>
      
    </div>
  </div>
    
  <?php include('inc.js.php'); ?>
  <?php include('inc.footer.php'); ?>
</body>
</html>
