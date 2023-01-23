<?php

  $html = '
    <main id="main">

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
          <div class="container">
            <div class="section-title">
              <h2>AREA ' . $_SESSION['area_info']['Area_Num'] . '</h2>
              <p><b>' . $_SESSION['area_info']['Area_Desc'] . '</b></p>
            </div>

            <div class="row" data-aos="fade-up">
              <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">';

  $levels = $_SESSION['level_list'];
  foreach ($levels as $key => $level) {
      $html .= '<li data-filter=".filter-level' . $key . '">' . $level['Level_Name']. '</li>';

  }

  $html .= '    </ul>
              </div>
            </div>';

  echo $html;

