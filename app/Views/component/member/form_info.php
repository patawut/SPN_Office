<?php
    $fc = new \App\Helpers\fcPosition($db);
    $cat2 = $fc->memberPositionTypeList($db);

    $fc2 = new \App\Helpers\fcBank($db);
    $cat3 = $fc2->bankTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    
    $photourl1='';
    $showPhotoE1='';
    $photo1='';
    $status='';
    $firstname='';
    $lastname='';
    $idcard='';
    $birthday='';
    $address='';
    $zipcode='';
    $note='';


    if ($even == "editInfo"){
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
        }else{
            $even = "addInfo";
        }
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
                                            class="fadeIn animated bx bx-user-circle"></i> รายละเอียดข้อมูลสมาชิก

                                    </h5>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                            <input type="hidden" class="form-control" id="infoid" name="infoid" value="<?=$id?>">
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
                                            ><?=$note?></textarea>
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
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn_back3" id="btn_back3"><i
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
    $('#idcard').change(function() {
        let p1 = $('#idcard').val();
        $.ajax({
            url: './component/member/process', // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                idcard_ck: p1,
                even: "checkidcard"
            },
            success: function(data) {
                if (data.status == 1) {
                    console.log(data.status);
                    Swal.fire({
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.msg,
                    });
                    $('#idcard').val('');
                    console.log(data.status);
                }
            },
            dataType: 'json'
        });
    });


    $('form#formInfo').submit(function(e) {
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


    $('#btn_back3').click(function(e) {
        e.preventDefault();
        $.post("./component/member/list", (data) => {
            $('#contentData').html(data);
        }, "html");
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