<?php
    header("Content-type: text/css; charset: UTF-8");
	
	require_once "../database/photoclass.php";
	$photo = new photo();
	$photos = $photo->getAll();

for ($i=0; $i<count($photos);$i++){	

echo ".animation--fade-bg-".$photos[$i]['id_photo']."{\n";
echo  "border-bottom-left-radius:4px !important;\n";
echo  "border-bottom-right-radius:4px !important;\n";
echo  "display:block;\n";
echo  "text-align:center;\n";
echo  "background-position:center;\n";
echo  "background-size: 100%;\n";
echo  "background-repeat: no-repeat;\n";
echo  "background-image: url('../img/".$photos[$i]['name']."');\n";

// echo "animation-name: fade-bg-".$photos[$i]['id_photo'].";\n";
// echo "animation-duration: 8s;\n";
// echo "animation-delay: 0;\n";
// echo "animation-direction: alternate;\n";
// echo "-webkit-animation-name: fade-bg-".$photos[$i]['id_photo'].";\n";
// echo "-webkit-animation-duration: 8s;\n";
// echo "-webkit-animation-delay: 0;\n";
// echo "-webkit-animation-direction: alternate;\n";
 echo "}\n\n";

// echo "@keyframes fade-bg-".$photos[$i]['id_photo']."{\n";
// echo     "from {opacity: 0;\n";
// echo   "background-image: url('../img/".$photos[$i]['name']."');}\n";
// echo        "30% {opacity: 1;\n";
// echo   "background-image: url('../img/".$photos[$i]['name']."');}\n";
// echo	    "70% {opacity: 1;\n";
// echo   "background-image: url('../img/".$photos[$i]['name']."');}\n";
// echo        "to {opacity: 0;\n";
// echo   "background-image: url('../img/".$photos[$i]['name']."');}\n";
// echo "}\n\n";

// echo "@-webkit-keyframes fade-bg-".$photos[$i]['id_photo']." {\n";

    // echo "from {opacity: 0;\n";
        // echo "background-image: url('../img/".$photos[$i]['name']."');}\n";
    // echo "30% {opacity: 1;\n";
        // echo "background-image: url('../img/".$photos[$i]['name']."');}\n";
	// echo "70% {opacity: 1;\n";
        // echo "background-image: url('../img/".$photos[$i]['name']."');}\n";
    // echo "to {opacity: 0;\n";
        // echo "background-image: url('../img/".$photos[$i]['name']."');}\n";
// echo "}\n\n";

	}
?>