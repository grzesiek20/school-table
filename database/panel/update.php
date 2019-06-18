<?php

	require_once __DIR__."/../class/divclass.php";
	require_once __DIR__."/../class/validator.php";

	$panel= new panel();
	$validator = new validator();
	if ($validator->checkNumber($_POST['id_panel'])) {
		$panel->setIdDiv($_POST['id_panel']);
	}
	if ($validator->checkNumber($_POST['percent_width'])) {
		$panel->setPer_width($_POST['percent_width']);
	}
	if ($validator->checkNumber($_POST['height'])) {
		$panel->setHeight($_POST['height']);
	}
	if ($validator->checkNumber($_POST['height'])) {
		$panel->setHeight($_POST['height']);
	}
	if ($validator->checkNumber($_POST['percent_left_margin'])) {
		$panel->setPer_leftm($_POST['percent_left_margin']);
	}
	if ($validator->checkNumber($_POST['top_margin'])) {
		$panel->setTopm($_POST['top_margin']);
	}
		$panel->updatePanelLocation();
		
		header('Location: ../../index.php');
		exit;	
?>