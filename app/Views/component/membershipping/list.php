<?php
$even = isset($_POST['even'])?$_POST['even']:'';
$id = isset($_POST['id'])?$_POST['id']:'';
?>
<div class="table-responsive">
    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr class="text-nowrap bg-warning">
                <th class="text-center">ลำดับ</th>
                <th class="text-nowrap">ชื่อ</th>
                <th class="text-nowrap">ที่อยู่</th>
                <th class="text-nowrap">รหัสไปรษณีย์</th>
                <th class="text-center">เบอร์โทรศัพท์</th>
                <th class="text-center"><i class="fas fa-cog"></i></th>
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
                <td class="text-nowarp align-middle"><?=esc($row['telephone'])?></td>
                <td class="text-center">
                    <button class="btn btn-outline-secondary dropdown-toggle bg-info" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false"><i class="lni lni-cog"></i></button>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item text-warning ControlEdit"
                                ttID="<?=esc($row['member_shopping_id'])?>" tID="<?=$id?>" href="javascript:;"><i
                                    class="fadeIn animated bx bx-edit"></i>&nbsp;แก้ไขข้อมูล</a>
                        </li>
                        <li> <a class="dropdown-item text-danger ControlDelete" ttID="<?=esc($row['member_id'])?>"
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
    <script>
$(document).ready(function() {
    
    $('.ControlEdit').click(function(e) {
        e.preventDefault();
        let idd = $(this).attr('ttID');
        let id = $(this).attr('tID');
        var even = 'editSendData';
        $.post("./component/membershipping/form", {
            even: even,
            idd: idd,
            id: id
        }, (data) => {
            $('#showform').html(data);
        }, "html");
    });

    $('.ControlDelete').click(function(e) {
        e.preventDefault();
        console.log('del');
        let id = $(this).attr('tID');
        console.log(id);
        Swal.fire({
            title: 'คุณต้องการเปลี่ยนสถานะใช่หรือไม่?',
            showDenyButton: true,
            confirmButtonText: 'ใช่',
            denyButtonText: `ไม่`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.post("./component/membershipping/process", {
                        even: 'del',
                        id: id
                    },
                    function(data) {
                        //console.log(data) test data เมื่อเปี่ยนเป็น html
                        if (data.status == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ลบเรียบร้อยแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {});
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
    $('#dataTable').DataTable();
});
</script>