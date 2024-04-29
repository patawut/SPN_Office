<?php 
$return=array();
$query = $db->query("SELECT * FROM  `bankcode` ORDER BY `BankCode` ASC ");
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="fadeIn animated bx bx-buildings"></i> ข้อมูลธนาคาร</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลธนาคาร</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<hr />
<div class="card  border-top border-0 border-4 border-info">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0"><i class="fadeIn animated bx bx-buildings"></i>
                    จัดการข้อมูลธนาคาร</h5>
            </div>
            <div class="col-md-4 order-md-2">
            </div>
        </div>
        <hr />
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="text-nowrap bg-warning">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-nowrap">รหัสบัญชี</th>
                        <th class="text-nowrap">ชื่อธนาคาร (ภาษาอังกฤษ)</th>
                        <th class="text-nowrap">ชื่อธนาคาร (ภาษาไทย)</th>
                        <th class="text-nowrap">ตัวอักษร</th>
                        <th class="text-center">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($query->getResult('array') as $row){ 
                        $i++;
                    ?>
                    <tr>
                        <td class="text-center align-middle"><?=$i?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['BankCode'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['bankNameEn'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['bankNameTh'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['user_bank_type'])?></td>
                        <td class="text-nowrap">
                            <select class="form-select <?=$row['status'] =="1"?"bg-success":"bg-danger"?> text-white"
                                id="status" name="status" TypeID="<?=esc($row['BankCode'])?>">
                                <option value="0" <?=$row['status'] == "0"?"selected='selected'":""?>>ปิดใช้งาน</option>
                                <option value="1" <?=$row['status'] == "1"?"selected='selected'":""?>>เปิดใช้งาน
                                </option>
                            </select>
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




<script>
$(document).ready(function() {
    $('.form-select').change(function(e) {
        e.preventDefault();
        let id = $(this).attr('TypeID');
        let value = $(this).val();
        $.post("./component/banklist/process", {
                id: id,
                value: value,
                even: 'editstatus'
            },
            function(data) {
                //console.log(data);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        text: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        $.post("./component/banklist/list", (data) => {
                            $('#contentData').html(data);
                        }, "html");
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'ข้อมูลผิดพลาด',
                        text: data.msg,
                    })
                } //console.log(data);
            }, "json"
        );
    });
    $('#dataTable').DataTable();
});
</script>