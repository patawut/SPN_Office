<?php 
$session = session();
$even = isset($_POST['even']) ? $_POST['even'] : '';
$status=isset($_POST['status']) ? $_POST['status'] : '';
$value=isset($_POST['value']) ? $_POST['value'] : '';
$id=isset($_POST['id']) ? $_POST['id'] : '';
$response = [];
// เช็ค ตัวแปร

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

if($even=="editstatus"){
    //print_r($_POST);

    $response = [
        'even' => 'editstatus',
        'id' => $id,
        'value' => $value,
    ];
    //exit;
    $query = $db->query("UPDATE `bankcode` SET `status` = ?  WHERE `BankCode` = ?", [$value,$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}