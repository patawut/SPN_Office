<?=$this->include('layout/header') ?>
<div class="container-fluid">
        <div class="col-12" id="contentTop"></div>
        <div class="col-12 mt-2"  id="contentData"></div>
        <div class="col-12 mt-2"  id="contentList"></div>
    
</div>

<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            
            <div class="modal-body" id="orderModal_content">
            </div>
            
        </div>
</div>
</div>
<?=$this->include('layout/footer') ?>

<script>
$.post("./component/bookingmain/search",(data)=> {  $('#contentTop').html(data);},"html");
$.post("./component/bookingmain/data",(data)=> {  $('#contentData').html(data);},"html");
$.post("./component/bookingmain/list",(data)=> {  $('#contentList').html(data);},"html");
</script>