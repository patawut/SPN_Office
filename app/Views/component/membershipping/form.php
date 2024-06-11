<?php
    $fc = new \App\Helpers\fcPosition($db);
    $cat2 = $fc->memberPositionTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $idd = isset($_POST['idd'])?$_POST['idd']:'';
    $shipid='';
    $fullname='';
    $address='';
    $status='';
    $telephone='';
    $zipcode='';
    $note='';
    $selected='';
    if ($even == "editSendData"){
        $query_shipping = $db->query("SELECT * FROM `member_shipping` WHERE `member_shopping_id` = ? " ,[$idd]);
        $row_shipping = $query_shipping->getRow();
            if($row_shipping){
                $fullname = $row_shipping->fullname;
                $address = $row_shipping->address;
                $zipcode = $row_shipping->zipcode;
                $telephone = $row_shipping->telephone;
                $note = $row_shipping->note;
            }else{
                $even = "addShipping";
            }
    }
?>
<div class="row">
    <form class="row g-3" id="formShipping" method="post" enctype="multipart/form-data" name="formShipping">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="shipid" name="shipid" value="<?=$id?>">
            <input type="hidden" class="form-control" id="shipieditidd" name="shipieditidd" value="<?=$idd?>">
            <div class="row">
                <div class="col-12">
                    <div class="col-12 mb-2">
                        <label for="fullname_shipping" class="form-label">ชื่อ - นามสกุล</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                    class='fadeIn animated bx bx-user-circle'></i></span>
                            <input type="text" class="form-control border-start-0" id="fullname_shipping"
                                name="fullname_shipping" value="<?=$fullname?>" required />
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="address_shipping" class="form-label">ที่อยู่</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                    class='fadeIn animated bx bx-target-lock'></i></span>
                            <input type="text" class="form-control border-start-0" id="address_shipping"
                                name="address_shipping" value="<?=$address?>" required />
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="zipcode_shipping" class="form-label">รหัสไปรษณีย์</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                    class='fadeIn animated bx bx-pin'></i></span>
                            <input type="number" class="form-control border-start-0" id="zipcode_shipping"
                                name="zipcode_shipping" value="<?=$zipcode?>" required />
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="telephone_shipping" class="form-label">เบอร์โทรศัพท์</label>
                        <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                    class='fadeIn animated bx bx-pin'></i></span>
                            <input type="number" class="form-control border-start-0" id="telephone_shipping"
                                name="telephone_shipping" value="<?=$telephone?>" required />
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="note_shipping" class="form-label">รายละเอียด</label>
                        <textarea id="summernote11" class="form-control" rows="3"
                            name="note_shipping"><?=$note?></textarea>
                    </div>
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
        
    </form>
</div>
<script>
$(document).ready(function() {

    $('form#formShipping').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        $.ajax({
            url: './component/membershipping/process',
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
                        $.post("./component/membershipping/viewlist", (data) => {
                          //  $('#showform').html(data);
                            $('#showlist').html(data);
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


    $('#summernote11').summernote({
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
                $('#summernote11').summernote("insertImage", data.url);
            },
            error: function(e) {
                console.log(e);
                alert('Error uploading image');
            }
        });
    }

    $('#dataTable').DataTable();
});
</script>