<?php
    $fc = new \App\Helpers\fcUser($db);
    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $type_name='';
    $level='';
    $note='';
    $status='';

    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `product_type` WHERE `type_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $type_name = $row->type_name;
            $status = $row->status;
            $level = $row->level;
            $note = $row->note;
        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-cube"></i> ข้อมูลประเภทสินค้า</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./producttype')?>"> จัดการข้อมูลประเภทสินค้า</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลประเภทสินค้า";  }else{ echo "เพิ่มข้อมูลประเภทสินค้า";} ?>
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
                <h5 class="text-md-start text-center mb-0" > <i class="fadeIn animated bx bx-cube"></i>  <?php if($even == "edit"){ echo "แก้ไขข้อมูลประเภทสินค้า";  }else{ echo "เพิ่มข้อมูลประเภทสินค้า";} ?></h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับข้อมูลประเภทสินค้า
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formProductType" method="post" enctype="multipart/form-data" name="formProductType">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-md-12">
                <label for="type_name" class="form-label">ชื่อประเภทสินค้า</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-cube'></i></span>
                    <input type="text" class="form-control border-start-0" id="type_name" name="type_name"
                        value="<?=$type_name?>" required>
                </div>
            </div>
            <div class="col-md-12">
                <label for="note" class="form-label">รายละเอียด</label>
                <textarea id="summernote" class="form-control"  rows="3" ><?=$note?></textarea>
            </div>
            <div class="col-12">
                <label class="form-label">ระดับการเข้าถึง</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i class='fadeIn animated bx bx-key'></i>
                    </button>
                    <select class="form-select single-select" id="level" name="level"
                        aria-label="Example select with button addon">
                        <option value="99">-- เลือกระดับของประเภทสินค้า --</option>
                        <?php 
                        for($i=1;$i<=50;$i++){
                        ?>
                        <option value="<?=$i?>" <?=$level=="$i"?"selected":""?>><?=$i?></option>

                        <?php } ?>
                    </select>
                </div>
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
    $('form#formProductType').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/producttype/process',
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
                        $.post("./component/producttype/list", (data) => {
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
        $.post("./component/producttype/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/producttype/list", (data) => {
            $('#contentData').html(data);
        }, "html");
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
});
</script>