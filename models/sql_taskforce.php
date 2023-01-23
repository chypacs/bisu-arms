<?php

require_once 'models/db_connect.php';

class SQL_TaskForce extends DB_Connect {

    public $db_tbl_fields = array(
        'Area_Key',
        'First_Name',
        'Last_Name',
        'Is_Coordinator',
        'Email',
        'User_Name',
        'Pass_Word',
    );

    public $tbl_columns = array(
        'Area_Code',
        'User_Name',
        'Last_Name',
        'First_Name',
        'Email',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_area.php';
        $this->area_sql = new SQL_Area;
    }

    public function getTaskForceData()
    {
        $sql = "
            SELECT *
            FROM task_force as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            ORDER BY Area_Code, Area_Name, Last_Name, First_Name
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveTaskForce($input)
    {
        $table = 'task_force';
        $columns = $this->db_tbl_fields;
        $data = array();
        foreach ($input as $values) {
            $values['Area_Key'] = $this->area_sql->getAreaKey($values['Area_Code']);
            $values['Pass_Word'] = hashPassword($values['Pass_Word']);
            $values['Is_Coordinator'] = intval($values['Is_Coordinator']);
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