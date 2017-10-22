<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:07
 */
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    define("LOG_PATH", "logs");
    define("SECRET", "S4D_L1F3!!!!");
    define("APPEND_FIELD", '/WH_GP_web200');

    $db = mysqli_connect("localhost", "test", "1234", "test");
    if ( mysqli_connect_errno() ) {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }