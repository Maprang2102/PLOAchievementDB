<?php
@session_start();
//check&keep sesion 
if (@$_GET['data'] ) {
    $role = @$_GET["data"];
    if ($role == "admin") {
        $_SESSION['role'] = $role;
    }
    if ($role == "advisor") {
        $_SESSION['role'] = $role;
    }
    if ($role == "student") {
        $_SESSION['role'] = $role;
    }
    if ($role == "logout") {
        $_SESSION['role'] = "normal";
        header("location: ./login.php");
    }
    if ($role == "login") {
        // $_SESSION['role'] = "normal";
        header("location: ./login.php");
    }
} else if ($_SESSION['role']) {
} else {
    $_SESSION['role'] = "normal";
}

return $_SESSION['role'];
