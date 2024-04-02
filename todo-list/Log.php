<?php class Log {
    public function wh_log($log_msg)
    {
        $log_filename = "logs";
        if (!file_exists($log_filename))
        {
            // create directory/folder uploads.
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.logging';
        // if you don't add `FILE_APPEND`, the file will be erased each time you add a logging
        file_put_contents($log_file_data, date("Y-m-d H:i:s ") . $log_msg . "\n", FILE_APPEND);
    }
}