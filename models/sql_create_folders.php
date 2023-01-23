<?php

require_once 'models/db_connect.php';

class SQL_Create_Folders extends DB_Connect {

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_folders.php';
        $this->folder_sql = new SQL_Folders;
        require_once 'models/sql_area.php';
        $this->area_sql = new SQL_Area;
        require_once 'models/sql_level.php';
        $this->level_sql = new SQL_Level;

        $this->area_dirs = array();
        $this->param_dirs = array();
        $this->folder_dirs = array();        
    }

    public function getAcademicYearList()
    {

    }

    public function createDefaultFoldersForAY($academic_yr, $structure)
    {
        print_r($structure);
        exit;
        $this->academic_yr = $academic_yr;
        $this->createMainFolders($structure);
    }

    public function createMainFolders($structure) 
    {
        $folders = array();
        $path = AACCUP_FILES;
        foreach ($structure as $area_code => $param_list) {
            # AcademicYear > Level > Area > Department > Area folders
            $this->createAreaLevelFolders($area_code);
            print "<pre>$area_code\n"; continue;
            //print "<pre>"; print_r($this->area_dirs); print_r($param_list);  exit;
            if (!empty($this->area_dirs)) {
                foreach ($param_list as $param_code => $folder_list) {
                    $this->param_dirs = array();
                    foreach ($this->area_dirs as $area_dir) {
                        # Parameter Folder
                        $param_dir = $area_dir.'/Param'.$param_code;
                        //print "<pre>Param: $param_dir\n";
                        createDir($param_dir);
                        if (is_dir($param_dir)) {
                            $this->param_dirs[] = $param_dir;
                        }
                    }
                    if (!empty($this->param_dirs)) {
                        foreach ($folder_list as $folder => $subfolders) {                
                            $folder = trim($folder);
                            $folder = preg_replace("/\.$/", '', $folder);
                            $this->folder_dirs = array();        
                            foreach ($this->param_dirs as $param_dir) {
                                # Main Folder
                                $main_dir = $param_dir.'/'.$folder;
                                //print "<pre>Main: $main_dir\n";
                                createDir($main_dir);
                                if (is_dir($main_dir)) {
                                    $sub1_dir = '';
                                    $base_dir = $main_dir;
                                    foreach ($subfolders as $sub) {
                                        $sub[0] = trim($sub[0]);
                                        $sub[0] = preg_replace("/\.$/", '', $sub[0]);
                                        $sub[1] = trim($sub[1]);
                                        $sub[1] = preg_replace("/\.$/", '', $sub[1]);
                                        # First level sub-folder
                                        if (!empty($sub[0])) {
                                            $sub1_dir = $main_dir.'/'.$sub[0];
                                            //print "<pre>Sub1 Dir: $sub1_dir\n";
                                            createDir($sub1_dir);
                                            if (is_dir($sub1_dir)) {
                                                $base_dir = $sub1_dir;
                                                $this->folder_dirs[] = $sub1_dir;  
                                            }
                                        } elseif (!empty($sub1_dir)) {
                                            $base_dir = $sub1_dir;
                                        }

                                        # Second level sub-folder                                
                                        if (!empty($sub[1])) {
                                            $sub2_dir = $base_dir.'/'.$sub[1];
                                            //print "<pre>Sub2 Dir: $sub2_dir\n";
                                            createDir($sub2_dir);
                                            if (is_dir($sub2_dir)) {
                                                $this->folder_dirs[] = $sub2_dir;  
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function createAreaLevelFolders($area_code)
    {
        $departments = $this->level_sql->getDepartmentsData();
        $area = $this->area_sql->getAreaInfoFromAreaCode($area_code);
        $area_levels = $this->level_sql->getAreaLevelsData($area['Area_Key']);

        $path = AACCUP_FILES;
        # Academic Year Folder
        $ay_dir = $path.'/AY-'.$this->academic_yr;
        print "<pre>AY: $ay_dir\n";
        createDir($ay_dir);
        # Create AY > Level > Department > Area folders
        $this->area_dirs = array();
        foreach ($area_levels as $level) {
            foreach ($departments as $dept) {
                if (is_dir($ay_dir)) {
                    # Level folder
                    $level_dir = $ay_dir.'/LEVEL-'.$level['Level_Code'];
                    print "<pre>Level: $level_dir\n";
                    createDir($level_dir);
                    if (is_dir($level_dir)) {
                        # Department Folder
                        $dept_dir = $level_dir.'/'.$dept['Department_Code'];
                        print "<pre>Dept: $dept_dir\n";
                        createDir($dept_dir);
                        if (is_dir($dept_dir)) {
                            # Area Folder
                            $area_dir = $dept_dir.'/AREA-'.$level['Area_Code'];
                            print "<pre>Area: $area_dir\n";
                            createDir($area_dir);
                            if (is_dir($area_dir)) {
                                $this->area_dirs[] = $area_dir;
                                exit;
                            }
                        }
                    }
                }
            }
        }
    }

}

?>