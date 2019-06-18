<?php
	
	require_once __DIR__."/../class/divclass.php";
	require_once __DIR__."/../class/sdivclass.php";
	require_once __DIR__."/../class/validator.php";
	$panel=new panel();
	$validator = new validator();
			 if(isset($_POST['submit'])){
				 $Error="";
				//$header= htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
				if(isset($_POST['block_type'])){
					$panel->setBlockType(htmlentities($_POST['block_type']));
					$_SESSION['block_type'] = $_POST['block_type'];
				} else {
					echo "No block_type";
				}


				$panel->setHeader(htmlentities($_POST['header_text']));
				$_SESSION['header_text'] = htmlentities($_POST['header_text']);

				$panel->setHeadercolor($validator->formatColor($_POST['header_color']));
				if ($validator->checkColor($panel->getHeadercolor()) != true) {
					$Error = "Zły kolor nagłówka!";
				} else {
					$_SESSION['header_color'] = $_POST['header_color'];
				}

				$panel->setHeaderfcolor($validator->formatColor($_POST['header_font_color']));
				if ($validator->checkColor($panel->getHeaderfcolor()) != true) {
					$Error = "Zły kolor czcionki nagłówka!";
				} else {
					$_SESSION['header_font_color'] = $_POST['header_font_color'];
				}

				$panel->setHeaderfsize($_POST['header_font_size']);
				if ($validator->checkNumber($panel->getHeaderfsize()) != true) {
					$Error = "Zły rozmiar czcionki!";
				} else {
					$_SESSION['header_font_size'] = $_POST['header_font_size'];
				}

				$panel->setBgcolor($validator->formatColor($_POST['background_color']));
				if ($validator->checkColor($_POST['background_color']) != true) {
					$Error = "Zły kolor tła!";
				} else {
					$_SESSION['background_color'] = $_POST['background_color'];
				}

				$panel->setFontsize($_POST['font_size']);
				$_SESSION['font_size'] = $_POST['font_size'];
				
				$panel->setFontcolor($validator->formatColor($_POST['font_color']));
				if ($validator->checkColor($panel->getFontcolor()) != true) {
					$Error = "Zły kolor czcionki!";
				} else {
					$_SESSION['font_color'] = $_POST['font_color'];
				}


				$panel->setTopm($_POST['top_margin']);
				$panel->setHeight($_POST['height']);
				$panel->setPer_width($_POST['percent_width']);
				
				if ($Error=="") {
					unset($_SESSION['block_type']);
					unset($_SESSION['header_text']);
					unset($_SESSION['header_color']);
					unset($_SESSION['header_font_color']);
					unset($_SESSION['header_font_size']);
					unset($_SESSION['background_color']);
					unset($_SESSION['font_size']);
					unset($_SESSION['font_color']);
					$panel->addDiv();
					header('Location: ../../index.php');
					exit;	
				}	
			 }

			 if(isset($_POST['back'])){
				unset($_SESSION['Error']);
				unset($_SESSION['block_type']);
				unset($_SESSION['header_text']);
				unset($_SESSION['header_color']);
				unset($_SESSION['header_font_color']);
				unset($_SESSION['header_font_size']);
				unset($_SESSION['background_color']);
				unset($_SESSION['font_size']);
				unset($_SESSION['font_color']);
				header('Location: ../../index.php');
				exit;	
			}


?>