<?php
    $fc = new \App\Helpers\fcUser($db);
    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $mid='';
    $password='';
    $fullname='';
    $username='';
    $status='';
    $typeuser='';
    $selected = '';

    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `user` WHERE `username` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $username = $row->username;
            $password = $row->password;
            $fullname = $row->fullname;
            $typeuser = $row->type;
        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class='bx bxs-user'></i> ข้อมูลผู้ใช้งาน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./userlist')?>"> จัดการข้อมูลผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลผู้ใช้งาน";  }else{ echo "เพิ่มข้อมูลผู้ใช้งาน";} ?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<hr />
<div class="card border-top border-0 border-4 <?php if($even == "edit"){ echo "border-danger";  }else{ echo "border-primary";} ?>">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0" > <i class="bx bxs-user me-1 "></i>  <?php if($even == "edit"){ echo "แก้ไขข้อมูลผู้ใช้งาน";  }else{ echo "เพิ่มข้อมูลผู้ใช้งาน";} ?></h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับข้อมูลผู้ใช้งาน
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formUser" method="post" enctype="multipart/form-data" name="formUser">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="uid" name="uid" value="<?=$id?>">
            <?php if($even == "add"){ ?>
            <div class="col-md-12">
                <label for="username" class="form-label">ชื่อ Username</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-user'></i></span>
                    <input type="text" class="form-control border-start-0" id="username" name="username"
                        placeholder="กรอกชื่อผู้เข้าระบบเพื่อใช้งาน" value="<?=$username?>">
                </div>
                <small class="text-danger">* กรุณากรอกเป็นภาษาอังกฤษเท่านั้น *</small>
            </div>
            <?php } ?>
            <?php if($even == "edit"){ ?>
            <div class="col-md-12">
                <label for="username" class="form-label">ชื่อ Username</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-user'></i></span>
                    <input type="text" class="form-control border-start-0" id="username" name="username"
                        placeholder="กรอกชื่อผู้เข้าระบบเพื่อใช้งาน" value="<?=$username?>" disabled />
                </div>
            </div>
            <?php } ?>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-lock-open'></i></span>
                    <input type="text" class="form-control border-start-0" id="password" name="password"
                        placeholder="กรุณากรอกรหัสผ่าน" <?php if($even == "add"){ echo "required"; }else{   }?> />
                </div>

                <?php if($even == "edit"){  ?> <small class="text-danger">*
                    ถ้าไม่เปลี่ยนรหัสผ่านไม่ต้องกรอกข้้อมูลใดๆๆลงช่องกรอกนี้้ *</small><?php }else{ ?><small
                    class="text-danger">* กรุณากรอกเป็นภาษาอังกฤษพร้อมตัวเลข เพื่อป้องกันการเข้าถึง *</small><?php } ?>
            </div>
            <div class="col-12">
                <label for="fullname" class="form-label">ชื่อผู้ใช้งาน</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-user-circle'></i></span>
                    <input type="text" class="form-control border-start-0" id="fullname" name="fullname"
                        placeholder="ชื่อ-นามสกุลของผู้ใช้งาน" value="<?=$fullname?>" required />
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">ระดับการเข้าถึง</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i class='fadeIn animated bx bx-key'></i>
                    </button>
                    <select class="form-select single-select" id="usertype" name="usertype"
                        aria-label="Example select with button addon">
                        <option value="99">-- เลือกระดับ --</option>
                        <option value="SuperAdmin" <?=$typeuser=="SuperAdmin"?"selected":""?>>SuperAdmin</option>
                        <option value="Owner" <?=$typeuser=="Owner"?"selected":""?>>Owner</option>
                        <option value="Administrator" <?=$typeuser=="Owner"?"selected":""?>>Administrator</option>
                        <option value="Support" <?=$typeuser=="Support"?"selected":""?>>Support</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">สถานะ</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" <?=$status=="1"?"selected":""?>>เปิดใช้งาน</option>
                    <option value="0" <?=$status=="0"?"selected":""?>>ปิดใช้งาน</option>
                </select>
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
    $('form#formUser').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/userlist/process',
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
                        $.post("./component/userlist/list", (data) => {
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
        $.post("./component/userlist/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/userlist/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });
});
</script>