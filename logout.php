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

    header('Location: login.php');
    die();