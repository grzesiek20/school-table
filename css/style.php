<?php
    header("Content-type: text/css; charset: UTF-8");
	
	//require_once "../database/conf.php";
	require_once __DIR__."/../database/conf.php";	
?>

body
{
	background-color: #eeeeee;
	color: #ffffff;
	font-family: 'Lato', sans-serif;
	font-size: 20px;
}

.panel{
	border-style:none !important;
	position:absolute !important;
}

.buttoncustom{
	padding:0px !important;
	text-align:center;	
}

.top{
	margin-top:20px;
	margin-bottom:20px;
	padding-top:5px;
	padding-bottom:5px;
	background-color: #3095d3;
	text-align: center;
}


#container{
	background-color: #eeeeee;
	padding:0;
	margin-left:auto;
	margin-right:auto;
	height:750px;
	position:relative;
}

.block{
	border-style:none !important;
	position:absolute !important;
}

.section{
	color:black;
}

.icons{
	color:#333333;
	font-size:15px;
}

.icons:hover{
	color:white !important;
}

.rand:hover{
	color:white;
}

.nopadding{
	padding:0px;
	margin-bottom:0px;
	margin-top:0px !important;
	border-radius:none !important;
}

#sdiv6{
	background-size:100%;
	height:<?php echo $slider.'px;';?>
	display:block;
	background-position:center;
}
<?php
	for ($i=0; $i<count($divs);$i++){
		if($i==0){
			echo "#div".$divs[$i]['id_diva']."{\n";
			echo "height:".$divs[$i]['height']."px;\n";
			echo "width:".$divs[$i]['per_width']."%;\n";
			echo "top:".$divs[$i]['topm']."px;\n";
			echo "left:".$divs[$i]['per_leftm']."%;\n";
			echo "background-color:".$divs[$i]['bgcolor'].";\n";
			echo "color:".$divs[$i]['fontcolor'].";\n";
			echo "text-align:".$divs[$i]['textalign'].";\n";
			echo "z-index:1;\n";
			echo "}\n\n";

			echo ".cust".$divs[$i]['id_diva']."{\n";
			echo "font-size:".$divs[$i]['fontsize']."px;\n";
			echo "}\n";
		}
		else
		{
			echo "#div".$divs[$i]['id_diva']."{\n";
			echo "height:".$divs[$i]['height']."px;\n";
			echo "width:".$divs[$i]['per_width']."%;\n";
			echo "top:".$divs[$i]['topm']."px;\n";
			echo "left:".$divs[$i]['per_leftm']."%;\n";
			echo "background-color:".$divs[$i]['bgcolor'].";\n";
			echo "color:".$divs[$i]['fontcolor'].";\n";
			echo "text-align:".$divs[$i]['textalign'].";\n";
			echo "}\n\n";
			
			echo ".head".$divs[$i]['id_diva']."{\n";
			echo "background-color:".$divs[$i]['headercolor']." !important;\n";
			echo "font-size:".$divs[$i]['headerfsize']."px;\n";
			echo "color:".$divs[$i]['headerfcolor']." !important;\n";
			echo "}\n\n";
			
			echo ".cust".$divs[$i]['id_diva']."{\n";
			echo "font-size:".$divs[$i]['fontsize']."px;\n";
			echo "}\n";
		}
		
	}
?>

@media (max-width: 992px) {
<?php
for ($i=0; $i<count($divs);$i++){
		if($i==0){
			echo ".cust".$divs[$i]['id_diva']."{\n";
			echo "font-size:40px;\n";
			echo "padding-top:12px;\n";
			echo "}\n";
		}
		else
		{
			echo ".head".$divs[$i]['id_diva']."{\n";
			echo "font-size:20px;\n";
			echo "}\n\n";
			
			echo ".cust".$divs[$i]['id_diva']."{\n";
			echo "font-size:20px;\n";
			echo "}\n";
		}
		
	}
?>
}
