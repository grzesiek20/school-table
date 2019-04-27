<?php
require_once('../securimage/securimage.php');
$options = array();
$options['input_name']             = 'captcha_input'; // change name of input element for form post
$options['disable_flash_fallback'] = false; // allow flash fallback
	session_start();
	
	 if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: ../index.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>			
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">	
		<link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
        <!-- <script src="https://www.google.com/recaptcha/api.js?render=6Ld8gJ8UAAAAAMZ7x1w6scSaHaIXDFMfhVuMl1_g"></script> -->
  <!-- <script>
        var recaptchaResponse = 0;
        grecaptcha.ready(function() {
        grecaptcha.execute('6Ld8gJ8UAAAAAMZ7x1w6scSaHaIXDFMfhVuMl1_g', {action: 'homepage'}).then(function(token) {

    //your code to be executed after 1 second
        var recaptchaResponse = document.getElementById('recaptcha_response');
        console.log(recaptchaResponse);
        recaptchaResponse.value = token;
      });
  });
  </script> -->
</head>
<body>	
<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>Logowanie</h3>
                </div>	
                <div class="panel-body logon">
                    <form action="../database/zaloguj.php" method="post">
                        <div class="form-group label-floating">
                            <label for="login" class="control-label">Login</label>
                            <input type="text" class="form-control" id="login" name="login" value="" autofocus>
							
                        </div>
                        <div class="form-group label-floating"> 
							<label for="password" class="control-label">Hasło</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <?php
                        if (isset($_SESSION['wronglogins']) && $_SESSION['wronglogins'] >= 3){
                            echo "<div id='captcha_container_1'>";
                            echo Securimage::getCaptchaHtml($options); 
                            echo  "</div>";
                        }
                        ?> 
                        <div class="pull-right">
                            <input type="submit" id="submit"class="btn btn-primary btn-raised" value="Zaloguj">
                        </div>	
                        <!-- <input type="" value="" name="recaptcha_response" id="recaptcha_response"> -->
					<?php if(isset($_SESSION['blad'])) {
                        echo $_SESSION['blad'];
                        unset($_SESSION['blad']);
                    }?>
                    </form>

              </div>
            </div>
        </div>
    </div>
</div>
</body>
