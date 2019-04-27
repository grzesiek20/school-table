<?php
	
class validator 
{
    function checkDate($date) {
		return (bool)preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date);
	}
    
    function checkColor($color) {
        return (bool)preg_match("/#[a-fA-F0-9]{6}/",$color);
    }

    function formatColor($color) {
        while (strlen($color) < 7) {
            $color = $color.'0';
        }
        return $color;
    }

    function checkNumber($number) {
        return (bool)preg_match("/[0-9]+/",$color);
    }

    function checkLogin($login) {
        return (bool)ctype_alnum($login);
    }
 }
?>