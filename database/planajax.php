<?php
	
	require_once __DIR__."/class/sdivclass.php";
	$message=new message();
	$plan= $message->getPlan($_POST['end_hour']);
	
	echo $plan;

?>