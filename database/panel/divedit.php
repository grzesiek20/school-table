<?php

	require_once __DIR__."/../class/divclass.php";
	require_once __DIR__."/../class/sdivclass.php";
	require_once __DIR__."/../class/randomizeclass.php";
	

	
	$div = new div();
	$sdiv = new sdiv();
	$randomize = new randomize();
	
	

			 if(isset($_POST['submit'])){
			 
			 //$header = htmlentities($_POST['header'], ENT_QUOTES, "UTF-8");
			 $div->setIdDiv($_POST['id_diva']);
			 $div->setHeader($_POST['header']);
			 $div->setHeadercolor($_POST['headercolor']);
			 $div->setHeaderfcolor($_POST['headerfcolor']);
			 $div->setHeaderfsize($_POST['headerfsize']);
			 $div->setBgcolor($_POST['bgcolor']);
			 $div->setFontsize($_POST['fontsize']);
			 $div->setFontcolor($_POST['fontcolor']);
			 $div->setTextalign($_POST['textalign']);
			
			 if($_POST['id_diva']==8){
				 $randomize->setMax($_POST['numbers']);
			 }
			$div->updateDiv();
					
					 header('Location: ../../index.php');
					 exit;	

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