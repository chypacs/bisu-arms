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

if (!isset($_GET['m'])) {
    $_GET['m'] = 'areas';
}
//print "<pre>"; print_r($_GET); print_r($_POST);  exit;

# Areas
if ($_GET['m'] == 'areas') {
    require_once 'models/sql_area.php';
    $sql = new SQL_Area;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveAreas($list);
                //var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Areas saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getAreasData()
    );

    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_areas.php';

# Task Force
} elseif ($_GET['m'] == 'taskforce') {
    require_once 'models/sql_taskforce.php';
    $sql = new SQL_TaskForce;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveTaskForce($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Task Force saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getTaskForceData()
    );

    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_taskforce.php';

# Indicators
} elseif ($_GET['m'] == 'indicators') {
    require_once 'models/sql_parameters.php';
    $sql = new SQL_Parameters;
    $headers = array('Indicator_Code', 'Description');
    $data = array();
    foreach ($sql->indicator_list as $code => $desc) {
        $data[] = array(
            'Indicator_Code' => $code,
            'Description' => $desc,
        );
    }

    $_GET['table'] = array(
        'table_headers' => $headers,
        'table_data' => $data
    );
    require_once 'views/ui_indicators.php';

# Parameters
} elseif ($_GET['m'] == 'parameters') {
    require_once 'models/sql_parameters.php';
    $sql = new SQL_Parameters;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveParameters($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Parameters saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getParametersData()
    );

    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_parameters.php';

# Folders
} elseif ($_GET['m'] == 'folders') {
    require_once 'models/sql_folders.php';
    $sql = new SQL_Folders;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveFolders($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Default folders saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->tbl_columns,
        'table_data' => $sql->getFoldersData()
    );
    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_folders.php';

# Levels
} elseif ($_GET['m'] == 'levels') {
    require_once 'models/sql_level.php';
    $sql = new SQL_Level;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveLevels($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Area Levels saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->levels_columns,
        'table_data' => $sql->getLevelsData()
    );
    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_levels.php';

# Department
} elseif ($_GET['m'] == 'departments') {
    require_once 'models/sql_level.php';
    $sql = new SQL_Level;
    //print "<pre>"; print_r($_GET); print_r($_POST);  exit;

    if (isset($_POST['save'])) {
        if (isset($_FILES['upload_csv']) && !empty($_FILES['upload_csv']['tmp_name'])) {
            $csv_file = $_FILES['upload_csv']['tmp_name'];
            //print "<pre>"; print_r($_FILES); exit;
            if (is_file($csv_file)) {
                $list = getCSVFileData($csv_file, "\t");
                //print "<pre>"; print_r($list); exit;
                $created = $sql->saveDepartments($list);
                var_dump($created);
                if ($created === true) {
                    $_POST['success'] = 'Departments saved.';
                } else {
                    $_POST['danger'] = 'Something went wrong.';
                }
            }
        } else {
            $_POST['warning'] = 'No file selected.';
        }
    }
    $_GET['table'] = array(
        'table_headers' => $sql->dept_columns,
        'table_data' => $sql->getDepartmentsData()
    );
    //print "<pre>"; print_r($_GET['table']); exit;
    require_once 'views/ui_upload_departments.php';

} else {
    header('Location: index.php');
}

?>