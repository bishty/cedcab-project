<?php
include_once 'class/dbconn.php';
session_start();
class ride extends dbconn
{
    public $ride_id;
    public $ride_date;
    public $from;
    public $to;
    public $total_distance;
    public $luggage;
    public $total_fare;
    public $customer_user_id;
    public $cabtype;
    public $conn;
    public $location_arr = array();
    public $ride_arr = array();

    public function __construct()
    {
        $obj = new dbconn();
        $conn = $obj->connect();
        $this->conn = $conn;
    }
    function farecalculation($pickUpPoint, $dropPoint, $cabtype, $luggage = 0)
    {
        $firstDis = 0;
        $lastDiss = 0;
        $firstPoint = '';
        $secondPoint = '';
        $sql = "Select * from `tbl_location` where distance in ('$pickUpPoint','$dropPoint')";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $this->location_arr[$i] = $row;
                ++$i;
            }
        }
        if ($this->location_arr[0]['distance'] == $pickUpPoint) {
            $firstDis = $this->location_arr[0]['distance'];
            $firstPoint = $this->location_arr[0]['name'];
        }
        if ($this->location_arr[1]['distance'] == $dropPoint) {
            $lastDiss = $this->location_arr[1]['distance'];
            $secondPoint = $this->location_arr[1]['name'];
        }
        $distance = abs($firstDis - $lastDiss);
        $_SESSION['user']['TotalDis'] = $distance;
        $_SESSION['user']['firstPoint'] = $firstPoint;
        $_SESSION['user']['secondPoint'] = $secondPoint;
        $_SESSION['user']['cabType'] = $cabtype;
        switch ($cabtype) {

            case "CedMicro":
                if ($distance <= 10) {
                    $fare = ($distance * 13.50) + 50;
                } else if ($distance <= 60 && $distance > 10) {
                    $fare = 135 + 50 + (($distance - 10) * 12);
                } else if ($distance <= 160 && $distance > 60) {
                    $fare = 135 + 50 + 600 + (($distance - 60) * 10.2);
                } else {
                    $fare = 135 + 50 + 600 + 1020 + (($distance - 160) * 8.50);
                }


                break;
            case "CedMini":

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 14.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 14.50;
                    $fare = (($distance - 10) * 13.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 14.50;
                    $temp2 = 50 * 13.00;
                    $fare = (($distance - 60) * 11.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 14.50;
                    $temp2 = 50 * 13.00;
                    $temp3 = 100 * 11.20;
                    $fare = (($distance - 160) * 9.50) + ($temp1 + $temp2 + $temp3);
                }
                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 100;
                } else {
                    $fare += 200;
                }

                $fare += 150;

                break;

            case "CedRoyal":

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 15.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 15.50;
                    $fare = (($distance - 10) * 14.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 15.50;
                    $temp2 = 50 * 14.00;
                    $fare = (($distance - 60) * 12.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 15.50;
                    $temp2 = 50 * 14.00;
                    $temp3 = 100 * 12.20;
                    $fare = (($distance - 160) * 10.50) + ($temp1 + $temp2 + $temp3);
                }

                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 50;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 100;
                } else {
                    $fare += 200;
                }

                $fare += 200;

                break;
            case "CedSUV":

                if ($distance > 0 && $distance <= 10) {
                    $fare = $distance * 16.50;
                } else if ($distance > 10 && $distance <= 60) {
                    $temp1 = 10 * 16.50;
                    $fare = (($distance - 10) * 15.00) + $temp1;
                } else if ($distance <= 160 && $distance > 60) {
                    $temp1 = 10 * 16.50;
                    $temp2 = 50 * 15.00;
                    $fare = (($distance - 60) * 13.20) + ($temp1 + $temp2);
                } else {
                    $temp1 = 10 * 16.50;
                    $temp2 = 50 * 15.00;
                    $temp3 = 100 * 13.20;
                    $fare = (($distance - 160) * 11.50) + ($temp1 + $temp2 + $temp3);
                }

                if ($luggage == 0) {
                    $fare += 0;
                } else if ($luggage > 0 && $luggage <= 10) {
                    $fare += 100;
                } else if ($luggage > 10 && $luggage <= 20) {
                    $fare += 200;
                } else {
                    $fare += 400;
                }
                $fare += 250;
                break;
        }
        $s = "Select * from `tbl_location` where 'distance' in ('$pickUpPoint','$dropPoint')";
        $r = $this->conn->query($s);
        if ($r->num_rows > 0) {
            $i = 0;
            while ($row = $r->fetch_assoc()) {
                $this->location_arr[$i] = $row;
                ++$i;
            }
        }
        $_SESSION['user']['TotalFare'] = $fare;
        return array("totalfare" => $fare, "luggageprice" => $luggage, "TotalDis" => $distance, "pickUpPoint" => $this->location_arr[0]['name'], "DropPoint" => $this->location_arr[1]['name'], "cabType" => $cabtype);
    }
    public function bookride($luggage, $carType)
    {
        if (isset($_SESSION['user']['TotalFare'])) {
            $_SESSION['user']['carType'] = $carType;
            $_SESSION['user']['luggage'] = $luggage;
            return 1;
        } else {
            return 0;
        }
    }



    public function completeride()
    {
        if(isset($_SESSION['user']['id']))
        {
            $id=$_SESSION['user']['id'];
        $sql = "SELECT * from `tbl_ride`  WHERE customer_user_id=$id";
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
}
    public function pendingride()
    {
        if(isset($_SESSION['user']['id']))
        {
            $id=$_SESSION['user']['id'];
        $sql = "SELECT * from tbl_ride  WHERE customer_user_id= $id AND `status`=1";
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
}
    public function cancelride()
    {
        if(isset($_SESSION['user']['id']))
        {
            $id=$_SESSION['user']['id'];
        $sql = "SELECT * from tbl_ride  WHERE customer_user_id= $id AND `status`=0";
    
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
}
    public function totalamount()
    {
        if(isset($_SESSION['user']['id']))
        {
            $id=$_SESSION['user']['id'];
        $sql = "SELECT * from tbl_ride  WHERE customer_user_id= $id AND `status`=2";
    
     
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
}

    public function viewdetail($ride_id)
    {
        $sql = "SELECT * from `tbl_ride`  WHERE `id` = $ride_id";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $ride_arr[$i] = $row;
                ++$i;
            }
            return $ride_arr;
        }
    }



    public function cancel($ride_id)
    {
        $sql = " UPDATE tbl_ride SET `status` = '0' WHERE `id`= $ride_id";
        if ($this->conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }
    }

    public function number()
    {
        $id = $_SESSION['user']['id'];
        $SQL = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = $id ";
        $result = $this->conn->query($SQL);
        if ($result->num_rows > 0) {
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $details[$i] = $row;
                ++$i;
            }
            return $details;
        } else {
            return $this->conn->error;
        }
    }
    public function allride()
    {
        $sql = "SELECT * from tbl_ride";
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
    public function totalearning()
    {
        $sql = "SELECT * from tbl_ride WHERE `status` = '2' ";
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
    public function tcancelride()
    {
        $sql = "SELECT * from tbl_ride WHERE `status` = '0' ";
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
    public function tpendingride()
    {
        $sql = "SELECT * from tbl_ride WHERE `status` = '1' ";
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

    public function approve($e)
    {
        $sql = "UPDATE `tbl_ride` SET `status`= 2 WHERE `id` = '$e'; ";
        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }

    public function cancell($e)
    {
        $sql = "UPDATE `tbl_ride` SET `status`= 0 WHERE `id` = '$e'; ";

        $result = $this->conn->query($sql);
        if ($result == TRUE) {
            return 1;
        } else {
            return $this->conn->error;
        }
    }
    public function tra($select1, $select2, $e)
    {
        $sql = "SELECT * FROM tbl_ride WHERE `customer_user_id` = $e order by {$select2} {$select1}";
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
}
   
    

