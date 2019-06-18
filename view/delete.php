<?php
	require_once __DIR__."/../database/session.php";
	require_once __DIR__."/../database/class/divclass.php";
	
	$panel = new panel();
	$panel->getDiv($_GET['id']);
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

</head>

<body>
	<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
            <div class="panel panel-custom panel-primary">
                <div class="panel-heading head-custom">
                    <h3>Usuwanie bloku</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="../database/panel/divedit.php">
					<p class="panel-title section">Czy na pewno chcesz usunąć wybrany blok?</p>
						<div class="col-md-12">
						<div class="row">
								<div class="col-md-3 col-md-offset-3">
								<input type="submit" id="yes" name="yes" value="Tak" class="btn btn-custom">
							</div>
							<div class="col-md-3">
								<input type="submit" id="no" name="no" value="Nie" class="btn btn-custom">
							</div>
						</div>
							<input type="hidden" value="<?php echo $panel->getIdDiv(); ?>" class="form-control" placeholder="id_panel" id="id_panel" name="id_panel">
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>