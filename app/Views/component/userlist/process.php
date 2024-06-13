<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$uid= isset($_POST['uid']) ? $_POST['uid'] : '';
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
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $query1 = $db->query("SELECT * FROM `user` WHERE `username` = ? ",[$username]);
                if($usertype != '99'){
                    $sql2="INSERT INTO `user` (`username`, `password`,`fullname`,`type`,`status`) VALUES (?, ?, ?, ?,?)";
                    $query3 =$db->query($sql2,[$username,$pass,$fullname,$usertype,$status]);
        
                    if($query3){
                        $response['status']=1;
                        $response['msg']='บันทึกข้อมูลสำเร็จ';
                    }else{
                        $response['status']=0;
                        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                    } 
                }else{
                    $response['status']=0;
                    $response['msg']='กรุณาเลือกระดับการเข้าถึง';
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