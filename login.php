<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    session_start();
    require_once ('utils.php');
    if ( isset($_SESSION['username']) or isset($_SESSION['role']) ) {
        header('Location: index.php');
        die();
    }

    if (isset($_POST['login']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        $query = 'SELECT username, role FROM users WHERE username=? AND password=?';
        if ($stmt = $db->prepare($query)) {
            $new_pass = md5($_POST['password']);
            $stmt->bind_param('ss', $_POST['username'], $new_pass);
            $stmt->execute();
            $stmt->bind_result($user, $role);
            $stmt->fetch();
            if ( $user && $role ) {
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $role;
                header('Location: foods.php');
                die();
            }
        }
        else {
            die($db->error);
        }
    }
?>


<html lang = "en">
<body>
<form class = "form-signin" role = "form"
      action = "" method = "post">
    <input type = "text" class = "form-control"
           name = "username" required autofocus></br>
    <input type = "password" class = "form-control"
           name = "password" required>
    <button class = "btn btn-lg btn-primary btn-block" type = "submit"
            name = "login">Login</button>
</form>
</body>
</html>