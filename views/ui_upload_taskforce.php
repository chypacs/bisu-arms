<?php 
    require_once 'views/header.php';
    require_once 'views/menu_settings.php';
?>

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>TASK FORCE</h2>
                <p>These are the AACCUP Task Force for BISU - Balilihan Campus.</p>
            </div>

            <?php require_once 'views/ui_alert.php' ?>

            <div class="row g-0 justify-content-center">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                    <form action="settings.php?m=taskforce" method="POST" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-9">
                                <p class="text-primary text-uppercase mb-2">Select TSV (Tab Separated Values) file to upload Task Force List</p>
                                <input type="file" name="upload_csv" accept="text/tsv" class="form-control form-control-lg" id="upload_csv" />
                            </div>
                            <div class="col-md-3 text-center">
                                <input type="hidden" name="save" value="taskforce" />
                                <button class="btn btn-primary py-4 px-5" type="save" value="taskforce">Upload</button>
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