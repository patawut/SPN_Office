<?php
$even = isset($_POST['even'])?$_POST['even']:'';
$id = isset($_POST['id'])?$_POST['id']:'';
$selected='';
$mid='';
$password='';
$fullname='';
$username='';
$status='';
$typeuser='';
$selected = '';

    if ($even == "editProfile"){
        $query = $db->query("SELECT * FROM `user` WHERE `username` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $username = $row->username;
            $password = $row->password;
            $fullname = $row->fullname;
            $typeuser = $row->type;
            $status = $row->status;
        }
    }
?>
<form class="row g-3" id="formProfile" method="post" enctype="multipart/form-data" name="formProfile">
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">ข้อมูลคุณ <?=$fullname?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
    <div id="profileData" data-memberid="<?=$id?>">
        <div class="card-body">
            <br>
            <div class="container overflow-hidden">
                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                <input type="hidden" class="form-control" id="mid" name="mid" value="<?=$id?>">
                <?php if($even == "editProfile"){ ?>
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
                                class='fadeIn animated bx bx-key'></i></span>
                        <input type="text" class="form-control border-start-0" id="password" name="password"
                            placeholder="กรุณากรอกรหัสผ่าน" />
                    </div>

                    <small class="text-danger">*
                        ถ้าไม่เปลี่ยนรหัสผ่านไม่ต้องกรอกข้้อมูลใดๆๆลงช่องกรอกนี้้ *</small>
                </div>
                <div class="col-12">
                    <label for="fullname" class="form-label">ชื่อผู้ใช้งาน</label>
                    <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                class='fadeIn animated bx bx-user-circle'></i></span>
                        <input type="text" class="form-control border-start-0" id="fullname" name="fullname"
                            placeholder="ชื่อ-นามสกุลของผู้ใช้งาน" value="<?=$fullname?>" required />
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" id="save"> <i
            class="fadeIn animated bx bx-save"></i>&nbsp;บันทึก</button>
</div>
</form>
<script>
$(document).ready(function() {
    $('form#formProfile').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/profile/process',
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
                        location.reload();
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
});
</script>