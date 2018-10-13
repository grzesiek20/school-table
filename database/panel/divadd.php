<?php
	
	require_once __DIR__."/../class/divclass.php";
	$div=new div();

			 if(isset($_POST['submit'])){
				 
				//$header= htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
				$div->setHeader($_POST['header']);
				$div->setHeadercolor($_POST['headercolor']);
				$div->setHeaderfcolor($_POST['headerfcolor']);
				$div->setHeaderfsize($_POST['headerfsize']);
				$div->setBgcolor($_POST['bgcolor']);
				$div->setFontsize($_POST['fontsize']);
				$div->setFontcolor($_POST['fontcolor']);
				$div->setTopm($_POST['topm']);
				$div->setHeight($_POST['height']);
				$div->setPer_width($_POST['per_width']);
				
				$div->addDiv();
					
					 header('Location: ../../index.php');
					 exit;	

			 }


?>