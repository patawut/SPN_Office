<?php
    $fc = new \App\Helpers\fcPosition($db);
    $cat2 = $fc->memberPositionTypeList($db);

    $fc2 = new \App\Helpers\fcBank($db);
    $cat3 = $fc2->bankTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $email='';
    $line='';
    $name='';
    $telephone='';
    $password='';
    $profile_id='';
    $selected='';
    $position_id='';
    $photourl='';
    $showPhotoE='';
    $photo='';
    $photourl1='';
    $showPhotoE1='';
    $photo1='';
    $photourl2='';
    $showPhotoE12='';
    $photo2='';
    $status='';
    $firstname='';
    $lastname='';
    $idcard='';
    $birthday='';
    $line='';
    $address='';
    $zipcode='';
    $note='';
    $account_name='';
    $numbook='';
    $bank_id='';


    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
        $row = $query->getRow();
        $query_bank = $db->query("SELECT * FROM `member_bank` WHERE `member_id` = ? " ,[$id]);
        $row_bank = $query_bank->getRow();
        $query_info = $db->query("SELECT * FROM `member_info` WHERE `member_id` = ? " ,[$id]);
        $row_info = $query_info->getRow();
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

            $bank_id = $row_bank->bank_id;
            $numbank = $row_bank->numbank;
            $account_name = $row_bank->account_name;
            $photo2 = $row_bank->bookbank_photo;

            $idcard = $row_info->idcard;
            $firstname = $row_info->firstname;
            $lastname = $row_info->lastname;
            $birthday = $row_info->birthday;
            $zipcode = $row_info->zipcode;
            $photo1 = $row_info->idcard_photo;
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
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลตำแหน่งสมาชิก";  }else{ echo "เพิ่มข้อมูลตำแหน่งสมาชิก";} ?>
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
                        <?php if($even == "edit"){ echo "แก้ไขข้อมูลสมาชิก";  }else{ echo "เพิ่มข้อมูลสมาชิก";} ?>
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
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row no-gutters">
                                <div class="col-md-8 order-md-1 mb-2 ">
                                    <h5 class="text-md-start text-center mb-0"> <i
                                            class="fadeIn animated bx bx-user-circle"></i> ข้อมูลสมาชิก

                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">

                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-2">
                                        <label for="profile_id" class="form-label">ID</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-user-circle'></i></span>
                                            <input type="text" class="form-control border-start-0" id="profile_id"
                                                name="profile_id" value="<?=$profile_id?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-key'></i></span>
                                            <input type="text" class="form-control border-start-0" id="password"
                                                name="password" placeholder="กรุณากรอกรหัสผ่าน"
                                                <?php if($even == "add"){ echo "required"; }else{   }?> />
                                        </div>

                                        <?php if($even == "edit"){  ?> <small class="text-danger">*
                                            ถ้าไม่เปลี่ยนรหัสผ่านไม่ต้องกรอกข้้อมูลใดๆๆลงช่องกรอกนี้้
                                            *</small><?php }else{ ?><small class="text-danger">*
                                            กรุณากรอกเป็นภาษาอังกฤษพร้อมตัวเลข เพื่อป้องกันการเข้าถึง
                                            *</small><?php } ?>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="name" class="form-label">ชื่อสมาชิก</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-user-circle'></i></span>
                                            <input type="text" class="form-control border-start-0" id="name" name="name"
                                                value="<?=$name?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">ระดับสมาชิก</label>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary" type="button"><i
                                                    class='fadeIn animated bx bx-buildings'></i>
                                            </button>
                                            <select class="form-select single-select" id="position_id"
                                                name="position_id" aria-label="Example select with button addon">
                                                <option value="99">-- เลือกระดับสมาชิก --</option>
                                                <?php
                                                    foreach($cat2 as $cats2){
                                                        if($even == "edit") {$selected = $cats2->position_id==$position_id?"selected":"";} 
                                                        echo $cats2->position_id;
                                                        echo '<option value="'.$cats2->position_id.'" '.$selected.'>'.$cats2->position_name.'</option>';
                                                    } 
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="telephone" class="form-label">เบอร์โทรศัพท์</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-phone-call'></i></span>
                                            <input type="number" class="form-control border-start-0" id="telephone"
                                                name="telephone" value="<?=$telephone?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="email" class="form-label">อีเมล์</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-mail-send'></i></span>
                                            <input type="email" class="form-control border-start-0" id="email"
                                                name="email" value="<?=$email?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="line" class="form-label">Line</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-globe'></i></span>
                                            <input type="text" class="form-control border-start-0" id="line" name="line"
                                                value="<?=$line?>" required />
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="photo" class="form-label"><i
                                                    class="fadeIn animated bx bx-images"></i>
                                                รูปภาพสมาชิก</label>
                                            <br>
                                            <div class="col-4" id="showPhoto"> </div>
                                            <?php // if($even=="edit"){?>
                                            <div class="col-4" id="showPhotoE"> <?php if($photo == ""){ }else{ ?> <img
                                                    src="<?=$_ENV['FileService']?>photo/<?=$photo?>" width="50%"
                                                    height="50%"><?php } ?>
                                            </div>
                                            <br>
                                            <?php // }  ?>
                                            <br>
                                            <div class="custom-file col-12">
                                                <input class="form-control" id="photo" name="photo" type="file"
                                                    accept=".jpg, .png, image/jpeg, image/png">
                                            </div>
                                        </div>
                                        <input type="hidden" name="photourl" id="photourl" value="<?=$photo?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row no-gutters">
                                <div class="col-md-8 order-md-1 mb-2 ">
                                    <h5 class="text-md-start text-center mb-0"> <i
                                            class="fadeIn animated bx bx-user-circle"></i> รายละเอียดข้อมูลสมาชิก

                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 mb-2">
                                        <label for="firstname" class="form-label">ชื่อ (ตามบัตรประชาชน)</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-user-circle'></i></span>
                                            <input type="text" class="form-control border-start-0" id="firstname"
                                                name="firstname" value="<?=$firstname?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="lastname" class="form-label">นามสกุล (ตามบัตรประชาชน)</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-user-circle'></i></span>
                                            <input type="text" class="form-control border-start-0" id="lastname"
                                                name="lastname" value="<?=$lastname?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="idcard" class="form-label">เลขบัตรประชาชน</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-id-card'></i></span>
                                            <input type="number" class="form-control border-start-0" id="idcard"
                                                name="idcard" value="<?=$idcard?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="birthday" class="form-label">วัน/เดือน/ปีเกิด</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-cake'></i></span>
                                            <input type="date" class="form-control border-start-0" id="birthday"
                                                name="birthday" value="<?=$birthday?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="address" class="form-label">ที่อยู่</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-target-lock'></i></span>
                                            <input type="text" class="form-control border-start-0" id="address"
                                                name="address" value="<?=$address?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="zipcode" class="form-label">รหัสไปรษณีย์</label>
                                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                    class='fadeIn animated bx bx-pin'></i></span>
                                            <input type="number" class="form-control border-start-0" id="zipcode"
                                                name="zipcode" value="<?=$zipcode?>" required />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label for="note" class="form-label">รายละเอียด</label>
                                        <textarea id="summernote" class="form-control" rows="3" name="note"
                                            required><?=$note?></textarea>
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
                                        <div class="col-4" id="showPhotoE1"> <?php if($photo1 == ""){ }else{ ?> <img
                                                src="<?=$_ENV['FileService']?>photo/<?=$photo1?>" width="50%"
                                                height="50%"><?php } ?>
                                        </div>
                                        <br>
                                        <?php // }  ?>
                                        <br>
                                        <div class="custom-file col-12">
                                            <input class="form-control" id="photo1" name="photo1" type="file"
                                                accept=".jpg, .png, image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <input type="hidden" name="photourl1" id="photourl1" value="<?=$photo1?>">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="row no-gutters">
                                <div class="col-md-8 order-md-1 mb-2 ">
                                    <h5 class="text-md-start text-center mb-0"> <i
                                            class="fadeIn animated bx bx-buildings"></i> ข้อมูลบัญชีธนาคาร
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
                                        <select class="form-select single-select" id="bank_id" name="bank_id"
                                            aria-label="Example select with button addon">
                                            <option value="99">-- เลือกชื่อธนาคาร --</option>
                                            <?php
                                                    foreach($cat3 as $cats3){
                                                        if($even == "edit") {$selected = $cats3->BankCode==$bankcode?"selected":"";} 
                                                        echo $cats3->BankCode;
                                                        echo '<option value="'.$cats3->BankCode.'" '.$selected.'>'.$cats3->bankNameTh.'</option>';
                                                    } 
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="account_name" class="form-label">ชื่อบัญชี</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='fadeIn animated bx bx-credit-card-front'></i></span>
                                        <input type="text" class="form-control border-start-0" id="account_name"
                                            name="account_name" value="<?=$account_name?>" required />
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="numbook" class="form-label">เลขที่บัญชี</label>
                                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                                class='fadeIn animated bx bx-credit-card-front'></i></span>
                                        <input type="text" class="form-control border-start-0" id="numbook"
                                            name="numbook" value="<?=$numbook?>" required />
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
                                        <div class="col-4" id="showPhotoE2"> <?php if($photo2 == ""){ }else{ ?> <img
                                                src="<?=$_ENV['FileService']?>photo/<?=$photo2?>" width="50%"
                                                height="50%"><?php } ?>
                                        </div>
                                        <br>
                                        <?php // }  ?>
                                        <br>
                                        <div class="custom-file col-12">
                                            <input class="form-control" id="photo2" name="photo2" type="file"
                                                accept=".jpg, .png, image/jpeg, image/png">
                                        </div>
                                    </div>
                                    <input type="hidden" name="photourl2" id="photourl2" value="<?=$photo2?>">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label class="form-label">สถานะ</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button"><i
                                class='fadeIn animated bx bx-show'></i>
                        </button>
                        <select class="form-select single-select" id="status" name="status"
                            aria-label="Example select with button addon">
                            <option value="1" <?=$status=="1"?"selected":""?>>เปิดใช้งาน</option>
                            <option value="0" <?=$status=="0"?"selected":""?>>ปิดใช้งาน</option>
                        </select>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <button type="button" class="btn btn-danger btn_back2" id="btn_back2"><i
                                class="fadeIn animated bx bx-x"></i> &nbsp;ยกเลิก</button>
                        <button type="submit" class="btn btn-primary" id="save"> <i
                                class="fadeIn animated bx bx-save"></i>&nbsp;บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<script>
$(document).ready(function() {

    $('#idcard').keyup(function() {
        let p1 = $('#idcard').val();
        $.ajax({
            url: './component/member/process',
            type: 'POST',
            data: ({
                even: "searchIDcard",
                idcard_ck: p1,
            }),
            success: function(data) {
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {});
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.msg,
                    })
                    $('#idcard').val('');

                    //  console.log(data);
                }
            },
            statusCode: {
                404: () => {
                    alert("page not found")
                },
                500: () => {
                    alert("เกินข้อผิดพลาดภายในระบบ")
                }
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false
        });
    });


    $('form#formMember').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/member/process',
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        $.post("./component/member/list", (data) => {
                            $('#contentData').html(data);
                        }, "html");
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.msg,
                    })
                    //  console.log(data);
                }
            },
            statusCode: {
                404: () => {
                    alert("page not found")
                },
                500: () => {
                    alert("เกินข้อผิดพลาดภายในระบบ")
                }
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false
        });
    });

    $('#btn_back1').click(function(e) {
        e.preventDefault();
        $.post("./component/member/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/member/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });


    $('#photo').change(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('image', $('#photo')[0].files[0]);
        $.ajax({
            url: '<?=$_ENV['FileService']?>upload/photo',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    $('#photourl').val(data.filename);
                    $('#showPhoto').html('<img src="' + data.url +
                        '" width="50%" height="50%">');
                    $('#showPhotoE').hide();
                }
            },
            error: function(e) {

            }
        });
    });

    $('#photo1').change(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('image', $('#photo1')[0].files[0]);
        $.ajax({
            url: '<?=$_ENV['FileService']?>upload/photo',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    $('#photourl1').val(data.filename);
                    $('#showPhoto1').html('<img src="' + data.url +
                        '" width="50%" height="50%">');
                    $('#showPhotoE1').hide();
                }
            },
            error: function(e) {

            }
        });
    });

    $('#photo2').change(function(e) {
        e.preventDefault();
        var formData = new FormData();
        formData.append('image', $('#photo2')[0].files[0]);
        $.ajax({
            url: '<?=$_ENV['FileService']?>upload/photo',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.success) {
                    $('#photourl2').val(data.filename);
                    $('#showPhoto2').html('<img src="' + data.url +
                        '" width="50%" height="50%">');
                    $('#showPhotoE2').hide();
                }
            },
            error: function(e) {

            }
        });
    });


    $('#summernote').summernote({
        callbacks: {
            onImageUpload: function(files) {
                uploadImage(files[0]);
            }
        }
    });



    function uploadImage(file) {
        var formData = new FormData();
        formData.append('image', file);
        //check file size less than 2MB
        $.ajax({
            url: 'https://fileservice.patawut44.com/upload/photo',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data);
                $('#summernote').summernote("insertImage", data.url);
            },
            error: function(e) {
                console.log(e);
                alert('Error uploading image');
            }
        });
    }


    // เมื่อเกิดการเปลี่ยนแปลงในฟิลด์ที่ต้องการตรวจสอบ


});
</script>