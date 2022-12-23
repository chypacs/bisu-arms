<?php

class SQL_Programs {

    function __construct() 
    {


    }

    public function getAllFolders(){
        $data = array(
            array(
                'folder_key' => 1,
                'folder_name' => 'Folder 1',
                'created_at' => '2022-12-23'
            ),
            array(
                'folder_key' => 2,
                'folder_name' => 'Folder 2',
                'created_at' => '2022-12-23'
            ),
            array(
                'folder_key' => 3,
                'folder_name' => 'Folder 3',
                'created_at' => '2022-12-23'
            ),
            array(
                'folder_key' => 4,
                'folder_name' => 'Folder 4',
                'created_at' => '2022-12-23'
            )
        );
        return $data;
    }

}

?>