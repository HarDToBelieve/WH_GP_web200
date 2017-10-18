<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:29
 */

    require_once ('utils.php');

    if (isset($_POST['login']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        $query = 'INSERT INTO users(username, password, role) VALUES(?,?,?)' ;
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
            $stmt->execute();
            if ( mysqli_connect_errno() ) {
                $msg = mysqli_connect_error();
            }
            else {
                header('Location: login.php');
                die();
            }
        }
    }