<?php
	
	require_once __DIR__."/class/sdivclass.php";
	$sdiv = new sdiv();
	$posts = $sdiv->getPosts();
	
	echo $posts;
	// $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	// mysqli_set_charset($polaczenie, "utf8");
	
	// if ($polaczenie->connect_errno!=0)
	// {
		// echo "Error: ".$polaczenie->connect_errno;
	// }
	// else
	// {
		// $sql= "UPDATE `sdiv` SET `visible` = 0 WHERE enddate<CURRENT_DATE() AND enddate<>'0000-00-00'";
		
		// $polaczenie->query($sql);
		
		// $sql = "SELECT * FROM `sdiv` WHERE id_diva=11 AND active=1 AND visible=1 AND ((begdate<=CURRENT_DATE() AND enddate>=CURRENT_DATE()) OR (begdate='0000-00-00' AND enddate='0000-00-00')) ORDER BY id_sdiv DESC;";
		
		// if($rezultat5 = @$polaczenie->query($sql))
			// $ile_wierszy = $rezultat5->num_rows;
		
		// $table5=$rezultat5->fetch_assoc();
		// $news=$table5['content'];
		// while($table5=$rezultat5->fetch_assoc()){
			// $news=$news.";;".$table5['content'];
		// }
		
		// echo $news."~".$ile_wierszy;
		
	// }

?>