<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    function checkHash($data, $signature) {

    }

    function extractData($data) {
        $user = explode("_", $data);
        return $user;
    }

    function isAdmin($user) {
        if ( $user['role'] === 'admin' ) {
            return true;
        }
        else {
            return false;
        }
    }

    session_start();
    if ( !isset($_SESSION['username']) or !isset($_SESSION['role']) ) {
        header('Location: login.php');
        die();
    }


