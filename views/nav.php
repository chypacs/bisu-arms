<?php

    $html = '
        <header id="header">
            <div class="d-flex flex-column">

            <nav id="navbar" class="nav-menu navbar">
                <ul>
    ';
    
    $area_list = $_SESSION['area_list'];
    $selected_area = $_SESSION['selected_area'];

    print $selected_area;
    $active = ($selected_area == 'home') ? ' active' : '';
    $html .= '<li><a href="index.php?area=home" class="nav-link'.$active.'"><i class="bx bx-home"></i> <span>Home</span></a></li>';
    foreach ($area_list as $area) {
        $active = ($selected_area == $area['Area_Name']) ? ' active' : '';
        $html .= '<li><a href="index.php?area='.$area['Area_Name'].'" class="nav-link'.$active.'">'."\n";
        $html .= '  <i class="bx bx-folder"></i> '."\n";
        $html .= '  <span>Area '.$area['Area_Name'].'</span>'."\n";
        $html .= '</a></li>'."\n";
    }

    $html .= '
                </ul>
            </nav><!-- .nav-menu -->
            </div>
        </header><!-- End Header -->
    ';

    echo $html;

?>

  