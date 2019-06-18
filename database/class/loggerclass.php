<?php
class Logger {
    function wh_log($method, $msg_type, $log_msg) {
        $filename = $_SERVER['DOCUMENT_ROOT']."/log";
        if (!file_exists($filename))
        {
            mkdir($filename, 0777, true);
        }
        $file_data = $filename.'/log_' . date('d-M-Y') . '.log';
        file_put_contents($file_data, date('d-M-Y')." ".date('H:i:s')." ".$msg_type." ".$method." ". $log_msg . "\n", FILE_APPEND);
    }
}
?>