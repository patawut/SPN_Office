<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$topic=isset($_POST['topic']) ? $_POST['topic'] : '';
$note=isset($_POST['note']) ? $_POST['note'] : '';
$linkurl=isset($_POST['linkurl']) ? $_POST['linkurl'] : '';
$photo=isset($_POST['photo']) ? $_POST['photo'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : '';
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

if($even == "add"){
    //print_r($_POST);
    $response = [
    'even' => 'add', 
    ];
    $sql="INSERT INTO `article` (`article_id`, `topic`,`photo`,`note`,`linkurl`,`status`) VALUES (NULL, ?, ?, ?, ?, ?)";
    $query =$db->query($sql,[$topic,$photourl,$note,$linkurl,$status]);
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
    $query = $db->query("UPDATE  `article` SET  `status` = 99  WHERE `article_id` = ?", [$id]);
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
        $query = $db->query("UPDATE `article` SET `status` = ?  WHERE `article_id` = ?", [$value,$id]);
        if ($query) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $query = $db->query("UPDATE `article` SET `status` = ?  WHERE `article_id` = ?", [$value,$id]);
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

if($even=="edit" && $tid!=""){
    $response = [
        'even' => 'edit',
        'tid' => $tid,
        'st' => $status, 
    ]; 
    $query =$db->query("UPDATE `article` SET `topic`= ? ,`note`= ?  ,`photo`= ?  ,`linkurl`= ?   ,`status` = ?  WHERE `article_id` = ?",[$topic,$note,$photourl,$linkurl,$status,$tid]);
    if($query){
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    }else{
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}