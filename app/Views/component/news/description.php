<?php
    $even = isset($_POST['even'])?$_POST['even']:'';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $topic='';
    $news_detail='';
    $showPhotoE='';
    $photo='';
    $status='';

    if ($even == "desc"){
        $query = $db->query("SELECT * FROM `news` WHERE `news_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $topic = $row->topic;
            $status = $row->status;
            $news_detail = $row->news_detail;
            $photo = $row->photo;
        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-news"></i> ข่าวสาร</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./news')?>"> จัดการข่าวสาร</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    หัวข้อ : <?=$topic?>
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
                <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-news"></i>
                    หัวข้อ : <?=$topic?>
                </h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับจัดการข่าวสาร
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formNews" method="post" enctype="multipart/form-data" name="formNews">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-12">
                <label class="form-label">ชื่อหัวข้อ</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-message-square-detail'></i></span>
                    <input type="text" class="form-control border-start-0" id="topic" name="topic"
                        value="<?=$topic?>" disabled />
                </div>
            </div>
            <div class="col-md-12">
                <label for="news_detail" class="form-label">รายละเอียด</label>
                <textarea id="summernote" class="form-control" name="news_detail" rows="3" disabled><?=$news_detail?></textarea>
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
                </div>
                <input type="hidden" name="photourl" id="photourl" value="<?=$photo?>">
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
        $.post("./component/news/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });
    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/news/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#summernote').summernote('disable');
});
</script>