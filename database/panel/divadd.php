<?php
	
	require_once __DIR__."/../class/divclass.php";
	require_once __DIR__."/../class/sdivclass.php";
	require_once __DIR__."/../class/validator.php";
	$div=new div();
	$validator = new validator();
			 if(isset($_POST['submit'])){
				 $Error="";
				//$header= htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
				if(isset($_POST['blocktype'])){
					$div->setBlockType($_POST['blocktype']);
					$_SESSION['blocktype'] = $_POST['blocktype'];
				} else {
					echo "No blocktype";
				}


				$div->setHeader($_POST['header']);
				$_SESSION['header'] = $_POST['header'];

				$div->setHeadercolor($validator->formatColor($_POST['headercolor']));
				if ($validator->checkColor($div->getHeadercolor()) != true) {
					$Error = "Zły kolor nagłówka!";
				} else {
					$_SESSION['headercolor'] = $_POST['headercolor'];
				}

				$div->setHeaderfcolor($validator->formatColor($_POST['headerfcolor']));
				if ($validator->checkColor($div->getHeaderfcolor()) != true) {
					$Error = "Zły kolor czcionki nagłówka!";
				} else {
					$_SESSION['headerfcolor'] = $_POST['headerfcolor'];
				}

				$div->setHeaderfsize($_POST['headerfsize']);
				$_SESSION['headerfsize'] = $_POST['headerfsize'];

				$div->setBgcolor($validator->formatColor($_POST['bgcolor']));
				if ($validator->checkColor($_POST['bgcolor']) != true) {
					$Error = "Zły kolor tła!";
				} else {
					$_SESSION['bgcolor'] = $_POST['bgcolor'];
				}

				$div->setFontsize($_POST['fontsize']);
				$_SESSION['fontsize'] = $_POST['fontsize'];
				
				$div->setFontcolor($validator->formatColor($_POST['fontcolor']));
				if ($validator->checkColor($div->getFontcolor()) != true) {
					$Error = "Zły kolor czcionki!";
				} else {
					$_SESSION['fontcolor'] = $_POST['fontcolor'];
				}


				$div->setTopm($_POST['topm']);
				$div->setHeight($_POST['height']);
				$div->setPer_width($_POST['per_width']);
				
				if ($Error=="") {
					unset($_SESSION['blocktype']);
					unset($_SESSION['header']);
					unset($_SESSION['headercolor']);
					unset($_SESSION['headerfcolor']);
					unset($_SESSION['headerfsize']);
					unset($_SESSION['bgcolor']);
					unset($_SESSION['fontsize']);
					unset($_SESSION['fontcolor']);
					$div->addDiv();
					header('Location: ../../index.php');
					exit;	
				}	
			 }

			 if(isset($_POST['back'])){
				unset($_SESSION['Error']);
				unset($_SESSION['blocktype']);
				unset($_SESSION['header']);
				unset($_SESSION['headercolor']);
				unset($_SESSION['headerfcolor']);
				unset($_SESSION['headerfsize']);
				unset($_SESSION['bgcolor']);
				unset($_SESSION['fontsize']);
				unset($_SESSION['fontcolor']);
				header('Location: ../../index.php');
				exit;	
			}


?>