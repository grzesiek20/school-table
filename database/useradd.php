<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
	session_start();
	require_once __DIR__."/class/userclass.php";
    require_once "../securimage/securimage.php";
    require_once __DIR__."/class/validator.php";
	
    $user= new user();
    $validator = new validator();
	unset($_SESSION['blad']);
if (isset($_POST['submit'])) {

    $securimage = new Securimage();
    $captcha = $_POST['captcha_input'];

    if ($securimage->check($captcha) == false) {
        $Error = 'Kod z obrazka jest błędny!';
    }
    if($_POST['password1'] != $_POST['password2']) {
        $Error = "Wprowadzone hasła są różne!";
    }
    if($_POST['password2'] == "") {
        $Error = "Powtórz hasło w celu weryfikacji!";
    }
    if($_POST['password1'] == "") {
        $Error = "Wprowadź hasło użytkownika!";
    }
    if($validator->checkLogin($_POST['login']) == false) {
        $Error = "Login może zawierać tylko znaki alfanumeryczne!";
    }
    if($_POST['login'] == "") {
        $Error = "Wprowadź nazwę użytkownika!";
    }
    $_POST['surname'] == "" ? $Error = "Wprowadź nazwisko!" : $_SESSION['surname'] = $_POST['surname'];
    $_POST['name'] == "" ? $Error = "Wprowadź imię!" : $_SESSION['name'] = $_POST['name'];
    if (isset($Error)) {
        $_SESSION['blad'] = '<span style="color:red">'.$Error.'</span>';
        header('Location: ../view/useradd.php');
        exit;
    } else {
        unset($_SESSION['blad']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);

        $user->setName($_POST['name']);
        $user->setSurname($_POST['surname']);
        $user->setLogin($_POST['login']);
        $user->setPassword($_POST['password1']);
        $user->addUser();
        header('Location: ../index.php');
		exit;
    }
}

if(isset($_POST['back'])) {
    unset($_SESSION['blad']);
    unset($_SESSION['name']);
    unset($_SESSION['surname']);
	header('Location: ../index.php');
	exit;
}
?>