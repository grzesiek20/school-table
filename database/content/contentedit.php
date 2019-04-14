<?php
	require_once __DIR__."/../class/sdivclass.php";
	require_once __DIR__."/../class/validator.php";
		
if(isset($_POST['yes'])){
	//$sql="UPDATE `sdiv` SET `active` = 0 WHERE id_sdiv=".$_POST['id_sdiv'];
	$sdiv=new sdiv();
	$sdiv->deleteSdiv($_POST['id_sdiv']);		
	header("Location: ../../view/edit.php?id=".$_POST['id_div']);
	exit;	
}
	
if(isset($_POST['no'])){		
	header("Location: ../../view/edit.php?id=".$_POST['id_div']);
	exit;	
}

if(isset($_POST['add'])){
	//$content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");
	// $sql="INSERT INTO `sdiv` (`id_sdiv`, `id_diva`,`id_user`, `content`, `begdate`, `enddate`) VALUES (NULL,'".$_POST['id_div']."','1','".$_POST['content']."', '".$_POST['begdate']."', '".$_POST['enddate']."');";
	$sdiv=new sdiv();
	$sdiv->setIdDiv($_POST['id_div']);
	$sdiv->setContent($_POST['content']);
	if(!$_POST['begdate']) {
		$sdiv->setBegdate('0000-00-00');
	} else if (validator::checkDate($_POST['begdate']) == true ) {
		$sdiv->setBegdate($_POST['begdate']);
	} else {
		$Error = "Wrong begin date!";
	}

	if(!$_POST['enddate']) {
		$sdiv->setEnddate('0000-00-00');
	} else if (validator::checkDate($_POST['enddate']) == true ) {
		$sdiv->setEnddate($_POST['enddate']);
	} else {
		$Error = "Wrong end date!";
	}

	$sdiv->setVisible(1);
	
	if (!$Error) {
		unset($_SESSION['Error']);
		$sdiv->insertSdiv();
		header("Location: ../../view/edit.php?id=".$_POST['id_div']);
		exit;
	} else {
		$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
		header("Location: ../../view/addcontent.php");
	}
}
	
if(isset($_POST['submit'])){
	//$content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");
	//$sql="UPDATE `sdiv` SET `content` = '".$content."',`begdate` = '".$_POST['begdate']."', `enddate` = '".$_POST['enddate']."', `visible` = '1' WHERE id_sdiv =".$_POST['id_sdiv'].";";
	$sdiv=new sdiv();

	$sdiv->setIdSdiv($_POST['id_sdiv']);
	$sdiv->setContent($_POST['content']);
	
	if(!$_POST['begdate']) {
		$sdiv->setBegdate('0000-00-00');
	} else if (validator::checkDate($_POST['begdate'])) {
		$sdiv->setBegdate($_POST['begdate']);
	} else {
		$Error = "Wrong begin date!";
	}

	if(!$_POST['enddate']) {
		$sdiv->setEnddate('0000-00-00');
	} else if (validator::checkDate($_POST['enddate'])) {
		$sdiv->setEnddate($_POST['enddate']);
	} else {
		$Error = "Wrong end date!";
	}
	
	$sdiv->setVisible(1);
	if (!$Error) {
		unset($_SESSION['Error']);
		$sdiv->updateSdiv();
		header("Location: ../../view/edit.php?id=".$_POST['id_div']);
		exit;
	} else {
		$_SESSION['Error'] = '<span style="color:red">'.$Error.'</span>';
		header("Location: ../../view/editcontent.php?sdiv=".$_POST['id_sdiv']);
		exit;
	}
} else {
	$sdiv=new sdiv();
}
?>