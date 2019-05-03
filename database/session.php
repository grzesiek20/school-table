<?php
    session_start();
	if (!isset($_SESSION['zalogowany']) || !isset($_COOKIE['user']) || isset($_SESSION['zalogowany']) && isset($_COOKIE['user']) && $_SESSION['zalogowany']!=$_COOKIE['user'])
	{
		$_SESSION['blad'] = '<span style="color:red">Błąd uwierzytelniania! Zaloguj się ponownie!</span>';
		//session_unset();
		if(isset($_COOKIE['user'])){
			setcookie('user', '', time()-3600);
		}
		header('Location: ../view/login.php');
		exit();
	} 
?>