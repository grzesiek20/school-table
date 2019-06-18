<?php
	require_once __DIR__."/../class/sdivclass.php";
	require_once __DIR__."/../class/validator.php";
	require_once __DIR__."/../class/loggerclass.php";
		
if(isset($_POST['yes'])){
	//$sql="UPDATE `message` SET `active` = 0 WHERE id_message=".$_POST['id_message'];
	unset($_SESSION['Error']);
	unset($_SESSION['content']);
	unset($_SESSION['begin_date']);
	unset($_SESSION['end_date']);
	$message=new message();
	$message->deleteSdiv($_POST['id_message']);		
	header("Location: ../../view/edit.php?id=".$_POST['id_div']);
	exit;	
}
	
if(isset($_POST['no'])){
	unset($_SESSION['Error']);
	unset($_SESSION['content']);
	unset($_SESSION['begin_date']);
	unset($_SESSION['end_date']);
	header("Location: ../../view/edit.php?id=".$_POST['id_div']);
	exit;	
}

if(isset($_POST['add'])){
	unset($_SESSION['Error']);
	//$content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");
	// $sql="INSERT INTO `message` (`id_message`, `id_panel`,`id_user`, `content`, `begin_date`, `end_date`) VALUES (NULL,'".$_POST['id_div']."','1','".$_POST['content']."', '".$_POST['begin_date']."', '".$_POST['end_date']."');";
	Logger::wh_log(__METHOD__,"Info","Dodawanie komunikatu");
	
	$message=new message();
	$message->setIdDiv($_POST['id_div']);
	$message->setContent(htmlentities($_POST['content']));
	if(!$_POST['begin_date']) {
		$message->setBegdate('0000-00-00');
	} else if (validator::checkDate($_POST['begin_date']) == true) {
		$message->setBegdate($_POST['begin_date']);
	} else {
		$Error = "Zła data początkowa!";
		Logger::wh_log(__METHOD__, "Error", $Error." ".$_POST['begin_date']);
	}

	if(!$_POST['end_date']) {
		$message->setEnddate('0000-00-00');
	} else if (validator::checkDate($_POST['end_date']) == true) {
		$message->setEnddate($_POST['end_date']);
	} else {
		$Error = "Zła data końcowa!";
		Logger::wh_log(__METHOD__, "Error", $Error." ".$_POST['end_date']);
	}

	$message->setVisible(1);
	
	if (!$Error) {
		unset($_SESSION['Error']);
		unset($_SESSION['content']);
		unset($_SESSION['begin_date']);
		unset($_SESSION['end_date']);
		$message->insertSdiv();
		header("Location: ../../view/edit.php?id=".$_POST['id_div']);
		exit;
	} else {
		$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
		Logger:wh_log(__METHOD__,"Error", $Error);
		header("Location: ../../view/addcontent.php?id=".$_POST['id_div']);
	}
}

//unset($Error);
if(isset($_POST['back'])){
	unset($_SESSION['Error']);
	unset($_SESSION['content']);
	unset($_SESSION['begin_date']);
	unset($_SESSION['end_date']);
	header("Location: ../../view/edit.php?id=".$_POST['id_div']);
	exit;
}
	
if(isset($_POST['submit'])){
	unset($_SESSION['Error']);
	//$content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");
	//$sql="UPDATE `message` SET `content` = '".$content."',`begin_date` = '".$_POST['begin_date']."', `end_date` = '".$_POST['end_date']."', `visible` = '1' WHERE id_message =".$_POST['id_message'].";";
	$message=new message();

	$message->setIdSdiv($_POST['id_message']);
	$message->setContent(htmlentities($_POST['content']));
	$_SESSION['content'] = $_POST['content'];
	if(!$_POST['begin_date']) {
		$message->setBegdate('0000-00-00');
	} else if (validator::checkDate($_POST['begin_date'])) {
		$message->setBegdate($_POST['begin_date']);
		$_SESSION['begin_date'] = $_POST['begin_date'];
	} else {
		$Error = "Zła data początkowa!";
		Logger::wh_log(__METHOD__, "Error", $Error." ".$_POST['begin_date']);
	}

	if(!$_POST['end_date']) {
		$message->setEnddate('0000-00-00');
	} else if (validator::checkDate($_POST['end_date'])) {
		$message->setEnddate($_POST['end_date']);
		$_SESSION['end_date'] = $_POST['end_date'];
	} else {
		$Error = "Zła data końcowa!";
		Logger::wh_log(__METHOD__, "Error", $Error." ".$_POST['end_date']);
	}
	
	$message->setVisible(1);
	if (!$Error) {
		unset($_SESSION['Error']);
		unset($_SESSION['content']);
		unset($_SESSION['begin_date']);
		unset($_SESSION['end_date']);
		$message->updateSdiv();
		header("Location: ../../view/edit.php?id=".$_POST['id_div']);
		exit;
	} else {
		$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
		header("Location: ../../view/editcontent.php?sdiv=".$_POST['id_message']);
		exit;
	}
} else {
	$message=new message();
}
?>