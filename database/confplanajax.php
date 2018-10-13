<?php
	
	require_once "class/sdivclass.php";
	$sdiv=new sdiv();
	$plan= $sdiv->getPlan($_POST['gkoniec']);
	
	echo $plan;

?>