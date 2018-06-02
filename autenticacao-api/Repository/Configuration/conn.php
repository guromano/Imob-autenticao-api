<?php
class DataBase{ 
    public $con;

    public function __construct()
    {
        try{
            $this->con =  new PDO('mysql:host=localhost;dbname=nuvem', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }catch(PDOException $ex){
            die(json_encode(array('outcome' => false, 'message' => 'Unable to connect')));
        }
    }
}
?>