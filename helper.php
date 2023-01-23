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

?>