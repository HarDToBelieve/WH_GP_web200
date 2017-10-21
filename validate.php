<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 21/10/17
 * Time: 15:04
 */

    require_once ('utils.php');
    $data = $_SERVER['QUERY_STRING'];
    $signature = $_POST['signature'];
    if ( md5(SECRET . ' : ' . $data) === $signature ) {
        die (json_encode(array("user" => $_GET['role'])));
    }
    else {
        die (json_encode(array("user" => "hacker")));
    }