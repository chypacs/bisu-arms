<?php

require_once 'models/db_connect.php';

class SQL_Area extends DB_Connect {

    public $tbl_columns = array(
        'Area_Code',
        'Area_Name',
        'Area_Desc',
    );

    function __construct() 
    {
        Parent::__construct();
    }

    public function getAreaKey($area_code)
    {
        $sql = "
            SELECT * 
            FROM areas
            WHERE Area_Code = '{$area_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Area_Key'];
        }

        return $key;
    }

    public function getAreaInfo($area_key)
    {
        $sql = "
            SELECT * 
            FROM areas
            WHERE Area_Key = {$area_key}
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getAreasData()
    {
        $sql = "
            SELECT *
            FROM areas
            ORDER BY Area_Code, Area_Name
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveAreas($input)
    {
        $table = 'areas';
        $columns = $this->tbl_columns;
        $data = array();
        foreach ($input as $values) {
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        //print "<pre>"; print_r($data); print_r($columns);
        $res = $this->insertTableRow($table, $columns, $data);

        return $res;
    }


}

?>