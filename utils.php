<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:07
 */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function validate($s) {
        if ( preg_match('/GET|POST|escapeshellarg|escapeshellcmd|exec|passthru|proc_close|proc_get_status|proc_nice|proc_open|proc_terminate|shell_exec|system|fopen|fwrite|file_get_contents|stream_context_create|file_put_contents|call_user_func|call_user_func_array/i', $s) ) {
            die ('Hacking attemp!!');
        }
    }

    define("LOG_PATH", "GmQrH5RBZSGizH7EjLl");
    define("SECRET", "pzFQbAtgPUWRL1v4H9B");
    define("APPEND_FIELD", '');

    $HOSTDB = 'localhost';
    $USERDB = 'test';
    $PASSDB = '1234';
    $NAMEDB = 'test';

    $db = mysqli_connect($HOSTDB, $USERDB, $PASSDB, $NAMEDB);
    if ( mysqli_connect_errno() ) {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }
