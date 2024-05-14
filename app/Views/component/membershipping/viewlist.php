<?php
$even = isset($_POST['even'])?$_POST['even']:'';
$id = isset($_POST['id'])?$_POST['id']:'';
?>

<input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
<input type="hidden" class="form-control" id="idd" name="idd" value="<?=$id?>">

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="col-12" id="showform"></div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="col-12" id="showlist"></div>
    </div>
</div>


<br>
<script>
$(document).ready(function() {
    let idd = $('#id').val();
    var urls4 = ["./component/membershipping/form"];
    $.ajax({
        url: urls4, // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
        type: 'POST',
        data: {
            id: idd,
            even: "editSendData"
        },
        success: function(data) {
            $('#showform').html(data);
        },
        dataType: 'html'
    });

    var urls5 = ["./component/membershipping/list"];
    $.ajax({
        url: urls5, // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
        type: 'POST',
        data: {
            id: idd,
            even: "editList"
        },
        success: function(data) {
            $('#showlist').html(data);
        },
        dataType: 'html'
    });
});
</script>