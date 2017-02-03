<?php

session_start();

/*if (isset($_COOKIE['user'] ['username']) && isset($_COOKIE['user'] ['password'])) {
    setcookie("user['username']", time() - 3600);
    setcookie("user['password']", time() - 3600);
}*/

session_unset();
session_destroy();
header('location: index.php');



?>