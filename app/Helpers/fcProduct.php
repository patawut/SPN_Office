<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;

class FcProduct{
    protected $db;
    function __construct(ConnectionInterface $db){
        $this->db = $db; 
 
    }   
    public function productTypeList():array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `product_type` WHERE `status` = '1'");
        $return = $query->getResult();
        return $return;
    }  

    public function productTypeID(int $id):array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `product_type` WHERE `type_id` = ? ",[$id]);
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