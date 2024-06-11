<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$sid= isset($_POST['sid']) ? $_POST['sid'] : '';
$infoid= isset($_POST['infoid']) ? $_POST['infoid'] : '';
$nobankid= isset($_POST['nobankid']) ? $_POST['nobankid'] : '';

$idcard=isset($_POST['idcard']) ? $_POST['idcard'] : '';
$line=isset($_POST['line']) ? $_POST['line'] : '';
$email=isset($_POST['email']) ? $_POST['email'] : '';
$password=isset($_POST['password']) ? $_POST['password'] : '';
$name=isset($_POST['name']) ? $_POST['name'] : '';
$profile_id=isset($_POST['profile_id']) ? $_POST['profile_id'] : '';
$telephone=isset($_POST['telephone']) ? $_POST['telephone'] : '';
$mname=isset($_POST['mname']) ? $_POST['mname'] : '';
$photo=isset($_POST['photo']) ? $_POST['photo'] : '';
$position_id=isset($_POST['position_id']) ? $_POST['position_id'] : '';

$firstname=isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname=isset($_POST['lastname']) ? $_POST['lastname'] : '';
$birthday=isset($_POST['birthday']) ? $_POST['birthday'] : '';
$address=isset($_POST['address']) ? $_POST['address'] : '';
$zipcode=isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
$note=isset($_POST['note']) ? $_POST['note'] : '';

$bank_id=isset($_POST['bank_id']) ? $_POST['bank_id'] : '';
$numbank=isset($_POST['numbank']) ? $_POST['numbank'] : '';
$account_name=isset($_POST['account_name']) ? $_POST['account_name'] : '';

$status=isset($_POST['status']) ? $_POST['status'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : '';
$photourl1=isset($_POST['photourl1']) ? $_POST['photourl1'] : '';
$photourl2=isset($_POST['photourl2']) ? $_POST['photourl2'] : '';

$tel=isset($_POST['tel']) ? $_POST['tel'] : '';
$mail_ck=isset($_POST['mail_ck']) ? $_POST['mail_ck'] : '';
$line_ck=isset($_POST['line_ck']) ? $_POST['line_ck'] : '';
$profile_ck=isset($_POST['profile_ck']) ? $_POST['profile_ck'] : '';
$idcard_ck=isset($_POST['idcard_ck']) ? $_POST['idcard_ck'] : '';
$numbank_ck=isset($_POST['numbank_ck']) ? $_POST['numbank_ck'] : '';

$position_mlm_id=isset($_POST['position_mlm_id']) ? $_POST['position_mlm_id'] : '';
$mmid=isset($_POST['mmid']) ? $_POST['mmid'] : '';




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


if($even == "addM"){
    $response = [
        'even' => 'addM', 
    ];
    if($position_mlm_id != '99'){
      $sql_mlm = "INSERT INTO `member_mlm` (`node_id`, `member_id`, `left_id`, `right_id`, `left_pv`, `right_pv`, `guild_id`, `upline_id`, `position_mlm_id`, `num_guild`, `num_team`, `upline_list`, `status`) VALUES (NULL, ?, NULL, NULL, ?, ?, NULL, NULL, ?, ?, ?, NULL, ?)";
        $query_mlm = $db->query($sql_mlm, [$mmid,'0','0',$position_mlm_id,'0','0', 1]);

        if ($query_mlm) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $response['status'] = 0;
        $response['msg'] = 'กรุณาเลือกระดับสมาชิก';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}
