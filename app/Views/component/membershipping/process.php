<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$even1 = isset($_POST['even1']) ? $_POST['even1'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$sid= isset($_POST['sid']) ? $_POST['sid'] : '';
$infoid= isset($_POST['infoid']) ? $_POST['infoid'] : '';
$nobankid= isset($_POST['nobankid']) ? $_POST['nobankid'] : '';
$shipid= isset($_POST['shipid']) ? $_POST['shipid'] : '';
$shipieditidd= isset($_POST['shipieditidd']) ? $_POST['shipieditidd'] : '';

$fullname_shipping=isset($_POST['fullname_shipping']) ? $_POST['fullname_shipping'] : '';
$address_shipping=isset($_POST['address_shipping']) ? $_POST['address_shipping'] : '';
$zipcode_shipping=isset($_POST['zipcode_shipping']) ? $_POST['zipcode_shipping'] : '';
$telephone_shipping=isset($_POST['telephone_shipping']) ? $_POST['telephone_shipping'] : '';
$note_shipping=isset($_POST['note_shipping']) ? $_POST['note_shipping'] : '';



$value=isset($_POST['value']) ? $_POST['value'] : '';
$vv=isset($_POST['vv']) ? $_POST['vv'] : '';
$response = [];
$date = date("Y-m-d H:i:s");
$user = $session->get('username');

if(!$session->has('username')){
    $response = [
        'status' => 0,
        'msg' => 'กรุณาเข้าสู่ระบบก่อน',
    ];
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}


if ($even == "editSendData"){
    //print_r($_POST);
        $response = [
            'even' => 'editSendData', 
        ];
        //typeRegister
        $sql_shipping = "UPDATE `member_shipping` SET `fullname` = ?,`address` = ?, `zipcode` = ?, `telephone` = ?, `note` = ? WHERE `member_shopping_id` = ?";
        $query_shipping = $db->query($sql_shipping, [$fullname_shipping, $address_shipping, $zipcode_shipping, $telephone_shipping, $note_shipping,$shipieditidd]);

            if ($query_shipping) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "addShipping"){
   
        //print_r($_POST);
    $response = [
        'even' => 'addInfo', 
    ];
  
        $sql_shipping = "INSERT INTO `member_shipping` (`member_shopping_id`, `member_id`,`fullname`, `address`,`zipcode`,`telephone`,`note`,`status`) VALUES (NULL, ?, ?, ?,?,?,?,?)";
        $query_shipping = $db->query($sql_shipping, [$shipid,$fullname_shipping, $address_shipping, $zipcode_shipping, $telephone_shipping, $note_shipping , 1]);
    
        if ($query_shipping) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
}