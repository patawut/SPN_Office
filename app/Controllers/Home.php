<?php
namespace App\Controllers; 
use CodeIgniter\Controller;

class Home extends Controller
{
    protected $db;
    protected $session;
    function __construct(){
        $this->db= db_connect();
        $this->session = session();
    }

    public function index(){ 
        if($this->checkLogin()){
            return view('page/main');
        }else{
            return view('page/login');
        }
    }
    public function home($a){ 
        return view('page/main',['a'=>$a]);
    }

    public function getLogin(){
        return view('page/login');
    }

    public function postLogin(){ 
        $username = $this->request->getPost('telephone');
        $password = $this->request->getPost('inputChoosePassword');
        $user = $this->db->table('user')->where('username', $username)->get()->getFirstRow('array');
        if (!$user) {
            $response = [
                'code' => 0,
                'message' => 'Incorrect username or password',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } elseif (!password_verify($password, $user['password'])) {
            $response = [
                'code' => 0,
                'message' => 'Incorrect username or password',
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        } else {
            session()->set([ 
                'username' => $user['username'],
                'fullname' => $user['fullname'],
                'typeUser' => $user['type'], 
                'status' => $user['status'],
            ]);
            $response = [
                'code' => 1,
                'message' => 'Login successful', 
                'username' => $user['username']
            ];
            return $this->response->setStatusCode(200)->setJSON($response);
        }
        
    }
    public function postUser(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $fullname = $this->request->getPost('fullname');
        $data = [
            'username' => $username,
            'fullname' => $fullname,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'typeuser'=>9,
            'status'=>1,
        ];
        $this->db->table('user')->insert($data);
        $response = [ 
            'code' => 1,
            'txt'=> 'Registration successful',
        ];   
    } 
    public function logout(){
        // session()->destroy();
        return redirect()->to(site_url('login'));
    }
    private function checkLogin(){ 
        return $this->session->has('username')?true:false;
    }

    public function userlist(){
        if($this->checkLogin()){
            return view('page/userlist');
        }else{
            return view('page/login');
        } 
    }

    public function producttype(){
        if($this->checkLogin()){
            return view('page/producttype');
        }else{
            return view('page/login');
        } 
    }
    public function banklist(){
        if($this->checkLogin()){
            return view('page/banklist');
        }else{
            return view('page/login');
        } 
    }
    public function bankaccount(){
        if($this->checkLogin()){
            return view('page/bankaccount');
        }else{
            return view('page/login');
        } 
    }
    public function article(){
        if($this->checkLogin()){
            return view('page/article');
        }else{
            return view('page/login');
        } 
    }
    public function news(){
        if($this->checkLogin()){
            return view('page/news');
        }else{
            return view('page/login');
        } 
    }
    public function product(){
        if($this->checkLogin()){
            return view('page/product');
        }else{
            return view('page/login');
        } 
    }
    
}