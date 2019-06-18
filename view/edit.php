<?php
	require_once __DIR__."/../database/session.php";
	require_once __DIR__."/../database/panel/divedit.php";
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Publiczna Szkoła Podstawowa</title>
	
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../css/styleedit.php">
	<link rel="stylesheet" href="../css/fontello.css">
	<link rel="stylesheet" href="../css/material_design.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/4aad2fe4/dist/css/ripples.min.css">
	<!-- resizable-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<!--<link rel="stylesheet" href="css/freelancer.css"/>-->
	<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<script src="js/losowanie.js"></script>
	<script src="js/widoczny.js"></script>

</head>

<body>
	<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
            <div class="panel panel-custom panel-primary">
                <div class="panel-heading head-custom">
                    <h3>Edycja bloku</h3>
                </div>
                <div class="panel-body">
				<?php if(isset($_SESSION['Error'])) echo $_SESSION['Error']; ?>
                    <form method="post" action="../database/panel/divedit.php">
					<h4 class="panel-title section">Header</h4>
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_color" class="control-label">Kolor nagłówka</label>
										<input type="color" value="<?php
										if (isset($_SESSION['header_color'])){
											echo $_SESSION['header_color'];
											unset($_SESSION['header_color']);
										} else {
											echo $panel->getHeadercolor();
										}?>" class="form-control" placeholder="Kolor nagłówka" id="header_color" name="header_color">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_font_color" class="control-label">Kolor czcionki</label>
										<input type="color" value="<?php 
										if (isset($_SESSION['header_font_color'])){
											echo $_SESSION['header_font_color'];
											unset($_SESSION['header_font_color']);
										} else {
											echo $panel->getHeaderfcolor();
										} ?>" class="form-control" placeholder="Kolor czcionki" id="header_font_color" name="header_font_color">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_font_size" class="control-label">Rozmiar czcionki</label>
										<input type="number" value="<?php 
										if (isset($_SESSION['header_font_size'])){
											echo $_SESSION['header_font_size'];
											unset($_SESSION['header_font_size']);
										} else {
											echo $panel->getHeaderfsize();
										}?>" class="form-control" placeholder="Rozmiar czcionki" id="header_font_size" name="header_font_size">
									</div>
								</div>
							</div>
								<div class="form-group label-floating">
									<label for="header" class="control-label">Nagłówek</label>
									<input type="text" value="<?php 
									if (isset($_SESSION['header'])){
										echo $_SESSION['header'];
										unset($_SESSION['header']);
									} else {
										echo $panel->getHeader(); 
									}?>" class="form-control" placeholder="Nagłówek" id="header" name="header">
									
									<input type="hidden" value="<?php echo $_GET['id']; ?>" class="form-control" placeholder="id_panel" id="id_panel" name="id_panel">
								</div>
							</div>
						
						<h4 class="panel-title section">Body</h4>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="background_color" class="control-label">Kolor bloku</label>
											<input type="color" value="<?php
											if (isset($_SESSION['background_color'])){
												echo $_SESSION['background_color'];
												unset($_SESSION['background_color']);
											} else {
												echo $panel->getBgcolor();
											}?>" class="form-control" placeholder="Kolor bloku" id="background_color" name="background_color">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="font_color" class="control-label">Kolor czcionki</label>
											<input type="color" value="<?php
											if (isset($_SESSION['font_color'])){
												echo $_SESSION['font_color'];
												unset($_SESSION['font_color']);
											} else {
												echo $panel->getFontcolor();
											}?>" class="form-control" placeholder="Kolor czcionki" id="font_color" name="font_color">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="font_size" class="control-label">Rozmiar czcionki</label>
											<input type="number" value="<?php
											if (isset($_SESSION['font_size'])){
												echo $_SESSION['font_size'];
												unset($_SESSION['font_size']);
											} else {
												echo $panel->getFontsize();
											}?>" class="form-control" placeholder="Rozmiar czcionki" id="font_size" name="font_size">
										</div>
									</div>
								</div>
							
									<div class="form-group label-floating">
											<label for="text_align" class="control-label">Rozmieszczenie tekstu</label>
										<div class="col-md-3">
												<input type="radio" <?php if($text_align=="left") {echo "checked";}?> value="left" class="form-control" placeholder="Rozmieszczenie tekstu" id="text_align" name="text_align"><h6 class="section text-center">Do lewej</h6>
										</div>
										<div class="col-md-3">
												<input type="radio" <?php if($text_align=="center") {echo "checked";}?> value="center" class="form-control" placeholder="Rozmieszczenie tekstu" id="text_align" name="text_align"><h6 class="section text-center">Wyśrodkuj</h6>
										</div>
										<div class="col-md-3">
												<input type="radio" <?php if($text_align=="right") {echo "checked";}?> value="right" class="form-control" placeholder="Rozmieszczenie tekstu" id="text_align" name="text_align"><h6 class="section text-center">Do prawej</h6>
										</div>
										<div class="col-md-3">
												<input type="radio" <?php if($text_align=="justify") {echo "checked";}?> value="justify" class="form-control" placeholder="Rozmieszczenie tekstu" id="text_align" name="text_align"><h6 class="section text-center">Wyjustuj</h6>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2 pull-right">
											<?php
											if($panel->getBlockType()=='singleblock' ||
												$panel->getBlockType()=='multipleblock')
												// jeśli inne, niż wszystkie z wyświetlanym JavaScriptem, to możliwośc dodawania treści
													echo '<div class="pull-right ico"><a href="addcontent.php?id='.$_GET['id'].'"><i class="icon-plus-2 icons"></i></a></div>';
											?>
										</div>
									</div>
										<?php 
								//============ blok z losowaniem==================
											if($panel->getBlockType()=='drawblock')
											{
												$random = $randomize->getNumberScope();
										echo '<div class="row">';
											echo '<div class="col-md-6">';
												echo '<div class="form-group label-floating">';
													echo '<label for="height" class="control-label">Pula losowanych liczb</label>'; // zakres losowania
													echo '<input type="number" value="'.$random.'" class="form-control" placeholder="Pula liczb" id="numbers" name="numbers">';
												echo '</div>';
											echo '</div>';
											
											echo '<div class="col-md-6">';
													echo '<button class="btn" id="reset" name="reset">Resetuj</button>';   //przycisk resetujący losowania
											echo '</div>';	
										echo '</div>';	
								//===========================================================
											}
										?>
									</br>
								
								<?php
								if($_GET['id']!=2&&
								$_GET['id']!=3&&
								$_GET['id']!=4&&
								$_GET['id']!=5&& // jeśli inne, niż wszystkie z wyświetlanym JavaScriptem
								$_GET['id']!=8&&
								$_GET['id']!=10)
								{
								$messages = $message->getAllDESC($_GET['id']);
								$k=1;
								for($i=0; $i<count($messages);$i++){
								echo '<div class="row">';
									echo '<div class="col-md-6">';                    // wyświetlanie zawartych treści do edycji
										echo '<label for="content" class="control-label">Treść '.$k.'</label>';
									if($messages[$i]['visible']==0)                              // jeżeli niewidoczny, to na szaro
										echo '<p class="gray">'.$messages[$i]['content'].'</p>';
									else
										echo '<p>'.$messages[$i]['content'].'</p>';
									echo '</div>';
									
									//echo '<div class="col-md-2">'; 
									//	echo '<label for="content" class="control-label">Dodał:</label>';
								//		echo '<h4>'.$messages[$i]['name'].' '.$messages[$i]['surname'].'</h4>';
								//	echo '</div>';
									
									echo '<div class="col-md-6">';                            // ikony edycji i usuwania
										echo '<div class="pull-right ico"><a href="deletecontent.php?sdiv='.$messages[$i]['id_message'].'"><i id="del" class="icon-trash icons"></i></a></div>';
										echo '<div class="pull-right ico"><a href="editcontent.php?sdiv='.$messages[$i]['id_message'].'"><i id="edit" class="icon-cog icons"></i></a></div>';
									
										if($messages[$i]['visible']==1)                         //jeśli widoczny, to oko przekreślone
										{
											echo '<div class="pull-right ico"><a href="../visible.php?id_message='.$messages[$i]['id_message'].'&set=0"><i id="visible"';
											echo 'class="icon-eye-off icons"></i></a></div>';
										}
										else
										{                                            // jeśli niewidoczny, to oko
											echo '<div class="pull-right ico"><a href="../visible.php?id_message='.$messages[$i]['id_message'].'&set=1"><i id="visible"';
											echo 'class="icon-eye icons"></i></a></div>';
										}
										
									echo '</div>';
								echo '</div>';
									$k++;
										}
								}
								?>
								<input type="hidden" value="<?php echo $messages[$i]['id_message']; ?>" class="form-control" placeholder="Treść" id="id_message" name="id_message">
								
							</div>
                        <div class="pull-right">
							<input type="submit" id="back" name="back" value="Powrót" class="btn btn-custom">
                            <input type="submit" id="submit" name="submit" value="Zapisz" class="btn btn-primary">
                        </div>
                    </form>
				</div>
             </div>
         </div>
     </div>


</body>

</html>