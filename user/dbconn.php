<?php
class dbconn{

    public $servername="localhost";
    public $username="root";
    public $password="";
    public $db="cedcab";
    public $conn;

    function __construct(){

    }
    public function connect()
    {
        $this->conn= new mysqli($this->servername,$this->username,$this->password,$this->db);
        return $this->conn;
}

} 
?>