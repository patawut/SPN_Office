<div class="row">
    <div class="col-12">
        <div class="col-12" id="showSearch"></div>
        <br>
        <div class="col-12" id="showlist"></div>
    </div>
</div>
<br>
<script>
    $.post("./component/member/search",(data)=> {  $('#showSearch').html(data);},"html");
</script>