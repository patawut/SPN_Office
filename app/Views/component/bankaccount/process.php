<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$accout_name=isset($_POST['accout_name']) ? $_POST['accout_name'] : '';
$accout_number=isset($_POST['accout_number']) ? $_POST['accout_number'] : '';
$photo=isset($_POST['photo']) ? $_POST['photo'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : '';
$bankcode=isset($_POST['bankcode']) ? $_POST['bankcode'] : '';
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

if ($even == "add"){
    //print_r($_POST);
        $response = [
            'even' => 'add', 
        ];
            
                if($bankcode != '99'){
                    $sql="INSERT INTO `bank_account` (`bank_id`, `bankCode`,`accout_name`,`accout_number`,`accout_logo`,`status`) VALUES (NULL, ?, ?, ?, ?, ?)";
                    $query =$db->query($sql,[$bankcode,$accout_name,$accout_number,$photourl,$status]);
                    if($query){
                        $response['status']=1;
                        $response['msg']='บันทึกข้อมูลสำเร็จ';
                    }else{
                        $response['status']=0;
                        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                    } 
                }else{
                    $response['status']=0;
                    $response['msg']='กรุณาเลือกชื่อธนาคาร';
                }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
 }

 if ($even == "del") { 
    $query = $db->query("UPDATE  `user` SET  `status` = 99  WHERE `username` = ?", [$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even=="editstatus"){
    $response = [
        'even' => 'editstatus',
        'id' => $id,
        'value' => $value,
    ];
    if($value == '1'){
        $query = $db->query("UPDATE `user` SET `status` = ?  WHERE `username` = ?", [$value,$id]);
        if ($query) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $query = $db->query("UPDATE `user` SET `status` = ?  WHERE `username` = ?", [$value,$id]);
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

if($even=="edit" && $uid!=""){
    $response = [
        'even' => 'edit',
        'id' => $id,
        'st' => $status, 
        'username' => $username,
    ];
    if($usertype != '99'){
        if($password != ""){
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $query = $db->query("UPDATE `user` SET `password`= ? ,`fullname`= ? ,`type`= ?  ,`status` = ?  WHERE `username` = ?",[$pass,$fullname,$usertype,$status,$uid]);
            if ($query) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        }else{
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $query = $db->query("UPDATE `user` SET `fullname`= ? ,`type`= ?  ,`status` = ?  WHERE `username` = ?",[$fullname,$usertype,$status,$uid]);
            if ($query) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        }
    }else{
        $response['status']=0;
        $response['msg']='กรุณาเลือกระดับการเข้าถึง';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}