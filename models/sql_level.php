<?php

require_once 'models/db_connect.php';

class SQL_Level extends DB_Connect {

    public $levels_tbl_fields = array(
        'Area_Key',
        'Level_Code',
        'Level_Desc',
    );

    public $levels_columns = array(
        'Area_Code',
        'Level_Code',
        'Level_Desc',
    );

    public $dept_tbl_fields = array(
        'Department_Code',
        'Department_Name',
    );

    public $dept_columns = array(
        'Department_Code',
        'Department_Name',
    );

    function __construct() 
    {
        Parent::__construct();
        
        require_once 'models/sql_area.php';
        $this->area_sql = new SQL_Area;
    }

    public function getLevelKey($area_key, $level_code)
    {
        $sql = "
            SELECT * 
            FROM levels
            WHERE Area_Key = {$area_key}
                AND Level_Code = '{$level_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Level_Key'];
        }

        return $key;
    }

    public function getLevelInfoFromKey($level_key)
    {
        $sql = "
            SELECT * 
            FROM levels
            WHERE Level_Key = {$level_key}
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getAreaInfoFromCode($level_code)
    {
        $sql = "
            SELECT * 
            FROM levels
            WHERE Level_Code = '{$level_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getLevelsList()
    {
        $sql = "
            SELECT distinct Level_Code, Level_Desc
            FROM levels
            ORDER BY Level_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getAreaLevelsData($area_key)
    {
        $sql = "
            SELECT *
            FROM levels as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            WHERE t1.Area_Key = {$area_key}
            ORDER BY Area_Code, Level_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function getLevelsData()
    {
        $sql = "
            SELECT *
            FROM levels as t1
            LEFT JOIN areas as t2 
                ON t1.Area_Key = t2.Area_Key
            ORDER BY Area_Code, Level_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveLevels($input)
    {
        $table = 'levels';
        $columns = $this->levels_tbl_fields;
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

    public function getDepartmentKey($dept_code)
    {
        $sql = "
            SELECT * 
            FROM departments
            WHERE Department_Code = '{$dept_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Department_Key'];
        }

        return $key;
    }

    public function getDepartmentList()
    {
        $data = $this->getDepartmentsData();
        $list = array();
        foreach ($data as $row) {
            $list[$row['Department_Code']] = $row['Department_Name'];
        }

        return $list;
    }

    public function getDepartmentInfoFromCode($dept_code)
    {
        $sql = "
            SELECT * 
            FROM departments
            WHERE Department_Code = '{$dept_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $info = empty($data) ? array() : $data[0];

        return $info;
    }

    public function getDepartmentsData()
    {
        $sql = "
            SELECT *
            FROM departments
            ORDER BY Department_Code
        ";
        $data = $this->getDataFromTable($sql);

        return $data;
    }

    public function saveDepartments($input)
    {
        $table = 'departments';
        $columns = $this->dept_tbl_fields;
        $data = array();
        foreach ($input as $values) {
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