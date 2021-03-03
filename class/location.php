<?php
include_once 'class/dbconn.php';

class location extends dbconn
{
    public $id;
    public $name;
    public $distance;
    public $is_available;
    public $conn;
    public $loc = array();
    public $location_arr = array();

    public function __construct()
    {
        $obj = new dbconn();
        $conn = $obj->connect();
        $this->conn = $conn;
    }


    function locations()
    {
        $sql = "SELECT * FROM tbl_location";
        $res = $this->conn->query($sql);

        if ($res->num_rows > 0) {
            $i = 0;
            while ($row = $res->fetch_assoc()) {
                $loc[$i] = $row;
                ++$i;
            }
        }
        return  $loc;
    }




    public function alluser()
    {
        $sql = "SELECT * from tbl_user";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->ride_arr[$i] = $row;
                ++$i;
            }
            return $this->ride_arr;
        }
    }
    public function locationGet()
    {
        $SQL = "SELECT * FROM `tbl_location`";
        $result = $this->conn->query($SQL);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $location_arr[$i] = $row;
                ++$i;
            }
        }
        return $location_arr;
    }


    public function addlocation($select1, $select2)
    {
        $SQL = "INSERT INTO `tbl_location` (`name`,`distance`,`is_available`) VALUES ('$select1', '$select2', 1);";
        $result = $this->conn->query($SQL);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    function blockk($id)
    {
        $sql = "UPDATE `tbl_location` SET `is_available`= 0 WHERE `id` = '$id';";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    function unblockk($id)
    {
        $sql = "UPDATE `tbl_location` SET `is_available`= 1  WHERE `id` = '$id';";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
}
