<?php
	require_once __DIR__."/../database/session.php";
	require_once '../securimage/securimage.php';
	$options = array();
	$options['input_name']             = 'captcha_input'; // change name of input element for form post
	$options['disable_flash_fallback'] = false; // allow flash fallback

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
    <!-- <link rel="stylesheet" href="https://cdn.rawgit.com/FezVrasta/bootstrap-material-design/4aad2fe4/dist/css/ripples.min.css"> -->
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
            <div class="panel panel-primary">
                <div class="panel-heading head-custom">
                    <h3>Dodawanie użytkownika</h3>
                </div>
                <div class="panel-body">
				<?php if(isset($_SESSION['blad'])) {
					echo $_SESSION['blad'];
					unset($_SESSION['blad']);
					} ?>
                    <form method="post" action="../database/useradd.php">
						<div class="col-md-12">
							<div class="row">
							<h4 class="panel-title section">Dane użytkownika</h4>
								<div class="form-group label-floating">
									<label for="name" class="control-label">Imię</label>
									<input type="text" value="<?php
									if(isset($_SESSION['name'])) {
										echo $_SESSION['name'];
										unset ($_SESSION['name']);
									} ?>" class="form-control" placeholder="" id="name" name="name">
								</div>
								<div class="form-group label-floating">
									<label for="surname" class="control-label">Nazwisko</label>
									<input type="text" value="<?php
									if(isset($_SESSION['surname'])) {
										echo $_SESSION['surname'];
										unset ($_SESSION['surname']);
									} ?>"class="form-control" placeholder="" id="surname" name="surname">
								</div>
							</br>
							<h4 class="panel-title section">Dane logowania</h4>
								<div class="form-group label-floating">
									<label for="login" class="control-label">Login</label>
									<input type="text" class="form-control" placeholder="" id="login" name="login">
								</div>
								<div class="form-group label-floating">
									<label for="password1" class="control-label">Hasło</label>
									<input type="password" class="form-control" placeholder="" id="password1" name="password1">	
								</div>
								<div class="form-group label-floating">
									<label for="password2" class="control-label">Powtórz hasło</label>
									<input type="password" class="form-control" placeholder="" id="password2" name="password2">	
								</div>
								<div id='captcha_container_1' class="panel-title section">
									<?php echo Securimage::getCaptchaHtml($options); ?>
								</div>
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