<?php
	
	require_once __DIR__."/class/randomizeclass.php";
		
		$randomize = new randomize();
		$numbers = $randomize->getUndrawn();
		echo $numbers;
		
	 if(isset($_POST['number'])){
			
			$randomize->setDrawnNumber($_POST['number']);
					
					 header("Location: ../index.php");
					 exit;	
	 }
		
?>