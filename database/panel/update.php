<?php

	require_once __DIR__."/../class/divclass.php";

	$div= new div();

					$div->setIdDiv($_POST['id_diva']);
					$div->setPer_width($_POST['per_width']);
					$div->setHeight($_POST['height']);
					$div->setPer_leftm($_POST['per_leftm']);
					$div->setTopm($_POST['topm']);
					
					$div->updateDivLocation();
					
					header('Location: ../../index.php');
					exit;	
				
?>