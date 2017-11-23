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
        if ( isset($_COOKIE['data']) ) {
            $tmpCookie = base64_decode($_COOKIE['data']);
            validate($tmpCookie);
            if ( md5(SECRET . $tmpCookie) === $_COOKIE['signature'] ) {
                $data = explode(';', $tmpCookie);
                foreach ($data as $tmp) {
                    $tmp2 = explode('=', $tmp);
                    $_SESSION[$tmp2[0]] = urldecode($tmp2[1]);
                }
            }
            else {
                header('Location: login.php');
                die();
            }
        }
        else {
            header('Location: login.php');
            die();
        }
    }

    validate($_SERVER["REQUEST_URI"]);
    $path = LOG_PATH . '/' . $_SESSION['username'] . '_' . $_SESSION['suffix'];
    file_put_contents($path,$_SESSION['nickname'] . ' as known as ' . $_SESSION['username'] . ' ' . $_SERVER["REQUEST_METHOD"] . ' ' . $_SERVER["REQUEST_URI"] . ' ' . $_SERVER['SERVER_PROTOCOL']);
    if ( empty($_GET['S4cr3t_P4r4m3t3r']) ) {
        $path = 'index.php';
    }
    else {
        $path = basename($_GET['S4cr3t_P4r4m3t3r']);
    }
    include ('pages/' . $path);

?>
