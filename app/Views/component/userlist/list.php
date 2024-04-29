<?php 
$return=array();
$fc = new \App\Helpers\fcUser($db);

$query = $db->query("SELECT * FROM `user` WHERE `status` <> '99' ORDER BY `username` DESC ");
?>

<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class='bx bxs-user'></i> ข้อมูลผู้ใช้งาน</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลผู้ใช้งาน</li>
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
                <h5 class="text-md-start text-center mb-0"><i class="bx bxs-user me-1 font-22 "></i> จัดการข้อมูลผู้ใช้งาน</h5>
            </div>
            <div class="col-md-4 order-md-2">
                <div class="text-md-end text-center">
                    <button type="button" class="btn btn-primary align-items-center" id="add">
                        <i class="fadeIn animated bx bx-user-plus"></i>
                        &nbsp;
                        เพิ่มข้อมูลผู้ใช้งาน
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
                        <th class="text-nowrap">Username</th>
                        <th class="text-nowrap">Password</th>
                        <th class="text-nowrap">ชื่อเต็ม</th>
                        <th class="text-nowrap">ระดับ</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center"><i class="fas fa-cog"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;
                    foreach($query->getResult('array') as $row){ 
                        $i++;
                        $user_data = $row['username'];
                        $utype = $fc->userTypeID($user_data);
                    ?>
                    <tr>
                        <td class="text-center align-middle"><?=$i?></td>
                        <td class="text-nowarp align-middle"><?=esc($row['username'])?></td>
                        <td class="text-nowarp align-middle">Password</td>
                        <td class="text-nowarp align-middle"><?=esc($row['fullname'])?></td>
                        <td class="text-nowarp align-middle"><?=esc($utype['type'])?></td>
                        <td class="text-nowrap">
                            <select class="form-select <?=$row['status'] =="1"?"bg-success":"bg-danger"?> text-white"
                                id="status" name="status" TypeID="<?=esc($row['username'])?>">
                                <option value="0" <?=$row['status'] == "0"?"selected='selected'":""?>>ปิดใช้งาน</option>
                                <option value="1" <?=$row['status'] == "1"?"selected='selected'":""?>>เปิดใช้งาน
                                </option>
                            </select>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-outline-secondary dropdown-toggle bg-info" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="lni lni-cog"></i></button>
                            <ul class="dropdown-menu">
                                <li> <a class="dropdown-item text-warning ControlEdit" tID="<?=esc($row['username'])?>"
                                        href="javascript:;"><i
                                            class="fadeIn animated bx bx-edit"></i>&nbsp;แก้ไขข้อมูล</a>
                                </li>
                                <li> <a class="dropdown-item text-danger ControlDelete" tID="<?=esc($row['username'])?>"
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
        $.post("./component/userlist/form", (data) => {
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
                $.post("./component/userlist/process", {
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
                                $.post("./component/userlist/list", (data) => {
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
        $.post("./component/userlist/form", {
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
        $.post("./component/userlist/process", {
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
                        $.post("./component/userlist/list", (data) => {
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