<?php 
include('../config.php');
$validate=new Validation();
if($_SESSION[LOGIN_ADMIN]['id']!='')
{ 
	redirect(ADMIN_URL."dashboard.php");	
}
if(isset($_POST['submit']))
{ 
 	$iCheckEmailId=$db->getVal("select * from  admin_login where emailid='".$_POST['email']."'");
	if($iCheckEmailId!='')
	{  
		$iCheckPassword=$db->getRow("select * from  admin_login where password='".$_POST['password']."' and emailid='".$_POST['email']."' and usertype='0'");
		if($iCheckPassword['id']=='')
		{ 
			 $stat['error']="Invalid password.";
		}
		elseif($iCheckPassword['status']=='1')
		{   
			$_SESSION[LOGIN_ADMIN]=array('id'=>$iCheckPassword['id'],'usertype'=>$iCheckPassword['usertype']);
			if($_SESSION[LOGIN_ADMIN]['id']!='')
					{
			redirect(ADMIN_URL."dashboard.php");	
					}	
		}
		else
		{   
			$stat['error']="Disable by admin.";
		}	
	}
	else
	{
		$stat['error']="This email id do not exit.";
	}
} 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include('inc.meta.php'); ?>
<style>
.card-box{
    margin: auto;
    width: 30%;
    height: 60%;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
	background-color: #fff !important;
}
</style>
</head>

    <body>



        <div class="account-pages"></div>

        <div class="clearfix"></div>

        <div class="wrapper-page">

        	<div class="card-box">

            <div class="panel-heading"> 

                <h3 class="text-center"> Sign In  </h3>

                <?php echo msg($stat); ?>

            </div> 

            <div class="panel-body">

            <form class="form-horizontal m-t-20" action="index.php" method="post">

                <div class="form-group ">

                    <div class="col-xs-12">

                        <input class="form-control" type="text" required placeholder="Email" name="email" value="<?php echo $_COOKIE['admin_email']; ?>">

                    </div>

                </div>

                <div class="form-group">

                    <div class="col-xs-12">

                        <input class="form-control" type="password" required placeholder="Password" name="password" value="<?php echo $_COOKIE['admin_password']; ?>">

                    </div>

                </div>



                <div class="form-group ">

                    <div class="col-xs-12">

                        <div class="checkbox checkbox-primary">

                            <input id="checkbox-signup" type="checkbox" value="1" name="remember_checked" <?php if($_COOKIE['admin_email']!='') { echo 'checked'; } ?>>

                            <label for="checkbox-signup">

                                Remember me                            </label>

                        </div>

                    </div>

                </div>

                

                <div class="form-group text-center m-t-40">

                    <div class="col-xs-12">

                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="submit">Log In</button>

                    </div>

                </div>



                <div class="form-group m-t-30 m-b-0">

                    <div class="col-sm-12">

                                         </div>

                </div>

            </form> 

            </div>   

            </div>                              

                <div class="row">

            	<div class="col-sm-12 text-center">

            		 

                    </div>

            </div>

        </div>

	</body>

</html>