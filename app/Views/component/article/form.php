<?php
    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $topic='';
    $note='';
    $linkurl='';
    $showPhotoE='';
    $photo='';
    $status='';

    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `article` WHERE `article_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $topic = $row->topic;
            $status = $row->status;
            $note = $row->note;
            $linkurl = $row->linkurl;
            $photo = $row->photo;
        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-file"></i> บทความ</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./article')?>"> จัดการบทความ</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "edit"){ echo "แก้ไขบทความ";  }else{ echo "เพิ่มบทความ";} ?>
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
                <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-file"></i>
                    <?php if($even == "edit"){ echo "แก้ไขบทความ";  }else{ echo "เพิ่มบทความ";} ?>
                </h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับจัดการบทความ
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formArticle" method="post" enctype="multipart/form-data" name="formArticle">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-12">
                <label class="form-label">ชื่อหัวข้อ</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-message-square-detail'></i></span>
                    <input type="text" class="form-control border-start-0" id="topic" name="topic"
                        value="<?=$topic?>" required />
                </div>
            </div>
            <div class="col-md-12">
                <label for="note" class="form-label">รายละเอียด</label>
                <textarea id="summernote" class="form-control" name="note" rows="3" required><?=$note?></textarea>
            </div>
            
            <div class="col-12">
                <label class="form-label">ลิงค์อ้างอิง</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-link'></i></span>
                    <input type="text" class="form-control border-start-0" id="linkurl" name="linkurl"
                        value="<?=$linkurl?>" required />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label for="photo" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพ</label>
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
    $('form#formArticle').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/article/process',
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
                        $.post("./component/article/list", (data) => {
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
        $.post("./component/article/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/article/list", (data) => {
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