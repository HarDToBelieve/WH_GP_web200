<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:29
 */

    require_once ('utils.php');

    if (isset($_POST['register']) && !empty($_POST['username'])
        && !empty($_POST['password'])) {

        $query = 'INSERT INTO users(username, password, role) VALUES(?,?,?)' ;
        if ($stmt = $db->prepare($query)) {
            $role = 'guest';
            $stmt->bind_param('sss', $_POST['username'], md5($_POST['password']), $role);
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
            name = "register">Register</button>
</form>
</body>
</html>