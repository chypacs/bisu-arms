
<header id="header">
    <div class="d-flex flex-column">

        <nav id="navbar" class="nav-menu navbar">
            <ul>
                <li>
                    <a href="index.php?m=login" class="nav-link">
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
                <li>
                    <a href="settings.php?m=academic_yr" class="nav-link 
                        <?php if ($_GET['m'] == 'academic_yr'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-calendar-fill"></i> <span>Academic Year</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=areas" class="nav-link 
                        <?php if ($_GET['m'] == 'areas'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-card-checklist"></i> <span>Areas</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=levels" class="nav-link 
                        <?php if ($_GET['m'] == 'levels'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-bar-chart-fill"></i> <span>Levels</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=departments" class="nav-link 
                        <?php if ($_GET['m'] == 'departments'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-box-fill"></i> <span>Departments</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=taskforce" class="nav-link 
                        <?php if ($_GET['m'] == 'taskforce'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-people-fill"></i> <span>Task Force</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=indicators" class="nav-link 
                        <?php if ($_GET['m'] == 'indicators'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-basket-fill"></i> <span>Indicators</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=parameters" class="nav-link 
                        <?php if ($_GET['m'] == 'parameters'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bi bi-menu-button-wide-fill"></i> <span>Parameters</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php?m=folders" class="nav-link 
                        <?php if ($_GET['m'] == 'folders'): ?>
                            active
                        <?php endif; ?>
                    ">
                        <i class="bx bx-folder"></i> <span>Default Folders</span>
                    </a>
                </li>
            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->