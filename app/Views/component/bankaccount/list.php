<?php 
$fc = new \App\Helpers\fcBank($db);
$return=array();
$query = $db->query("SELECT * FROM `bank_account`  WHERE `status` <> '99'  ORDER BY `bank_id` DESC ");
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="lni lni-cog"></i>  ตั้งบัญชีรับเงิน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลบัญชีรับเงิน</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<hr />
<div class="card border-top border-0 border-4 border-info">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0"><i class="lni lni-cog"></i> จัดการข้อมูลบัญชีรับเงิน</h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center" id="add">
                        <i class="fadeIn animated bx bx-plus"></i>
                        &nbsp;
                        เพิ่มข้อมูลบัญชีรับเงิน
                    </button>
                </div>
            </div>
        </div>
        <hr />
        <div class="table-responsive">
            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr class="text-nowrap bg-warning">
                        <th class="text-center">ลำดับ</th>
                        <th class="text-nowrap">ชื่อธนาคาร</th>
                        <th class="text-nowrap">ชื่อบัญชี</th>
                        <th class="text-nowrap">เลขบัญชี</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($query->getResult('array') as $row){ 
                        $i++;
                        $btype = $fc->bankTypeID($row['bankCode']);
                    ?>
                    <tr>
                        <td class="text-center align-middle"><?=$i?></td>
                        <td class="text-nowarp align-middle"><?=esc($btype['bankNameTh'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['accout_name'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['accout_number'])?></td>
                        <td class="text-nowrap">
                            <select class="form-select <?=$row['status'] =="1"?"bg-success":"bg-danger"?> text-white" id="status" name="status" TypeID="<?=esc($row['bank_id'])?>">
                                <option value="0" <?=$row['status'] == "0"?"selected='selected'":""?>>ปิดใช้งาน</option>
                                <option value="1" <?=$row['status'] == "1"?"selected='selected'":""?>>เปิดใช้งาน
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary dropdown-toggle bg-info" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="lni lni-cog"></i></button>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item text-dark ControlDesc" tID="<?=esc($row['bank_id'])?>"
                                        st="<?=$row['status']?>" href="javascript:;"><i
                                            class="fadeIn animated bx bx-detail"></i>&nbsp;
                                        รายละเอียด</a>
                                </li>
                                <hr />
                                <li> <a class="dropdown-item text-warning ControlEdit" tID="<?=esc($row['bank_id'])?>"
                                        href="javascript:;"><i class="fadeIn animated bx bx-edit"></i>&nbsp;แก้ไขข้อมูล</a>
                                </li>
                                <li> <a class="dropdown-item text-danger ControlDesc" tID="<?=esc($row['bank_id'])?>"
                                        st="<?=$row['status']?>" href="javascript:;"><i
                                            class="fadeIn animated bx bx-eraser"></i>&nbsp;
                                        ลบข้อมูล</a></a>
                                </li>
                            </ul>
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
    $('#add').click(function(e) {
        e.preventDefault();
        $.post("./component/bankaccount/form", (data) => {
            $('#contentData').html(data);
        }, "html");
    });


    $('.ControlDelete').click(function(e) {
        e.preventDefault();
        console.log('del');
        let id = $(this).attr('tID');
        let st = $(this).attr('st');
        console.log(id);
        Swal.fire({
            title: 'คุณต้องการเปลี่ยนสถานะใช่หรือไม่?',
            showDenyButton: true,
            confirmButtonText: 'ใช่',
            denyButtonText: `ไม่`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.post("./component/bankaccount/process", {
                        even: 'del',
                        id: id,
                        st: st
                    },
                    function(data) {
                        //console.log(data) test data เมื่อเปี่ยนเป็น html
                        if (data.status == 1) {
                            Swal.fire({

                                icon: 'success',
                                title: 'ลบเรียบร้อยแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $.post("./component/bankaccount/list", (data) => {
                                    $('#contentData').html(data);
                                }, "html");
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ข้อมูลผิดพลาด',
                                text: data.message,
                            })
                        }
                    },
                    "json" //test change  html
                );
            }
        })
    });

    $('.ControlEdit').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('tID');
        var even = 'edit';
        $.post("./component/bankaccount/form", {
            even: even,
            id: id
        }, (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('.ControlDesc').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('tID');
        var even = 'desc';
        $.post("./component/bankaccount/description", {
            even: even,
            id: id
        }, (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('.form-select').change(function(e) {
        e.preventDefault();
        let id = $(this).attr('TypeID');
        let value = $(this).val();
        $.post("./component/bankaccount/process", {
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
                        $.post("./component/bankaccount/list", (data) => {
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