<?php

class SQL_Level {

    function __construct() 
    {


    }

    public function getAreaLevelList($area)
    {
        // TODO: get data from database based from passed $area
        $list = array();
        $list[1] = array(
            'Level_Name' => 'PSV',
        );
        $list[2] = array(
            'Level_Name' => 'Level I',
        );
        $list[3] = array(
            'Level_Name' => 'Level II',
        );
        $list[4] = array(
            'Level_Name' => 'Level III',
        );


        return $list;
    }

    public function getAreaLevelPrograms($area)
    {
        // TODO: get data from database based from passed $area
        $programs = array();
        $list = array();
        $list[1] = array(
            'Program_Code' => 'BSIT',
            'Program_Name' => 'Bachelor of Science in Information Technology'
        );
        $list[2] = array(
            'Program_Code' => 'BSCS',
            'Program_Name' => 'Bachelor of Science in Computer Science'
        );
        $list[3] = array(
            'Program_Code' => 'BSIT-FPSM',
            'Program_Name' => 'Bachelor of Science in Industrial Technology - Major in Food Preparation and Service Management'
        );
        $list[4] = array(
            'Program_Code' => 'BS-ELEX',
            'Program_Name' => 'Bachelor of Science in Electronics Technology'
        );
        $list[5] = array(
            'Program_Code' => 'BS-ELEC',
            'Program_Name' => 'Bachelor of Science in Electrical Technology'
        );
        $programs[1] = $list;
        $programs[2] = $list;
        $programs[3] = $list;
        $programs[4] = $list;
        return $programs;
    }

}

?>