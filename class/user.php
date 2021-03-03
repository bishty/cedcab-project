<?php
include_once 'class/dbconn.php';
class user extends dbconn
{
    public $user_id;
    public $email_id;
    public $name;
    public $dateofsignup;
    public $mobile;
    public $status;
    public $password;
    public $is_admin;
    public $conn;
    public $location;
    function __construct()
    {
        $obj = new dbconn();
        $this->conn = $obj->connect();
    }
    public function Signup($email_id, $name, $mobile, $status, $password, $is_admin, $location)
    {


        $sql = "INSERT INTO `tbl_user`(`email_id`, `name`, `mobile`,  `password`,`status`, `is_admin`,`filess`)
        VALUES('$email_id','$name','$mobile','$password',0,0,'$location')";

        $res = $this->conn->query($sql);

        if ($res == TRUE) {
            return 1;
        } else {
            return 0;
        }
    }
    public function logincheck($email, $pass)
    {
       
        $sql = "SELECT * FROM `tbl_user` WHERE email_id = '$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
          
            $row = $result->fetch_assoc();
            if ($row['email_id'] == "admin@gmail.com" && $row['password'] == 'Password123$') {
                $_SESSION['admin']['email'] = $email;
                $_SESSION['admin']['password'] = $pass;
                return 2;
            } else if ($row['password'] == $pass) {
                $_SESSION['user']['email'] = $email;
                $_SESSION['user']['password'] = $pass;
                $_SESSION['user']['id'] = $row['user_id'];

                #user exist and store details in db
                if (isset($_SESSION['user']['TotalDis'])) {
                    $pickUpPoint = $_SESSION['user']['firstPoint'];
                    $dropPoint = $_SESSION['user']['secondPoint'];
                    $TotalDis = $_SESSION['user']['TotalDis'];
                    $luggage = $_SESSION['user']['luggage'];
                    $TotalFare = $_SESSION['user']['TotalFare'];
                    $id = $_SESSION['user']['id'];
                
                    $cabtype = $_SESSION['user']['cabType'];
                    $s = "INSERT INTO `tbl_ride`(`from`, `to`, `total_distance`, `luggage`, `total_fare`, `status`,`customer_user_id`,`cabtype`) VALUES ('$pickUpPoint','$dropPoint','$TotalDis','$luggage','$TotalFare','1','$id','$cabtype')";
                    
                    $result = $this->conn->query($s);
                    if ($result == TRUE) {
                        return 1;
                    } else {
                        return $this->conn->error;
                    }
                }
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    public function emailcheck($email, $password)
    {
        $sql = "SELECT * FROM `tbl_user` WHERE email_id='$email'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function block($e){
        $sql = "UPDATE `tbl_user` SET `status`= 0 WHERE `user_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    public function unblock($e){
        $sql = "UPDATE `tbl_user` SET `status`= 1 WHERE `user_id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
  

    
}

