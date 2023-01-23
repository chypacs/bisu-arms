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
    require_once 'models/sql_level.php';
    $sql_level = new SQL_Level;
    $_POST['area'] = $sql->getAreaInfo($_GET['akey']);
    $_POST['area_levels'] = $sql_level->getAreaLevelsData($_GET['akey']);
    
    //print "<pre>"; print_r($_POST); exit;
    require_once 'views/ui_area.php';

# Level / Folders section
} elseif ($_GET['m'] == 'level') {
    require_once 'models/sql_area.php';
    $sql = new SQL_Area;
    require_once 'models/sql_level.php';
    $sql_level = new SQL_Level;
    $_POST['area'] = $sql->getAreaInfo($_GET['akey']);
    $_POST['area_levels'] = $sql_level->getAreaLevelsData($_GET['akey']);
    $_POST['level'] = $sql_level->getLevelInfoFromKey($_GET['lkey']);

    $_POST['ay_sel'] = $_SESSION['academic_year_list'][0];
    if (isset($_POST['create']) && $_POST['create'] == 'ay_folders')  {
        $_POST['ay_sel'] = $_POST['academic_yr'];
        global $FILE_LIST;
        $FILE_LIST = array();
        $path = AACCUP_FILES.'/'.$_POST['ay_sel'] . '/LEVEL-' . $_POST['level']['Level_Code'] . '/' . $_GET['dept'] . '/AREA-' . $_POST['area']['Area_Code'].'/';
        recursive_scan($path);

        //print "<pre>$path\n";
        //print_r($FILE_LIST);

        //$dirs = scandir("./AACCUP_FILES/AY-2019-2020/LEVEL-I/ITD/AREA-I/");
        //var_dump($dirs);
        //exit;

    }

    //print "<pre>"; print_r($_POST); print_r($_GET); exit;
    require_once 'views/ui_folders.php';
} else {
    require_once 'views/ui_home.php';
}

?>