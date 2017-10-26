<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    session_start();
    require_once ('utils.php');
    if ( isset($_SESSION['username'])  ) {
        header('Location: index.php');
        die();
    }

    if ( isset($_COOKIE['data']) ) {
        if ( md5(SECRET . $_COOKIE['data']) === $_COOKIE['signature'] ) {
            $data = explode(';', $_COOKIE['data']);
            foreach ($data as $tmp) {
                $tmp2 = explode('=', $tmp);
                $_SESSION[$tmp2[0]] = $tmp2[1];
            }
            header('Location: index.php');
            die();
        }
    }
    else if (isset($_POST['login']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        $query = 'SELECT username, nickname, role, suffix FROM users WHERE username=? AND password=?';
        if ($stmt = $db->prepare($query)) {
            $new_pass = md5($_POST['password']);
            $stmt->bind_param('ss', $_POST['username'], $new_pass);
            $stmt->execute();
            $stmt->bind_result($user, $nickname, $role, $suffix);
            $stmt->fetch();
            if ( $user && $role ) {
                $_SESSION['username'] = $user;
                $_SESSION['role'] = $role;
                $_SESSION['suffix'] = $suffix;
                $_SESSION['nickname'] = $nickname;
                $cookie_value = 'username=' . $user . ';role=' . $role . ';nickname=' . $nickname . ';suffix=' . $suffix;
                setcookie('data', base64_encode($cookie_value), time() + (86400 * 30), '/');
                $hash_value = md5(SECRET . $cookie_value);
                setcookie('signature', $hash_value, time() + (86400 * 30), '/');
                header('Location: index.php');
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