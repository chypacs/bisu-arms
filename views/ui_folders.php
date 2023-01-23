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
        <h2>
          Area <?php echo $_POST['area']['Area_Code'] ?> > <?php echo $_POST['level']['Level_Desc'] ?>
        </h2>
        <p class="h5 pb-2"> 
            <?php echo $_SESSION['departments'][$_GET['dept']] ?>
        </p>
        <p><b><?php echo $_POST['area']['Area_Desc'] ?></b></p>
      </div>

      <?php require_once 'views/ui_alert.php' ?>

      <div class="row g-0 justify-content-center">
          <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
              <form action="index.php?m=level&lkey=<?php echo $_GET['lkey'] ?>&akey=<?php echo $_GET['akey'] ?>&dept=<?php echo $_GET['dept'] ?>" method="POST" enctype="multipart/form-data">
                  <div class="row g-3">
                      <div class="col-12">
                        <select class="form-control selectpicker"  id="academic_yr" name="academic_yr">
                            <?php foreach ($_SESSION['academic_year_list'] as $academic_yr) : ?>
                                <option value="<?php echo $academic_yr ?>"><?php echo $academic_yr ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="academic_yr">Academic Year</label>
                      </div>
                      <div class="col-md-3 text-center">
                          <input type="hidden" name="create" value="ay_folders" />
                          <button class="btn btn-primary py-4 px-5" type="submit" name="create" value="ay_folders">View Files</button>
                      </div>
                  </div>
              </form>
          </div>
          
          <div style="padding-top:30px">
              <?php
                  require_once 'views/tpl_tree.php';
              ?>
          </div>
      </div>

    </div>
  </section>
    
</main><!-- End #main -->';

<?php 
    require_once 'views/footer.php';
?>        