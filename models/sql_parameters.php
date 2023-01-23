<?php

require_once 'models/db_connect.php';

class SQL_Parameters extends DB_Connect {

    public $indicator_list = array(
        'SIP' => SIP,
        'IMP' => IMP ,
        'OUT' => OUT,
    );

    public $db_tbl_fields = array(
        'Area_Key',
        'Parameter_Code',
        'Parameter_Desc',
    );

    public $tbl_columns = array(
        'Area_Code',
        'Parameter_Code',
        'Parameter_Desc',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_area.php';
        $this->area_sql = new SQL_Area;
    }

    public function getParameterKey($area_key, $parameter_code)
    {
        $sql = "
            SELECT * 
            FROM parameters
            WHERE Area_Key = {$area_key}
                AND Parameter_Code = '{$parameter_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Parameter_Key'];
        }

        return $key;
    }

    public function getParametersData()
    {
        $sql = "
            SELECT *
            FROM parameters as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            ORDER BY Area_Code, Area_Name, Parameter_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveParameters($input)
    {
        $table = 'parameters';
        $columns = $this->db_tbl_fields;
        $data = array();
        foreach ($input as $values) {
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $row = array();
            foreach ($columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        //print "<pre>"; print_r($input); print_r($data); print_r($columns);
        $res = $this->insertTableRow($table, $columns, $data);

        return $res;
    }


}

?>