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
    <div class="breadcrumb-title pe-3">ข้อมูลผู้ใช้งาน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลผู้ใช้งาน";  }else{ echo "เพิ่มข้อมูลผู้ใช้งาน";} ?>
                </li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="text-right"><button type="button" class="btn btn-primary btn_back1" id="btn_back1"><i
                    class="fadeIn animated bx bx-arrow-back"></i> &nbsp; กลับข้อมูลผู้ใช้งาน</button>
        </div>
    </div>
</div>
<hr />
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body p-5">
        <div class="card-title d-flex align-items-center">
            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
            </div>
            <h5 class="mb-0 text-primary">
                <?php if($even == "edit"){ echo "แก้ไขข้อมูลผู้ใช้งาน";  }else{ echo "เพิ่มข้อมูลผู้ใช้งาน";} ?></h5>
        </div>
        <hr>
        <form class="row g-3" id="formType" method="post" enctype="multipart/form-data" name="formType">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="uid" name="uid" value="<?=$id?>">
            <div class="col-md-12">
                <label for="username" class="form-label">ชื่อ Username</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-user'></i></span>
                    <input type="text" class="form-control border-start-0" id="Username"
                        placeholder="กรอกชื่อผู้เข้าระบบเพื่อใช้งาน" value="<?=$username?>">
                </div>
                <small class="text-danger">* กรุณากรอกเป็นภาษาอังกฤษเท่านั้น *</small>
            </div>
            <?php if($even == "edit"){ ?>
            <div class="col-md-12">
                <label for="username" class="form-label">ชื่อ Username</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-user'></i></span>
                    <input type="text" class="form-control border-start-0" id="Username"
                        placeholder="กรอกชื่อผู้เข้าระบบเพื่อใช้งาน" value="<?=$username?>">
                </div>
                <small class="text-danger">* กรุณากรอกเป็นภาษาอังกฤษเท่านั้น *</small>
            </div>
            <?php } ?>
            <div class="col-12">
                <label for="password" class="form-label">Password</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='bx bxs-lock-open'></i></span>
                    <input type="text" class="form-control border-start-0" id="password" placeholder="กรุณากรอกรหัสผ่าน"
                        <?php if($even == "add"){ echo "required"; }else{   }?> />
                </div>

                <?php if($even == "edit"){  ?> <small class="text-danger">*
                    ถ้าไม่เปลี่ยนรหัสผ่านไม่ต้องกรอกข้้อมูลใดๆๆลงช่องกรอกนี้้ *</small><?php }else{ ?><small
                    class="text-danger">* กรุณากรอกเป็นภาษาอังกฤษพร้อมตัวเลข เพื่อป้องกันการเข้าถึง *</small><?php } ?>
            </div>
            <div class="col-12">
                <label for="fullname" class="form-label">ชื่อผู้ใช้งาน</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-user-circle'></i></span>
                    <input type="text" class="form-control border-start-0" id="fullname"
                        placeholder="ชื่อ-นามสกุลของผู้ใช้งาน" value="<?=$fullname?>" required />
                </div>
            </div>

            <div class="col-12">
                <label class="form-label">ระดับการเข้าถึง</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i class='fadeIn animated bx bx-key'></i>
                    </button>
                    <select class="form-select single-select" id="inputGroupSelect03"
                        aria-label="Example select with button addon">
                        <option value="99">เลือกระดับ</option>
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
                            class="fas fa-eye-slash"></i> &nbsp;ยกเลิก</button>
                    <button type="submit" class="btn btn-primary" id="save"> <i
                            class="fas fa-plus fa-sm"></i>&nbsp;บันทึก</button>
                </div>
                <button type="submit" class="btn btn-danger px-5">Register</button>
            </div>
        </form>
    </div>
</div>


<script>
$('form#formType').submit(function(e) {
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
</script>