<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$topic=isset($_POST['topic']) ? $_POST['topic'] : '';
$news_detail=isset($_POST['news_detail']) ? $_POST['news_detail'] : '';
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
    $sql="INSERT INTO `news` (`news_id`, `topic`,`news_detail`,`photo`,`status`) VALUES (NULL, ?, ?, ?, ?)";
    $query =$db->query($sql,[$topic,$news_detail,$photourl,$status]);
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
    $query = $db->query("UPDATE  `news` SET  `status` = 99  WHERE `news_id` = ?", [$id]);
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
        $query = $db->query("UPDATE `news` SET `status` = ?  WHERE `news_id` = ?", [$value,$id]);
        if ($query) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $query = $db->query("UPDATE `news` SET `status` = ?  WHERE `news_id` = ?", [$value,$id]);
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
    $query =$db->query("UPDATE `news` SET `topic`= ? ,`news_detail`= ?  ,`photo`= ?   ,`status` = ?  WHERE `news_id` = ?",[$topic,$news_detail,$photourl,$status,$tid]);
    if($query){
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    }else{
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}