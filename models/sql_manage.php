<?php

require_once 'models/db_connect.php';

class SQL_Manage extends DB_Connect {

    public function __construct() 
    {
        Parent::__construct();
    }

    public function getDataTitle($type='')
    {
        $list = array(
            'courses' => 'Courses',
            'officials' => 'BISU System Officials',
            'board' => 'Board of Regents',
            'faculty' => 'Teaching Staff',
            'non_teaching' => 'Non-Teaching Staff',
            'awardees' => 'Awardees & Achievers',
            'officers' => 'Batch Officers',
            'grad_song' => 'Graduation Song',
            'tribute_song' => 'Tribute Song',
            'graduates' => 'The Graduates',
        );
        $title = '';
        if (isset($list[$type])) {
            $title = $list[$type];
        }

        return $title;
    }

    public function getTableName($type='')
    {
        $list = array(
            'courses' => 'courses',
            'officials' => 'bisu_system_officials',
            'board' => 'board_of_regents',
            'faculty' => 'teaching_staff',
            'non_teaching' => 'non_teaching_staff',
            'awardees' => 'awardees_achievers',
            'officers' => 'batch_officers',
            'graduates' => 'graduates',
            'yearbooks' => 'yearbooks',
        );
        $table = '';
        if (isset($list[$type])) {
            $table = $list[$type];
        }

        return $table;
    }

    public function getDataHeaders($type='')
    {
        $columns = array();
        if ($type == 'awardees') {
            $columns = array(
                'First_Name',
                'Last_Name',
                'Award',
                'Award_Type'
            );
        } elseif ($type == 'officers') {
            $columns = array(
                'Full_Name',
                'Position'
            );
        } elseif ($type == 'courses') {
            $columns = array(
                'Course_Code',
                'Course_Name',
                'Department'
            );
        } elseif ($type == 'graduates') {
            $columns = array(
                'Course_Code',
                'Pic_File',
                'First_Name',
                'Last_Name',
                'Gender',
                'Home_Address',
            );
        } else {
            $columns = array(
                'Full_Name',
                'Position',
                'Office'
            );
        }

        return $columns;
    }

    public function getTableColumns($type='')
    {
        $columns = array();
        if ($type == 'awardees') {
            $columns = array(
                'Yearbook_Key',
                'Graduate_Key',
                'Award',
                'Award_Type'
            );
        } elseif ($type == 'officers') {
            $columns = array(
                'Yearbook_Key',
                'Full_Name',
                'Position'
            );
        } elseif ($type == 'courses') {
            $columns = array(
                'Course_Code',
                'Course_Name',
                'Department'
            );
        } elseif ($type == 'yearbooks') {
            $columns = array(
                'Batch',
                'Theme',
                'Is_Published'
            );
        } elseif ($type == 'graduates') {
            $columns = array(
                'Yearbook_Key',
                'Course_Key',
                'Pic_File',
                'First_Name',
                'Last_Name',
                'Gender',
                'Home_Address',
            );
        } else {
            $columns = array(
                'Yearbook_Key',
                'Full_Name',
                'Position',
                'Office'
            );
        }

        return $columns;
    }

    public function addTableData($type, $tbl_data)
    {
        $table = $this->getTableName($type);
        $tbl_columns = $this->getTableColumns($type);
        $data = array();
        foreach ($tbl_data as $values) {
            $row = array();
            foreach ($tbl_columns as $col) {
                $row[] = isset($values[$col]) ? $values[$col] : '';
            }
            $data[] = $row;
        }
        $res = $this->insertTableRow($table, $tbl_columns, $data);

        return $res;
    }

    public function getTableDataList($type, $yearbook_key, $primary_key)
    {
        $table = $this->getTableName($type);
        $sql = "
            SELECT *
            FROM {$table} 
            WHERE Yearbook_Key = $yearbook_key
            ORDER BY $primary_key
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getUploadedData($type, $yearbook_key) 
    {
        $data = array();
        if ($type == 'officials') {
            $data = $this->getBISUSystemOfficials($type, $yearbook_key);
        } elseif ($type == 'board') {
            $data = $this->getBoardOfRegents($type, $yearbook_key);
        } elseif ($type == 'faculty') {
            $data = $this->getTeachingStaff($type, $yearbook_key);
        } elseif ($type == 'non_teaching') {
            $data = $this->getNonTeachingStaff($type, $yearbook_key);
        } elseif ($type == 'officers') {
            $data = $this->getBatchOfficers($type, $yearbook_key);
        } elseif ($type == 'courses') {
            $data = $this->getCourses();
        } elseif ($type == 'graduates') {
            $data = $this->getGraduates($yearbook_key);
        }

        return $data;
    }

    public function getYearbookList()
    {
        $sql = "
            SELECT *
            FROM yearbooks
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getYearbookData()
    {
        $sql = "
            SELECT *
            FROM yearbooks
        ";
        $list = $this->getDataFromTable($sql);
        $data = array();
        foreach ($list as $row) {
            $data[$row['Batch']] = $row;
        }

        return $list;
    } 


    public function getCourseList()
    {
        $sql = "
            SELECT *
            FROM courses
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getCourseKey($course_code)
    {
        $sql = "
            SELECT * 
            FROM courses
            WHERE Course_Code = '{$course_code}'
            LIMIT 1
        ";
        $data = $this->getDataFromTable($sql);
        $key = 0;
        foreach ($data as $row) {
            $key = $row['Course_Key'];
        }

        return $key;
    }

    public function getCourses()
    {
        $list = $this->getCourseList();
        $data = array();
        $data['center'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $data['center'] = $list;

        return $data;
    }

    public function getGraduateList($yearbook_key)
    {
        $sql = "
            SELECT g.*, Course_Code
            FROM graduates as g
            LEFT JOIN courses as c ON g.Course_Key = c.Course_Key
            WHERE g.Yearbook_Key = $yearbook_key
            ORDER BY Course_Code, Last_Name, First_Name
        ";
        $list = $this->getDataFromTable($sql);

        return $list;
    } 

    public function getGraduates($yearbook_key)
    {
        $data = array();
        $data['table_headers'] = $this->getDataHeaders('graduates');
        $data['table_data'] = $this->getGraduateList($yearbook_key);

        return $data;
    }

    public function getBISUSystemOfficials($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Bisu_Official_Key');
        $data = array();
        $data['center'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $data['center'][] = array_shift($list);
        $half = floor((count($list)) / 2);
        $data['left'] = array_slice($list, 0, $half);
        $data['right'] = array_slice($list, $half);

        return $data;
    }

    public function getBoardOfRegents($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Board_Key');
        $data = array();
        $data['center'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $data['center'][] = array_shift($list);
        $data['center'][] = array_shift($list);
        $data['center'][] = array_shift($list);
        $half = floor((count($list)) / 2);
        $data['left'] = array_slice($list, 0, $half);
        $data['right'] = array_slice($list, $half);

        return $data;
    }

    public function getTeachingStaff($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Staff_Key');
        $data = array();
        $data['center'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $data['center'][] = array_shift($list);
        $half = floor((count($list)) / 2);
        $data['left'] = array_slice($list, 0, $half);
        $data['right'] = array_slice($list, $half);

        return $data;
    }

    public function getNonTeachingStaff($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Staff_Key');
        $data = array();
        $data['center'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $half = floor((count($list)) / 2);
        $data['left'] = array_slice($list, 0, $half);
        $data['right'] = array_slice($list, $half);

        return $data;
    }

    public function getBatchOfficers($type, $yearbook_key)
    {
        $list = $this->getTableDataList($type, $yearbook_key, 'Officer_Key');
        $data = array();
        $data['center'] = array();
        $data['bottom'] = array();
        $data['left'] = array();
        $data['right'] = array();
        $data['center'][] = array_shift($list);
        $data['bottom'][] = array_pop($list);
        $half = floor((count($list)) / 2);
        $data['left'] = array_slice($list, 0, $half);
        $data['right'] = array_slice($list, $half);

        return $data;
    }

}

?>