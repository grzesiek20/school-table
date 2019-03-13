<?php
	require_once __DIR__."/../database/session.php";
	require_once __DIR__."/../database/class/sdivclass.php";
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
	<script src="../js/date.js"></script>

</head>

<body>
	<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
            <div class="panel panel-custom panel-primary">
                <div class="panel-heading head-custom">
                    <h3>Edycja treści</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="../database/content/contentedit.php">
						
							<div class="col-md-12">
								
								
								<?php
								$sdiv= new sdiv();
								$sdiv->getSdiv($_GET['sdiv']);
								$div = $sdiv->getIdDiv();
								$i=1;

									echo '<div class="col-md-12">';
										echo '<label for="content" class="control-label">Treść '.$i.'</label>';
										echo'</br>';
										echo '<textarea class="form-control" id="content" name="content">'.$sdiv->getContent().'</textarea>';
									if($div==11 || $div==9) // jeśli slider z komunikatami, to dodaj daty do wyświetlania
									{
										echo '<div class="row">';
											echo '<div class="col-md-6">';
												echo '<div class="form-group label-floating">';
													echo '<label for="begdate" class="control-label">Data początkowa</label>';
													echo '<input readonly="readonly" value="'.$sdiv->getBegdate().'" class="form-control" placeholder="begdate" id="begdate" name="begdate">';
												echo '</div>';
											echo '</div>';
											echo '<div class="col-md-6">';
												echo '<div class="form-group label-floating">';
													echo '<label for="enddate" class="control-label">Data końcowa</label>';
													echo '<input readonly="readonly" value="'.$sdiv->getEnddate().'" class="form-control" placeholder="enddate" id="enddate" name="enddate">';
												echo '</div>';
											echo '</div>';
									echo '</div>';
									}
									$i++;
								
								?>
								<input type="hidden" value="<?php echo $sdiv->getIdSdiv(); ?>" class="form-control" placeholder="Treść" id="id_sdiv" name="id_sdiv">
								<input type="hidden" value="<?php echo $sdiv->getIdDiv(); ?>" class="form-control" placeholder="id" id="id_div" name="id_div">
							</div>
                        <div class="pull-left">
                            <input type="submit" id="submit" name="submit" value="Zapisz" class="btn btn-custom">
                        </div>
						<?php
						if($div==11 || $div==9){
						echo '<div class="pull-right">';
							echo '<button type="button" onclick="resetnews()" id="newsreset" name="newsreset"  class="btn btn-custom">Resetuj daty</button>';
                        echo '</div>';
						}
						?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>