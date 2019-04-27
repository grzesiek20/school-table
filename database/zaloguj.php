<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
	session_start();
	require_once __DIR__."/class/userclass.php";
	require_once "../securimage/securimage.php";
	
	$user= new user();
	unset($_SESSION['blad']);
	if (!isset($_SESSION['wronglogins'])){
		$_SESSION['wronglogins'] = 0;
	}
//  if (isset($_SESSION['zalogowany']) &&($_SESSION['zalogowany'] == true))
// 	 {
// 		 header('Location: ../index.php');
// 		 exit();
// 	 } else {
// if ($polaczenie->connect_errno!=0)
// {
// 	echo "Error: ".$polaczenie->connect_errno . "Opis: ". $polaczenie->connect_error;
// }
// else
// {
	// $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
	// $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
if (isset($_POST['login']) && isset($_POST['password'])){
	// && isset($_POST['captcha_input']
	$login = $_POST['login'];
	$password = $_POST['password'];

	if($_SESSION['wronglogins'] >= 3) {
		$securimage = new Securimage();
		$captcha = $_POST['captcha_input'];

		if ($securimage->check($captcha) == false) {
			$_SESSION['blad'] = '<span style="color:red">Kod z obrazka jest błędny!</span>';
		  	header('Location: ../view/login.php');
		  	exit;
	  	} else {
		$user->setLogin($login);
		$user->setPassword($password);
		$user->checkUser();
	  }

	}
else {
		$user->setLogin($login);
		$user->setPassword($password);
		$user->checkUser();
	}

	// function getCaptcha($secretKey) {
	// 	$recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
	// 	$recaptcha_secret = "6Ld8gJ8UAAAAAIZ3WxXdtzW1Atx58lnsrxyNDa0i";
	// 	$recaptcha_response = $_POST['recaptcha_response'];
	// 	$recaptcha = file_get_contents($recaptcha_url."?secret=".$recaptcha_secret."&response={$secretKey}");
	// 	$return = json_decode($recaptcha);
	// 	return $return;
	// }
	// $response = getCaptcha($_POST['recaptcha_response']);

	// if ($response->success === true && $response->score >0.5){
		// $user->setLogin($login);
		// $user->setPassword($password);
		// $user->checkUser();
	// } else {
	// 	$_SESSION['blad'] = '<span style="color:red">Jesteś robotem!</span>';
	// 	header('Location: ../view/login.php');
	// 	exit;
	// }

	// $sql = "SELECT * FROM user WHERE login='$login' AND password='$password'";
	// if($rezultat = @$polaczenie->query(
	// 	sprintf("SELECT * FROM user WHERE login='%s' AND password='%s'",
	// 	mysqli_real_escape_string($polaczenie,$login),
	// 	mysqli_real_escape_string($polaczenie,$password))))
	// 	{
	// 		$ilu_userow = $rezultat->num_rows;
	// 		if($ilu_userow>0)
	// 			{
	// 					$_SESSION['zalogowany'] = true;
	// 					$wiersz = $rezultat->fetch_assoc();
	// 					$_SESSION['login'] = $wiersz['login'];
	// 					$_SESSION['id'] = $wiersz['id'];
						
	// 					unset($_SESSION['blad']);
	// 					$rezultat->free_result();
	// 					header('Location: index.php');
	// 			}
} 
else
{
	//$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
	//header('Location: ../view/login.php');
	header('Location: ../index.php');
 	exit();
}
//}
	
	
	
	//}
	
	
//	$polaczenie->close();
//}
?>