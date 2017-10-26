<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 21/10/17
 * Time: 15:04
 */

    session_start();
    require_once ('utils.php');
    if ( !isset($_SESSION['username']) ) {
        header('Location: index.php');
        die();
    }

    if ( md5(SECRET . ' : ' . $data) === $signature and !isset($_SESSION['token']) ) {
        $_SESSION['token'] = genHash(32);
        $_SESSION[$_SESSION['token']] = $_GET['role'];
        die ($_SESSION['token']);
    }
    else {
        die ("0xDEADC0DE");
    }