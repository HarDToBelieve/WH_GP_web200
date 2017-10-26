<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:29
 */

    session_start();

    unset($_SESSION["username"]);
    unset($_SESSION["role"]);
    unset($_SESSION["suffix"]);
    unset($_SESSION["nickname"]);

    setcookie('data', '', time()-1000, '/');
    setcookie('signature', '', time()-1000, '/');

    header('Location: login.php');
    die();