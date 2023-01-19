<?php
    $html ='
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">';

    $area = $_SESSION['selected_area'];
    $programs = $_SESSION['programs'];
    foreach ($programs as $level_key => $level_programs) {
        $level = $_SESSION['level_list'][$level_key]['Level_Name'];
        foreach ($level_programs as $program_key => $program) {
            $program = $programs[$level_key][$program_key]['Program_Name'];
            $title = "AREA "  . $_SESSION['area_info']['Area_Name']." > ". $level. " > ".$program;
            $url = 'area='.$area.'&level_key='.$level_key.'&program_key='.$program_key;
            $html .= '
                <div class="col-lg-4 col-md-6 portfolio-item filter-level' . $level_key . '">
                    <div class="portfolio-wrap">
                        <img src="assets/img/programs/'.$level_key.'program-' . $program_key . '.png" class="img-fluid" alt="">
                        <div class="portfolio-links">
                        <a href="assets/img/programs/'.$level_key.'program-' . $program_key . '.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="'.$title.'"><i class="bx bx-info-circle"></i></a>
                        <a href="index.php?' . $url . '" title="More Details"><i class="bx bx-link"></i></a>
                        </div>
                    </div>
                </div>';
        }
    }
    

    $html .='
            </div>
    
        </div>
        </section><!-- End Portfolio Section -->

      </main><!-- End #main -->';

    echo $html;

?>