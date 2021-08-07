<?php
require_once("constants.php");

class Model
{
    private $Mysqli;

    function __construct()
    {
        $this->Mysqli = new mysqli(SERVER_NAME, USER_NAME, USER_PASSWORD, DATABASE_NAME);
        if ($this->Mysqli->connect_errno) {
            die("Failed to connect: " . $this->Mysqli->connect_error);
        }
    }

    function __destruct()
    {
        $this->Mysqli->close();
    }

    function Insert($query)
    {
        if ($this->Mysqli->query($query)) {
            return $this->Mysqli->insert_id;
        } else {
            die("Mysql error: " . $this->Mysqli->error);
        }
    }

    function Update($query)
    {
        if (!$this->Mysqli->query($query)) {
            die("Mysql Error :" . $this->Mysql->error);
        }
    }

    function Select($query)
    {
        $data = array();
        if ($res = $this->Mysqli->query($query)) {
            while ($obj = $res->fetch_assoc()) {
                $data[] = $obj;
            }
            $res->close();
            return $data;
        }else{
            die("Mysql Error : ". $this->Mysqli->error);
        }

    }

    function SingleSelect($query){
        $data = array();
        if($res = $this->Mysqli->query($query)){
            if($obj = $res->fetch_assoc()){
                $data = $obj;
            }
            $res->close();
            return $data;
        }else{
            die("Mysql Error: ". $this->Mysqli->error);
        }
        return false;

    }

    function Count($query) {
        $count = 0;
        if ($res = $this->Mysqli->query($query)) {
            $count = $res->num_rows;
            $res->close();
            return $count;
        } else {
            die("MySQL Error: " . $this->Mysqli->error);
        }
        return $count;
    }


}


