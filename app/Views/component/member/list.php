<?php 
$return=array();
$fc = new \App\Helpers\fcPosition($db);
$id = isset($_POST['id']) ? $_POST['id'] : '';

$query = $db->query("SELECT * FROM `member` WHERE `member_id` LIKE '%$id%' AND `status` <> '99' ORDER BY `member_id` DESC ");
?>

<div class="card border-top border-0 border-4 border-info">
    <div class="card-body p-5">
        <div class="row no-gutters">
            <div class="col-md-8 order-md-1 mb-2 ">
                <h5 class="text-md-start text-center mb-0"><i class="bx bxs-user me-1 font-22 "></i> จัดการข้อมูลสมาชิก</h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center" id="add">
                        <i class="fadeIn animated bx bx-user-plus"></i>
                        &nbsp;
                        เพิ่มข้อมูลสมาชิก
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
                        <th class="text-nowrap">รหัสสมาชิก</th>
                        <th class="text-nowrap">ชื่อผู้ใช้งาน</th>
                        <th class="text-nowrap">Password</th>
                        <th class="text-nowrap">ชื่อ - นามสกุล</th>
                        <th class="text-center">ระดับสมาชิก</th>
                        <th class="text-center">เบอร์โทรศัพท์</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($query->getResult('array') as $row){ 
                        $i++;
                        $mPosition = $fc->memberPositionTypeID($row['position_id']);
                        
                    ?>
                    <tr>
                        <td class="text-center align-middle"><?=$i?></td>
                        <td class="text-nowarp align-middle"><?=esc($fc->convert10digit($row['member_id']))?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['profile_id'])?></td>
                        <td class="text-nowarp align-middle">Password</td>
                        <td class="text-nowarp align-middle"><?=esc($row['name'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($mPosition['position_name'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['telephone'])?></td>
                        <td class="text-nowrap">
                            <select class="form-select <?=$row['status'] =="1"?"bg-success":"bg-danger"?> text-white"
                                id="status" name="status" TypeID="<?=esc($row['member_id'])?>">
                                <option value="0" <?=$row['status'] == "0"?"selected='selected'":""?>>ปิดใช้งาน</option>
                                <option value="1" <?=$row['status'] == "1"?"selected='selected'":""?>>เปิดใช้งาน
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary dropdown-toggle bg-info" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="lni lni-cog"></i></button>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item text-dark ControlDesc" tID="<?=esc($row['member_id'])?>"
                                        st="<?=$row['status']?>" href="javascript:;"><i
                                            class="fadeIn animated bx bx-detail"></i>&nbsp;
                                        รายละเอียด</a>
                                </li>
                                <hr />
                                <li> <a class="dropdown-item text-warning ControlEdit" tID="<?=esc($row['member_id'])?>"
                                        href="javascript:;"><i
                                            class="fadeIn animated bx bx-edit"></i>&nbsp;แก้ไขข้อมูล</a>
                                </li>
                                <li> <a class="dropdown-item text-danger ControlDelete" tID="<?=esc($row['member_id'])?>"
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
        $.post("./component/member/form_add", (data) => {
            $('#contentData').html(data);
        }, "html");
    });

    $('.ControlDesc').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('tID');
        var even = 'edit';
        $.post("./component/member/form", {
            even: even,
            id: id
        }, (data) => {
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
                $.post("./component/member/process", {
                        even: 'dela',
                        id: id,
                        st: st
                    },
                    function(data) {
                        // console.log(data) 
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบเรียบร้อยแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $.post("./component/member/list", (data) => {
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
        $.post("./component/member/form_add", {
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
        $.post("./component/member/process", {
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
                        $.post("./component/member/list", (data) => {
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