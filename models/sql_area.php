<?php

class SQL_Area {

    function __construct() 
    {


    }

    public function getAreaList()
    {
        // TODO: get data from database
        $list = array();
        $list['01'] = array(
            'Area_Name' => '01',
            'Area_Num' => 'I',
            'Area_Desc' => 'Vision, Mission, Goals, and Objectives'
        );
        $list['02'] = array(
            'Area_Name' => '02',
            'Area_Num' => 'II',
            'Area_Desc' => 'Faculty'
        );
        $list['03'] = array(
            'Area_Name' => '03',
            'Area_Num' => 'III',
            'Area_Desc' => 'Curriculum and Instruction'
        );
        $list['04'] = array(
            'Area_Name' => '04',
            'Area_Num' => 'IV',
            'Area_Desc' => 'Support to Students'
        );
        $list['05'] = array(
            'Area_Name' => '05',
            'Area_Num' => 'V',
            'Area_Desc' => 'Research'
        );
        $list['06'] = array(
            'Area_Name' => '06',
            'Area_Num' => 'VI',
            'Area_Desc' => 'Extension and Community Involvement'
        );
        $list['07'] = array(
            'Area_Name' => '07',
            'Area_Num' => 'VII',
            'Area_Desc' => 'Library'
        );
        $list['08'] = array(
            'Area_Name' => '08',
            'Area_Num' => 'VIII',
            'Area_Desc' => 'Physical Plant and Facilities'
        );
        $list['09'] = array(
            'Area_Name' => '09',
            'Area_Num' => 'IX',
            'Area_Desc' => 'Laboratories'
        );
        $list['10'] = array(
            'Area_Name' => '10',
            'Area_Num' => 'X',
            'Area_Desc' => 'Administration'
        );

        return $list;
    }

}

?>