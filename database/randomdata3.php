<?php

	session_start();
	
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	mysqli_set_charset($polaczenie, "utf8");
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
			if(!empty($_POST['datacount']))
			{
			 mysqli_set_charset($polaczenie, "utf8");
			 
			$datacount = $_POST['datacount'];
			
			$sql="SELECT id_user FROM user;";					
				$wyniki = $polaczenie->query($sql);
				$k=0;
				
			while($tab=$wyniki->fetch_assoc()) {
				$user[$k]=$tab['id_user'];
				$k++;
			}

			$random_cont = Array('Neque','porro','quisquam','est','qui','dolorem','ipsum','quia','dolor','sit','amet','consectetur','adipisci','velit');
			$panelsID= Array('11','9');
			
			for($i=0;$i<=$datacount;$i++)
				{	
				for($j=0;$j<=5;$j++)
					{	$r=mt_rand(0,13);
						$content = $content.' '.$random_cont[$r];	
					}
			
					$panelindex = mt_rand(0,1);
					$id_panel = $panelsID[$panelindex];
					$index = mt_rand(0,count($user)-1);
					$id_user = $user[$index];
					
					$sql="INSERT INTO `message`(`id_message`, `id_panel`, `id_user`, `content`) VALUES ('','{$id_panel}','{$id_user}','{$content}');";					
					$polaczenie->query($sql);	
					unset($content);
				}
				
			
				
				header('Location: ../index.php');
				exit;
			}
	}
?>