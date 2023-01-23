<?php


function logout()
{
    unset($_SESSION['logged']);
    $_SESSION['logged'] = 'guest';
    require_once 'views/ui_home.php';
    exit;

}

function hashPassword($pwd)
{
    $hashed = md5('bisu-bc-arms_'.$pwd);

    return $hashed;
}

function getCSVFileData($file, $separator=",") 
{
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        $line = trim(fgets($fd));
        $headers = explode($separator, $line);
        while (!feof($fd)) {
            $line = trim(fgets($fd));
            if (empty($line)) continue;
            $token = explode($separator, $line);
            $row = array();
            foreach ($headers as $i => $header) {
                $row[$header] = $token[$i];
            }
            $data[] = $row;
        }
        fclose($fd);
    }

    return $data;
}

function getFoldersFromDir($path) 
{
    $files = scandir($path);
    $folders = array();
    foreach($files as $file) {
        if ($file == '.' || $file == '..') continue;
        if (is_dir($path.'/'.$file)) {
            $folders[] = $file;
        }
    }

    return $folders;
}

function getImagesFromDir($path) 
{
    $files = scandir($path);
    $images = array();
    foreach($files as $file) {
        $fpath = $path.'/'.$file;
        if (is_file($fpath)) {
            $type = mime_content_type($fpath);
            if (preg_match('/^image/', $type)) {
                $base_fn = preg_replace('/\..+$/', '', $file);
                $images[$base_fn] = dirname($fpath).'/'.$file;
            }
        }
    }

    return $images;
}

function getFolderStructure($file, $separator=",")
{
    
    $data = array();
    if (is_file($file)) {
        $fd = fopen($file, "r");
        if ($fd == null) {
            die("Command 'fopen' failed for $file.");
        }
        $line = trim(fgets($fd));
        //$headers = explode($separator, $line);
        while (!feof($fd)) {
            $line = fgets($fd);
            if (empty($line)) continue;
            $token = explode($separator, $line);
            # Area Code
            $area_code = array_shift($token);
            $area_code = trim($area_code);
            if (!empty($area_code)) {
                $area_code_cur = $area_code;
            }
            # Parameter Code
            $param_code = array_shift($token);
            $param_code = trim($param_code);
            if (!empty($param_code)) {
                $param_code_cur = $param_code;
            }
            # Main Folder
            $main_folder = array_shift($token);
            $main_folder = trim($main_folder);
            if (!empty($main_folder)) {
                $main_folder_cur = $main_folder;
            }

            $data[$area_code_cur][$param_code_cur][$main_folder_cur][] = $token;
        }
        fclose($fd);
    }

    return $data;
}

function createDir($dir)
{
    if (!is_dir($dir)) {
        $ret = mkdir($dir);
        if (!$ret) {
            //print "<pre>$dir\n";
        }
    }
}

/**
 * 
 * @function recursive_scan
 * @description Recursively scans a folder and its child folders
 * @param $path :: Path of the folder/file
 * 
 * */
function recursive_scan($path)
{
    global $FILE_LIST;
    $path = rtrim($path, '/');
    if (!is_dir($path)) {
        $FILE_LIST[] = $path;
    } else {
        $files = scandir($path);
        foreach($files as $file) {
            if ($file != '.' && $file != '..') {
                recursive_scan($path . '/' . $file);
            }
        }
    }
}

?>