<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$type_name=isset($_POST['type_name']) ? $_POST['type_name'] : '';
$status=isset($_POST['status']) ? $_POST['status'] : '';
$note=isset($_POST['note']) ? $_POST['note'] : '';
$note1=isset($_POST['note1']) ? $_POST['note1'] : '';
$level=isset($_POST['level']) ? $_POST['level'] : '';
$value=isset($_POST['value']) ? $_POST['value'] : '';
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

if ($even == "add"){
        $response = [
            'even' => 'add', 
        ];
        $sql="INSERT INTO `product_type` (`type_id`, `type_name`, `note`, `level`, `status`) VALUES (NULL, ?, ?, ?, ?)";
        $query =$db->query($sql,[$type_name,$note,$level,$status]);
        if($query){
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        }else{
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        } 
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
if ($even == "del") { 
    $query = $db->query("UPDATE `product_type` SET `status` = 99 WHERE `type_id` = ?", [$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even=="edit" && $tid!=""){
        $response = [
            'even' => 'edit',
            'id' => $tid,
            'st' => $status, 
            'typename' => $type_name,
        ];
        $query = $db->query("UPDATE `product_type` SET `type_name`= ? , `note`= ?, `level`= ? ,`status` = ?  WHERE `type_id` = ?", [ $type_name,$note,$level,$status,$tid]);
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
    //print_r($_POST);

    $response = [
        'even' => 'editstatus',
        'id' => $id,
    ];
    
    $query = $db->query("UPDATE `product_type` SET `status` = ?  WHERE `type_id` = ?", [$value,$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}