<?php
$even = isset($_POST['even'])?$_POST['even']:'';
$id = isset($_POST['id'])?$_POST['id']:'';
?>
<div class="card border-top border-0 border-4 border-danger">
    <input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
    <input type="hidden" class="form-control" id="idd" name="idd" value="<?=$id?>">
    <div class="row">
        <div class="col-12">
            <div class="card-body p-5">
                <div class="row no-gutters">
                    <div class="col-md-8 order-md-1 mb-2 ">
                        <h5 class="text-md-start text-center mb-0"> <i class="fadeIn animated bx bx-buildings"></i>
                            ข้อมูลส่งสินค้า
                        </h5>
                    </div>
                </div>
                <hr>
                <div id="main">
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<br>
<script>
$(document).ready(function() {
    let idd = $('#id').val();
    var urlsM = ["./component/membershipping/viewlist"];
    $.ajax({
        url: urlsM, // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
        type: 'POST',
        data: {
            id: idd,
            even: "goShipping"
        },
        success: function(data) {
            $('#main').html(data);
        },
        dataType: 'html'
    });
});
</script>