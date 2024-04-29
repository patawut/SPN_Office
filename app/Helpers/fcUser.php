<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;

class fcUser{
    protected $db;
    function __construct(ConnectionInterface $db){
        $this->db = $db; 
 
    }   

    public function userTypeID(string $id):array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `user` WHERE `username` = ? ",[$id]);
        if($return = $query->getFirstRow('array')){
            return $return;
        }
        return $return;
    }  


    function convert5digit($number){
        $number = strval($number);
        $number = str_pad($number, 5, "0", STR_PAD_LEFT);
        return $number;
    }

    function convert1digit($number){
        $number = strval($number);
        $number = str_pad($number, 2, "0", STR_PAD_LEFT);
        return $number;
    }
    public function userList():array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `user` WHERE `status` = '1'");
        $return = $query->getResult();
        return $return;
    }  
    
}