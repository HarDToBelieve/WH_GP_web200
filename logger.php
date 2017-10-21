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
    include ($_GET['S4cr3t_P4r4m3t3r']);