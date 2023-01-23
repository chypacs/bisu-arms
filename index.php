<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = 'guest';
}

require_once 'config.php';
require_once 'helper.php';
require_once 'init.php';

//print "<pre>"; print_r($_SESSION); exit;

# Logout
if (isset($_GET['m']) && $_GET['m'] == 'logout') {
    logout();
}

# Login
if (isset($_GET['m']) && $_GET['m'] == 'login') {
    if (isset($_POST['login']) && $_POST['login'] == 'submit') {
        //print "<pre>"; print_r($_POST); exit;
        $valid = false;
        if (isset($_POST['username']) && $_POST['username'] !== '' && isset($_POST['password']) && $_POST['password'] !== '') {
            include_once 'models/db_connect.php';
            $sql = new DB_Connect; 
            $valid = $sql->isValidUser($_POST['username'], $_POST['password']);
            if (!$valid) {
                $_POST['danger'] = "Either user does not exist or username/password mismatched.";
            }
        } else {
            $_POST['danger'] = "Invalid Login.";
            require_once 'views/login.php';
            die();
        }
    } else {
        require_once 'views/login.php';
        die();
    }
}

if (!isset($_GET['m'])) {
    $_GET['m'] = 'home';
}

# Area section
if ($_GET['m'] == 'area') {
    require_once 'models/sql_area.php';
    $sql = new SQL_Area;
    $_POST['area'] = $sql->getAreaInfo($_GET['akey']);
    
    //print "<pre>"; print_r($_POST); exit;
    require_once 'views/ui_area.php';

} else {
    require_once 'views/ui_home.php';
}

?>