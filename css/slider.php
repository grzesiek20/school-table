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
    
    function cryptPassword ($data, $key, $decrypt = false) {
        $td = mcrypt_module_open('tripledes', '', 'ecb', '');
        $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
        mcrypt_generic_init($td, $key, $iv);
        if($decrypt) {
            $output = mdecrypt_generic($td, base64_decode($data));

        } else {
            $output = base64_encode(mcrypt_generic($td, $data));
        }

        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);
        return $output;
    }

$password = $this->cryptPassword($password, 'cryptKey', false);

$salt = 'randomString';
$password = hash('sha256', $salt.$password);






?>