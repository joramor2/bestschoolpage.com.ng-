<?php  
include('../config.php'); 
include('inc.session-create.php'); 
 
 session_destroy();
 redirect('index.php');
 ?>