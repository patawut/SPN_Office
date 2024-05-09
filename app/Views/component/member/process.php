<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';

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


$status=isset($_POST['status']) ? $_POST['status'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : '';
$photourl1=isset($_POST['photourl1']) ? $_POST['photourl1'] : '';
$photourl2=isset($_POST['photourl2']) ? $_POST['photourl2'] : '';

$tel=isset($_POST['tel']) ? $_POST['tel'] : '';
$mail_ck=isset($_POST['mail_ck']) ? $_POST['mail_ck'] : '';
$line_ck=isset($_POST['line_ck']) ? $_POST['line_ck'] : '';
$profile_ck=isset($_POST['profile_ck']) ? $_POST['profile_ck'] : '';

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


if ($even == "search"){
    //print_r($_POST);
        $response = [
            'even' => 'search', 
            'mname' => $mname,
        ];
        $query_chk = $db->query("SELECT * FROM `member` WHERE `member_id` = '$mname' AND `status` <> '99'");
        $row = $query_chk->getRowArray();
        if ($row) {
            if ($row) {
                $response['status'] = 1;
                $response['msg'] = 'กำลังค้นหาข้อมูล';
                $response['rowdata'] = $row; 
            } else {
                $response['status'] = 0;
                $response['msg'] = 'ไม่พบข้อมูล';
            }
        } else {
            $response['status'] = 0;
            $response['msg'] = 'ไม่มีรหัสนี้';
        }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if ($even == "add"){
    //print_r($_POST);
        $response = [
            'even' => 'add', 
        ];
        //typeRegister
        if($position_id != '99'){
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $sql_member = "INSERT INTO `member` (`member_id`, `profile_id`,`password`, `telephone`,`email`,`line`,`name`,`photo`,`position_id` ,`status`) VALUES (NULL, ?, ?, ?, ?,?,?,?,?,?)";
            $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone, $email, $line,$name,$photourl ,$position_id, $status]);
            $idreturn = $db->insertID();
            
            //$sql_bank = "INSERT INTO `member_bank` (`member_bank_id`, `member_id`,`bank_id`, `numbank`,`account_name`,`bookbank_photo` ,`status`) VALUES (NULL, ?, ?, ?, ?,?,?)";
            //$query_bank = $db->query($sql_bank, [$idreturn, $bank_id, $numbank, $account_name,$photourl2 , $status]);
        
            //$sql_info = "INSERT INTO `member_info` (`member_id`, `idcard`,`firstname`, `lastname`,`birthday`,`address`,`zipcode`,`idcard_photo`,`note` ,`status`) VALUES (?, ?, ?, ?,?,?,?,?,?,?)";
            //$query_info = $db->query($sql_info, [$idreturn, $idcard, $firstname, $lastname, $birthday,$address,$zipcode ,$photourl1 ,$note , $status]);
            if ($query_member) {
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

if($even == "edit"){
    $response = [
        'even' => 'edit', 
        'tid' => $tid,
    ];
     
    if($position_id != '99'){
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $sql_member = "UPDATE `member` SET `profile_id` = ?,`password` = ?, `telephone` = ?, `email` = ?, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
        $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone, $email, $line,$name,$photourl ,$position_id, $status,$tid]);
     
        if ($query_member) {
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

if($even=="editstatus"){
    $response = [
        'even' => 'editstatus',
        'id' => $id,
        'value' => $value,
    ];
    if($value == '1'){
        $query = $db->query("UPDATE `member` SET `status` = ?  WHERE `member_id` = ?", [$value,$id]);
        if ($query) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $query = $db->query("UPDATE `member` SET `status` = ?  WHERE `member_id` = ?", [$value,$id]);
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

if ($even == "del") { 
    $query = $db->query("UPDATE  `member` SET  `status` = 99  WHERE `member_id` = ?", [$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "searchMemID"){
    $response = [
        'even' => 'searchMemID', 
        'memID' => $memID,
        'tid' => $tid,
    ];
        //ติดตรงนี้ ตรวจสอบ guidecode รหัสนั้นมีแล้วหรือยัง ถ้าไม่มีใส่ได้ แต่ห้ามใส่ซ้ำรหัสของที่จะสร้าง สมมุติเลย 2 มา ห้ามใส่ 2 ลงในguide
        //$query_chk = $db->query("SELECT * FROM `member`WHERE `memberID` LIKE '%$guideMem%' AND `guideCode` IS NULL;");
      
        $query_chk = $db->query("SELECT * FROM `member`WHERE `idCard` LIKE '%$memID%'  AND  `status` <> '99' ");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีเลขประจำบัตรประชาชนนี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้เลขประจำบัตรประชาชนนี้ได้';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if($even == "checktelephone"){
    $response = [
        'even' => 'checktelephone', 
        'idcard' => $tel,
    ];
        $query_chk = $db->query("SELECT * FROM `member` WHERE `telephone` = '$tel'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีเบอร์นี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้เบอร์นี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if($even == "checkmail"){
    $response = [
        'even' => 'checkmail', 
        'mail' => $mail_ck,
    ];
        $query_chk = $db->query("SELECT * FROM `member` WHERE `email` = '$mail_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีอีเมล์นี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้อีเมล์นี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checkline"){
    $response = [
        'even' => 'checkline', 
        'line' => $line_ck,
    ];
        $query_chk = $db->query("SELECT * FROM `member` WHERE `line` = '$line_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มี Line นี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้ Line นี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checkprofile"){
    $response = [
        'even' => 'checkprofile', 
        'line' => $profile_ck,
    ];
        $query_chk = $db->query("SELECT * FROM `member` WHERE `profile_id` = '$profile_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มี id นี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้ id นี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}