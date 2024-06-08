<?php
$fc = new \App\Helpers\fcPosition($db);
$cat2 = $fc->memberPositionTypeList($db);

$fc2 = new \App\Helpers\fcBank($db);
$cat3 = $fc2->bankTypeList($db);
$even = isset($_POST['even'])?$_POST['even']:'edit';
$id = isset($_POST['id'])?$_POST['id']:'';
$selected='';
$note=''; 
$email='';
$line='';
$name='';
$telephone='';
$password='';
$profile_id='';
$selected='';
$position_id='';
$photourl='';
$showPhotoE='';
$photo='';
$status='';

$photourl2='';
$showPhotoE12='';
$photo2='';
$account_name='';
$numbank='';
$bank_id='';

$photourl1='';
$showPhotoE1='';
$photo1='';
$firstname='';
$lastname='';
$idcard='';
$birthday='';
$address='';
$zipcode='';



    if ($even == "desc"){
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
                    <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?>
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
                        <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?>
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
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

                    <?php
                        $query = $db->query("SELECT * FROM `member` WHERE `member_id` = ? " ,[$id]);
                        $row = $query->getRow();   
                        if($row){
                            $status = $row->status;
                            $profile_id = $row->profile_id;
                            $password = $row->password;
                            $telephone = $row->telephone;
                            $email = $row->email;
                            $line = $row->line;
                            $name = $row->name;
                            $photo = $row->photo;
                            $position_id = $row->position_id;
                            $status = $row->status;
                        }
                    ?>

                    <form class="row g-3" id="formMember" method="post" enctype="multipart/form-data" name="formMember">
                        <div class="card border-top border-0 border-4 border-warning">
                            <div class="card-body p-5">
                                <div class="row no-gutters">
                                    <div class="col-md-3 order-md-1 mb-2 ">
                                        <h5 class="text-md-start text-center mb-0"> <i
                                                class="fadeIn animated bx bx-user-plus"></i>
                                            ข้อมูลสมาชิก
                                        </h5>
                                    </div>
                                </div>
                                <hr>
                                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                                <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <h6><b>ID</b> :
                                                        <?php if($profile_id == NULL){ echo "-";}else{ echo $profile_id;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>ระดับสมาชิก</b> :
                                                        <?php if($name == NULL){ echo "-";}else{ echo $name;} ?></h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <?php
                                                        foreach($cat2 as $cats2){ 
                                                            if($cats2->position_id==$position_id){
                                                              ?>
                                                     <?=$cats2->position_name?>
                                                    <?php
                                                                }
                                                    ?>
                                                    <?php
                                                        } 
                                                    ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>เบอร์โทรศัพท์</b> : <?=$telephone?></h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>อีเมล์</b> :
                                                        <?php if($email == NULL){ echo "-";}else{ echo $email;} ?></h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>Line</b> :
                                                        <?php if($line == NULL){ echo "-";}else{ echo $line;} ?></h6>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="photo" class="form-label"><i
                                                                class="fadeIn animated bx bx-images"></i>
                                                            รูปภาพสมาชิก</label>
                                                        <br>
                                                        <div class="col-4" id="showPhotoE">
                                                            <?php if($photo == ""){ }else{ ?> <img
                                                                src="<?=$_ENV['FileService']?>photo/<?=$photo?>"
                                                                width="100%" height="100%"><?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php
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
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <h6><b>ชื่อ - นามสกุล (ตามบัตรประชาชน)</b> :
                                                        <?php if($firstname == NULL && $lastname == NULL){ echo "-";}else{ echo "คุณ $firstname $lastname";} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>เลขบัตรประชาชน</b> :
                                                        <?php if($idcard == NULL){ echo "-";}else{ echo $idcard;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>วัน/เดือน/ปีเกิด</b> :
                                                        <?php if($birthday == NULL){ echo "-";}else{ echo $birthday;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>ที่อยู่</b> :
                                                        <?php if($address == NULL){ echo "-";}else{ echo $address;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>รหัสไปรษณีย์</b> :
                                                        <?php if($zipcode == NULL){ echo "-";}else{ echo $zipcode;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b>รายละเอียด</b> :
                                                        <?php if($note == NULL){ echo "-";}else{ echo $note;} ?>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label"><i
                                                            class="fadeIn animated bx bx-images"></i>
                                                        รูปภาพบัตรประชาชน</label>
                                                    <br>
                                                    <div class="col-4" id="showPhotoE1">
                                                        <?php if($photo1 == ""){ }else{ ?> <img
                                                            src="<?=$_ENV['FileService']?>photo/<?=$photo1?>"
                                                            width="100%" height="100%"><?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <?php
                                        $query_bank = $db->query("SELECT * FROM `member_bank` WHERE `member_id` = ? " ,[$id]);
                                        $row_bank = $query_bank->getRow();
                                        if($row_bank){
                                            $bank_id = $row_bank->bank_id;
                                            $numbank = $row_bank->numbank;
                                            $account_name = $row_bank->account_name;
                                            $photo2 = $row_bank->bookbank_photo;
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <h6><b>ชื่อธนาคาร</b> :
                                                    <?php
                                                        foreach($cat3 as $cats3){ 
                                                            if($cats3->BankCode==$bank_id){
                                                              ?>
                                                    <?=$cats3->bankNameTh?>
                                                    <?php
                                                            }
                                                    ?>
                                                    <?php
                                                        } 
                                                    ?>
                                                </h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6><b>ชื่อบัญชี</b> :
                                                    <?php if($account_name == NULL){ echo "-";}else{ echo $account_name;} ?>
                                                </h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6><b>เลขที่บัญชี</b> :
                                                    <?php if($numbank == NULL){ echo "-";}else{ echo $numbank;} ?>
                                                </h6>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label"><i
                                                            class="fadeIn animated bx bx-images"></i>
                                                        รูปภาพสมุดบัญชี</label>
                                                    <br>
                                                    <?php // if($even=="edit"){?>
                                                    <div class="col-4" id="showPhotoE2">
                                                        <?php if($photo2 == ""){ }else{ ?> <img
                                                            src="<?=$_ENV['FileService']?>photo/<?=$photo2?>"
                                                            width="100%" height="100%"><?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="card border-top border-0 border-4 border-danger">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body p-5">
                                    <div class="row no-gutters">
                                        <div class="col-md-8 order-md-1 mb-2 ">
                                            <h5 class="text-md-start text-center mb-0"> <i
                                                    class="fadeIn animated bx bx-buildings"></i>
                                                ข้อมูลส่งสินค้า
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr class="text-nowrap bg-warning">
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-nowrap">ชื่อ</th>
                                                    <th class="text-nowrap">ที่อยู่</th>
                                                    <th class="text-nowrap">รหัสไปรษณีย์</th>
                                                    <th class="text-nowrap">เบอร์โทรศัพท์</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i=0;
                                                    $query_ship = $db->query("SELECT * FROM `member_shipping` WHERE `member_id` = '$id' AND `status` <> '99' ORDER BY `member_shopping_id` DESC ");
                                                    foreach($query_ship->getResult('array') as $row){ 
                                                        $i++;
                                                ?>
                                                <tr>
                                                    <td class="text-center align-middle"><?=$i?></td>
                                                    <td class="text-nowarp align-middle">
                                                        <?=esc($row['fullname'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['address'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['zipcode'])?></td>
                                                    <td class="text-nowarp align-middle"><?=esc($row['telephone'])?>
                                                    </td>
                                                </tr>
                                                <?php 
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                   
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    
                </div>
            </div>
        </div>
</form>

<script>
$(document).ready(function() {
    $('#btn_back1').click(function(e) {
        e.preventDefault();
        $.post("./component/member/viewlist", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('#summernote').summernote('disable');
    $('#summernote1').summernote('disable');

    $('#dataTable').DataTable();
});
</script>