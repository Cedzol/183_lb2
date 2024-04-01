<?php session_start();

    require_once 'logging/Log.php';

    $log = new Log();
    $log->wh_log("Logout successful for User " . $_SESSION["userid"] . " and ip " . $_SERVER['REMOTE_ADDR']);
    $_SESSION["username"] = '';
    $_SESSION["userid"] = '';
    $_SESSION["role"] = '';
    unset($_SESSION['username']);
    unset($_SESSION['userid']);
    unset($_SESSION['role']);
    session_destroy();
    header("Location: /");
    exit();
?>