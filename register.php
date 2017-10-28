<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:29
 */

    require_once ('utils.php');

    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        if (isset($_POST['username']) && !empty($_POST['username'])
            && isset($_POST['password']) && !empty($_POST['password'])
            && isset($_POST['nickname']) && !empty($_POST['nickname'])) {
            var_dump($_POST['username']);
            if (!preg_match("/^[a-zA-Z0-9\s]+$/", $_POST['username'])) {
                $error = 'Name must contain letters only';
            } else if (strlen($_POST['nickname']) > 5) {
                $error = 'Nickname\'s length must be less than 5 characters';
            } else {
                $query = 'INSERT INTO users(username, nickname, password, role, suffix) VALUES(?,?,?,?,?)';
                if ($stmt = $db->prepare($query)) {
                    $role = 'guest';
                    $suffix = generateRandomString(10);
                    $new_pass = md5($_POST['password']);
                    $stmt->bind_param('sssss', $_POST['username'], $_POST['nickname'], $new_pass, $role, $suffix);
                    $stmt->execute();
                    if (mysqli_connect_errno()) {
                        $error = 'Something went wrong';
                    } else {
                        header('Location: login.php');
                        die();
                    }
                } else {
                    $error = 'Something went wrong';
                }
            }
        } else {
            $error = 'Fill in the blank';
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <p class="h5 text-center mb-4">Register</p>
        </div>
        <div class="card-body">
            <!-- Form login -->
            <form action="register.php" method="post">
                <div class="md-form">
                    <?php if ( isset($error) ) echo "<font id='error' color='red'>" . $error . "</font><br>"; ?>
                </div>
                <div class="md-form">
                    <input type="text" id="defaultForm-username" class="form-control" name="username">
                    <label for="defaultForm-username">Username</label>
                </div>

                <div class="md-form">
                    <input type="text" id="defaultForm-nickname" class="form-control" name="nickname">
                    <label for="defaultForm-nickname">Nickname</label>
                </div>

                <div class="md-form">
                    <input type="password" id="defaultForm-pass" class="form-control" name="password">
                    <label for="defaultForm-pass">Password</label>
                </div>

                <div class="text-center">
                    <button class = "btn btn-default" type = "submit">Register</button><br>
                    <a href="login.php">Sign in</a>
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