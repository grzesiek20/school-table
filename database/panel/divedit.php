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

		$div->setHeadercolor(validator::formatColor($_POST['headercolor']));
		if (validator::checkColor($div->getHeadercolor()) != true) {
			$Error = "Wrong header color!";
		}
		$div->setHeaderfcolor(validator::formatColor($_POST['headerfcolor']));
		if (validator::checkColor($div->getHeaderfcolor()) != true) {
			$Error = "Wrong header font color!";
		}
			
		$div->setHeaderfsize($_POST['headerfsize']);

		$div->setBgcolor(validator::formatColor($_POST['bgcolor']));
		if (validator::checkColor($_POST['bgcolor']) != true) {
			$Error = "Wrong panel background color!";
		}

		$div->setFontsize($_POST['fontsize']);

		$div->setFontcolor(validator::formatColor($_POST['fontcolor']));
		if (validator::checkColor($div->getFontcolor()) != true) {
			$Error = "Wrong font color!";
		}
		$div->setTextalign($_POST['textalign']);
		
		if($_POST['id_diva']==8){
			$randomize->setMax($_POST['numbers']);
		}
		if (!$Error) {
			unset($_SESSION['Error']);
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
				
		header('Location: ../../index.php');
		exit;	

	}
			
	if(isset($_POST['no'])){

		header('Location: ../../index.php');
		exit;	
	}
		
			if(isset($_POST['reset'])){
				$randomize->resetLos();

				
					header('Location: ../../index.php');
					exit;	

			}
			else{
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