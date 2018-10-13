<?php
	require_once __DIR__."/../class/sdivclass.php";

		
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
			$sdiv->setBegdate($_POST['begdate']);
			$sdiv->setEnddate($_POST['enddate']);
			$sdiv->setVisible(1);
			
				$sdiv->insertSdiv();
					
					header("Location: ../../view/edit.php?id=".$_POST['id_div']);
					exit;	
				
			}
			
			 if(isset($_POST['submit'])){

			//$content = htmlentities($_POST['content'], ENT_QUOTES, "UTF-8");
			 //$sql="UPDATE `sdiv` SET `content` = '".$content."',`begdate` = '".$_POST['begdate']."', `enddate` = '".$_POST['enddate']."', `visible` = '1' WHERE id_sdiv =".$_POST['id_sdiv'].";";
			$sdiv=new sdiv();

			$sdiv->setIdSdiv($_POST['id_sdiv']);
			$sdiv->setContent($_POST['content']);
			$sdiv->setBegdate($_POST['begdate']);
			$sdiv->setEnddate($_POST['enddate']);
			$sdiv->setVisible(1);
			
				 $sdiv->updateSdiv();
					
					   header("Location: ../../view/edit.php?id=".$_POST['id_div']);
						exit;	
				 

			 } else{
				$sdiv=new sdiv();
			 }
?>