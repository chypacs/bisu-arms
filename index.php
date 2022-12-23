<?php
    session_start();
 
    include 'views/header.php';

    require 'models/sql_area.php';
    $sql_area = new SQL_Area;
    $_SESSION['area_list'] = $sql_area->getAreaList();
    $selected_area = (!isset($_GET['area']) || empty($_GET['area'])) ? 'home' : trim($_GET['area']);
    if (!isset($_SESSION['area_list'][$selected_area])) {
        $selected_area = 'home';
    }
    $_SESSION['selected_area'] = $selected_area;
    include 'views/nav.php';
    
        if(isset($_GET['area']) && isset($_GET['level_key']) && isset($_GET['program_key'])){
            include 'views/ui_program.php';
            
        }
        else{
            if ($selected_area != 'home') {
                require 'models/sql_level.php';
                $sql_level = new SQL_Level;
                $_SESSION['level_list'] = $sql_level->getAreaLevelList($selected_area);
                $_SESSION['programs'] = $sql_level->getAreaLevelPrograms($selected_area);
                $details = $_SESSION['area_list'][$selected_area];
                $_SESSION['area_info'] = $details;
                include 'views/ui_area.php';  
                include 'views/ui_level.php';

                
          
            } else {   
                include 'views/home.php';
            }
        }



    include 'views/footer.php';

?>