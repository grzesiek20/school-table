<?php
	session_start();
	require_once __DIR__."/class/userclass.php";
	
	$user= new user();
	
 if (isset($_SESSION['zalogowany']) &&($_SESSION['zalogowany'] == true))
	 {
		 header('Location: ../index.php');
		 exit();
	 } 

if ($polaczenie->connect_errno!=0)
{
	echo "Error: ".$polaczenie->connect_errno . "Opis: ". $polaczenie->connect_error;
}
else
{

	// $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
	// $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
	 
	$login = $_POST['login'];
	$password = $_POST['password'];
	$user->setLogin($login);
	$user->setPassword($password);
	 
	$user->checkUser();

	$sql = "SELECT * FROM user WHERE login='$login' AND password='$password'";
	
	// if($rezultat = @$polaczenie->query(
	// sprintf("SELECT * FROM user WHERE login='%s' AND password='%s'",
	// mysqli_real_escape_string($polaczenie,$login),
	// mysqli_real_escape_string($polaczenie,$password))))
	// {
	// 	$ilu_userow = $rezultat->num_rows;
	// 	if($ilu_userow>0)
	// 		{
	// 				$_SESSION['zalogowany'] = true;
	// 				$wiersz = $rezultat->fetch_assoc();
	// 				$_SESSION['login'] = $wiersz['login'];
	// 				$_SESSION['id'] = $wiersz['id'];
					
	// 				unset($_SESSION['blad']);
	// 				$rezultat->free_result();
	// 				header('Location: index.php');
	// 		}
	// 	else
	// 		{
	// 			$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
	// 			header('Location: ../view/login.php');
	// 		}
	// }
	
	
	$polaczenie->close();
}
?>