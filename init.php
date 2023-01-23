<?php

require_once 'models/sql_area.php';
$sql_area = new SQL_Area;
$_SESSION['area_list'] = $sql_area->getAreasData();

require_once 'models/sql_level.php';
$sql_level = new SQL_Level;
$_SESSION['level_list'] = $sql_level->getLevelsList();
$_SESSION['area_levels'] = $sql_level->getLevelsData();
$_SESSION['departments'] = $sql_level->getDepartmentsData();



?>