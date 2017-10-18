<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    session_start();
    require_once ('utils.php');

    if (isset($_POST['login']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        $query = 'SELECT username, role FROM users WHERE username=? AND password=?';
        if ($stmt = $db->prepare($query)) {
            $stmt->bind_param('ss', $_POST['username'], $_POST['password']);
            $stmt->execute();
            $stmt->bind_result($user);
            $stmt->fetch();
            if ( $user ) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                header('Location: index.php');
                die();
            }
        }
    }
?>


