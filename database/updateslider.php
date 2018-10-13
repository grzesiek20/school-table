<?php

	require_once __DIR__."/class/divclass.php";

	$div= new div();
	$div->updateSliderheight($_POST['sliderheight']);
					
					header('Location: ../index.php');
					exit;	
				
?>