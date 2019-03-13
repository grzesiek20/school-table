<?php
    session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: ../database/zaloguj.php');
		exit();
	} 
?>