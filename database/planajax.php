<?php
	
	require_once __DIR__."/class/sdivclass.php";
	$sdiv=new sdiv();
	$plan= $sdiv->getPlan($_POST['gkoniec']);
	
	echo $plan;

?>