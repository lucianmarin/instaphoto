<?php
    include 'include/context.php';

    $expire = time() + (3600 * 24 * 365);

    if (isset($_GET['key']) and md5($_GET['key']) === $password) {
        setcookie('user', $password, $expire, '/');
    }

    if (isset($_GET['clear'])) {
        setcookie('user', '', 1, '/');
    }

    redirect();
?>
