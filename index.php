<?php
	session_start();
	require_once "database/initindex.php";
	require_once "database/test.php";
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>	
	<title>Publiczna Szkoła Podstawowa im. Julisza Słowackiego w Pacanowie</title>
	<meta name="description" content="PSP im. Janusza Słowackiego nr 1 w Pacanowie - Aktualności, informacje, kontakt " />

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<!-- Bootstrap Core CSS -->
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link rel="stylesheet" href="css/slider2.css">
	<link rel="stylesheet" href="css/style.php">
	<link rel="stylesheet" href="css/fontello.css">
	<link rel="stylesheet" href="css/material_design.min.css">
	
    <!--<link rel="stylesheet" href="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/4aad2fe4/dist/css/ripples.min.css">-->
	<!-- resizable-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	

	<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body onload="bazaAjax();newAjax();odliczanie();prepare()">
		<div id="container" class="container">
<?php		
//=============================== Górny blok ==================================================
for ($i=0; $i<count($divs);$i++){
	if($i==0){
		echo '<div class ="tile">';
		if (isset($_SESSION['zalogowany'])) {
			echo '<div class="welcome panel showico block" id="div'.$divs[$i]['id_diva'].'">';
		} else {
			echo '<div class="welcome panel" id="div'.$divs[$i]['id_diva'].'">';
		}
					echo '<div class="col-md-12 cust'.$divs[$i]['id_diva'].'">';
					echo $divs[$i]['headertext'];
					echo '</div>';
					if (isset($_SESSION['zalogowany'])) {
						echo '<div class="pull-left icolog"><a href="database/logout.php"><i class="icon-logout icons"></i></a></div>'; //wylogowanie
						echo '<div class="pull-left ico"><a href="search.php"><i class="icon-search icons"></i></a></div>'; //wylogowanie
						echo '<div class="pull-left ico"><a href="view/add.php"><i class="icon-plus-2 icons"></i></a></div>';
						echo '<div class="pull-left ico"><a href="view/useradd.php"><i class="icon-user-plus icons"></i></a></div>';
						echo '<div class="pull-right ico"><a href="view/delete.php?id='.$divs[$i]['id_diva'].'"><i class="icon-trash icons"></i></a></div>';
						echo '<div class="pull-right ico"><a href="view/edit1.php?id='.$divs[$i]['id_diva'].'"><i class="icon-cog icons"></i></a></div>';
						
					} else {
						echo '<div class="pull-left icolog"><a href="view/login.php"><i class="icon-login icons"></i></a></div>'; //logowanie
					}				
			echo '</div>';
		echo '</div>';
	}
	else{
//================================== Pozostałe bloki =============================================
			if (isset($_SESSION['zalogowany'])) {
				echo '<div class="ui-widget-content panel panel-primary block" id="div'.$divs[$i]['id_diva'].'">';
				echo '<div class="panel-heading showico head'.$divs[$i]['id_diva'].'">';
			} else {
				echo '<div class="ui-widget-content panel panel-primary" id="div'.$divs[$i]['id_diva'].'">';
				echo '<div class="panel-heading head'.$divs[$i]['id_diva'].'">';
			}
					echo '<div class="row">';
						echo '<div class="col-md-12">';
								echo $divs[$i]['headertext'];
							echo '</div>';
								 echo '<div class="col-md-12">';
								 if (isset($_SESSION['zalogowany'])) {
									 echo '<div class="pull-left ico"><a href="view/edit.php?id='.$divs[$i]['id_diva'].'"><i class="icon-cog icons"></i></a></div>';
									 echo '<div class="pull-left ico"><a href="view/delete.php?id='.$divs[$i]['id_diva'].'"><i class="icon-trash icons"></i></a></div>';
								 }
//--------- Jeśli blok z losowaniem ----------------------------
									if($divs[$i]['id_diva']==8){
										echo '<button onclick="losowanieAjax()" class="btn ico icons buttoncustom pull-right" id="randomize" name="randomize"><i class="icon-spin3 rand"></i></button>';
									}
//---------------------------------------------------------
								echo '</div>';
					 echo '</div>';
				 echo '</div>';
//---------- Jeśli blok ze zdjęciami, bez paddingu---------
		 if($divs[$i]['id_diva']==5)
			 echo '<div class="panel-body nopadding cust'.$divs[$i]['id_diva'].'">';
//---------------------------------------------------------
		 else
			 echo '<div class="panel-body cust'.$divs[$i]['id_diva'].'">';
		
//========================== Subdivy malejąco ================================		
			 $sdiv = new sdiv();
			 $sdivs = $sdiv->getAllVisibleDESC($divs[$i]['id_diva']);
			
//------------ Jeśli blok z komunikatami -----------------------------------
		if(count($sdivs)>0){
			 if($divs[$i]['id_diva']==11)
				 echo '<div id="sdiv'.$sdivs[0]['id_sdiv'].'" class="anim">';	
			 else 
				 echo '<div id="sdiv'.$sdivs[0]['id_sdiv'].'">';
			
				 echo '<p>'.$sdivs[0]['content'].'</p>';
				 echo '</div>';
		}
//=========================================================================
		/*	while($e=$subtable->fetch_assoc()){
				echo '<div id="sdiv'.$e['id_sdiv'].'">';	
					echo '<p>'.$e['content'].'</p>';
				echo '</div>';
					
				}*/
			echo '</div>';
			echo '</div>';
	}
}
?>
		</div>
		<script src="js/slider.js"></script>
		<script src="js/zegar.js"></script>
		<script src="js/divsinfo.js"></script>
		<script src="js/seedrandom.js"></script> <!-- Biblioteka losowania z seedowaniem -->
		<script src="js/losowanie.js"></script>


</body>
</html>