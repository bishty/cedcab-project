<?php
class dbconn{

    public $servername="localhost";
    public $username="root";
    public $password="";
    public  $db="cedcab";

    function __construct($servername,$username, $password, $db){
        mysql_connect($this->servername,$this->username,$this->password,$this->db);
    }

}
?>