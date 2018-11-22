<?php

if (isset($_COOKIE['login'])) {
    setcookie('login', '', -1, '/');
    setcookie('password', '', -1, '/');
    header('Location: /index.php');
}
 