<?php
$fc = new \App\Helpers\fcPosition($db);
$cat2 = $fc->memberPositionTypeList($db);

$fc2 = new \App\Helpers\fcBank($db);
$cat3 = $fc2->bankTypeList($db);
$even = isset($_POST['even'])?$_POST['even']:'edit';
$id = isset($_POST['id'])?$_POST['id']:'';
$selected='';
$note='';
    if ($even == "desc"){
        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
        $row = $query->getRow();

            if($row){
                $name = $row->name;
            }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-grid-alt"></i> ข้อมูลสมาชิก</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./member')?>"> จัดการข้อมูลสมาชิก</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<hr />
<form class="row g-3" id="formMember" method="post" enctype="multipart/form-data" name="formMember">
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-5">
            <div class="row no-gutters">
                <div class="col-md-8 order-md-1 mb-2 ">
                    <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-user-plus"></i>
                        <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?>
                    </h5>
                </div>
                <div class="col-md-4 order-md-2">
                    <div class="text-md-end text-center">
                        <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                            <i class="fadeIn animated bx bx-arrow-back"></i>
                            &nbsp;
                            กลับจัดการข้อมูลสมาชิก
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php
                        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
                        $row = $query->getRow();   
                        if($row){
                            $status = $row->status;
                            $profile_id = $row->profile_id;
                            $password = $row->password;
                            $telephone = $row->telephone;
                            $email = $row->email;
                            $line = $row->line;
                            $name = $row->name;
                            $photo = $row->photo;
                            $position_id = $row->position_id;
                            $status = $row->status;
                        }
                    ?>

                    <form class="row g-3" id="formMember" method="post" enctype="multipart/form-data" name="formMember">
                        <div class="card border-top border-0 border-4 border-warning">
                            <div class="card-body p-5">
                                <div class="row no-gutters">
                                    <div class="col-md-8 order-md-1 mb-2 ">
                                        <h5 class="text-md-start text-center mb-0"> <i
                                                class="fadeIn animated bx bx-user-plus"></i>
                                            ข้อมูลสมาชิก
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="hidden" class="form-control" id="even" name="even"
                                            value="<?=$even?>">
                                        <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <label for="profile_id" class="form-label">ID</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-user-circle'></i></span>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="profile_id" name="profile_id"
                                                            value="<?=$profile_id?>" disabled/>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-key'></i></span>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="password" name="password"
                                                            placeholder="กรุณากรอกรหัสผ่าน"
                                                            <?php if($even == "editMem"){  }else{  echo "required";  }?> disabled/>
                                                    </div>

                                                    <?php if($even == "editMem"){  ?> <small class="text-danger">*
                                                        ถ้าไม่เปลี่ยนรหัสผ่านไม่ต้องกรอกข้้อมูลใดๆๆลงช่องกรอกนี้้
                                                        *</small><?php }else{ ?><small class="text-danger">*
                                                        กรุณากรอกเป็นภาษาอังกฤษพร้อมตัวเลข เพื่อป้องกันการเข้าถึง
                                                        *</small><?php } ?>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="name" class="form-label">ชื่อสมาชิก</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-user-circle'></i></span>
                                                        <input type="text" class="form-control border-start-0" id="name"
                                                            name="name" value="<?=$name?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">ระดับสมาชิก</label>
                                                    <div class="input-group">
                                                        <button class="btn btn-outline-secondary" type="button"><i
                                                                class='fadeIn animated bx bx-buildings'></i>
                                                        </button>
                                                        <select class="form-select single-select" id="position_id"
                                                            name="position_id"
                                                            aria-label="Example select with button addon" disabled>
                                                            <option value="99">-- เลือกระดับสมาชิก --</option>
                                                            <?php
                                                        foreach($cat2 as $cats2){
                                                            if($even == "desc") {$selected = $cats2->position_id==$position_id?"selected":"";}
                                                                echo $cats2->position_id;
                                                                echo '<option value="'.$cats2->position_id.'" '.$selected.'>'.$cats2->position_name.'</option>';
                                                            } 
                                                        ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="telephone" class="form-label">เบอร์โทรศัพท์</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-phone-call'></i></span>
                                                        <input type="number" class="form-control border-start-0"
                                                            id="telephone" name="telephone" value="<?=$telephone?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="email" class="form-label">อีเมล์</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-mail-send'></i></span>
                                                        <input type="email" class="form-control border-start-0"
                                                            id="email" name="email" value="<?=$email?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="line" class="form-label">Line</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-globe'></i></span>
                                                        <input type="text" class="form-control border-start-0" id="line"
                                                            name="line" value="<?=$line?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="photo" class="form-label"><i
                                                                class="fadeIn animated bx bx-images"></i>
                                                            รูปภาพสมาชิก</label>
                                                        <br>
                                                        <div class="col-4" id="showPhoto"> </div>
                                                        <div class="col-4" id="showPhotoE">
                                                            <?php if($photo == ""){ }else{ ?> <img
                                                                src="<?=$_ENV['FileService']?>photo/<?=$photo?>"
                                                                width="50%" height="50%"><?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $query_info = $db->query("SELECT * FROM `member_info` WHERE `member_id` = ? " ,[$id]);
                    $row_info = $query_info->getRow();
                    if($row_info){
                        $idcard = $row_info->idcard;
                        $firstname = $row_info->firstname;
                        $lastname = $row_info->lastname;
                        $birthday = $row_info->birthday;
                        $zipcode = $row_info->zipcode;
                        $photo1 = $row_info->idcard_photo;
                        $address = $row_info->address;
                    }
                    ?>

                    <form class="row g-3" id="formInfo" method="post" enctype="multipart/form-data" name="formInfo">
                        <div class="card border-top border-0 border-4 border-info">
                            <div class="card-body p-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row no-gutters">
                                            <div class="col-md-8 order-md-1 mb-2 ">
                                                <h5 class="text-md-start text-center mb-0"> <i
                                                        class="fadeIn animated bx bx-user-circle"></i>
                                                    รายละเอียดข้อมูลสมาชิก

                                                </h5>
                                            </div>
                                        </div>
                                        <hr>
                                        <input type="hidden" class="form-control" id="even" name="even"
                                            value="<?=$even?>">
                                        <input type="hidden" class="form-control" id="infoid" name="infoid"
                                            value="<?=$id?>">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <label for="firstname" class="form-label">ชื่อ
                                                        (ตามบัตรประชาชน)</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-user-circle'></i></span>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="firstname" name="firstname" value="<?=$firstname?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="lastname" class="form-label">นามสกุล
                                                        (ตามบัตรประชาชน)</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-user-circle'></i></span>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="lastname" name="lastname" value="<?=$lastname?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-id-card'></i></span>
                                                        <input type="number" class="form-control border-start-0"
                                                            id="idcard" name="idcard" value="<?=$idcard?>" disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="birthday" class="form-label">วัน/เดือน/ปีเกิด</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-cake'></i></span>
                                                        <input type="date" class="form-control border-start-0"
                                                            id="birthday" name="birthday" value="<?=$birthday?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="address" class="form-label">ที่อยู่</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-target-lock'></i></span>
                                                        <input type="text" class="form-control border-start-0"
                                                            id="address" name="address" value="<?=$address?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="zipcode" class="form-label">รหัสไปรษณีย์</label>
                                                    <div class="input-group"> <span
                                                            class="input-group-text bg-transparent"><i
                                                                class='fadeIn animated bx bx-pin'></i></span>
                                                        <input type="number" class="form-control border-start-0"
                                                            id="zipcode" name="zipcode" value="<?=$zipcode?>"
                                                            disabled />
                                                    </div>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label for="note" class="form-label">รายละเอียด</label>
                                                    <textarea id="summernote" class="form-control" rows="3"
                                                        name="note" ><?=$note?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label"><i
                                                            class="fadeIn animated bx bx-images"></i>
                                                        รูปภาพบัตรประชาชน</label>
                                                    <br>
                                                    <div class="col-4" id="showPhoto1"> </div>
                                                    <?php // if($even=="edit"){?>
                                                    <div class="col-4" id="showPhotoE1">
                                                        <?php if($photo1 == ""){ }else{ ?> <img
                                                            src="<?=$_ENV['FileService']?>photo/<?=$photo1?>"
                                                            width="50%" height="50%"><?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    $query_bank = $db->query("SELECT * FROM `member_bank` WHERE `member_id` = ? " ,[$id]);
                    $row_bank = $query_bank->getRow();
                    if($row_bank){
                        $bank_id = $row_bank->bank_id;
                        $numbank = $row_bank->numbank;
                        $account_name = $row_bank->account_name;
                        $photo2 = $row_bank->bookbank_photo;
                    }
                    ?>

                    <form class="row g-3" id="formBank" method="post" enctype="multipart/form-data" name="formBank">
                        <div class="card border-top border-0 border-4 border-danger">

                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                                    <input type="hidden" class="form-control" id="nobankid" name="nobankid"
                                        value="<?=$id?>">
                                    <div class="card-body p-5">
                                        <div class="row no-gutters">
                                            <div class="col-md-8 order-md-1 mb-2 ">
                                                <h5 class="text-md-start text-center mb-0"> <i
                                                        class="fadeIn animated bx bx-buildings"></i>
                                                    ข้อมูลบัญชีธนาคาร
                                                </h5>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <label class="form-label">ชื่อธนาคาร</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary" type="button"><i
                                                            class='fadeIn animated bx bx-buildings'></i>
                                                    </button>
                                                    <select class="form-select single-select" id="bank_id"
                                                        name="bank_id" aria-label="Example select with button addon" disabled>
                                                        <option value="99">-- เลือกชื่อธนาคาร --</option>
                                                        <?php
                                                            foreach($cat3 as $cats3){
                                                                if($even == "desc") {$selected = $cats3->BankCode==$bank_id?"selected":"";} 
                                                                    echo $cats3->BankCode;
                                                                    echo '<option value="'.$cats3->BankCode.'" '.$selected.'>'.$cats3->bankNameTh.'</option>';
                                                            } 
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label for="account_name" class="form-label">ชื่อบัญชี</label>
                                                <div class="input-group"> <span
                                                        class="input-group-text bg-transparent"><i
                                                            class='fadeIn animated bx bx-credit-card-front'></i></span>
                                                    <input type="text" class="form-control border-start-0"
                                                        id="account_name" name="account_name" value="<?=$account_name?>"
                                                        disabled />
                                                </div>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <label for="numbank" class="form-label">เลขที่บัญชี</label>
                                                <div class="input-group"> <span
                                                        class="input-group-text bg-transparent"><i
                                                            class='fadeIn animated bx bx-credit-card-front'></i></span>
                                                    <input type="text" class="form-control border-start-0" id="numbank"
                                                        name="numbank" value="<?=$numbank?>" disabled />
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label"><i
                                                            class="fadeIn animated bx bx-images"></i>
                                                        รูปภาพสมุดบัญชี</label>
                                                    <br>
                                                    <div class="col-4" id="showPhoto2"> </div>
                                                    <?php // if($even=="edit"){?>
                                                    <div class="col-4" id="showPhotoE2">
                                                        <?php if($photo2 == ""){ }else{ ?> <img
                                                            src="<?=$_ENV['FileService']?>photo/<?=$photo2?>"
                                                            width="50%" height="50%"><?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-12">
                    <div class="card border-top border-0 border-4 border-danger">

                        <div class="row">
                            <div class="col-12">
                                <div class="card-body p-5">
                                    <div class="row no-gutters">
                                        <div class="col-md-8 order-md-1 mb-2 ">
                                            <h5 class="text-md-start text-center mb-0"> <i
                                                    class="fadeIn animated bx bx-buildings"></i>
                                                ข้อมูลส่งสินค้า
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr class="text-nowrap bg-warning">
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-nowrap">ชื่อ</th>
                                                    <th class="text-nowrap">ที่อยู่</th>
                                                    <th class="text-nowrap">รหัสไปรษณีย์</th>
                                                    <th class="text-nowrap">เบอร์โทรศัพท์</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i=0;
                                                    $query_ship = $db->query("SELECT * FROM `member_shipping` WHERE `member_id` = '$id' AND `status` <> '99' ORDER BY `member_shopping_id` DESC ");
                                                    foreach($query_ship->getResult('array') as $row){ 
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?=$i?></td>
                                                    <td class="text-nowarp align-middle">
                                                        <?=esc($row['fullname'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['address'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['zipcode'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['telephone'])?>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>

<script>
    $(document).ready(function() {
    $('#btn_back1').click(function(e) {
        e.preventDefault();
        $.post("./component/member/viewlist", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#summernote').summernote('disable');
    $('#summernote1').summernote('disable');

    $('#dataTable').DataTable();
});
</script>