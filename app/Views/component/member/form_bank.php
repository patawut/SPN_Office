<?php
    $fc = new \App\Helpers\fcPosition($db);
    $cat2 = $fc->memberPositionTypeList($db);

    $fc2 = new \App\Helpers\fcBank($db);
    $cat3 = $fc2->bankTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $nobankid='';
    $photourl2='';
    $showPhotoE12='';
    $photo2='';
    $status='';
    $account_name='';
    $numbank='';
    $bank_id='';
    $selected='';
    if ($even == "editBank"){
        $query_bank = $db->query("SELECT * FROM `member_bank` WHERE `member_id` = ? " ,[$id]);
        $row_bank = $query_bank->getRow();
            if($row_bank){
                $bank_id = $row_bank->bank_id;
                $numbank = $row_bank->numbank;
                $account_name = $row_bank->account_name;
                $photo2 = $row_bank->bookbank_photo;
            }else{
                $even = "addBank";
            }
      
    }
?>

<form class="row g-3" id="formBank" method="post" enctype="multipart/form-data" name="formBank">
    <div class="card border-top border-0 border-4 border-danger">
       
        <div class="row">
            <div class="col-12">
                    <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                    <input type="hidden" class="form-control" id="nobankid" name="nobankid" value="<?=$id?>">
                <div class="card-body p-5">
                    <div class="row no-gutters">
                        <div class="col-md-8 order-md-1 mb-2 ">
                            <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-buildings"></i>
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
                                <select class="form-select single-select" id="bank_id" name="bank_id"
                                    aria-label="Example select with button addon">
                                    <option value="99">-- เลือกชื่อธนาคาร --</option>
                                    <?php
                                        foreach($cat3 as $cats3){
                                            if($even == "editBank") {$selected = $cats3->BankCode==$bank_id?"selected":"";} 
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
                                    name="account_name" value="<?=$account_name?>"  />
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="numbank" class="form-label">เลขที่บัญชี</label>
                            <div class="input-group"> <span class="input-group-text bg-transparent"><i
                                        class='fadeIn animated bx bx-credit-card-front'></i></span>
                                <input type="text" class="form-control border-start-0" id="numbank" name="numbank"
                                    value="<?=$numbank?>"  />
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <div class="form-group">
                                <label for="photo" class="form-label"><i class="fadeIn animated bx bx-images"></i>
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
                        <br>
                        <div class="col-12">
                            <div class="text-center">
                                <button type="button" class="btn btn-danger btn_back4" id="btn_back4"><i
                                        class="fadeIn animated bx bx-x"></i> &nbsp;ยกเลิก</button>
                                <button type="submit" class="btn btn-primary" id="save"> <i
                                        class="fadeIn animated bx bx-save"></i>&nbsp;บันทึก</button>
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
    $('#numbank').change(function() {
        let p1 = $('#numbank').val();
        $.ajax({
            url: './component/member/process', // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                numbank_ck: p1,
                even: "checknumbank"
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
                    $('#numbank').val('');
                    console.log(data.status);
                }
            },
            dataType: 'json'
        });
    });


    $('form#formBank').submit(function(e) {
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

    $('#btn_back4').click(function(e) {
        e.preventDefault();
        $.post("./component/member/list", (data) => {
            $('#contentData').html(data);
        }, "html");
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
});
</script>