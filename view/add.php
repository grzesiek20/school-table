<?php
	
	require_once __DIR__."/../database/panel/divadd.php";
?>

<!DOCTYPE html>
<html lang="pl">

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
										<label for="headercolor" class="control-label">Kolor nagłówka</label>
										<input type="color" value="#009c8a" class="form-control" placeholder="Kolor nagłówka" id="headercolor" name="headercolor">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="headerfcolor" class="control-label">Kolor czcionki</label>
										<input type="color" value="#ffffff" class="form-control" placeholder="Kolor czcionki" id="headerfcolor" name="headerfcolor">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="headerfsize" class="control-label">Rozmiar czcionki</label>
										<input type="number" value="20" class="form-control" placeholder="Rozmiar czcionki" id="headerfsize" name="headerfsize">
									</div>
								</div>
							</div>
								<div class="form-group label-floating">
									<label for="header" class="control-label">Nagłówek</label>
									<input type="text" value="" class="form-control" placeholder="Nagłówek" id="header" name="header">	
								</div>
							</div>
						
						<h4 class="panel-title section">Body</h4>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="bgcolor" class="control-label">Kolor bloku</label>
											<input type="color" value="#ffffff" class="form-control" placeholder="Kolor bloku" id="bgcolor" name="bgcolor">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="fontcolor" class="control-label">Kolor czcionki</label>
											<input type="color" value="#000000" class="form-control" placeholder="Kolor czcionki" id="fontcolor" name="fontcolor">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="fontsize" class="control-label">Rozmiar czcionki</label>
											<input type="number" value="20" class="form-control" placeholder="Rozmiar czcionki" id="fontsize" name="fontsize">
										</div>
										
										<input type="hidden" value="90" class="form-control" placeholder="topm" id="topm" name="topm">
										<input type="hidden" value="90" class="form-control" placeholder="height" id="height" name="height">
										<input type="hidden" value="10" class="form-control" placeholder="per_width" id="per_width" name="per_width">
										
									</div>
								</div>
							</div>
                        <div class="pull-left">
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