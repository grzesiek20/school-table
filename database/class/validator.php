<?php
require_once __DIR__."/loggerclass.php";
class validator 
{
    function checkDate($date) {
        if ($date == '0000-00-00') {
            Logger::wh_log(__METHOD__, "Info", "Domyślna wartość gdy nie ustawiono daty:\n".$date);
            return true;
        } else{
            $isValid = (bool)preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date);
            if($isValid) {
                Logger::wh_log(__METHOD__, "Info", "Poprawny format daty:\n".$date);
            } else {
                Logger::wh_log(__METHOD__, "Error", "Niepoprawny format daty:\n".$date);
            }
        }
		return $isValid;
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
        return (bool)preg_match("/[0-9]+/",$number);
    }

    function checkLogin($login) {
        return (bool)ctype_alnum($login);
    }
 }
?>