<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);
error_reporting(0);

session_start();
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=='127.0.0.1')
	{
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
$dbName = "bestsch3_skooling";
$user =   "root";
$pass =   "";
$host = "localhost";
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
/*-------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
define("SITE_URL","http://127.0.0.1/bestschoolpage.com.ng/");
define("ADMIN_URL","http://127.0.0.1/bestschoolpage.com.ng/admin/");
define("LIVE_URL","http://127.0.0.1/bestschoolpage.com.ng/");
define("SKOOL_URL","http://127.0.0.1/bestschoolpage.com.ng/skool/");
define("PARENT_URL","http://127.0.0.1/bestschoolpage.com.ng/parent/");
/*--------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
	}else {
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
$dbName = "bestsch3_skooling";
$user =   "bestsch3_skool";
$pass =   "!63yntf39TMj";
$host = "127.0.0.1";
/*--------------------------------------------------------------Just Change the Database Name of your project------------------------------------*/
/*-------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
define("SITE_URL","https://www.bestschoolpage.com.ng/");
define("ADMIN_URL","https://www.bestschoolpage.com.ng/admin/");
define("LIVE_URL","https://www.bestschoolpage.com.ng/");
define("SKOOL_URL","https://www.bestschoolpage.com.ng/skool/");
define("PARENT_URL","https://www.bestschoolpage.com.ng/parent/");
/*--------------------------------------------------------------Just change the folder name Of your PRoject------------------------------------*/
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
	$location = 'https://www.' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: ' . $location);
	exit;
}	

	}
	
define("DS",DIRECTORY_SEPARATOR);
define("PATH_ROOT",dirname(__FILE__));
define("PATH_LIB",PATH_ROOT.DS."library".DS);
define("PATH_IMAGES",PATH_ROOT.DS.'images'.DS);
define("PATH_UPLOAD",PATH_ROOT.DS."uploads".DS);
define("URL_ADMIN_SOFTWARE_MODULE",PATH_ROOT.DS."modules".DS);
define("URL_ADMIN_SOFTWARE_WITHOUT_MODULE",PATH_ROOT.DS);
define("URL_IMG",SITE_URL."images/");
define("URL_CSS",SITE_URL."css/");
define("URL_JS",SITE_URL."js/");
define("SELF",basename($_SERVER['PHP_SELF']));
require_once(PATH_LIB."class.database.php");
require_once(PATH_LIB."validations.php");
$db=new MySqlDb($host,$user,$pass,$dbName);
// $mysqli = new mysqli($host,$user,$pass,$dbName);
// if ($mysqli->connect_errno) {
//     echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
// }
// exit;
// if ($db->connect_errno) {
//     echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
// }
// exit;
$db->query("SET NAMES 'utf8'");
require_once(PATH_LIB."functions.php");
date_default_timezone_set('Asia/Kolkata');
$iSettingDetail=$db->getRow("select * from settings where id='1'");

$iHomeSettingDetails=$db->getRow("select * from home_content where id='1'");
$iCurrentFileName = basename($_SERVER['PHP_SELF']);
?>