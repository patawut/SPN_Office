<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;

class FcBank{
    protected $db;
    function __construct(ConnectionInterface $db){
        $this->db = $db; 
 
    }   
    public function bankTypeList():array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `bankcode` WHERE `status` = '1'");
        $return = $query->getResult();
        return $return;
    }  

    public function bankTypeID(int $id):array{
        $return = [];
        $query = $this->db->query("SELECT * FROM `bankcode` WHERE  `BankCode` = ? ",[$id]);
        if($return = $query->getFirstRow('array')){
            return $return;
        }
        return $return;
    }  
}