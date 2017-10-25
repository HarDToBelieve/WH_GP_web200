<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    if ( isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token'] ) {
        $token = $_SESSION['token'];
        if ( $_SESSION[$token] === 'member' ) {
            include ('pages/'.$_POST['page']);
        }
        else if ( $_SESSION[$token] === 'guest' ) {
            include ('pages/guest.html');
        }
        else {
            include ('pages/busted.html');
        }
        unset($_SESSION[$token]);
        unset($_SESSION['token']);
    }
    else {
        $msg = 'Something went wrong';
    }
