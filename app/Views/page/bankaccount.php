<?=$this->include('layout/header') ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="col-12" id="contentTop"></div>
        <div class="col-12 mt-2" id="contentData"></div>

    </div>
</div>
<?=$this->include('layout/footer') ?>


<script>
$.post("./component/bankaccount/list", (data) => {
    $('#contentData').html(data);
}, "html");

</script>