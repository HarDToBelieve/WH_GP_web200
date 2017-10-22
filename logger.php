<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 14:02
 */

    session_start();
    require_once ('utils.php');
    if ( !isset($_SESSION['username']) or !isset($_SESSION['role']) ) {
        header('Location: login.php');
        die();
    }
    if ( preg_match('/GET|POST|escapeshellarg|escapeshellcmd|exec|passthru|proc_close|proc_get_status|proc_nice|proc_open|proc_terminate|shell_exec|system|fopen|fwrite|file_get_contents|stream_context_create|file_put_contents/i', strtok($_SERVER["REQUEST_URI"],'?')) ) {
        die ('Hacking attemp!!');
    }
    file_put_contents('logs/tuan.dat',$_SESSION['username'] . ' : ' . $_SERVER["REQUEST_METHOD"] . ' ' . strtok($_SERVER["REQUEST_URI"],'?') . ' ' . $_SERVER['SERVER_PROTOCOL']);
    if ( empty($_GET['S4cr3t_P4r4m3t3r']) ) {
        $path = 'index.php';
    }
    else {
        $path = basename($_GET['S4cr3t_P4r4m3t3r']);
    }
?>
<!DOCTYPE html>
<html class="mdc-typography">
<head>
    <title>Vietnamese Food</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/mdb.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/mdb.min.js"></script>
<!--    <style>-->
<!--        body {-->
<!--            background-image: url('bootstrap/img/maxresdefault_live.jpg');-->
<!--            -webkit-background-size: cover;-->
<!--            -moz-background-size: cover;-->
<!--            -o-background-size: cover;-->
<!--            background-size: cover;-->
<!--        }-->
<!--    </style>-->
</head>

<?php include ('pages/' . $path); ?>

</html>
