<?php
	
	require_once "connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	mysqli_set_charset($polaczenie, "utf8");
	
		
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		
			$sdiv=$_GET['id_sdiv'];
			mysqli_set_charset($polaczenie, "utf8");
			$sql="UPDATE `sdiv` SET `visible` =0 where id_sdiv=".$sdiv.";";
			
				if($polaczenie->query($sql)){
					
					header("Location: ../index.php");
					exit;	
				}
			
	}
		
?>