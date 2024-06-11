<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;

class fcPositionmlm{
    protected $db;
    function __construct(ConnectionInterface $db){
        $this->db = $db; 
 
    }   
    public function PositionMlmTypeList():array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `member_mlm_position` WHERE `status` = '1'");
        $return = $query->getResult();
        return $return;
    }  

    public function  PositionMlmTypeID(int $id):array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `member_mlm_position` WHERE `position_mlm_id` = ? ",[$id]);
        if($return = $query->getFirstRow('array')){
            return $return;
        }
        return $return;
    }  
    function convert10digit($number){
        $number = strval($number);
        $number = str_pad($number, 10, "0", STR_PAD_LEFT);
        return $number;
    }
}