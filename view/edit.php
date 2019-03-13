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
                    <form method="post" action="../database/panel/divedit.php">
					<h4 class="panel-title section">Header</h4>
							<div class="col-md-12">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="headercolor" class="control-label">Kolor nagłówka</label>
										<input type="color" value="<?php echo $div->getHeadercolor(); ?>" class="form-control" placeholder="Kolor nagłówka" id="headercolor" name="headercolor">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="headerfcolor" class="control-label">Kolor czcionki</label>
										<input type="color" value="<?php echo $div->getHeaderfcolor(); ?>" class="form-control" placeholder="Kolor czcionki" id="headerfcolor" name="headerfcolor">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group label-floating">
										<label for="headerfsize" class="control-label">Rozmiar czcionki</label>
										<input type="number" value="<?php echo $div->getHeaderfsize(); ?>" class="form-control" placeholder="Rozmiar czcionki" id="headerfsize" name="headerfsize">
									</div>
								</div>
							</div>
								<div class="form-group label-floating">
									<label for="header" class="control-label">Nagłówek</label>
									<input type="text" value="<?php echo $div->getHeader(); ?>" class="form-control" placeholder="Nagłówek" id="header" name="header">
									
									<input type="hidden" value="<?php echo $_GET['id']; ?>" class="form-control" placeholder="id_diva" id="id_diva" name="id_diva">
								</div>
							</div>
						
						<h4 class="panel-title section">Body</h4>
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
							
									<div class="form-group label-floating">
											<label for="textalign" class="control-label">Rozmieszczenie tekstu</label>
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
										<?php 
								//============ blok z losowaniem==================
											if($_GET['id']==8)
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
								$sdivs = $sdiv->getAllDESC($_GET['id']);
								$k=1;
								for($i=0; $i<count($sdivs);$i++){
								echo '<div class="row">';
									echo '<div class="col-md-6">';                    // wyświetlanie zawartych treści do edycji
										echo '<label for="content" class="control-label">Treść '.$k.'</label>';
									if($sdivs[$i]['visible']==0)                              // jeżeli niewidoczny, to na szaro
										echo '<p class="gray">'.$sdivs[$i]['content'].'</p>';
									else
										echo '<p>'.$sdivs[$i]['content'].'</p>';
									echo '</div>';
									
									//echo '<div class="col-md-2">'; 
									//	echo '<label for="content" class="control-label">Dodał:</label>';
								//		echo '<h4>'.$sdivs[$i]['name'].' '.$sdivs[$i]['surname'].'</h4>';
								//	echo '</div>';
									
									echo '<div class="col-md-6">';                            // ikony edycji i usuwania
										echo '<div class="pull-right ico"><a href="deletecontent.php?sdiv='.$sdivs[$i]['id_sdiv'].'"><i id="del" class="icon-trash icons"></i></a></div>';
										echo '<div class="pull-right ico"><a href="editcontent.php?sdiv='.$sdivs[$i]['id_sdiv'].'"><i id="edit" class="icon-cog icons"></i></a></div>';
									
										if($sdivs[$i]['visible']==1)                         //jeśli widoczny, to oko przekreślone
										{
											echo '<div class="pull-right ico"><a href="../visible.php?id_sdiv='.$sdivs[$i]['id_sdiv'].'&set=0"><i id="visible"';
											echo 'class="icon-eye-off icons"></i></a></div>';
										}
										else
										{                                            // jeśli niewidoczny, to oko
											echo '<div class="pull-right ico"><a href="../visible.php?id_sdiv='.$sdivs[$i]['id_sdiv'].'&set=1"><i id="visible"';
											echo 'class="icon-eye icons"></i></a></div>';
										}
										
									echo '</div>';
								echo '</div>';
									$k++;
										}
								}
								?>
								<input type="hidden" value="<?php echo $sdivs[$i]['id_sdiv']; ?>" class="form-control" placeholder="Treść" id="id_sdiv" name="id_sdiv">
								
							</div>
                        <div class="pull-left">
                            <input type="submit" id="submit" name="submit" value="Zapisz" class="btn btn-custom">
                        </div>
						<div class="col-md-2 pull-right">
						<?php
						if($_GET['id']!=2&&
								$_GET['id']!=3&&
								$_GET['id']!=4&&
								$_GET['id']!=5&& // jeśli inne, niż wszystkie z wyświetlanym JavaScriptem, to możliwośc dodawania treści
								$_GET['id']!=8&&
								$_GET['id']!=10)
							echo '<div class="pull-right ico"><a href="addcontent.php?id='.$_GET['id'].'"><i class="icon-plus-2 icons"></i></a></div>';
						?>
						</div>
					
                    </form>
				</div>
             </div>
         </div>
     </div>


</body>

</html>