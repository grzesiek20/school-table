<?php
	require_once __DIR__."/../database/session.php";
	require_once __DIR__."/../database/panel/divedit.php";
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
                    <h3>Edycja bloku</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="../database/panel/divedit.php">
					<h4 class="panel-title section">Header</h4>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="bgcolor" class="control-label">Kolor bloku</label>
											<input type="color" value="<?php echo $div->getBgcolor(); ?>" class="form-control" placeholder="Kolor bloku" id="bgcolor" name="bgcolor">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="fontcolor" class="control-label">Kolor czcionki</label>
											<input type="color" value="<?php echo $div->getFontcolor(); ?>" class="form-control" placeholder="Kolor czcionki" id="fontcolor" name="fontcolor">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group label-floating">
											<label for="fontsize" class="control-label">Rozmiar czcionki</label>
											<input type="number" value="<?php echo $div->getFontsize(); ?>" class="form-control" placeholder="Rozmiar czcionki" id="fontsize" name="fontsize">
										</div>
									</div>
								</div>
							</div>
						
							<div class="col-md-12">
								<div class="form-group label-floating">
									<label for="header" class="control-label">Nagłówek</label>
									<input type="text" value="<?php echo $div->getHeader(); ?>" class="form-control" placeholder="Nagłówek" id="header" name="header">
									
									<input type="hidden" value="<?php echo $_GET['id']; ?>" class="form-control" placeholder="id_diva" id="id_diva" name="id_diva">
								</div>
								
							 
									<div class="form-group label-floating">
											<label for="fontsize" class="control-label">Rozmieszczenie tekstu</label>
										<div class="col-md-3">
											<input type="radio" <?php if($textalign=="left") {echo "checked";}?> value="left" class="form-control" placeholder="Rozmieszczenie tekstu" id="textalign" name="textalign"><h6 class="section text-center">Do lewej</h6>
										</div>
										<div class="col-md-3">
											<input type="radio" <?php if($textalign=="center") {echo "checked";}?> value="center" class="form-control" placeholder="Rozmieszczenie tekstu" id="textalign" name="textalign"><h6 class="section text-center">Wyśrodkuj</h6>
										</div>
										<div class="col-md-3">
											<input type="radio" <?php if($textalign=="right") {echo "checked";}?> value="right" class="form-control" placeholder="Rozmieszczenie tekstu" id="textalign" name="textalign"><h6 class="section text-center">Do prawej</h6>
										</div>
										<div class="col-md-3">
											<input type="radio" <?php if($textalign=="justify") {echo "checked";}?> value="justify" class="form-control" placeholder="Rozmieszczenie tekstu" id="textalign" name="textalign"><h6 class="section text-center">Wyjustuj</h6>
										</div>
									</div>
							
								</br>
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