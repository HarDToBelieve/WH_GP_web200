<?php
/**
 * Created by PhpStorm.
 * User: hardtobelieve
 * Date: 16/10/17
 * Time: 13:28
 */

    $data = 'user=' . $_SESSION['username'] . '&role=' . $_SESSION['role'];
    $url = 'http://' . $_SERVER['HTTP_HOST'] . APPEND_FIELD . '/validate.php?' . $data;

    $postData = array('signature' => md5(md5(SECRET . ' : ' . $data)));
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($postData)
        )
    );
    $context  = stream_context_create($options);
    $result = json_decode(file_get_contents($url, false, $context));
    if ( $result ) {
        if ( $result['user'] === 'member' ) {
            include ($_GET['page']);
        }
        else if ( $result['user'] === 'guest' ) {
            include ('default.html');
        }
        else {
            include ('busted.html');
        }
    }
    else {
        $msg = 'Something went wrong';
    }
