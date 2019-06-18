<?php

require_once __DIR__."/../class/divclass.php";
require_once __DIR__."/../class/sdivclass.php";
require_once __DIR__."/../class/randomizeclass.php";
require_once __DIR__."/../class/validator.php";



$panel = new panel();
$message = new message();
$randomize = new randomize();

//unset($Error);
if(isset($_POST['back'])){
	unset($_SESSION['Error']);
	header('Location: ../../index.php');
	exit;
}

	if(isset($_POST['submit'])){
			//$header = htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
		$panel->setIdDiv($_POST['id_panel']);
		//$panel->setBlockType()
		$panel->setHeader(htmlentities($_POST['header']));
		$_SESSION['header'] = $_POST['header'];

		$panel->setHeadercolor(validator::formatColor($_POST['header_color']));
		if (validator::checkColor($panel->getHeadercolor()) != true) {
			$Error = "Zły kolor nagłówka!";
		} else {
			$_SESSION['header_color'] = $_POST['header_color'];
		}
		$panel->setHeaderfcolor(validator::formatColor($_POST['header_font_color']));
		if (validator::checkColor($panel->getHeaderfcolor()) != true) {
			$Error = "Zły kolor czcionki nagłówka!";
		} else {
			$_SESSION['header_font_color'] = $_POST['header_font_color'];
		}
		
		// $panel->setHeaderfsize(validator::checkNumber($_POST['header_font_size']));
		if (validator::checkNumber($_POST['header_font_size'])) {
			$panel->setHeaderfsize($_POST['header_font_size']);
			$_SESSION['header_font_size'] = $_POST['header_font_size'];
		} else {
			$Error = "Zła wartość rozmiaru czcionki!";
		}

		$panel->setBgcolor(validator::formatColor($_POST['background_color']));
		if (validator::checkColor($_POST['background_color']) != true) {
			$Error = "Zły kolor tła!";
		} else {
			$_SESSION['background_color'] = $_POST['background_color'];
		}


		
		if (validator::checkNumber($_POST['font_size'])) {
			$panel->setFontsize($_POST['font_size']);
			$_SESSION['font_size'] = $_POST['font_size'];
		} else {
			$Error = "Zła wartość rozmiaru czcionki!";
		}

		$panel->setFontcolor(validator::formatColor($_POST['font_color']));
		if (validator::checkColor($panel->getFontcolor()) != true) {
			$Error = "Zły kolor czcionki!";
		} else {
			$_SESSION['font_color'] = $_POST['font_color'];
		}

		if ($_POST['text_align'] == 'justify' 
		|| $_POST['text_align'] == 'center'
		|| $_POST['text_align'] == 'left'
		|| $_POST['text_align'] == 'right') {
			$panel->setTextalign($_POST['text_align']);
			$_SESSION['text_align'] = $_POST['text_align'];
		} else {
			$Error = "Zła wartość rozmieszczenia tekstu!";
		}


		if($_POST['id_panel']==8){
			$randomize->setMax($_POST['numbers']);
		}
		if (!$Error) {
			unset($_SESSION['Error']);
			unset($_SESSION['header']);
			unset($_SESSION['header_color']);
			unset($_SESSION['header_font_color']);
			unset($_SESSION['header_font_size']);
			unset($_SESSION['background_color']);
			unset($_SESSION['font_size']);
			unset($_SESSION['font_color']);
			unset($_SESSION['text_align']);
			$panel->updatePanel();
			header('Location: ../../index.php');
			exit;
		} else {
			$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
			header('Location: ../../view/edit.php?id='.$_POST['id_panel']);
			exit;
		}
	}
		
	if(isset($_POST['yes'])){
		$panel->deletePanel($_POST['id_panel']);
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['header_color']);
		unset($_SESSION['header_font_color']);
		unset($_SESSION['header_font_size']);
		unset($_SESSION['background_color']);
		unset($_SESSION['font_size']);
		unset($_SESSION['font_color']);
		unset($_SESSION['text_align']);
				
		header('Location: ../../index.php');
		exit;	

	}
			
	if(isset($_POST['no'])){
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['header_color']);
		unset($_SESSION['header_font_color']);
		unset($_SESSION['header_font_size']);
		unset($_SESSION['background_color']);
		unset($_SESSION['font_size']);
		unset($_SESSION['font_color']);
		unset($_SESSION['text_align']);
		header('Location: ../../index.php');
		exit;	
	}
		
	if(isset($_POST['reset'])){
		$randomize->resetLos();
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['header_color']);
		unset($_SESSION['header_font_color']);
		unset($_SESSION['header_font_size']);
		unset($_SESSION['background_color']);
		unset($_SESSION['font_size']);
		unset($_SESSION['font_color']);
		header('Location: ../../index.php');
		exit;	
	} else {
		$panel->getDiv($_GET['id']);
		$message->getAllDESC($_GET['id']);
		$text_align= $panel->getTextalign();
	}
?>