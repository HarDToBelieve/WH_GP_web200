<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:29
 */

    require_once ('utils.php');

    if (isset($_POST['register']) && !empty($_POST['username'])
        && !empty($_POST['password']) && !empty($_POST['nickname'])) {
        if ( !preg_match ("/^[a-zA-Z\s]+$/",$_POST['username']) ) {
            $error = 'Name must contain letters only';
        }
        else {
            $query = 'INSERT INTO users(username, nickname, password, role, signature) VALUES(?,?,?,?,?)';
            if ($stmt = $db->prepare($query)) {
                $role = 'guest';
                $signature = generateRandomString(10);
                $new_pass = md5($_POST['password']);
                $stmt->bind_param('sssss', $_POST['username'], $_POST['nickname'], $new_pass, $role, $signature);
                $stmt->execute();
                if (mysqli_connect_errno()) {
                    $msg = mysqli_connect_error();
                } else {
                    header('Location: login.php');
                    die();
                }
            } else {
                $error = 'Something went wrong';
            }
        }
    }
    else {
        $error = 'Fill in the blank';
    }

?>
<html lang = "en">
<body>
<form class = "form-signin" role = "form"
      action = "" method = "post">
    <input type = "text" class = "form-control"
           name = "username" required autofocus></br>
    <input type = "text" class = "form-control"
           name = "nickname" required autofocus></br>
    <input type = "password" class = "form-control"
           name = "password" required>
    <button class = "btn btn-lg btn-primary btn-block" type = "submit"
            name = "register">Register</button>
</form>
</body>
</html>