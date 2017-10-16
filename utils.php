<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:07
 */

    define("LOG_PATH", "logs");
    define("SECRET", "S4D L1F3!!!!");
    $db = mysqli_connect("localhost", "web200", "web200", "web200");
    if ( mysqli_connect_errno() ) {
        die ("Failed to connect to MySQL: " . mysqli_connect_error());
    }