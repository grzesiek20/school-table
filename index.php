<?php
	session_start();
	require_once "database/initindex.php";
	require_once "database/test.php";
	if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] != $_COOKIE['user']) {
		$_SESSION['blad'] = '<span style="color:red">Błąd uwierzytelniania! Zaloguj się ponownie!</span>';
		session_unset();
		if(isset($_COOKIE['user'])){
			setcookie('user', '', time()-3600);
		}
		header('Location: ../view/login.php');
		exit();
	}
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
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body onload="prepare();bazaAjax();newAjax();odliczanie();">
	<div id="container" class="container">
<?php
	echo '<div class="overlay" id="myNav">';
	//echo '<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';
	echo '<div class="col-md-12"></div>';
if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
	//echo '<div class="pull-left ico"><a href="search.php"><i class="icon-search icons"></i></a></div>'; //wylogowanie
	echo '<div class="pull-left"><div class="text-center"><a href="view/add.php"><i class="icon-plus-2"></br><div class="icotext">Dodaj blok</div></i></a></div></div>';
	echo '<div class="pull-left"><div class="text-center"><a href="view/profile.php"><i class="icon-user menuicons"></br><div class="icotext">Dane użytkownika</div></i></a></div></div>';
	if ($_SESSION['role'] == 1) {
		echo '<div class="pull-left"><div class="text-center"><a href="view/useradd.php"><i class="icon-user-plus menuicons"></br><div class="icotext">Dodaj użytkownika</div></i></a></div></div>';
	}
	echo '<div class="pull-right"><div class="text-center"><a href="database/logout.php"><i class="icon-logout"></br><div class="icotext">Wyloguj</div></i></a></div></div>'; //wylogowanie			
} else {
	echo '<div class="pull-right"><div class="text-center"><a href="view/login.php"><i class="icon-login menuicons"></br><div class="icotext">Zaloguj</div></i></a></div></div>'; //logowanie
}
							
	//echo '</div>';
	echo '</div>';
	//echo '</div>';
	//echo '</div>';

	echo '<div id="menu" class="showico"></div>';
	// <span class="icons ico menuicon" onclick="openNav()">&#9776;</span>


//=============================== Górny blok ==================================================
for ($i=0; $i<count($panels);$i++){
	if($panels[$i]['block_type']=='headblock'){
		echo '<div class ="tile">';
		if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
			echo '<div class="welcome panel showico block" id="div'.$panels[$i]['id_panel'].'">';
		} else {
			echo '<div class="welcome panel" id="div'.$panels[$i]['id_panel'].'">';
		}
		echo '<div class="col-md-12 cust'.$panels[$i]['id_panel'].'">';
		echo $panels[$i]['header_text'];
		echo '</div>';
		if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
			echo '<div class="pull-right ico"><a href="view/delete.php?id='.$panels[$i]['id_panel'].'"><i class="icon-trash icons"></i></a></div>';
			echo '<div class="pull-right ico"><a href="view/edit1.php?id='.$panels[$i]['id_panel'].'"><i class="icon-cog icons"></i></a></div>';
		}
								
		
		echo '</div>';
	echo '</div>';
	}
	else {
//================================== Pozostałe bloki =============================================
			if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
				echo '<div class="ui-widget-content panel panel-primary block" id="div'.$panels[$i]['id_panel'].'">';
				echo '<div class="panel-heading showico head'.$panels[$i]['id_panel'].'">';
			} else {
				echo '<div class="ui-widget-content panel panel-primary" id="div'.$panels[$i]['id_panel'].'">';
				echo '<div class="panel-heading head'.$panels[$i]['id_panel'].'">';
			}
					echo '<div class="row">';
						echo '<div class="col-md-12">';
								echo $panels[$i]['header_text'];
							echo '</div>';
								echo '<div class="col-md-12">';
								if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
									echo '<div class="pull-left ico"><a href="view/edit.php?id='.$panels[$i]['id_panel'].'"><i class="icon-cog icons"></i></a></div>';
									echo '<div class="pull-left ico"><a href="view/delete.php?id='.$panels[$i]['id_panel'].'"><i class="icon-trash icons"></i></a></div>';
								}
//--------- Jeśli blok z losowaniem ----------------------------
									if($panels[$i]['block_type']=='drawblock'){
										if (isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany'] == $_COOKIE['user']) {
											echo '<button onclick="losowanieAjax()" class="btn ico icons buttoncustom pull-right" id="randomize" name="randomize"><i class="icon-spin3 rand"></i></button>';
										}
									}
//---------------------------------------------------------
								echo '</div>';
					 echo '</div>';
				 echo '</div>';
//---------- Jeśli blok ze zdjęciami, bez paddingu---------
		 if($panels[$i]['block_type']=='sliderblock')
			echo '<div class="panel-body nopadding sliderblock cust'.$panels[$i]['id_panel'].'">';
//---------------------------------------------------------
		else
			echo '<div class="panel-body cust'.$panels[$i]['id_panel'].'">';
		
//========================== Subpanel malejąco ================================		
			$message = new message();
			$messages = $message->getAllVisibleDESC($panels[$i]['id_panel']);
			
//------------ Jeśli blok z komunikatami -----------------------------------
		if(count($messages)>0){
			if($panels[$i]['block_type']=='multipleblock') 
				echo '<div id="sdiv'.$messages[0]['id_message'].'" class="anim '.$panels[$i]['block_type'].'">';	
			else 
				echo '<div id="sdiv'.$messages[0]['id_message'].'" class="'.$panels[$i]['block_type'].'">';
			
				echo '<p>'.$messages[0]['content'].'</p>';
				echo '</div>';
		}
//=========================================================================
		/*	while($e=$subtable->fetch_assoc()){
				echo '<div id="sdiv'.$e['id_message'].'">';	
					echo '<p>'.$e['content'].'</p>';
				echo '</div>';
					
				}*/
			echo '</div>';
			echo '</div>';
	}
}
?>
		</div>
		
		<script src="js/zegar.js"></script>
		<script src="js/divsinfo.js"></script>
		<script src="js/seedrandom.js"></script> <!-- Biblioteka losowania z seedowaniem -->
		<script src="js/losowanie.js"></script>
		<script src="js/slider.js"></script>


</body>
</html>