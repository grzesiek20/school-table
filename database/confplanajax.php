<?php
	
	require_once "class/sdivclass.php";
	$message=new message();
	$plan= $message->getPlan($_POST['end_hour']);
	
	echo $plan;

?>