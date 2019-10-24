<?php


/**
 * @param $value
 * @return bool|mixed
 */
function env(
    $value)
{
    $config = require __DIR__ . '/../../config.php';
    if(is_null($value))
        return $config;
    $path = explode('.', $value);
    foreach ($path as $x)
        if (!isset($config[$x]))
            return false;
        else
            $config = $config[$x];
    return $config;

}

/**
 * @param string $message
 * @return bool
 */
function close_connection(
    $message = '<p style="color:red; font-weight: bold;"> Ignore request</p>')
{
    if(PHP_SAPI == 'cli') return false;
    ob_end_clean();
    header('HTTP/1.1 200 OK', true, 200);
    header('Connection: close');
    ignore_user_abort(true);
    ob_start();
//    print $message;
    $size = ob_get_length();
    header('Content-Length: '. $size);
    ob_end_flush();
    flush();
}


/**
 * @param $string
 * @return bool
 */
function is_json(
    $string) {
    @json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

