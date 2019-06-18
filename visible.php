<?php

	require_once "database/class/sdivclass.php";
	
	$message = new message();
		
			 $message->getSdiv($_GET['id_message']);
			 $message->setVisibility($_GET['id_message'],$_GET['set']);
			
					 header("Location: view/edit.php?id=".$message->getIdDiv());
					 exit;	

		
?>