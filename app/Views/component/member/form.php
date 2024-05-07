<?php
    $fc = new \App\Helpers\fcUser($db);
    $fc2 = new \App\Helpers\fcBank($db);
    $fc3 = new \App\Helpers\fcPosition($db);
    $cat2 = $fc2->bankTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $email='';
    $line='';
    $telephone='';
    $password='';
    $profile_id='';
    $selected='';
    $position_id='';
    $photourl='';
    $showPhotoE='';
    $photo='';
    $status='';

    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $accout_name = $row->member_id;
            $status = $row->status;
            $profile_id = $row->profile_id;
            $password = $row->password;
            $telephone = $row->telephone;
            $email = $row->email;
            $line = $row->line;
            $name = $row->name;
            $photo = $row->photo;
            $position_id = $row->position_id;
            $showPhotoE = $row->showPhotoE;
            $photourl = $row->photourl;
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
<div
    class="card border-top border-0 border-4 <?php if($even == "edit"){ echo "border-danger";  }else{ echo "border-primary";} ?>">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-book-content"></i>
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลบัญชีรับเงิน";  }else{ echo "เพิ่มข้อมูลบัญชีรับเงิน";} ?>
                </h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับจัดการข้อมูลบัญชีรับเงิน
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formBankAcc" method="post" enctype="multipart/form-data" name="formBankAcc">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-12">
                <label class="form-label">ชื่อธนาคาร</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i
                            class='fadeIn animated bx bx-buildings'></i>
                    </button>
                    <select class="form-select single-select" id="bankcode" name="bankcode"
                        aria-label="Example select with button addon">
                        <option value="99">-- เลือกชื่อธนาคาร --</option>
                        <?php
                            foreach($cat2 as $cats2){
                                if($even == "edit") {$selected = $cats2->BankCode==$bankcode?"selected":"";} 
                                echo $cats2->BankCode;
                                echo '<option value="'.$cats2->BankCode.'" '.$selected.'>'.$cats2->bankNameTh.'</option>';
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label for="accout_name" class="form-label">ชื่อบัญชี</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-user-circle'></i></span>
                    <input type="text" class="form-control border-start-0" id="accout_name" name="accout_name"
                        value="<?=$accout_name?>" required />
                </div>
            </div>
            <div class="col-12">
                <label for="accout_number" class="form-label">เลขบัญชี</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-message-alt-edit'></i></span>
                    <input type="text" class="form-control border-start-0" id="accout_number" name="accout_number"
                        value="<?=$accout_number?>" required />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                <label for="photo" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพหน้าบัญชีธนาคาร</label>
                    <br>
                    <div class="col-4" id="showPhoto"> </div>
                    <?php // if($even=="edit"){?>
                    <div class="col-4" id="showPhotoE"> <?php if($photo == ""){ }else{ ?> <img
                            src="<?=$_ENV['FileService']?>photo/<?=$photo?>" width="50%" height="50%"><?php } ?></div>
                    <br>
                    <?php // }  ?>
                    <br>
                    <div class="custom-file col-12">
                        <input class="form-control" id="photo" name="photo" type="file" accept=".jpg, .png, image/jpeg, image/png" >
                    </div>
                </div>
                <input type="hidden" name="photourl" id="photourl" value="<?=$photo?>">
            </div>
            <div class="col-12">
                <label class="form-label">สถานะ</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i class='fadeIn animated bx bx-show'></i>
                    </button>
                    <select class="form-select single-select" id="status" name="status"
                        aria-label="Example select with button addon">
                        <option value="1" <?=$status=="1"?"selected":""?>>เปิดใช้งาน</option>
                        <option value="0" <?=$status=="0"?"selected":""?>>ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center">
                    <button type="button" class="btn btn-danger btn_back2" id="btn_back2"><i
                            class="fadeIn animated bx bx-x"></i> &nbsp;ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="save"> <i
                            class="fadeIn animated bx bx-save"></i>&nbsp;บันทึก</button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function() {
    $('form#formBankAcc').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/bankaccount/process',
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
                        $.post("./component/bankaccount/list", (data) => {
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
        $.post("./component/bankaccount/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/bankaccount/list", (data) => {
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
});
</script>