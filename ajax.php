<?php include('config.php');
$validate = new Validation();


if ($_POST['action'] == 'subscribemail') {


	$validate->addRule($_POST['subscribe_email'], 'email', 'Email id', true);

	if ($validate->validate() && count($stat) == 0) {
		$iCheckEmailId = $db->getVal("select * from  subscribe where emailid='" . $_POST['subscribe_email'] . "'");

		if ($iCheckEmailId != '') {
			echo '<span style="    background: #ff00009e;    padding: 10px;    color: #fff;"> This email id already exit.</span>';
		} else {

			$aryData = array(
				'emailid'                                 	=> $_POST['subscribe_email'],
				'create_at'  			              	  	=> date("Y-m-d H:i:s"),
			);
			$flgIn1 = $db->insertAry("subscribe", $aryData);
			echo '<span style="    background: #00800091;    padding: 10px;    color: #fff;">Subscribe successfully </span>';
			exit;
		}
	} else {
		echo '<span style="    background: #ff00009e;    padding: 10px;    color: #fff;"> Please enter valid email id. </span>';
	}

	//echo msg($stat);
	exit;
}
