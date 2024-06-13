<?php
    $fc = new \App\Helpers\fcProduct($db);
    $cat2 = $fc->productTypeList($db);
    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';
    $tid='';
    $product_code='';
    $type_id='';
    $selected='';
    $note='';
    $note_short='';
    $product_name='';
    $status='';
    $showPhotoE='';
    $photo='';
    $showPhotoE1='';
    $photo1='';
    $showPhotoE2='';
    $photo2='';
    $showPhotoE3='';
    $photo3='';
    $price='';
    $price_member='';
    $pv='';
    $discount='';
    $cost='';

    if ($even == "desc"){
        $query = $db->query("SELECT * FROM `product` WHERE `product_id` = ? " ,[$id]);
        $row = $query->getRow();
        if($row){
            $product_code = $row->product_code;
            $product_name = $row->product_name;
            $status = $row->status;
            $type_id = $row->type_id;
            $note = $row->note;
            $note_short = $row->note_short;
            $photo = $row->photo1;
            $photo1 = $row->photo2;
            $photo2 = $row->photo3;
            $photo3 = $row->photo4;
            $price = $row->price;
            $price_member = $row->price_member;
            $pv = $row->pv;
            $discount = $row->discount;
            $cost = $row->cost;
        }
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-box"></i> ข้อมูลสินค้า</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./product')?>"> จัดการข้อมูลสินค้า</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php if($even == "edit"){ echo "แก้ไขข้อมูลสินค้า";  }else{ echo "เพิ่มข้อมูลสินค้า";} ?>
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
                <h5 class="text-md-start text-center mb-0" > <i class="fadeIn animated bx bx-box"></i>  <?php if($even == "edit"){ echo "แก้ไขข้อมูลสินค้า";  }else{ echo "เพิ่มข้อมูลสินค้า";} ?></h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับข้อมูลสินค้า
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formProduct" method="post" enctype="multipart/form-data" name="formProduct">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-md-12">
                <label for="product_code" class="form-label">รหัสสินค้า</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-cart-alt'></i></span>
                    <input type="text" class="form-control border-start-0" id="product_code" name="product_code"
                        value="<?=$product_code?>" disabled>
                </div>
            </div>
            <div class="col-12">
                <label class="form-label">ประเภทสินค้า</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i
                            class='fadeIn animated bx bx-box'></i>
                    </button>
                    <select class="form-select single-select" id="type_id" name="type_id"
                        aria-label="Example select with button addon" disabled>
                        <option value="99">-- เลือกประเภทสินค้า --</option>
                        <?php
                            foreach($cat2 as $cats2){
                                if($even == "desc") {$selected = $cats2->type_id==$type_id?"selected":"";} 
                                echo $cats2->type_id;
                                echo '<option value="'.$cats2->type_id.'" '.$selected.'>'.$cats2->type_name.'</option>';
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <label for="product_name" class="form-label">ชื่อสินค้า</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-label'></i></span>
                    <input type="text" class="form-control border-start-0" id="product_name" name="product_name"
                        value="<?=$product_name?>" disabled>
                </div>
            </div>
            <hr />
            <div class="text-center"><h6><i class="fadeIn animated bx bx-detail"></i>รายละเอียดสินค้า</h6></div>
            <hr />
            <div class="col-md-12">
                <label for="note_short" class="form-label">แบบสั้น</label>
                <textarea id="summernote" class="form-control"  rows="3" name="note_short" disabled><?=$note_short?></textarea>
            </div>

            <div class="col-md-12">
                <label for="note" class="form-label">แบบยาว</label>
                <textarea id="summernote1" class="form-control"  rows="3" name="note" disabled><?=$note?></textarea>
            </div>
            <hr />
            <div class="text-center"><h6><i class="fadeIn animated bx bx-image"></i> รูปภาพสินค้า</h6></div>
            <hr />
            <?php if($photo !=""){ ?>
            <div class="col-md-12">
                <div class="form-group">
                <label for="photo" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพ1</label>
                    <br>
                    <div class="col-4" id="showPhoto"> </div>
                    <?php // if($even=="edit"){?>
                    <div class="col-4" id="showPhotoE"> <?php if($photo == ""){ }else{ ?> <img
                            src="<?=$_ENV['FileService']?>photo/<?=$photo?>" width="50%" height="50%"><?php } ?></div>
                    <br>
                    <?php // }  ?>
                </div>
                <input type="hidden" name="photourl" id="photourl" value="<?=$photo?>">
            </div>
            <?php } ?>
            <?php if($photo1 !=""){ ?>
            <div class="col-md-12">
                <div class="form-group">
                <label for="photo1" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพ2</label>
                    <br>
                    <div class="col-4" id="showPhoto1"> </div>
                    <?php // if($even=="edit"){?>
                    <div class="col-4" id="showPhotoE1"> <?php if($photo1 == ""){ }else{ ?> <img
                            src="<?=$_ENV['FileService']?>photo/<?=$photo1?>" width="50%" height="50%"><?php } ?></div>
                    <br>
                    <?php // }  ?>
                </div>
                <input type="hidden" name="photourl1" id="photourl1" value="<?=$photo1?>">
            </div>
            <?php } ?>
            <?php if($photo2 !=""){ ?>
            <div class="col-md-12">
                <div class="form-group">
                <label for="photo2" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพ3</label>
                    <br>
                    <div class="col-4" id="showPhoto2"> </div>
                    <?php // if($even=="edit"){?>
                    <div class="col-4" id="showPhotoE2"> <?php if($photo2 == ""){ }else{ ?> <img
                            src="<?=$_ENV['FileService']?>photo/<?=$photo2?>" width="50%" height="50%"><?php } ?></div>
                    <br>
                    <?php // }  ?>
                </div>
                <input type="hidden" name="photourl2" id="photourl2" value="<?=$photo2?>">
            </div>
            <?php } ?>
            <?php if($photo3 !=""){ ?>
            <div class="col-md-12">
                <div class="form-group">
                <label for="photo3" class="form-label"><i class="fadeIn animated bx bx-images"></i> รูปภาพ4</label>
                    <br>
                    <div class="col-4" id="showPhoto3"> </div>
                    <?php // if($even=="edit"){?>
                    <div class="col-4" id="showPhotoE3"> <?php if($photo3 == ""){ }else{ ?> <img
                            src="<?=$_ENV['FileService']?>photo/<?=$photo3?>" width="50%" height="50%"><?php } ?></div>
                    <br>
                    <?php // }  ?>
                </div>
                <input type="hidden" name="photourl3" id="photourl3" value="<?=$photo3?>">
            </div>
            <?php } ?>
            <hr />
            <div class="text-center"><h6><i class="fadeIn animated bx bx-detail"></i>  รายละเอียดราคา</h6></div>
            <hr />
            <div class="col-md-12">
                <label for="cost" class="form-label">ราคาต้นทุน</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-dollar-circle'></i></span>
                    <input type="number" class="form-control border-start-0" id="cost" name="cost"
                        value="<?=$cost?>" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <label for="price" class="form-label">ราคาขาย</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-dollar-circle'></i></span>
                    <input type="number" class="form-control border-start-0" id="price" name="price"
                        value="<?=$price?>" disabled>
                </div>
            </div>

            <div class="col-md-12">
                <label for="price_member" class="form-label">ราคาสมาชิก</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-dollar-circle'></i></span>
                    <input type="number" class="form-control border-start-0" id="price_member" name="price_member"
                        value="<?=$price_member?>" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <label for="pv" class="form-label">PV</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-dollar-circle'></i></span>
                    <input type="number" class="form-control border-start-0" id="pv" name="pv"
                        value="<?=$pv?>" disabled>
                </div>
            </div>
            <div class="col-md-12">
                <label for="discount" class="form-label">ส่วนลด</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-dollar-circle'></i></span>
                    <input type="number" class="form-control border-start-0" id="discount" name="discount"
                        value="<?=$discount?>" disabled>
                </div>
            </div>
            <hr />

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
        $.post("./component/product/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#btn_back2').click(function(e) {
        e.preventDefault();
        $.post("./component/product/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });


    $('#summernote').summernote('disable');
    $('#summernote1').summernote('disable');
   
});
</script>