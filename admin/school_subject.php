<?php include('../config.php'); 
include('inc.session-create.php'); 
$PageTitle="subject";
$FileName = 'school_subject.php';
$validate=new Validation();
if($_SESSION['success']!="")
{
$stat['success']=$_SESSION['success'];
unset($_SESSION['success']);
}
	if(isset($_POST['submit']))
		{ 

			
			$validate->addRule($_POST['selectsession'],'','session',true);
			$validate->addRule($_POST['selectsection'],'','section',true);
			$validate->addRule($_POST['selectclass'],'','class',true);
			$validate->addRule($_POST['subject'],'','subject name',true);
			if($validate->validate() && count($stat)==0)
				{
		
			$iRecord1=$db->getRow("select * from  school_subject where subject = '".$_POST['subject']."' ");
		
 		 
 
 
				$aryData1=array(	
					'session_id'     	 	        =>	$_POST['selectsession'],
					'section_id'     	 	        =>	$_POST['selectsection'],
					'class_id'     	 	        =>	$_POST['selectclass'],
					'subject'     	 	         		=>	$_POST['subject'],
					 
					'sid'     	 	         		 =>	0,
					'userid'     	 	         	=>	0,
					
					);  
					
					$flgIn2 = $db->insertAry("school_subject", $aryData1 );
				//echo $flgIn2 = $db->getLastQuery(); 
	 
				 
				 }
				 	else {
					$stat['error'] = $validate->errors();
				}
			
			echo msg($stat);
				 
					//unset($_POST);
				}
					 
			
		
	 
	elseif(isset($_POST['update']))
		{ 
		
		$aryData=array(
								'subject'        	 => $_POST['editsubject'],
							 
								);
					$flgIn1 = $db->updateAry("school_subject",$aryData, "where id ='".$_POST['subjectid']."'");
					//echo $flgIn1 = $db->getLastQuery(); 
 			 	
			 
		}
		elseif(($_REQUEST['action']=='delete'))
		{
		
			$flgIn1 = $db->delete("school_subject","where id='".$_GET['id']."' ");			
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
				<a href="<?php echo $FileName; ?>?action=add"  class="btn btn-default" style="float:right">Add New Record</a>
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
                        <select class=" form-control" name="selectsession"   >
							<option value="">select session</option>
					 <?php 
					  $sss=$db->getRows("select * from school_session where userid='0' and sid='0'");
					  foreach($sss as $ss)
					  {
					  ?>
							<option value="<?php echo $ss['id'];?>"><?php echo $ss['session'];?></option>
							<?php
					  }
					  ?>
						</select>
                      </div>
                    </div>
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="section">Section</label>
                      <div class="col-lg-10">
                        <select name="selectsection"  class="form-control " id="selectsection"  onchange="getclass()">
		  <option>Select Section </option>
		   <?php $i=0;
				$aryList=$db->getRows("select * from school_section where  userid='0' and sid='0'");
						foreach($aryList as $iList)
							{	$i=$i+1;
								 
							 ?>
		  <option value="<?php echo $iList['id']; ?>"> <?php if($iList['section']=="OTHERS"){ echo $iList['short_name'];}
else{ echo  $iList['section']; 
}		  ?></option>
							<?php } ?>
		  </select>
                      </div>
                    </div>
					<div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="class">Class</label>
                      <div class="col-lg-10" >
                         <select class="form-control" name="selectclass"id="selectclass">
				<option value="">Select Class</option>
				</select>
		 
                      </div>
                    </div>
					
                    <div class="form-group clearfix">
                      <label class="col-lg-2 control-label " for="subject">Subject</label>
                      <div class="col-lg-10">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $_POST['subject']; ?>">
                      </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Submit</button>
                    <a  href="<?php echo $FileName; ?>"  class="btn btn-default" >Back</a> 
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
				 
				 
				  <th>Subject</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
		$aryList=$db->getRows("select * from school_subject where userid='0' and sid='0'");
		foreach($aryList as $iList)
			{	
			$i=$i+1;
		$aryPgAct["id"]=$iList['id'];
			 
			 ?>
                <tr>
				 
                  <td><?php echo $i ;?></td>
				 
				 
				  <td><input type="text" name="	" style="border:none" value="<?php echo $iList['subject']; ?>" /></td>
                  <input type="hidden" name="subjectid" value="<?php echo $iList['id'];?>">
                  <td> 
				  <input type="submit" name="update" style="border:none" value="update" />
				  <a href="javascript:del('<?php echo $FileName; ?>?action=delete&id=<?php echo $iList['id']; ?>')"    class="table-action-btn" > <i class="fa fa-times"></i> </a>
                   </td>
			 
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


function getclass()
  {

  var sec_id= document.getElementById("selectsection").value;
alert(sec_id);
  $.post("ajax.php",
  {
	 action:"getsubclass",
     sec_id:sec_id,   	 
  },
  function(data)
  { 
  alert(data);
	  document.getElementById('selectclass').innerHTML=data;
  });
  }
</script>
<?php include('inc.js.php'); ?>
</body>
</html>
