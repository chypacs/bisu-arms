<?php

require_once 'models/db_connect.php';

class SQL_Folders extends DB_Connect {

    public $db_tbl_fields = array(
        'Parameter_Key',
        'Indicator_Code',
        'Folder_Code',
        'Folder_Desc',
    );

    public $tbl_columns = array(
        'Area_Code',
        'Parameter_Code',
        'Indicator_Code',
        'Folder_Code',
        'Folder_Desc',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_area.php';
        $this->area_sql = new SQL_Area;
    
        require_once 'models/sql_parameters.php';
        $this->parameter_sql = new SQL_Parameters;
    }

    public function getFoldersData()
    {
        $sql = "
            SELECT *
            FROM folders as t1
            LEFT JOIN parameters as t2
                ON t1.Parameter_Key = t2.Parameter_Key
            LEFT JOIN areas as t3
                ON t2.Area_Key = t3.Area_Key
            ORDER BY Area_Code, Parameter_Code, Folder_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveFolders($input)
    {
        $table = 'folders';
        $columns = $this->db_tbl_fields;
        $data = array();
        foreach ($input as $values) {
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $values['Parameter_Key'] = $this->parameter_sql->getParameterKey($values['Area_Key'], $values['Parameter_Code']);
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