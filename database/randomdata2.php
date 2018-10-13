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
			if(isset($_POST['submitusers'])&& $_POST['usercount']>=0)
			{
			 mysqli_set_charset($polaczenie, "utf8");
			 
			$usercount = $_POST['usercount'];
			 
			$imiona = Array('Adam','Grzegorz','Mateusz','Seweryn','Ireneusz','Zbigniew','Andrzej');
			$nazwiska = Array('Nowak','Kowalski','Duda','Walczak','Adamczyk','Wieczorek','Kwiatkowski');
			$login = Array('1','2','3','4','5','6','7');
			$password = Array('8','9','10','11','12','13','14');
			
			for($i=1;$i<=$usercount;$i++)
				{
					$r=mt_rand(0,6);
					$user_name = $imiona[$r];
					$r=mt_rand(0,6);
					$user_surname = $nazwiska[$r];
					$r=mt_rand(0,6);
					$user_login = $user_name.$login[$r];
					$r=mt_rand(0,6);
					$user_pass = $user_surname.$password[$r];
					
					$sql="INSERT INTO `user` (`id_user`, `login`, `password`, `name`, `surname`) VALUES ('','{$user_login}','{$user_pass}','{$user_name}','{$user_surname}');";
					$polaczenie->query($sql);
				}
				header('Location: ../index.php');
				exit;
			}
	}
?>