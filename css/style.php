
<?php
    header("Content-type: text/css; charset: UTF-8");
	
	//require_once "../database/conf.php";
	require_once __DIR__."/../database/conf.php";	
?>

.overlay {
  height: 0;
  width: 100%;
  position: fixed;
  z-index: 4;
  top: 0;
  left: 0;
  background-color: rgb(0,156,138);
  background-color: rgba(0,156,138, 0.9);
  overflow-x: hidden;
  overflow-y: hidden;
  transition: 0.5s;
}

#menu {
	width:100%;
	height:15px;
	z-index:3 !important;
	position:absolute !important;
}

.menuicons {
	text-align:center !important;
}

.menuicon {
	font-size:20px !important;
	cursor:pointer;
}

.overlay-content {
  position: relative;
  top: 25%;
  width: 100%;
  text-align: center;
  margin-top: 10px;
}

.overlay a {
  padding: 8px;
  text-decoration: none;
  font-size: 36px;
  color:#333333;
  display: block;
  transition: 0.3s;
  height:20px;
}

.overlay a:hover, .overlay a:focus {
  color:white;
}

.overlay .closebtn {
  position: absolute;
  top: 20px;
  right: 45px;
  font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
  font-size: 40px;
  top: 15px;
  right: 35px;
  }
}

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

.icotext {
	font-size:15px;
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
	for ($i=0; $i<count($panels);$i++){
		if($i==0){
			echo "#div".$panels[$i]['id_panel']."{\n";
			echo "height:".$panels[$i]['height']."px;\n";
			echo "width:".$panels[$i]['percent_width']."%;\n";
			echo "top:".$panels[$i]['top_margin']."px;\n";
			echo "left:".$panels[$i]['percent_left_margin']."%;\n";
			echo "background-color:".$panels[$i]['background_color'].";\n";
			echo "color:".$panels[$i]['font_color'].";\n";
			echo "text-align:".$panels[$i]['text_align'].";\n";
			echo "margin-top:auto\n";
			echo "margin-bottom:auto\n";
			echo "z-index:1;\n";
			echo "}\n\n";
			echo ".cust".$panels[$i]['id_panel']."{\n";
			echo "font-size:".$panels[$i]['font_size']."px;\n";
			echo "}\n";
		}
		else
		{
			echo "#div".$panels[$i]['id_panel']."{\n";
			echo "height:".$panels[$i]['height']."px;\n";
			echo "width:".$panels[$i]['percent_width']."%;\n";
			echo "top:".$panels[$i]['top_margin']."px;\n";
			echo "left:".$panels[$i]['percent_left_margin']."%;\n";
			echo "background-color:".$panels[$i]['background_color'].";\n";
			echo "color:".$panels[$i]['font_color'].";\n";
			echo "text-align:".$panels[$i]['text_align'].";\n";
			echo "}\n\n";
			
			echo ".head".$panels[$i]['id_panel']."{\n";
			echo "background-color:".$panels[$i]['header_color']." !important;\n";
			echo "font-size:".$panels[$i]['header_font_size']."px;\n";
			echo "color:".$panels[$i]['header_font_color']." !important;\n";
			echo "}\n\n";
			
			echo ".cust".$panels[$i]['id_panel']."{\n";
			echo "font-size:".$panels[$i]['font_size']."px;\n";
			echo "}\n";
		}
		
	}
?>

@media (max-width: 992px) {
<?php
for ($i=0; $i<count($panels);$i++){
		if($i==0){
			echo ".cust".$panels[$i]['id_panel']."{\n";
			echo "font-size:40px;\n";
			echo "padding-top:12px;\n";
			echo "}\n";
		}
		else
		{
			echo ".head".$panels[$i]['id_panel']."{\n";
			echo "font-size:20px;\n";
			echo "}\n\n";
			
			echo ".cust".$panels[$i]['id_panel']."{\n";
			echo "font-size:20px;\n";
			echo "}\n";
		}
		
	}
?>
}
