<?php
namespace App\Helpers;
use CodeIgniter\Database\ConnectionInterface;

class fcMember{
    protected $db;
    function __construct(ConnectionInterface $db){
        $this->db = $db; 
    }   
    
  
    function convert10digit($number){
        $number = strval($number);
        $number = str_pad($number, 10, "0", STR_PAD_LEFT);
        return $number;
    }
    //get all memberlog where memberID order by `createdate` DESC
   
    public function memberData($id){
        $return = [];
        $query = $this->db->query("SELECT * FROM `member` WHERE `member_id` = ? ",[$id]);
        if($return = $query->getFirstRow('array')){
            return $return;
        }
        return $return;
    }
   


}
