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

        if (empty($profile_id)) {
            $profile_id = NULL;
        }

        if (empty($email)) {
            $email = NULL;
        }

        if (empty($line)) {
            $line = NULL;
        }
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


if ($even == "addInfo"){
    //print_r($_POST);
        $response = [
            'even' => 'addInfo', 
        ];
        //typeRegister
       
        $sql_info = "INSERT INTO `member_info` (`member_id`, `idcard`,`firstname`, `lastname`,`birthday`,`address`,`zipcode`,`idcard_photo`,`note` ,`status`) VALUES (?, ?, ?, ?,?,?,?,?,?,?)";
        $query_info = $db->query($sql_info, [$infoid, $idcard, $firstname, $lastname, $birthday,$address,$zipcode ,$photourl1 ,$note , 1]);

            if ($query_info) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if ($even == "editInfo"){
    //print_r($_POST);
        $response = [
            'even' => 'editInfo', 
        ];
        //typeRegister
        
        $sql_info = "UPDATE `member_info` SET `idcard` = ?,`firstname` = ?, `lastname` = ?, `birthday` = ?, `address` = ?, `zipcode` = ?, `idcard_photo` = ?, `note` = ?, `status` = ?  WHERE `member_id` = ?";
        $query_info = $db->query($sql_info, [$idcard, $firstname, $lastname, $birthday, $address,$zipcode,$photourl1 ,$note, $status,$infoid]);

            if ($query_info) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if ($even == "addBank"){
    //print_r($_POST);
        $response = [
            'even' => 'addBank', 
        ];
        //typeRegister
            $sql_bank = "INSERT INTO `member_bank` (`member_bank_id`, `member_id`,`bank_id`, `numbank`,`account_name`,`bookbank_photo` ,`status`) VALUES (NULL, ?, ?, ?, ?,?,?)";
            $query_bank = $db->query($sql_bank, [$nobankid, $bank_id, $numbank, $account_name,$photourl2 , 1]);

            if ($query_bank) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if ($even == "editBank"){
    //print_r($_POST);
        $response = [
            'even' => 'editBank', 
        ];
        //typeRegister
        $sql_bank_edit = "UPDATE `member_bank` SET `bank_id`= ? , `numbank` = ?,`account_name` = ? ,`bookbank_photo` = ?  WHERE `member_id` = ?";
        $query_bank_edit = $db->query($sql_bank_edit, [$bank_id, $numbank, $account_name, $photourl2,$nobankid]);

            if ($query_bank_edit) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "edit"){
    $response = [
        'even' => 'edit', 
        'tid' => $tid,
    ];
    if (empty($profile_id)) {
        $profile_id = null;
    }
    if (empty($email)) {
        $email = null;
    }
    if (empty($line)) {
        $line = null;
    }

    if($position_id != '99'){
        if (empty($profile_id) && empty($email) && empty($line)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = NULL ,`password` = ?, `telephone` = ?, `email` = NULL, `line` = NULL, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [$pass, $telephone,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปรทั้งสามตัวเป็นค่าว่าง<br>";
        } else {
            // ตรวจสอบกรณีต่าง ๆ
            if (empty($profile_id) && !empty($email) && !empty($line)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = NULL ,`password` = ?, `telephone` = ?, `email` = ?, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [$pass, $telephone, $email, $line,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปร var1 เป็นค่าว่าง, ตัวแปร var2 และ var3 ไม่ว่าง<br>";
            }
        
            if (empty($email) && !empty($profile_id) && !empty($line)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = ?,`password` = ?, `telephone` = NULL, `email` = ?, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone, $line,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปร var2 เป็นค่าว่าง, ตัวแปร var1 และ var3 ไม่ว่าง<br>";
            }
        
            if (empty($line) && !empty($profile_id) && !empty($email)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = ?,`password` = ?, `telephone` = ?, `email` = ?, `line` = NULL, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone, $email,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปร var3 เป็นค่าว่าง, ตัวแปร var1 และ var2 ไม่ว่าง<br>";
            }
        
            if (!empty($profile_id) && empty($email) && empty($line)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = ?,`password` = ?, `telephone` = ?, `email` = NULL , `line` = NULL, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปร var1 ไม่ว่าง, ตัวแปร var2 และ var3 เป็นค่าว่าง<br>";
            }
        
            if (!empty($email) && empty($profile_id) && empty($line)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = NULL ?,`password` = ?, `telephone` = ?, `email` = ?, `line` = NULL, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [ $pass, $telephone, $email, $name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
                //echo "ตัวแปร var2 ไม่ว่าง, ตัวแปร var1 และ var3 เป็นค่าว่าง<br>";
            }
        
            if (!empty($var3) && empty($var1) && empty($var2)) {
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql_member = "UPDATE `member` SET `profile_id` = NULL,`password` = ?, `telephone` = ?, `email` = NULL, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ?, `status` = ?  WHERE `member_id` = ?";
                $query_member = $db->query($sql_member, [ $pass, $telephone, $line,$name,$photourl ,$position_id, $status,$tid]);
            
                if ($query_member) {
                    $response['status']=1;
                    $response['msg']='บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status']=0;
                    $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
                }
               //// echo "ตัวแปร var3 ไม่ว่าง, ตัวแปร var1 และ var2 เป็นค่าว่าง<br>";
            }
        
            // ตรวจสอบกรณีที่ตัวแปรทั้งสามตัวไม่ว่าง
            if (!empty($profile_id) && !empty($email) && !empty($line)) {
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
            }
        }
        
    }else{
        $response['status'] = 0;
        $response['msg'] = 'กรุณาเลือกระดับสมาชิก';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "editMem"){
    $response = [
        'even' => 'editMem', 
        'tid' => $tid,
    ];
     
    if($position_id != '99'){
        if($password == ""){
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $sql_member = "UPDATE `member` SET `profile_id` = ? , `telephone` = ?, `email` = ?, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ? WHERE `member_id` = ?";
            $query_member = $db->query($sql_member, [$profile_id, $telephone, $email, $line,$name,$photourl ,$position_id,$tid]);
         
            if ($query_member) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
        }else{
            $pass = password_hash($password,PASSWORD_DEFAULT);
            $sql_member = "UPDATE `member` SET `profile_id` = ?,`password` = ?, `telephone` = ?, `email` = ?, `line` = ?, `name` = ?, `photo` = ?, `position_id` = ? WHERE `member_id` = ?";
            $query_member = $db->query($sql_member, [$profile_id, $pass, $telephone, $email, $line,$name,$photourl ,$position_id,$tid]);
         
            if ($query_member) {
                $response['status']=1;
                $response['msg']='บันทึกข้อมูลสำเร็จ';
            } else {
                $response['status']=0;
                $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
            }
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
        if($mail_ck != ""){
            $query_chk = $db->query("SELECT * FROM `member` WHERE `email` = '$mail_ck'  AND  `status` = '1'");
            $row = $query_chk->getRowArray();
            if ($row){
                $response['status'] = 0;
                $response['msg'] = 'มีอีเมล์นี้แล้ว';
            }else{
                $response['status'] = 1;
                $response['msg'] = 'สามารถใช้อีเมล์นี้ได้';
              
            }
        }else{
            $response['status'] = 1;
            $response['msg'] = '';
        }
       
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checkline"){
    $response = [
        'even' => 'checkline', 
        'line' => $line_ck,
    ];
    if($line_ck != ""){
        $query_chk = $db->query("SELECT * FROM `member` WHERE `line` = '$line_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มี Line นี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้ Line นี้ได้';
          
        }
    }else{
        $response['status'] = 1;
        $response['msg'] = '';
    }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checkprofile"){
    $response = [
        'even' => 'checkprofile', 
        'line' => $profile_ck,
    ];
      
        if($profile_ck!=""){
            $query_chk = $db->query("SELECT * FROM `member` WHERE `profile_id` = '$profile_ck'  AND  `status` = '1'");
            $row = $query_chk->getRowArray();
            if ($row){
                $response['status'] = 0;
                $response['msg'] = 'มี id นี้แล้ว';
            }else{
                $response['status'] = 1;
                $response['msg'] = 'สามารถใช้ id นี้ได้';
              
            }
        }else{
            $response['status'] = 1;
            $response['msg'] = '';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checkidcard"){
    $response = [
        'even' => 'checkidcard', 
        'idcard' => $idcard_ck,
    ];
        $query_chk = $db->query("SELECT * FROM `member_info` WHERE `idcard` = '$idcard_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีเลขบัตรประชาชนนี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้เลขบัตรประชาชนนี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "checknumbank"){
    $response = [
        'even' => 'checknumbank', 
        'numbank' => $numbank_ck,
    ];
        $query_chk = $db->query("SELECT * FROM `member_bank` WHERE `numbank` = '$numbank_ck'  AND  `status` = '1'");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีเลขบัญขีธนาคารนี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้บัญขีธนาคารนี้ได้';
          
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if ($even == "del") { 
    $response = [
        'even' => 'del', 
    ];

    $sql = "UPDATE `member` SET `status` = ?  WHERE `member_id` = ?";
    $query = $db->query($sql, [99,$id]);

    $sql_bank = "UPDATE `member_bank` SET `status` = ? WHERE `member_id` = ?";
    $query_bank = $db->query($sql_bank, [99,$id]);

    $sql_info = "UPDATE `member_info` SET `status` = ?  WHERE `member_id` = ?";
    $query_info = $db->query($sql_info, [99,$id]);
    
    
    $response['status']=1;
    $response['msg']='บันทึกข้อมูลสำเร็จ';

    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if ($even == "dela") { 
    $query = $db->query("UPDATE  `member` SET `status` = 99  WHERE `member_id` = ?", [$id]);
    $query1 = $db->query("UPDATE  `member_bank` SET `status` = 99  WHERE `member_id` = ?", [$id]);
    $query2 = $db->query("UPDATE  `member_info` SET `status` = 99  WHERE `member_id` = ?", [$id]);
    if ($query) {
        $response['status']=1;
        $response['msg']='บันทึกข้อมูลสำเร็จ';
    } else {
        $response['status']=0;
        $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
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
