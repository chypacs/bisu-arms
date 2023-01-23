<?php

require_once 'models/sql_area.php';
$sql_area = new SQL_Area;
$_SESSION['area_list'] = $sql_area->getAreasData();

require_once 'models/sql_level.php';
$sql_level = new SQL_Level;
$_SESSION['level_list'] = $sql_level->getLevelsList();
$_SESSION['departments'] = $sql_level->getDepartmentList();


require_once 'models/sql_create_folders.php';
$sql_folder = new SQL_Create_Folders;
//$_SESSION['academic_year_list'] = $sql_folder->getAcademicYearList();
$_SESSION['academic_year_list'] = array(
    '2020-2021',
    '2021-2022',
    '2022-2023',
);

?>