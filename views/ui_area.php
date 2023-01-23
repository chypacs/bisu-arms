<?php 
    require_once 'views/header.php';
    require_once 'views/menu.php';

    //print "<pre>"; print_r($_SESSION);
    //print "<pre>"; print_r($_POST); exit;
?>

<main id="main">

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio section-bg">
    <div class="container">
      
      <div class="section-title">
        <h2>AREA <?php echo $_POST['area']['Area_Code'] ?></h2>
        <p><b><?php echo $_POST['area']['Area_Desc'] ?></b></p>
      </div>

      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <?php foreach ($_SESSION['level_list'] as $level): ?>
              <li data-filter=".filter-level<?php echo $level['Level_Code'] ?>"><?php echo $level['Level_Desc'] ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
        <?php foreach ($_POST['area_levels'] as $area_level): ?>
          <?php foreach ($_SESSION['departments'] as $dept_code => $dept_name): ?>
            <?php $title = "AREA {$area_level['Area_Code']} > {$area_level['Level_Desc']} >  {$dept_name}" ?>
            <div class="col-lg-4 col-md-6 portfolio-item filter-level<?php echo $area_level['Level_Code'] ?>">
              <div class="portfolio-wrap">
                  <img src="assets/img/levels/<?php echo $dept_code ?>_<?php echo $area_level['Level_Code'] ?>.png" class="img-fluid" alt="">
                  <div class="portfolio-links">
                    <a href="assets/img/levels/<?php echo $dept_code ?>_<?php echo $area_level['Level_Code'] ?>.png" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $title ?>"><i class="bx bx-info-circle"></i></a>
                    <a href="index.php?m=level&lkey=<?php echo $area_level['Level_Key'] ?>&akey=<?php echo $_GET['akey'] ?>&dept=<?php echo $dept_code ?>" 
                        target="_blank" title="Click Here!">
                      <i class="bx bx-link"></i>
                    </a>
                  </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>

    </div>
  </section>
    
</main><!-- End #main -->';

<?php 
    require_once 'views/footer.php';
?>        