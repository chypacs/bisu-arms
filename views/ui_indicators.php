<?php 
    require_once 'views/header.php';
    require_once 'views/menu_settings.php';
?>

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>INDICATORS</h2>
                <p>These are the AACCUP Indicators.</p>
            </div>

            <?php require_once 'views/ui_alert.php' ?>

            <div class="row g-0 justify-content-center">                
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