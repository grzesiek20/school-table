<?php
	require_once __DIR__."/../database/session.php";
	require_once __DIR__."/../database/panel/divadd.php";
?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Divy</title>
	
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../css/style.php">
	<link rel="stylesheet" href="../css/fontello.css">
	<link rel="stylesheet" href="../css/material_design.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/4aad2fe4/dist/css/ripples.min.css">
	<!-- resizable-->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	
	<!--<link rel="stylesheet" href="css/freelancer.css"/>-->
	<link href='http://fonts.googleapis.com/css?family=Lato|Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
	<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
            <div class="panel panel-custom panel-primary">
                <div class="panel-heading head-custom">
                    <h3>Dodawanie bloku</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="../database/panel/divadd.php">
					<h4 class="panel-title section">Header</h4>
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_color" class="control-label">Kolor nagłówka</label>
										<input type="color" value="<?php
									if(isset($_SESSION['header_color'])) {
										echo $_SESSION['header_color'];
										unset ($_SESSION['header_color']);
									} else {
										echo "#009c8a";
									} ?>" class="form-control" placeholder="Kolor nagłówka" id="header_color" name="header_color">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_font_color" class="control-label">Kolor czcionki</label>
										<input type="color" value="<?php
									if(isset($_SESSION['header_font_color'])) {
										echo $_SESSION['header_font_color'];
										unset ($_SESSION['header_font_color']);
									} else {
										echo "#ffffff";
									} ?>" class="form-control" placeholder="Kolor czcionki" id="header_font_color" name="header_font_color">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="header_font_size" class="control-label">Rozmiar czcionki</label>
										<input type="number" value="<?php
									if(isset($_SESSION['header_font_size'])) {
										echo $_SESSION['header_font_size'];
										unset ($_SESSION['header_font_size']);
									} else {
										echo "20";
									} ?>" class="form-control" placeholder="Rozmiar czcionki" id="header_font_size" name="header_font_size">
									</div>
								</div>
							</div>
								<div class="form-group label-floating">
									<label for="header_text" class="control-label">Nagłówek</label>
									<input type="text" value="" class="form-control" placeholder="Nagłówek" id="header_text" name="header_text">	
								</div>
							</div>
						
						<h4 class="panel-title section">Body</h4>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="background_color" class="control-label">Kolor bloku</label>
											<input type="color" value="<?php
									if(isset($_SESSION['background_color'])) {
										echo $_SESSION['background_color'];
										unset ($_SESSION['background_color']);
									} else {
										echo "#ffffff";
									} ?>" class="form-control" placeholder="Kolor bloku" id="background_color" name="background_color">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="font_color" class="control-label">Kolor czcionki</label>
											<input type="color" value="#000000" class="form-control" placeholder="Kolor czcionki" id="font_color" name="font_color">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="font_size" class="control-label">Rozmiar czcionki</label>
											<input type="number" value="<?php
									if(isset($_SESSION['font_size'])) {
										echo $_SESSION['font_size'];
										unset ($_SESSION['font_size']);
									} else {
										echo "20";
									} ?>" class="form-control" placeholder="Rozmiar czcionki" id="font_size" name="font_size">
										</div>
										
										<input type="hidden" value="90" class="form-control" placeholder="top_margin" id="top_margin" name="top_margin">
										<input type="hidden" value="90" class="form-control" placeholder="height" id="height" name="height">
										<input type="hidden" value="10" class="form-control" placeholder="percent_width" id="percent_width" name="percent_width">
										
									</div>
								</div>
								<div class="row section form-group label-floating">
									<label for="block_type" class="control-label">Typ bloku:</label>
									<select class="form-control" id="block_type" name="block_type">
										<option value="singleblock">Pojedynczy wpis</option>
										<option value="multipleblock">Slajder wpisów</option>
										<option value="sliderblock">Slajder zdjęć</option>
										<option value="dateblock">Wyświetlenie daty</option>
										<option value="planblock">Aktualnie trwające zajęcia</option>
										<option value="clockblock">Zegar</option>
										<option value="headblock">Blok nagłówkowy</option>
										<option value="countblock">Odliczanie do dzwonka</option>
										<option value="drawblock">Blok losowania numerka</option>
									</select>
								</div>
							</div>
                        <div class="pull-right">
							<input type="submit" id="back" name="back" value="Powrót" class="btn btn-custom">
                            <input type="submit" id="submit" name="submit" value="Zapisz" class="btn btn-custom">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>