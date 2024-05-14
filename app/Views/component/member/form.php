
<?php
$even = isset($_POST['even'])?$_POST['even']:'edit';
$id = isset($_POST['id'])?$_POST['id']:'';
    if ($even == "edit"){
        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
        $row = $query->getRow();

            if($row){
                $name = $row->name;
               
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
                    <?php if($even == "edit"){ echo "ข้อมูลคุณ $name";  }?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<hr />
<form class="row g-3" id="formMember" method="post" enctype="multipart/form-data" name="formMember">
    <div class="card border-top border-0 border-4 border-primary">
        <div class="card-body p-5">
            <div class="row no-gutters">
                <div class="col-md-8 order-md-1 mb-2 ">
                    <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-user-plus"></i>
                    <?php if($even == "edit"){ echo "ข้อมูลคุณ $name";  }?>
                    </h5>
                </div>
                <div class="col-md-4 order-md-2">
                    <div class="text-md-end text-center">
                        <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                            <i class="fadeIn animated bx bx-arrow-back"></i>
                            &nbsp;
                            กลับจัดการข้อมูลสมาชิก
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?=$id?>">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                   <div id="showFormMember"></div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div id="showFormInfo"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                   <div id="showFormBank"></div>
                </div>
                <div class="col-12">
                    <div id="showFormShipping"></div>
                </div>
            </div>
    </div>
</form>


<script>
$(document).ready(function() {
    let id = $('#id').val();
    var urls = ["./component/member/form_member"];
        $.ajax({
            url: urls , // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                id: id,
                even: "editMem"
            },
            success: function(data) {
                    $('#showFormMember').html(data);
            },
            dataType: 'html'
        });

        var urls1 = ["./component/member/form_info"];
        $.ajax({
            url: urls1 , // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                id: id,
                even: "editInfo"
            },
            success: function(data) {
                    $('#showFormInfo').html(data);
            },
            dataType: 'html'
        });

        var urls2 = ["./component/member/form_bank"];
        $.ajax({
            url: urls2 , // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                id: id,
                even: "editBank"
            },
            success: function(data) {
                    $('#showFormBank').html(data);
            },
            dataType: 'html'
        });

        var urls3 = ["./component/membershipping/main"];
        $.ajax({
            url: urls3 , // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
            type: 'POST',
            data: {
                id: id,
                even: "goShipping"
            },
            success: function(data) {
                    $('#showFormShipping').html(data);
            },
            dataType: 'html'
        });
});
</script>