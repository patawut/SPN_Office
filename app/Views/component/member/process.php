<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$idCard=isset($_POST['idCard']) ? $_POST['idCard'] : '';
$firstname=isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname=isset($_POST['lastname']) ? $_POST['lastname'] : '';
$lv=isset($_POST['lv']) ? $_POST['lv'] : '';
$lv1=isset($_POST['lv1']) ? $_POST['lv1'] : '';
$lv2=isset($_POST['lv2']) ? $_POST['lv2'] : '';
$lv3=isset($_POST['lv3']) ? $_POST['lv3'] : '';
$downline=isset($_POST['downline']) ? $_POST['downline'] : '';
$firstname1=isset($_POST['firstname1']) ? $_POST['firstname1'] : '';
$idCard1=isset($_POST['idCard1']) ? $_POST['idCard1'] : '';
$mname=isset($_POST['mname']) ? $_POST['mname'] : '';
$address=isset($_POST['address']) ? $_POST['address'] : '';
$photo=isset($_POST['photo']) ? $_POST['photo'] : '';
$photo1=isset($_POST['photo1']) ? $_POST['photo1'] : '';
$photo2=isset($_POST['photo2']) ? $_POST['photo2'] : '';
$provinces=isset($_POST['provinces']) ? $_POST['provinces'] : '';
$amphur=isset($_POST['amphur']) ? $_POST['amphur'] : '';

$districts=isset($_POST['districts']) ? $_POST['districts'] : '';
$zipcode=isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
$bankcode=isset($_POST['bankcode']) ? $_POST['bankcode'] : '';
$bank_no=isset($_POST['bank_no']) ? $_POST['bank_no'] : '';
$typeRegister=isset($_POST['typeRegister']) ? $_POST['typeRegister'] : '';

$memID=isset($_POST['memID']) ? $_POST['memID'] : '';
$guideMem=isset($_POST['guideMem']) ? $_POST['guideMem'] : '';
$status=isset($_POST['status']) ? $_POST['status'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : '';
$photourl1=isset($_POST['photourl1']) ? $_POST['photourl1'] : '';
$photourl2=isset($_POST['photourl2']) ? $_POST['photourl2'] : '';

$ppID=isset($_POST['ppID']) ? $_POST['ppID'] : '';
$TYPE=isset($_POST['TYPE']) ? $_POST['TYPE'] : '';

$v=isset($_POST['v']) ? $_POST['v'] : '';
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
                $response['msg'] = 'success';
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

if($even == "searchProvince"){
    $response = [
        'even' => 'searchProvince', 
        'ppID' => $ppID,
        'TYPE' => $TYPE,
    ];
    if($TYPE=='amphures'){
        $query_chk = $db->query("SELECT AMPHUR_ID, AMPHUR_NAME FROM `amphures` WHERE `PROVINCE_ID`='$ppID'");
        $row = $query_chk->getResult('array');
        if ($row) {
            $response['status'] = 1;
            $response['msg'] = 'success';
            $response['rowdata'] = $row; 
        } else {
            $response['status'] = 0;
            $response['msg'] = 'ไม่พบข้อมูล';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "searchAmphur"){
    $response = [
        'even' => 'searchAmphur', 
        'ppID' => $ppID,
        'TYPE' => $TYPE,
    ];
    if($TYPE=='districts'){
        $query_chk = $db->query("SELECT DISTRICT_ID, DISTRICT_NAME,DISTRICT_CODE FROM districts WHERE AMPHUR_ID='".$ppID."'");
        $row = $query_chk->getResult('array');
        if ($row) {
            $response['status'] = 1;
            $response['msg'] = 'success';
            $response['rowdata'] = $row; 
        } else {
            $response['status'] = 0;
            $response['msg'] = 'ไม่พบข้อมูล';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if($even == "searchDistrict"){
    $response = [
        'even' => 'searchDistrict', 
        'ppID' => $ppID,
        'TYPE' => $TYPE,
    ];
    if($TYPE=='zipcode'){
        $query_chk = $db->query("SELECT zipcode FROM zipcodes WHERE district_code='".$ppID."'");
        $row = $query_chk->getResult('array');
        if ($row) {
            $response['status'] = 1;
            $response['msg'] = 'success';
            $response['rowdata'] = $row; 
        } else {
            $response['status'] = 0;
            $response['msg'] = 'ไม่พบข้อมูล';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}


if ($even == "add"){
    //print_r($_POST);
        $response = [
            'even' => 'add', 
        ];
        //typeRegister
        if($lv ==1){
            if($v==1){
                if($vv==1){
                    if($typeRegister==2){
                        try {
                            $sql1 = "INSERT INTO `member` (`memberID`, `idCard`,`firstname`, `position`,`guideCode` ,`status`) VALUES (NULL, ?, ?, ?, ?,?)";
                            $query1 = $db->query($sql1, [$idCard1, $firstname1, $lv1 ,$guideMem, 2]);
                            $idreturn = $db->insertID();
                            $sql_max = "SELECT * FROM `member` WHERE  `idCard` ='$idCard1' AND `status` <> '99'";
                            $query_max = $db->query($sql_max);
                            $row_max = $query_max->getRowArray();
                            $max = $row_max['memberID'];
                            //id ล่าสุด  upline update 2 ไป และ id ที่ 2 ไปอับ downline เป็น id 22 
                            if($downline == "L"){
                                $sql_update_l = "UPDATE `member` SET `downlineLeft` = ?  WHERE `memberID` = ?";
                                $query_update_l = $db->query($sql_update_l, [$max,$tid]);
                                $sql_update_l_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                $query_update_l_max = $db->query($sql_update_l_max, [$tid ,$max]);
                            }else{
                                $sql_update_r = "UPDATE `member` SET `downlineRight` = ? WHERE `memberID` = ?";
                                $query_update_r = $db->query($sql_update_r, [$max, $tid]);
                                $sql_update_r_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                $query_update_r_max = $db->query($sql_update_r_max, [$tid ,$max]);
                                
                            }
                            $sql_log = "INSERT INTO memberlog (`logID`, `member`,`detail`, `type` ,`status`) VALUES (NULL, ?, ?, ?, ?)";
                                $query_log = $db->query($sql_log, [$max, 'เพิ่มข้อมูลนิติบุคคล 1 สมาชิก', '1' , 1]);
                            $response['status'] = 1;
                            $response['msg'] = 'บันทึกข้อมูลนิตบุคคลสำเร็จ';
                        //  $response['idreturn']=$idreturn;        
                        } catch (\Throwable $th) {
                        // $response['post']=$_POST;
                            $response['profile']="เลขประจำตัวผู้เสียภาษีนี้มีในระบบแล้ว";
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                            exit();
                        }
                    }else{
                        try {
                            $sql1 = "INSERT INTO `member` (`memberID`, `idCard`,`firstname`,`lastname`, `position`,`guideCode`  ,`status`) VALUES (NULL, ?, ?, ?, ?,?,?)";
                            $query1 = $db->query($sql1, [$idCard, $firstname, $lastname, $lv1, $guideMem , 1]);
                            $idreturn = $db->insertID();
                            $sql_max = "SELECT * FROM `member` WHERE `idCard` ='$idCard' AND `status` <> '99' ";
                            $query_max = $db->query($sql_max);
                            $row_max =  $query_max->getRowArray();
                            $max = $row_max['memberID'];
                            if($downline == "L"){
                                $sql_update_l = "UPDATE `member` SET `downlineLeft` = ?  WHERE `memberID` = ?";
                                $query_update_l = $db->query($sql_update_l, [$max,$tid]);
                                $sql_update_l_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                $query_update_l_max = $db->query($sql_update_l_max, [$tid ,$max]);
                            }else{
                                $sql_update_r = "UPDATE `member` SET `downlineRight` = ? WHERE `memberID` = ?";
                                $query_update_r = $db->query($sql_update_r, [$max, $tid]);
                                $sql_update_r_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                $query_update_r_max = $db->query($sql_update_r_max, [$tid ,$max]);
                            }
                            $sql_log = "INSERT INTO memberlog (`logID`, `member`,`detail`, `type` ,`status`) VALUES (NULL, ?, ?, ?, ?)";
                            $query_log = $db->query($sql_log, [$max, 'เพิ่มข้อมูลบุคคลธรรมดา 1 สมาชิก', '1' , 1]);
                            $response['status'] = 1;
                            $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                        // $response['idreturn']=$idreturn;        
                        } catch (\Throwable $th) {
                            //$response['post']=$_POST;
                            $response['msg']="รหัสบัตรประชาชนมีในระบบแล้ว";
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                            exit();
                        }
                    }
                }else{
                    $response['status'] = 0;
                    $response['msg'] = 'กรุณากดปุ่มเพื่อตรวจสอบเลขบัตรประชาชน/ผู้เสียภาษี ก่อน';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }
            }else{
                $response['status'] = 0;
                $response['msg'] = 'กรุณากดปุ่มเพื่อตรวจสอบรหัสผู้แนะนำ และ เลขบัตรประชาชน/ผู้เสียภาษี ก่อน';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }

            if($response['status']==1){
                $profile=array(); 
                $profile['address']=$address;
                $profile['provinces']=$provinces;
                $profile['amphur']=$amphur;
                $profile['districts']=$districts;
                $profile['zipcode']=$zipcode;
                $profile['bankcode']=$bankcode;
                $profile['bank_no']=$bank_no;
                $profile['typeRegister']=$typeRegister; 
                $profile['photoCard']=$photourl;
                $profile['photoCard1']=$photourl1;
                $profile['photoBook']=$photourl2;
              
                $datainsertFieldProfile= json_encode($profile, JSON_UNESCAPED_UNICODE);
                // $row=json_decode($data,true);
                //$row['address'];
                
                try {
                    
                    $sqlMemberProfile = "INSERT INTO `memberprofile` (`member`, `profile`,`type`) VALUES (?, ?, ?)";
                    $db->query($sqlMemberProfile, [$idreturn, $datainsertFieldProfile,$typeRegister]);
                    $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    exit();
                } catch (\Throwable $th) {
                    $response['profile']=$datainsertFieldProfile;
                    $response['msg']="Can't Save in member Profile";
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    exit();
                }
            }

        }else if($lv ==3){
            if($v==1){
                if($vv==1){
                    if($typeRegister==2){
                        $lv = array($lv1, $lv2, $lv3);
                        $i=1;
                        foreach ($lv as $lvs) {
                            $idCard11 = $idCard1 . $i;
                            $sql3 = "INSERT INTO `member` (`memberID`, `idCard`,`firstname`,`lastname`, `position`,`guideCode` , `status`) VALUES (NULL, ?, ?, ?, ?,?,?)";
                            $query3 = $db->query($sql3, [$idCard11, $firstname1, $lastname, $lvs, $guideMem , 2]);
                            $sql_max = "SELECT * FROM `member` WHERE  `idCard` ='$idCard11' AND `status` <> '99'";
                            $query_max = $db->query($sql_max);
                            $row_max = $query_max->getRowArray();
                            $max = $row_max['memberID'];
                            $data[] = $max;
                            $sql_log = "INSERT INTO memberlog (`logID`, `member`,`detail`, `type` ,`status`) VALUES (NULL, ?, ?, ?, ?)";
                            $query_log = $db->query($sql_log, [$max, 'เพิ่มนิติบุคคล 3 สมาชิก (สมาชิกลำดับที่'. $i.')', '1' , 1]);

                                if($downline == "L"){
                                    $sql_update_l = "UPDATE `member` SET `downlineLeft` = ?  WHERE `memberID` = ?";
                                    $query_update_l = $db->query($sql_update_l, [$data[0],$tid]);
                                    $sql_update_l_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                    $query_update_l_max = $db->query($sql_update_l_max, [$tid ,$data[0]]);
                                }else{
                                    $sql_update_r = "UPDATE `member` SET `downlineRight` = ? WHERE `memberID` = ?";
                                    $query_update_r = $db->query($sql_update_r, [$data[0], $tid]);
                                    $sql_update_r_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                    $query_update_r_max = $db->query($sql_update_r_max, [$tid ,$data[0]]);
                            }
                            $i++;
                        }
                        $sql_update_l2_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                        $query_update_l2_max = $db->query($sql_update_l2_max, [$data[0] ,$data[1]]);
                        $sql_update_l3_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                        $query_update_l3_max = $db->query($sql_update_l3_max, [$data[0] ,$data[2]]);


                        $sql_update_l1 = "UPDATE `member` SET `downlineLeft` = ? ,`downlineRight` = ? WHERE `memberID` = ?";
                        $query_update_l1 = $db->query($sql_update_l1, [$data[1],$data[2],$data[0]]);

                        $response['status'] = 1;
                    // $response['msg'] = 'บันทึกข้อมูลสำเร็จ';

                        if($response['status']==1){
                            $profile=array(); 
                            $profile['address']=$address;
                            $profile['provinces']=$provinces;
                            $profile['amphur']=$amphur;
                            $profile['districts']=$districts;
                            $profile['zipcode']=$zipcode;
                            $profile['bankcode']=$bankcode;
                            $profile['bank_no']=$bank_no;
                            $profile['typeRegister']=$typeRegister; 
                            $profile['photoCard']=$photourl;
                            $profile['photoCard1']=$photourl1;
                            $profile['photoBook']=$photourl2;
                            $datainsertFieldProfile= json_encode($profile, JSON_UNESCAPED_UNICODE);
                            // $row=json_decode($data,true);
                            //$row['address'];
                            
                            try {
                                for($j=0;$j<=2;$j++){
                                    $sqlMemberProfile = "INSERT INTO `memberprofile` (`member`, `profile`,`type`) VALUES (?, ?, ?)";
                                    $db->query($sqlMemberProfile, [$data[$j], $datainsertFieldProfile,$typeRegister]);
                                    //$response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                                    
                                }
                                $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                exit();
                            } catch (\Throwable $th) {
                                $response['profile']=$datainsertFieldProfile;
                                $response['msg']="Can't Save in member Profile";
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                exit();
                            }
                            
                            
                        }
                    }else{
                        $lv = array($lv1, $lv2, $lv3);
                        $i=1;
                        foreach ($lv as $lvs) {
                            $idCard1 = $idCard . $i;
                            $sql4 = "INSERT INTO `member` (`memberID`, `idCard`,`firstname`,`lastname`, `position`, `guideCode`, `status`) VALUES (NULL, ?, ?, ?, ?,?,?)";
                            $query4 = $db->query($sql4, [$idCard1, $firstname, $lastname, $lvs, $guideMem, 1]);
                            $sql_max = "SELECT * FROM `member` WHERE  `idCard` ='$idCard1' AND `status` <> '99'";
                            $query_max = $db->query($sql_max);
                            $row_max = $query_max->getRowArray();
                            $max = $row_max['memberID'];
                            $sql_log = "INSERT INTO memberlog (`logID`, `member`,`detail`, `type` ,`status`) VALUES (NULL, ?, ?, ?, ?)";
                            $query_log = $db->query($sql_log, [$max, 'เพิ่มบุคคลธรรมดา 3 สมาชิก (สมาชิกลำดับที่'. $i.')', '1' , 1]);
                            $data[] = $max;

                                if($downline == "L"){
                                    $sql_update_l = "UPDATE `member` SET `downlineLeft` = ?  WHERE `memberID` = ?";
                                    $query_update_l = $db->query($sql_update_l, [$data[0],$tid]);
                                    $sql_update_l_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                    $query_update_l_max = $db->query($sql_update_l_max, [$tid ,$data[0]]);
                                }else{
                                    $sql_update_r = "UPDATE `member` SET `downlineRight` = ? WHERE `memberID` = ?";
                                    $query_update_r = $db->query($sql_update_r, [$data[0], $tid]);
                                    $sql_update_r_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                                    $query_update_r_max = $db->query($sql_update_r_max, [$tid ,$data[0]]);
                                }
                            $i++;
                        }
                        $sql_update_l2_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                        $query_update_l2_max = $db->query($sql_update_l2_max, [$data[0] ,$data[1]]);

                        $sql_update_l3_max = "UPDATE `member` SET  `uplineCode` = ? WHERE `memberID` = ?";
                        $query_update_l3_max = $db->query($sql_update_l3_max, [$data[0] ,$data[2]]);

                        $sql_update_l1 = "UPDATE `member` SET `downlineLeft` = ? ,`downlineRight` = ? WHERE `memberID` = ?";
                        $query_update_l1 = $db->query($sql_update_l1, [$data[1],$data[2],$data[0]]);

                        
                        $response['data'] = $data;
                        $response['status'] = 1;
                    // $response['msg'] = 'บันทึกข้อมูลสำเร็จ';

                        if($response['status']==1){
                            $profile=array(); 
                            $profile['address']=$address;
                            $profile['provinces']=$provinces;
                            $profile['amphur']=$amphur;
                            $profile['districts']=$districts;
                            $profile['zipcode']=$zipcode;
                            $profile['bankcode']=$bankcode;
                            $profile['bank_no']=$bank_no;
                            $profile['typeRegister']=$typeRegister; 
                            $profile['photoCard']=$photourl;
                            $profile['photoCard1']=$photourl1;
                            $profile['photoBook']=$photourl2;
                            $datainsertFieldProfile= json_encode($profile, JSON_UNESCAPED_UNICODE);
                            // $row=json_decode($data,true);
                            //$row['address'];
                            
                            try {
                                for($j=0;$j<=2;$j++){
                                    $sqlMemberProfile = "INSERT INTO `memberprofile` (`member`, `profile`,`type`) VALUES (?, ?, ?)";
                                    $db->query($sqlMemberProfile, [$data[$j], $datainsertFieldProfile,$typeRegister]);
                                    
                                }
                                $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                            // exit();
                            } catch (\Throwable $th) {
                                $response['profile']=$datainsertFieldProfile;
                                $response['msg']="Can't Save in member Profile";
                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                exit();
                            }
                        }
                        
                    }
                }else{
                    $response['status'] = 0;
                    $response['msg'] = 'กรุณากดปุ่มเลขบัตรประชาชน/ผู้เสียภาษีก่อน';
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                }    
                //echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }else{
                $response['status'] = 0;
                $response['msg'] = 'กรุณากดปุ่มเพื่อตรวจสอบรหัสผู้แนะนำก่อน';
                echo json_encode($response, JSON_UNESCAPED_UNICODE);
            }
            
        }
}

if($even == "searchMem"){
    $response = [
        'even' => 'searchMem', 
        'guideMem' => $guideMem,
        'tid' => $tid,
    ];
        //ติดตรงนี้ ตรวจสอบ guidecode รหัสนั้นมีแล้วหรือยัง ถ้าไม่มีใส่ได้ แต่ห้ามใส่ซ้ำรหัสของที่จะสร้าง สมมุติเลย 2 มา ห้ามใส่ 2 ลงในguide
        //$query_chk = $db->query("SELECT * FROM `member`WHERE `memberID` LIKE '%$guideMem%' AND `guideCode` IS NULL;");
        $query_chk = $db->query("SELECT * FROM `member`WHERE `memberID` = '$guideMem'  AND  `status` <> '99' ");
        $row = $query_chk->getRowArray();
        if ($row){
            if($row['memberID'] != $tid){
                $response['status'] = 1;
                $response['msg'] = 'สามารถใช้รหัสแนะนำนี้ได้';
            }else{
                $response['status'] = 0;
                $response['msg'] = 'เป็นรหัสเหมือนกับด้านบน';
            }
        } else {
            $response['status'] = 0;
            $response['msg'] = 'ไม่มีผู้แนะนำรหัสนี้';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
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


if($even == "searchMemID1"){
    $response = [
        'even' => 'searchMemID1', 
        'memID' => $memID,
        'tid' => $tid,
    ];
        //ติดตรงนี้ ตรวจสอบ guidecode รหัสนั้นมีแล้วหรือยัง ถ้าไม่มีใส่ได้ แต่ห้ามใส่ซ้ำรหัสของที่จะสร้าง สมมุติเลย 2 มา ห้ามใส่ 2 ลงในguide
        //$query_chk = $db->query("SELECT * FROM `member`WHERE `memberID` LIKE '%$guideMem%' AND `guideCode` IS NULL;");
        $query_chk = $db->query("SELECT * FROM `member` WHERE `idCard` LIKE '%$memID%'  AND  `status` <> '99' ");
        $row = $query_chk->getRowArray();
        if ($row){
            $response['status'] = 0;
            $response['msg'] = 'มีเลขประจำตัวผู้เสียภาษีนี้แล้ว';
        }else{
            $response['status'] = 1;
            $response['msg'] = 'สามารถใช้เลขประจำตัวผู้เสียภาษีนี้ได้';
        }
       // echo json_encode($row, JSON_UNESCAPED_UNICODE);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}