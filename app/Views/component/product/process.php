<?php 
$session = session();
$id = isset($_POST['id']) ? $_POST['id'] : '';
$st = isset($_POST['st']) ? $_POST['st'] : '';
$even = isset($_POST['even']) ? $_POST['even'] : '';
$tid= isset($_POST['tid']) ? $_POST['tid'] : '';
$product_code=isset($_POST['product_code']) ? $_POST['product_code'] : '';
$product_name=isset($_POST['product_name']) ? $_POST['product_name'] : '';
$price=isset($_POST['price']) ? $_POST['price'] : '';
$price_member=isset($_POST['price_member']) ? $_POST['price_member'] : '';
$pv=isset($_POST['pv']) ? $_POST['pv'] : '';
$note_short=isset($_POST['note_short']) ? $_POST['note_short'] : '';
$note=isset($_POST['note']) ? $_POST['note'] : '';
$type_id=isset($_POST['type_id']) ? $_POST['type_id'] : '';
$photo=isset($_POST['photo']) ? $_POST['photo'] : '';
$photo1=isset($_POST['photo1']) ? $_POST['photo1'] : '';
$photo2=isset($_POST['photo2']) ? $_POST['photo2'] : '';
$photo3=isset($_POST['photo3']) ? $_POST['photo3'] : '';
$cost=isset($_POST['cost']) ? $_POST['cost'] : '';
$discount=isset($_POST['discount']) ? $_POST['discount'] : '';
$value=isset($_POST['value']) ? $_POST['value'] : '';
$status=isset($_POST['status']) ? $_POST['status'] : '';
$photourl=isset($_POST['photourl']) ? $_POST['photourl'] : ''; 
$photourl1=isset($_POST['photourl1']) ? $_POST['photourl1'] : ''; 
$photourl2=isset($_POST['photourl2']) ? $_POST['photourl2'] : ''; 
$photourl3=isset($_POST['photourl3']) ? $_POST['photourl3'] : ''; 


$response = [];

$user = $session->get('username');

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
        if($type_id != '99'){
            $query_chk = $db->query("SELECT * FROM `product` WHERE `product_code` = ?", [$product_code]);
            $row = $query_chk->getRowArray();
            if (!$row) {
                $sql1 = "INSERT INTO `product` (`product_id`, `type_id`,`product_code`,`product_name`,`note_short`, `note`, `photo1`, `photo2`, `photo3`, `photo4`, `cost`, `price`,`price_member`,`pv`,`discount`,`status`) VALUES (NULL, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?)";
                $query1 = $db->query($sql1, [$type_id, $product_code, $product_name, $note_short, $note, $photourl, $photourl1, $photourl2, $photourl3, $cost, $price,$price_member,$pv,$discount,$status]);
                    
                if ($query1) {
                    $response['status'] = 1;
                    $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                }else{
                    $response['status'] = 0;
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเร็จ';
                }
            }else{
                $response['status'] = 0;
                $response['msg'] = 'รหัสสินค้านี้มีอยู่ในระบบแล้ว กรุณากรอกใหม่อีกครั้ง';
            }
        }else{
            $response['status']=0;
            $response['msg']='กรุณาเลือกประเภทสินค้า';
        }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

//status statusPromote statusShop statusUnilevel
if($even=="edit" && $tid!=""){
    $response = [
        'even' => 'edit',
        'id' => $tid,
        'product_name' => $product_name,
    ];
    if($type_id != '99'){    

        $query_chk = $db->query("SELECT * FROM `product` WHERE `product_id` = ?", [$tid]);
        $row = $query_chk->getRowArray();
        if ($row) {
            if ($row['product_code'] == $product_code) {
                $sql_update_same_code = "UPDATE `product` SET `type_id` = ?, `product_name` = ?, `price` = ?, `price_member` = ?, `pv` = ?, `photo1` = ?, `photo2` = ?, `photo3` = ?, `photo4` = ?, `status` = ?  ,`note_short` = ? ,  `note`= ? , `cost` = ? , `discount` = ? WHERE `product_id` = ?";
                $query_update = $db->query($sql_update_same_code, [$type_id, $product_name, $price, $price_member, $pv, $photourl, $photourl1, $photourl2, $photourl3, $status, $note_short,$note,$cost,$discount,$tid]);
        
                if ($query_update) {
                    $response['status'] = 1;
                    $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                } else {
                    $response['status'] = 0;
                    $response['msg'] = 'บันทึกข้อมูลไม่สำเร็จ';
                }
            } else {
                $query_chk1 = $db->query("SELECT * FROM `product` WHERE `product_code` = ?", [$product_code]);
                $row1 = $query_chk1->getRowArray();
                if (!$row1) {
                    $sql12 = "UPDATE `product` SET `product_code` = ?,`type_id` = ?, `product_name` = ?, `price` = ?, `price_member` = ?, `pv` = ?, `photo1` = ?, `photo2` = ?, `photo3` = ?, `photo4` = ?, `status` = ?  ,`note_short` = ? ,  `note`= ? , `cost` = ? , `discount` = ? WHERE `product_id` = ?";
                    $query12 = $db->query($sql12, [$product_code, $type_id, $product_name, $price, $price_member, $pv, $photourl, $photourl1, $photourl2, $photourl3, $status,$note_short,$note,$cost,$discount ,$tid]);
                    if ($query12) {
                        $response['status'] = 1;
                        $response['msg'] = 'บันทึกข้อมูลสำเร็จ';
                    }else{
                        $response['status'] = 0;
                        $response['msg'] = 'บันทึกข้อมูลไม่สำเร็จ';
                    }
                }else{
                    $response['status'] = 0;
                    $response['msg'] = 'รหัสสินค้านี้มีอยู่ในระบบแล้ว กรุณากรอกใหม่อีกครั้ง';
                }
            }
        } else {
            
            $response['status'] = 0;
            $response['msg'] = 'รหัสสินค้านี้มีอยู่ในระบบแล้ว111 กรุณากรอกใหม่อีกครั้ง';
        }
    }else{
        $response['status']=0;
        $response['msg']='กรุณาเลือกประเภทสินค้า';
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

if ($even == "del") { 
    $query = $db->query("UPDATE  `product` SET `status` = 99  WHERE `product_id` = ?", [$id]);
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
        'value' => $value,
    ];
    
    if($value == '1'){
        $query = $db->query("UPDATE `product` SET `status` = ?  WHERE `product_id` = ?", [$value,$id]);
        if ($query) {
            $response['status']=1;
            $response['msg']='บันทึกข้อมูลสำเร็จ';
        } else {
            $response['status']=0;
            $response['msg']='บันทึกข้อมูลไม่สำเร็จ';
        }
    }else{
        $query = $db->query("UPDATE `product` SET `status` = ?  WHERE `product_id` = ?", [$value,$id]);
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