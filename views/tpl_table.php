
<?php if (isset($_GET['table'])) : ?>
    <div class="container">
        <?php if (isset($_GET['table']['table_title']) &&  $_GET['table']['table_title'] != '') : ?>
            <h2><?php echo $_GET['table']['table_title'] ?></h2>
        <?php endif; ?>
        <?php if (isset($_GET['table']['table_info']) &&  $_GET['table']['table_info'] != '') : ?>
            <p><?php echo $_GET['table']['table_info'] ?></p>
        <?php endif; ?>          
        <table class="table">
            <thead>
                <tr>
                    <?php foreach ($_GET['table']['table_headers'] as $header) : ?>
                        <th><?php echo $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($_GET['table']['table_data'] as $rows) : ?>
                    <tr>
                        <?php foreach ($_GET['table']['table_headers'] as $col) : ?>
                            <td><?php echo $rows[$col] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>