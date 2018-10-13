<?php
    header("Content-type: text/css; charset: UTF-8");
	
	require_once "../database/conf.php";
?>

p{color:black;}

body
{
	background-color: #eeeeee;
	color: #ffffff;
	font-family: 'Lato', sans-serif;
	font-size: 20px;
}

.gray{
	color:gray !important;
}

.buttoncustom{
	padding:0px !important;
	text-align:center;
	font-size:20px !important;
	height:0px !important;	
}

.tile
{
	background-color: #3095d3;
	text-align: center;
}

.top{
	margin-top:20px;
	margin-bottom:20px;
	padding-top:5px;
	padding-bottom:5px;
	background-color: #3095d3;
	text-align: center;
}

h4{
	color:black !important;
}

#container{
	background-color: #eeeeee;
	padding:0;
	margin-left:auto;
	margin-right:auto;
	height:750px;

}

.block{
	border-style:none !important;
	position:absolute !important;
	text-align:justify;
}

.section{
	color:black;
}

.icons{color:#333333;}

<?php
	$table=$rezultat->fetch_assoc();
		echo "#div".$table['id_diva']."{";
		echo 'height:'.$table['height'].'px;';
		echo 'width:'.$table['per_width'].'%;';
		echo 'top:'.$table['topm'].'px;';
		echo 'left:'.$table['per_leftm'].'%;';
		echo 'background-color:'.$table['bgcolor'].';';
		echo 'color:'.$table['fontcolor'].';';
		echo 'text-align:center;';
		echo 'z-index:10;';
		echo '}';

		echo ".cust".$table['id_diva']."{";
		echo 'font-size:'.$table['fontsize'].'px;';
		echo '}';
		

	while($table=$rezultat->fetch_assoc()) { 
		echo "#div".$table['id_diva']."{";
		echo 'height:'.$table['height'].'px;';
		echo 'width:'.$table['per_width'].'%;';
		echo 'top:'.$table['topm'].'px;';
		echo 'left:'.$table['per_leftm'].'%;';
		echo 'background-color:'.$table['bgcolor'].';';
		echo 'color:'.$table['fontcolor'].';';
		echo '}';
		
		echo ".head".$table['id_diva']."{";
		echo 'background-color:'.$table['headercolor'].' !important;';
		echo 'font-size:'.$table['headerfsize'].'px;';
		echo 'color:'.$table['headerfcolor'].' !important;';
		echo '}';
		
		echo ".cust".$table['id_diva']."{";
		echo 'font-size:'.$table['fontsize'].'px;';
		echo '}';
	}
?>