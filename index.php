<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 21/10/17
 * Time: 16:13
 */

    session_start();
    require_once ('utils.php');
    if ( !isset($_SESSION['username']) or !isset($_SESSION['role']) ) {
        header('Location: login.php');
        die();
    }
