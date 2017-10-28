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

    if (isset($_POST['username']) && !empty($_POST['username'])
        && isset($_POST['password']) && !empty($_POST['password'])) {

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
                $cookie_value = 'username=' . urlencode($user) . ';role=' . urlencode($role) . ';nickname=' . urlencode($nickname ). ';suffix=' . urlencode($suffix);
                setcookie('data', base64_encode($cookie_value), time() + (86400 * 30), '/');
                $hash_value = md5(SECRET . $cookie_value);
                setcookie('signature', $hash_value, time() + (86400 * 30), '/');
                header('Location: index.php');
                die();
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/font-awesome.min.css">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="bootstrap/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="bootstrap/css/style.css" rel="stylesheet">
    <style>
        body {
            background-image: url('images/maxresdefault_live.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>

<!-- Start your project here-->
<div class="container" style="padding-top: 2%">
    <!--Panel-->
    <div class="card" style="width: 50%; margin: 0 auto">
        <div class="card-header deep-orange lighten-1 white-text">
            <p class="h5 text-center mb-4">Sign in</p>
        </div>
        <div class="card-body">
            <!-- Form login -->
            <form action="login.php" method="post">
                <div class="md-form">
                    <input type="text" id="defaultForm-username" class="form-control" name="username">
                    <label for="defaultForm-username">Username</label>
                </div>

                <div class="md-form">
                    <input type="password" id="defaultForm-pass" class="form-control" name="password">
                    <label for="defaultForm-pass">Password</label>
                </div>

                <div class="text-center">
                    <button class = "btn btn-default" type = "submit">Login</button><br>
                    Don't have an account? <a href="register.php">Sign up</a>
                </div>
            </form>
            <!-- Form login -->
        </div>
    </div>
    <!--/.Panel-->
</div>
<!-- /Start your project here-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="bootstrap/js/mdb.min.js"></script>
</body>

</html>