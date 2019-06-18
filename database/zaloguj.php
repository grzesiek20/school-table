<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
	session_start();
	require_once __DIR__."/class/userclass.php";
	require_once __DIR__."/class/loggerclass.php";
	require_once "../securimage/securimage.php";
	
$logger = new Logger();

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
			$logger->wh_log(__METHOD__,"Error","Kod z obrazka jest błędny!");
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
} 
else
{
	header('Location: ../index.php');
 	exit();
}
?>