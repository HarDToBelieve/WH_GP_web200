<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 14:02
 */

    session_start();
    require_once ('utils.php');
    if ( !isset($_SESSION['username']) ) {
        header('Location: login.php');
        die();
    }
    if ( preg_match('/GET|POST|escapeshellarg|escapeshellcmd|exec|passthru|proc_close|proc_get_status|proc_nice|proc_open|proc_terminate|shell_exec|system|fopen|fwrite|file_get_contents|stream_context_create|file_put_contents/i', $_SERVER["REQUEST_URI"]) ) {
        die ('Hacking attemp!!');
    }

    $path = LOG_PATH . '/' . $_SESSION['username'] . '_' . $_SESSION['suffix'];
    file_put_contents($path,$_SESSION['nickname'] . ' as known as ' . $_SESSION['username'] . ' ' . $_SERVER["REQUEST_METHOD"] . ' ' . strtok($_SERVER["REQUEST_URI"],'?') . ' ' . $_SERVER['SERVER_PROTOCOL']);
    if ( empty($_GET['S4cr3t_P4r4m3t3r']) ) {
        $path = 'index.php';
    }
    else {
        $path = basename($_GET['S4cr3t_P4r4m3t3r']);
    }
    include ('pages/' . $path);

?>
