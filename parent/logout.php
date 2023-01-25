<?php  
include('../config.php'); 
include('inc.session-create.php'); 
 
session_destroy();
unset($_SESSION['userid']);
redirect('index.php');
?>