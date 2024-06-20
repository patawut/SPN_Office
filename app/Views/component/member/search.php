<?php
    $mname = isset($_SESSION['mname']);
    $even = isset($_POST['even'])?$_POST['even']:'search';
?>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3"><i class="bx bxs-user me-1 font-22 "></i> ข้อมูลสมาชิก</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="<?=site_url('./')?>"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลสมาชิก</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<hr />
<div class="card border-top border-0 border-4 border-primary">
    <div class="card-body">
        <form class="row" id="formSearch" method="post" enctype="multipart/form-data" name="formSearch
        ">
            <div class="input-group">
                <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
                
            </div>
            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false" id="searchType" sID="99" >ประเภทค้นหา</button>
                <ul class="dropdown-menu" style="">
                    <li><a class="dropdown-item search_dropdown" href="#" sID="1">รหัสสมาชิก</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item search_dropdown" href="#" sID="2">ชื่อสมาชิก</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item search_dropdown" href="#" sID="3">เบอร์โทรศัพท์</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item search_dropdown" href="#" sID="4">E-mail</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item search_dropdown" href="#" sID="5">แสดงข้อมูลทั้งหมด</a>
                    </li>
                </ul>
                <input type="text" class="form-control" id="mname" name="mname" placeholder="ค้นหาข้อมูลสมาชิก"
                    aria-label="ค้นหาข้อมูลสมาชิก" aria-describedby="btn_search">
                <button class="btn btn-outline-primary" type="submit" id="btn_search"><i
                        class="fadeIn animated bx bx-search-alt"></i></button>
            </div>
            <input type="hidden" class="form-control" id="search_val" name="search_val" value="99">
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.search_dropdown').click(function(e) {
        e.preventDefault();

        var selectedText = $(this).text();
        var selectedValue = $(this).attr('sID');
                
        $('#searchType').text(selectedText);
        if(selectedValue == '5'){
            $('#mname').attr('placeholder', selectedText);
        }else{
            $('#mname').attr('placeholder', 'ค้นหา' + selectedText);
        }
        $('#search_val').val(selectedValue);

    });

    $('form#formSearch').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        //console.log('p1');
        let id = formData.get('mname');
        let search_val = formData.get('search_val');
        $.ajax({
            url: './component/member/process',
            type: 'POST',
            data: formData,
            success: function(data) {
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        console.log(id);
                        console.log(search_val);
                        $.post("./component/member/list", {
                            id: id,
                            search_val: search_val
                        }, function(data) {
                            $('#showlist').html(data);
                        }, "html");
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: data.msg,
                    })
                    $.post("./component/member/search", (data) => {
                        $('#showSearch').html(data);
                    }, "html");
                    $.post("./component/member/list", {
                        id: id,
                        search_val: search_val
                    }, function(data) {
                        $('#showlist').html(data);
                    });
                }

            },
            statusCode: {

                404: () => {
                    alert("page not found")
                },
                500: () => {
                    alert("เกินข้อผิดพลาดภายในระบบ")
                }
            },
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
</script>