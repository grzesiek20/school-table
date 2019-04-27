<?php

require_once __DIR__."/../class/divclass.php";
require_once __DIR__."/../class/sdivclass.php";
require_once __DIR__."/../class/randomizeclass.php";
require_once __DIR__."/../class/validator.php";



$div = new div();
$sdiv = new sdiv();
$randomize = new randomize();

//unset($Error);
if(isset($_POST['back'])){
	unset($_SESSION['Error']);
	header('Location: ../../index.php');
	exit;
}

	if(isset($_POST['submit'])){
			//$header = htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
		$div->setIdDiv($_POST['id_diva']);
		$div->setHeader($_POST['header']);
		$_SESSION['header'] = $_POST['header'];

		$div->setHeadercolor(validator::formatColor($_POST['headercolor']));
		if (validator::checkColor($div->getHeadercolor()) != true) {
			$Error = "Zły kolor nagłówka!";
		} else {
			$_SESSION['headercolor'] = $_POST['headercolor'];
		}
		$div->setHeaderfcolor(validator::formatColor($_POST['headerfcolor']));
		if (validator::checkColor($div->getHeaderfcolor()) != true) {
			$Error = "Zły kolor czcionki nagłówka!";
		} else {
			$_SESSION['headerfcolor'] = $_POST['headerfcolor'];
		}
			
		$div->setHeaderfsize($_POST['headerfsize']);

		$div->setBgcolor(validator::formatColor($_POST['bgcolor']));
		if (validator::checkColor($_POST['bgcolor']) != true) {
			$Error = "Zły kolor tła!";
		} else {
			$_SESSION['bgcolor'] = $_POST['bgcolor'];
		}

		$div->setFontsize($_POST['fontsize']);
		$_SESSION['fontsize'] = $_POST['fontsize'];

		$div->setFontcolor(validator::formatColor($_POST['fontcolor']));
		if (validator::checkColor($div->getFontcolor()) != true) {
			$Error = "Zły kolor czcionki!";
		} else {
			$_SESSION['fontcolor'] = $_POST['fontcolor'];
		}

		$div->setTextalign($_POST['textalign']);
		$_SESSION['textalign'] = $_POST['textalign'];

		if($_POST['id_diva']==8){
			$randomize->setMax($_POST['numbers']);
		}
		if (!$Error) {
			unset($_SESSION['Error']);
			unset($_SESSION['header']);
			unset($_SESSION['headercolor']);
			unset($_SESSION['headerfcolor']);
			unset($_SESSION['headerfsize']);
			unset($_SESSION['bgcolor']);
			unset($_SESSION['fontsize']);
			unset($_SESSION['fontcolor']);
			unset($_SESSION['textalign']);
			$div->updateDiv();
			header('Location: ../../index.php');
			exit;
		} else {
			$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
			header('Location: ../../view/edit.php?id='.$_POST['id_diva']);
			exit;
		}
	}
		
	if(isset($_POST['yes'])){
		$div->deleteDiv($_POST['id_diva']);
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['headercolor']);
		unset($_SESSION['headerfcolor']);
		unset($_SESSION['headerfsize']);
		unset($_SESSION['bgcolor']);
		unset($_SESSION['fontsize']);
		unset($_SESSION['fontcolor']);
		unset($_SESSION['textalign']);
				
		header('Location: ../../index.php');
		exit;	

	}
			
	if(isset($_POST['no'])){
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['headercolor']);
		unset($_SESSION['headerfcolor']);
		unset($_SESSION['headerfsize']);
		unset($_SESSION['bgcolor']);
		unset($_SESSION['fontsize']);
		unset($_SESSION['fontcolor']);
		unset($_SESSION['textalign']);
		header('Location: ../../index.php');
		exit;	
	}
		
	if(isset($_POST['reset'])){
		$randomize->resetLos();
		unset($_SESSION['Error']);
		unset($_SESSION['header']);
		unset($_SESSION['headercolor']);
		unset($_SESSION['headerfcolor']);
		unset($_SESSION['headerfsize']);
		unset($_SESSION['bgcolor']);
		unset($_SESSION['fontsize']);
		unset($_SESSION['fontcolor']);
		header('Location: ../../index.php');
		exit;	
	} else {
		$div->getDiv($_GET['id']);
		$sdiv->getAllDESC($_GET['id']);
		$textalign= $div->getTextalign();
	}


// class Subt
// {	
// function sliderheight()
// {
	// $sql= "SELECT * FROM slider;";
	// return $sql;
// }


// }
?>