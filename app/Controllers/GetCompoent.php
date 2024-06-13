<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class GetCompoent extends ResourceController
{ 
    protected $security;
    protected $return;

    function __construct(){ 
        $this->return=array(); 
    }
    public function component($c='index') {
        $session = session();
        if(!$session->get('username')){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if(!is_file(APPPATH.'/Views/page/'.$c.'.php')){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            $data['db']=db_connect();
            echo view('component/'.$c.'.php',$data);
        }
    }

    public function subComponent($s='admin',$c='main') {
        $session = session();
        if(!$session->get('username')){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if(!is_file(APPPATH.'/Views/component/'.$s.'/'.$c.'.php')){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }else{
            $data['db']=db_connect();
            echo view('component/'.$s.'/'.$c.'.php',$data);
        }
    }
    
}

