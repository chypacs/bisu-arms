
<header id="header">
    <div class="d-flex flex-column">

        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li>
                    <a href="index.php?m=home" class="nav-link
                        <?php if ($_GET['m'] == 'home'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bx bx-home"></i> <span>Home</span>
                    </a>
                </li>
                <?php if ($_SESSION['logged'] == 'guest'): ?>
                    <li>
                        <a href="index.php?m=login" class="nav-link">
                            <i class="bi bi-box-arrow-in-left"></i> <span>Login</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="index.php?m=logout" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i> <span>Logout</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ($_SESSION['logged'] == ADMIN_USERNAME): ?>
                    <li>
                        <a href="settings.php" class="nav-link
                            <?php if ($_GET['m'] == 'settings'): ?>
                                active
                            <?php endif; ?>
                        ">
                        <i class="bi bi-gear-fill"></i> <span>Settings</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php foreach ($_SESSION['area_list'] as $area): ?>    
                    <li>
                        <a href="index.php?m=area&akey=<?php echo $area['Area_Key'] ?>" class="nav-link">
                        <i class="bx bx-folder"></i> <span>Area <?php echo $area['Area_Code'] ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->