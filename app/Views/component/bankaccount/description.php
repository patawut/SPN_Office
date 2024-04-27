<?php
    $fc = new \App\Helpers\fcUser($db);
    $fc2 = new \App\Helpers\fcBank($db);
    $cat2 = $fc2->bankTypeList($db);

    $even = isset($_POST['even'])?$_POST['even']:'add';
    $id = isset($_POST['id'])?$_POST['id']:'';

    $selected='';
    $query = $db->query("SELECT * FROM `bank_account` WHERE `bank_id` = ? " ,[$id]);
    $row = $query->getRow();
    if($row){
        $accout_name = $row->accout_name;
        $status = $row->status;
        $accout_number = $row->accout_number;
        $accout_logo = $row->accout_logo;
        $bankcode = $row->bankCode;
    }
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="lni lni-cog"></i> ตั้งบัญชีรับเงิน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?=site_url('./bankaccount')?>"> จัดการข้อมูลบัญชีรับเงิน</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    ข้อมูลบัญชีรับเงิน : <?=$accout_name?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<hr />
<div class="card border-top border-0 border-4 border-info">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
            <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-book-content"></i> ข้อมูลบัญชีรับเงิน : <?=$accout_name?></h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center btn_back1" id="btn_back1">
                        <i class="fadeIn animated bx bx-arrow-back"></i>
                        &nbsp;
                        กลับจัดการข้อมูลบัญชีรับเงิน
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <form class="row g-3" id="formBankAcc" method="post" enctype="multipart/form-data" name="formBankAcc">
            <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
            <input type="hidden" class="form-control" id="tid" name="tid" value="<?=$id?>">
            <div class="col-12">
                <label class="form-label">ชื่อธนาคาร</label>
                <div class="input-group">
                    <button class="btn btn-outline-secondary" type="button"><i
                            class='fadeIn animated bx bx-buildings'></i>
                    </button>
                    <select class="form-select single-select" id="bankcode" name="bankcode"
                        aria-label="Example select with button addon" disabled>
                        <option value="99">-- เลือกชื่อธนาคาร --</option>
                        <?php
                            foreach($cat2 as $cats2){
                                if($even == "desc") {$selected = $cats2->BankCode==$bankcode?"selected":"";} 
                                echo $cats2->BankCode;
                                echo '<option value="'.$cats2->BankCode.'" '.$selected.'>'.$cats2->bankNameTh.'</option>';
                            } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <label for="accout_name" class="form-label">ชื่อบัญชี</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-user-circle'></i></span>
                    <input type="text" class="form-control border-start-0" id="accout_name" name="accout_name"
                        value="<?=$accout_name?>" disabled />
                </div>
            </div>
            <div class="col-12">
                <label for="accout_number" class="form-label">เลขบัญชี</label>
                <div class="input-group"> <span class="input-group-text bg-transparent"><i
                            class='fadeIn animated bx bx-message-alt-edit'></i></span>
                    <input type="text" class="form-control border-start-0" id="accout_number" name="accout_number"
                        value="<?=$accout_number?>" disabled />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="photo" class="form-label"><i class="fadeIn animated bx bx-images"></i>
                        รูปภาพหน้าบัญชีธนาคาร</label>
                    <br>
                    <img src="<?=$_ENV['FileService']?>photo/<?=$accout_logo?>" width="50%" height="50%">
                </div>
                <br>
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
        $.post("./component/bankaccount/list", (data) => {
            $('#contentData').html(data);
        }, "html");
    });
});
</script>