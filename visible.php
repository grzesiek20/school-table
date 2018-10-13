<?php

	require_once "database/class/sdivclass.php";
	
	$sdiv = new sdiv();
		
			 $sdiv->getSdiv($_GET['id_sdiv']);
			 $sdiv->setVisibility($_GET['id_sdiv'],$_GET['set']);
			
					 header("Location: view/edit.php?id=".$sdiv->getIdDiv());
					 exit;	

		
?>