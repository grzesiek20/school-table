<?php
 error_reporting(E_ALL); ini_set('display_errors', 1);
	session_start();
	require_once __DIR__."/class/userclass.php";
    require_once "../securimage/securimage.php";
    require_once __DIR__."/class/validator.php";
    require_once __DIR__."/class/loggerclass.php";
    
    $user= new user();
    $validator = new validator();
    $logger = new Logger();
	unset($_SESSION['blad']);
if (isset($_POST['submit'])) {

    $logger->wh_log(__METHOD__, "Info", "Dodawanie użytkownika\n");

    // $securimage = new Securimage();
    // $captcha = $_POST['captcha_input'];

    // if ($securimage->check($captcha) == false) {
    //     $Error = 'Kod z obrazka jest błędny!';
    // }
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

        $user->setName(htmlentities($_POST['name']));
        $user->setSurname(htmlentities($_POST['surname']));
        $user->setLogin($_POST['login']);
        $user->setPassword($_POST['password1']);
        $user->setRole($_POST['role']);
        $user->addUser();
        header('Location: ../index.php');
		exit;
    }
}

if(isset($_POST['update'])) {
    $logger = new Logger();
    $user = new user();
    $user->setLogin($_SESSION['login']);
    $user->setName(htmlentities($_POST['name']));
    $user->setSurname(htmlentities($_POST['surname']));
    if(isset($_POST['oldpassword']) && isset($_POST['password1']) && isset($_POST['password2'])) {
        $user->checkOldPassword($_POST['oldpassword']);
        if($user->checkOldPassword($_POST['oldpassword'])==true && $_POST['password1']==$_POST['password2']) {
            $logger->wh_log(__METHOD__,"Info", $_POST['password1']." ".$_POST['password2']);
            $user->setPassword($_POST['password1']);
            $user->changePassword();
        }
    }
    if($_SESSION['role']==1 && isset($_POST['role'])) {
        $user->setRole($_POST['role']);
    }
    $user->updateLoggedUser();
    header('Location: ../index.php');
	exit;
}

if(isset($_POST['back'])) {
    unset($_SESSION['blad']);
    unset($_SESSION['name']);
    unset($_SESSION['surname']);
	header('Location: ../index.php');
	exit;
}
?>