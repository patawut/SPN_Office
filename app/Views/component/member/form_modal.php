<?php
$fcM = new \App\Helpers\fcPositionmlm($db);
$cat2 = $fcM->PositionMlmTypeList($db);
$id = isset($_POST['id'])?$_POST['id']:'';
$selected='';
$even = "addM";
?>
<form class="row g-3" id="formMemberMlm" method="post" enctype="multipart/form-data" name="formMemberMlm">
    <div id="memberData" data-memberid="<?=$id?>">
        <div class="card-body">
            <div class="container overflow-hidden">
                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                <input type="hidden" class="form-control" id="mmid" name="mmid" value="<?=$id?>">
                <div class="row gx-5">
                    <div class="col">
                        <div class="text-left text-primary">
                            <label class="form-label">ระดับสมาชิก</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button"><i
                                        class='fadeIn animated bx bx-buildings'></i>
                                </button>
                                <select class="form-select single-select" id="position_mlm_id" name="position_mlm_id"
                                    aria-label="Example select with button addon">
                                    <option value="99">-- เลือกระดับสมาชิก --</option>
                                    <?php
                                            foreach($cat2 as $cats2){
                                                echo '<option value="'.$cats2->position_mlm_id.'" '.$selected.'>'.$cats2->position_mlm_name.'</option>';
                                            } 
                                        ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-12">
                            &nbsp;
                        </div>
                    </div>
                    <div class="row gx-5">
                        <div class="col-12">
                            <div class="text-center">
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
    $('form#formMemberMlm').submit(function(e) {
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
                        $.post("./component/member/form_desc", (data) => {
                            $('#showform').html(data);
                            $('#memberModal_content').html('close');
                            $('#memberModal').modal('hide');
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

    function reloadThisPage() {
        var id = $('#memberData').attr('data-memberid');

        $.post("./component/member/form_modal", {
            id: id
        }, (data) => {
            $('#memberModal_content').html(data);
        }, "html");
    }
});
</script>