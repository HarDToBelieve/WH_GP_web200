<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */
    if ( $_SESSION['role'] === 'member' ) {
        include ($_GET['page']);
    }
    else if ( $_SESSION['role'] === 'guest' ) {
        echo '<h1>Only member can read the details</h1>';
    }
?>