<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$mid= isset($_POST['mid']) ? $_POST['mid'] : '';
$username=isset($_POST['username']) ? $_POST['username'] : '';
$password=isset($_POST['password']) ? $_POST['password'] : '';
$fullname=isset($_POST['fullname']) ? $_POST['fullname'] : '';
$telephone=isset($_POST['telephone']) ? $_POST['telephone'] : '';
$usertype=isset($_POST['usertype']) ? $_POST['usertype'] : '';
$value=isset($_POST['value']) ? $_POST['value'] : '';
$status=isset($_POST['status']) ? $_POST['status'] : '';
$response = [];
// เช็ค ตัวแปร
$userIP = $_SERVER['REMOTE_ADDR'];
$user = $session->get('username');

$date = date("Y-m-d H:i:s");
//  echo "post \n";
//  print_r($_POST);
//  echo "SESSION \n";
//  print_r($_SESSION);
//  exit;

if(!$session->has('username')){
    $response = [
        'status' => 0,
        'msg' => 'กรุณาเข้าสู่ระบบก่อน',
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

if($even=="editProfile" && $mid!=""){
    $response = [
        'even' => 'editProfile',
        'id' => $id,
        'fullname' => $fullname,
    ];
        if($password != ""){
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $query = $db->query("UPDATE `user` SET `password`= ? ,`fullname`= ?  WHERE `username` = ?",[$pass,$fullname,$mid]);
            $fullname = $session->set('fullname', $fullname);
            if ($query) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        }else{
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $query = $db->query("UPDATE `user` SET `fullname`= ?   WHERE `username` = ?",[$fullname,$mid]);
            $fullname = $session->set('fullname', $fullname);
            if ($query) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}