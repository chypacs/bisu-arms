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

    public function createDefaultFoldersForAY($academic_yr, $structure)
    {
        $this->academic_yr = $academic_yr;
        $this->createMainFolders($structure);

        print "<pre>";
        print_r($this->folder_dirs);
        die();
    }

    public function createMainFolders($structure) 
    {
        $folders = array();
        $path = AACCUP_FILES;
        foreach ($structure as $area_code => $param_list) {
            # Level > Area > Department > AcademicYear > Area folders
            $this->createAreaLevelFolders($area_code);
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
                            $this->folder_dirs = array();        
                            foreach ($this->param_dirs as $param_dir) {
                                # Main Folder
                                $main_dir = $param_dir.'/'.$folder;
                                //print "<pre>Main: $main_dir\n";
                                createDir($main_dir);
                                if (is_dir($main_dir)) {
                                    $this->folder_dirs[$main_dir] = $subfolders;
                                    print "<pre>Sub-folders: $main_dir\n";
                                    print_r($subfolders);
                                }
                            }
                        }
                        exit;
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

        # Create Level > Department > AY > Area folders
        $this->area_dirs = array();
        foreach ($area_levels as $level) {
            foreach ($departments as $dept) {
                $path = AACCUP_FILES;
                # Level folder
                $level_dir = $path.'/LEVEL-'.$level['Level_Code'];
                //print "<pre>Level: $level_dir\n";
                createDir($level_dir);
                if (is_dir($level_dir)) {
                    # Department Folder
                    $dept_dir = $level_dir.'/'.$dept['Department_Code'];
                    //print "<pre>Dept: $dept_dir\n";
                    createDir($dept_dir);
                    if (is_dir($dept_dir)) {
                        # Academic Year Folder
                        $ay_dir = $dept_dir.'/AY-'.$this->academic_yr;
                        //print "<pre>AY: $ay_dir\n";
                        createDir($ay_dir);
                        if (is_dir($ay_dir)) {
                            # Area Folder
                            $area_dir = $ay_dir.'/AREA-'.$level['Area_Code'];
                            //print "<pre>Area: $area_dir\n";
                            createDir($area_dir);
                            if (is_dir($area_dir)) {
                                $this->area_dirs[] = $area_dir;
                            }
                        }
                    }
                }
            }
        }
    }

}

?>