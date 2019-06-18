<?php
	
	require_once __DIR__."/class/sdivclass.php";
	$message = new message();
	$posts = $message->getPosts();
	
	echo $posts;
?>