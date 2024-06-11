<?php
$fc = new \App\Helpers\fcPosition($db);
$cat2 = $fc->memberPositionTypeList($db);

$fc2 = new \App\Helpers\fcBank($db);
$cat3 = $fc2->bankTypeList($db);

$fcM = new \App\Helpers\fcPositionmlm($db);
$fcMember = new \App\Helpers\fcMember($db);

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

$left_id = '';
$right_id = '';
$position_mlm_id = '';
$nameleft = '';
$nameright = '';
$num_guild = '';
$num_team = '';
$position='';
$position_mlm_name='';
$position='';

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
                    <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?> ( <?=$fc->convert10digit($id)?> )
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
                        <?php if($even == "desc"){ echo "ข้อมูลคุณ $name";  }?> ( <?=$fc->convert10digit($id)?> )
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

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
                                    <div class="col-md-6 order-md-1 mb-2 ">
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
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">ID</b> :
                                                        <?php if($profile_id == NULL){ echo "-";}else{ echo $profile_id;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">ระดับสมาชิก</b> :
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
                                                    <h6><b class="text-primary">เบอร์โทรศัพท์</b> : <?=$telephone?></h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">อีเมล์</b> :
                                                        <?php if($email == NULL){ echo "-";}else{ echo $email;} ?></h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">Line</b> :
                                                        <?php if($line == NULL){ echo "-";}else{ echo $line;} ?></h6>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label for="photo" class="form-label text-primary"><i
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
                                        <br>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">ชื่อ - นามสกุล (ตามบัตรประชาชน)</b> :
                                                        <?php if($firstname == NULL && $lastname == NULL){ echo "-";}else{ echo "คุณ $firstname $lastname";} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">เลขบัตรประชาชน</b> :
                                                        <?php if($idcard == NULL){ echo "-";}else{ echo $idcard;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">วัน/เดือน/ปีเกิด</b> :
                                                        <?php if($birthday == NULL){ echo "-";}else{ echo $birthday;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">ที่อยู่</b> :
                                                        <?php if($address == NULL){ echo "-";}else{ echo $address;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">รหัสไปรษณีย์</b> :
                                                        <?php if($zipcode == NULL){ echo "-";}else{ echo $zipcode;} ?>
                                                    </h6>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <h6><b class="text-primary">รายละเอียด</b> :
                                                        <?php if($note == NULL){ echo "-";}else{ echo $note;} ?>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label text-primary"><i
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
                                        <br>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
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
                                                <h6><b class="text-primary">ชื่อธนาคาร</b> :
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
                                                <h6><b class="text-primary">ชื่อบัญชี</b> :
                                                    <?php if($account_name == NULL){ echo "-";}else{ echo $account_name;} ?>
                                                </h6>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <h6><b class="text-primary">เลขที่บัญชี</b> :
                                                    <?php if($numbank == NULL){ echo "-";}else{ echo $numbank;} ?>
                                                </h6>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="photo" class="form-label text-primary"><i
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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
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
                    <div class="card border-top border-0 border-4 border-success">
                        <div class="row">
                            <div class="col-12">
                                <div class="card-body p-5">
                                    <div class="row no-gutters">
                                        <div class="col-md-8 order-md-1 mb-2 ">
                                            <h5 class="text-md-start text-center mb-0"> <i
                                                    class="fadeIn animated bx bx-buildings"></i>
                                                ข้อมูลนักธุรกิจ
                                            </h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <?php
                                        $query_mlm = $db->query("SELECT * FROM `member_mlm` WHERE `member_id` = ? " ,[$id]);
                                        $row_mlm = $query_mlm->getRow();
                                        if($row_mlm){
                                            $member_id = $row_mlm->member_id;
                                            $left_id = $row_mlm->left_id;
                                            $right_id = $row_mlm->right_id;
                                            $position_mlm_id = $row_mlm->position_mlm_id;
                                            $nameleft = $fcMember->memberData($row_mlm->left_id);
                                            $nameright = $fcMember->memberData($row_mlm->right_id);
                                            $num_guild = $row_mlm->num_guild;
                                            $num_team = $row_mlm->num_team;
                                            $position = $fcM->PositionMlmTypeID($position_mlm_id);
                                        }
                                        if(!empty($row_mlm)){
                                        ?>
                                    <div
                                        class="row row-cols-lg-2 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
                                        <div class="col">
                                            <div class="card radius-10 border-start border-0 border-3 border-info">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 text-secondary">จำนวนผู้แนะนำ</p>
                                                            <?php 
                                                                if (!empty($num_guild)) {
                                                            
                                                                    ?> <h4 class="my-1 text-info">
                                                                <?=number_format($num_guild)?></h4>
                                                            <?php } else { ?>
                                                            <h4 class="my-1 text-info">0</h4>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        <div
                                                            class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                                                            <i class="bx bx-trending-up"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card radius-10 border-start border-0 border-3 border-danger">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 text-secondary">จำนวนคนในทีม</p>
                                                            <?php 
                                                             //  $query_upline = $db->query("SELECT COUNT(`node_id`) AS count_upline FROM `member_mlm` WHERE `upline_id` = ? " ,[$id]);
                                                            //   $row_upline = $query_upline->getResult('array');
                                                                if (!empty($num_team)) {
                                                                   // $count_upline = $row_gupline[0]['count_upline'];
                                                                    ?> <h4 class="my-1 text-info">
                                                                <?=number_format($num_team)?></h4>
                                                            <?php } else { ?>
                                                            <h4 class="my-1 text-info">0</h4>
                                                            <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        <div
                                                            class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                                                            <i class="bx bx-group"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="row row-cols-lg-1 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
                                        <div class="col">
                                            <div class="card radius-10">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <p class="mb-0 text-secondary">ระดับตำแหน่งของสมาชิก</p>
                                                            <h4 class="my-1"> <?php if(!empty($position_mlm_id)){ echo $position['position_mlm_name'] . ' (' . $position['position_mlm_short'] . ')'; }else{  echo "-"; }
                                                            ?></h4>
                                                        </div>
                                                        <div class="widgets-icons bg-light-info text-info ms-auto"><i
                                                                class="bx bx-crown"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="row row-cols-lg-2 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
                                        <div class="col">
                                            <div class="card radius-10">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <div
                                                            class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                                            <i class="bx bx-chevrons-left"></i>
                                                        </div>
                                                        <h4 class="my-1">
                                                            <?php if ($left_id != NULL) {  $convertedLeftID = $fc->convert10digit($row_mlm->left_id);
                                                                                $name = isset($nameleft['name']) ? $nameleft['name'] : 'ชื่อไม่พบ'; 
                                                                                echo $convertedLeftID . ' (' . $name . ')';   }else{ echo "ไม่มีผู้แนะนำ"; } ?>
                                                        </h4>
                                                        <p class="mb-0 text-secondary"><b>สายงานซ้าย (LEFT)</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card radius-10">
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <div
                                                            class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                                                            <i class="bx bx-chevrons-right"></i>
                                                        </div>
                                                        <h4 class="my-1">
                                                            <?php if ($left_id != NULL) {  $convertedLeftID = $fc->convert10digit($row_mlm->left_id);
                                                                                $name = isset($nameleft['name']) ? $nameleft['name'] : 'ชื่อไม่พบ'; 
                                                                                echo $convertedLeftID . ' (' . $name . ')';   }else{ echo "ไม่มีผู้แนะนำ"; } ?>
                                                        </h4>
                                                        <p class="mb-0 text-secondary"><b>สายงานขวา (RIGHT)</b></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }else{ ?>
                                        <button type="button" class="btn btn-primary align-items-center openmodal"
                                        mIDD="<?=$id?>" id="btn_modal">
                                        <i class="fadeIn animated bx bx-plus-medical"></i>
                                        &nbsp;
                                        เพิ่มข้อมูลนักธุรกิจ
                                    </button>
                                    <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel"
                aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered">
                    <div class="modal-content " id="memberModal_content">


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

    $('.openmodal').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('mIDD');

        $.post("./component/member/form_modal", {
            id: id
        }, (data) => {
            //console.log(id);
            $('#memberModal').modal('show');
            $('#memberModal_content').html(data);
        }, "html");
    });

    $('#summernote').summernote('disable');
    $('#summernote1').summernote('disable');

    $('#dataTable').DataTable();
});
</script>