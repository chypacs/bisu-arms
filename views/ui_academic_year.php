<?php 
    require_once 'views/header.php';
    require_once 'views/menu_settings.php';
?>

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>ACADEMIC YEAR</h2>
                <p>Pre-create default folders for the specified Academic Year.</p>
            </div>

            <?php require_once 'views/ui_alert.php' ?>

            <div class="row g-0 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <form action="settings.php?m=academic_yr" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="academic_yr" name="academic_yr" placeholder="Course Code">
                                    <label for="academic_yr">Academic Year (e.g 2022-2023)</label>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <p class="text-primary text-uppercase mb-2">Select TSV (Tab Separated Values) file containing the folder structure</p>
                                <input type="file" name="upload_csv" accept="text/tsv" class="form-control form-control-lg" id="upload_csv" />
                            </div>
                            <div class="col-md-3 text-center">
                                <input type="hidden" name="create" value="ay_folders" />
                                <button class="btn btn-primary py-4 px-5" type="submit" name="create" value="ay_folders">Create Folders</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div style="padding-top:30px">
                    <?php
                        require_once 'views/tpl_table.php';
                    ?>
                </div>
            </div>            

        </div>
    </section>

</main><!-- End #main -->';

<?php 
    require_once 'views/footer.php';
?>        