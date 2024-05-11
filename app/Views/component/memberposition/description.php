<?php
    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $position_name='';
    $note='';
 
    $status='';

    if ($even == "desc"){
        $query = $db->query("SELECT * FROM `member_position` WHERE `position_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $position_name = $row->position_name;
            $status = $row->status;
            $note = $row->note;

        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-grid-alt"></i> ข้อมูลตำแหน่งสมาชิก</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./memberposition')?>"> จัดการข้อมูลตำแหน่งสมาชิก</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    เรื่อง : <?=$position_name?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<hr />
<div
    class="card border-top border-0 border-4 border-info">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-grid-alt"></i>
                เรื่อง : <?=$position_name?>
                </h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับจัดการข้อมูลตำแหน่งสมาชิก
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formArticle" method="post" enctype="multipart/form-data" name="formArticle">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-12">
                <label class="form-label">ชื่อตำแหน่งสมาชิก</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-message-square-detail'></i></span>
                    <input type="text" class="form-control border-start-0" id="position_name" name="position_name"
                        value="<?=$position_name?>" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <label for="note" class="form-label">รายละเอียด</label>
                <textarea id="summernote" class="form-control" name="note" rows="3" ><?=$note?></textarea>
            </div>
            
            <div class="col-12">
                <label class="form-label">สถานะ</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i class='fadeIn animated bx bx-show'></i>
                    </button>
                    <select class="form-select single-select" id="status" name="status"
                        aria-label="Example select with button addon" disabled>
                        <option value="1" <?=$status=="1"?"selected":""?>>เปิดใช้งาน</option>
                        <option value="0" <?=$status=="0"?"selected":""?>>ปิดใช้งาน</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
$(document).ready(function() {
    

    $('#btn_back1').click(function(e) {
        e.preventDefault();
        $.post("./component/memberposition/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/memberposition/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#summernote').summernote('disable');
});
</script>