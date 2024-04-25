<?=$this->include('layout/header') ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="col-12" id="contentTop"></div>
        <div class="col-12 mt-2" id="contentData"></div>

    </div>
</div>
<?=$this->include('layout/footer') ?>


<script>
$.post("./component/producttype/list", (data) => {
    $('#contentData').html(data);
}, "html");


$('#add').click(function(e) {
    e.preventDefault();
    console.log('go');
    $.post("./component/producttype/form", (data) => {
        $('#contentData').html(data);
    }, "html");

});
</script>