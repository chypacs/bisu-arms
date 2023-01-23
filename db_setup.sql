-- CREATE database bisu_ybook;
-- USE bisu_ybook;

--
-- Table structure for table courses
--
CREATE TABLE areas (
  Area_Key int(10) unsigned NOT NULL auto_increment,
  Area_Code char(10) NOT NULL,
  Area_Name char(100) NOT NULL,
  Area_Desc char(255) NOT NULL,
  PRIMARY KEY  (Area_Key),
  UNIQUE KEY tbl_unique (Area_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table task_force
--
CREATE TABLE task_force (
  Task_Force_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  First_Name char(100) NOT NULL,
  Last_Name char(100) NOT NULL,
  Is_Coordinator int(1) NOT NULL Default 0,
  Email char(100) NOT NULL,
  User_Name char(100) NOT NULL,
  Pass_Word char(32) NOT NULL,
  PRIMARY KEY  (Task_Force_Key),
  UNIQUE KEY tbl_unique (Area_Key,User_Name)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table parameters
--
CREATE TABLE parameters (
  Parameter_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  Parameter_Code char(1) NOT NULL,
  Parameter_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Parameter_Key),
  UNIQUE KEY tbl_unique (Area_Key, Parameter_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table folders
--
CREATE TABLE folders (
  Folder_Key int(10) unsigned NOT NULL auto_increment,
  Parameter_Key int(10) NOT NULL,
  Indicator_Code char(10) NOT NULL,
  Folder_Code char(20) NOT NULL,
  Folder_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Folder_Key),
  UNIQUE KEY tbl_unique (Parameter_Key, Folder_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table levels
--
CREATE TABLE levels (
  Level_Key int(10) unsigned NOT NULL auto_increment,
  Area_Key int(10) NOT NULL,
  Level_Code char(10) NOT NULL,
  Level_Desc varchar(255) NOT NULL,
  PRIMARY KEY  (Level_Key),
  UNIQUE KEY tbl_unique (Area_Key, Level_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table departments
--
CREATE TABLE departments (
  Department_Key int(10) unsigned NOT NULL auto_increment,
  Department_Code char(10) NOT NULL,
  Department_Name varchar(255) NOT NULL,
  PRIMARY KEY  (Department_Key),
  UNIQUE KEY tbl_unique (Department_Code)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------


-- CREATE user 'bisu'@'localhost' identified by 'B!su';
-- GRANT ALL PRIVILEGES ON bisu_arms.* TO 'bisu'@'localhost';
-- FLUSH PRIVILEGES;