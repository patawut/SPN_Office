<?php
$even = isset($_POST['even'])?$_POST['even']:'';
$id = isset($_POST['id'])?$_POST['id']:'';
?>

<input type="hidden" class="form-control" id="even" name="even" value="<?=$even?>">
<input type="hidden" class="form-control" id="idd" name="idd" value="<?=$id?>">

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="col-12" id="showform"></div>
    </div>
</div>


<br>
<script>
$(document).ready(function() {
    let idd = $('#id').val();
    var urls9 = ["./component/membermlm/form"];
    $.ajax({
        url: urls9, // เปลี่ยนเส้นทางไปยังสคริปต์ที่จะตรวจสอบค่า
        type: 'POST',
        data: {
            id: idd,
            even: "addM"
        },
        success: function(data) {
            $('#showform').html(data);
        },
        dataType: 'html'
    });
});
</script>