<?php

	require_once __DIR__."/class/divclass.php";

	$panel= new panel();
	$panel->updateSliderheight($_POST['sliderheight']);
					
					header('Location: ../index.php');
					exit;	
				
?>