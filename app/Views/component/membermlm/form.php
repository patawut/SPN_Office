<?php
$fc = new \App\Helpers\fcPosition($db);
$cat2 = $fc->memberPositionTypeList($db);

$fcM = new \App\Helpers\fcPositionmlm($db);
$fcMember = new \App\Helpers\fcMember($db);

$even = isset($_POST['even'])?$_POST['even']:'addM';
$id = isset($_POST['id'])?$_POST['id']:'';
$selected='';

$left_id = '';
$right_id = '';
$position_mlm_id = '';
$nameleft = '';
$nameright = '';
$num_guild = '';
$num_team = '';
$position='';
$position_mlm_name='';
$position='';

?>

<?php
$query_mlm = $db->query("SELECT * FROM `member_mlm` WHERE `member_id` = ? AND `status` <> '99'" ,[$id]);
$row_mlm = $query_mlm->getRow();
if($row_mlm){
    $member_id = $row_mlm->member_id;
    $left_id = $row_mlm->left_id;
    $right_id = $row_mlm->right_id;
    $position_mlm_id = $row_mlm->position_mlm_id;
    $nameleft = $fcMember->memberData($row_mlm->left_id);
    $nameright = $fcMember->memberData($row_mlm->right_id);
    $num_guild = $row_mlm->num_guild;
    $num_team = $row_mlm->num_team;
    $position = $fcM->PositionMlmTypeID($position_mlm_id);
}
if(!empty($row_mlm)){
?>
<div class="row row-cols-lg-1 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">ระดับตำแหน่งของสมาชิก</p>
                        <h4 class="my-1"> <?php if(!empty($position_mlm_id)){ echo $position['position_mlm_name'] . ' (' . $position['position_mlm_short'] . ')'; }else{  echo "-"; }
                        ?></h4>
                    </div>
                    <div class="widgets-icons bg-light-info text-info ms-auto"><i class="bx bx-crown"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-cols-lg-2 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">จำนวนผู้แนะนำ</p>
                        <?php 
                            if (!empty($num_guild)) {
                            ?> <h4 class="my-1 text-info">
                            <?=number_format($num_guild)?></h4>
                        <?php } else { ?>
                        <h4 class="my-1 text-info">0</h4>
                        <?php
                                                    }
                                                ?>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto">
                        <i class="bx bx-trending-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 border-start border-0 border-3 border-danger">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">จำนวนคนในทีม</p>
                        <?php 
                                                             //  $query_upline = $db->query("SELECT COUNT(`node_id`) AS count_upline FROM `member_mlm` WHERE `upline_id` = ? " ,[$id]);
                                                            //   $row_upline = $query_upline->getResult('array');
                            if (!empty($num_team)) {
                                                                   // $count_upline = $row_gupline[0]['count_upline'];
                            ?> <h4 class="my-1 text-info">
                            <?=number_format($num_team)?></h4>
                        <?php } else { ?>
                        <h4 class="my-1 text-info">0</h4>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto">
                        <i class="bx bx-group"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-lg-2 row-cols-1 row-cols-md-1 row-col-sm-12  row-cols-xl-12">
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="text-center">
                    <div class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                        <i class="bx bx-chevrons-left"></i>
                    </div>
                    <h4 class="my-1">
                        <?php if ($left_id != NULL) {  $convertedLeftID = $fc->convert10digit($row_mlm->left_id);
                                $name = isset($nameleft['name']) ? $nameleft['name'] : 'ชื่อไม่พบ'; 
                                echo $convertedLeftID;   }else{ echo "ไม่มีผู้แนะนำ"; } ?>
                    </h4>
                    <p class="mb-0 text-secondary"><?php if ($left_id != NULL) {  
                                $name = isset($nameleft['name']) ? $nameleft['name'] : 'ชื่อไม่พบ'; 
                                echo ' ( คุณ ' . $name . ' ) ';   }else{ echo "-"; } ?></p>
                    <p class="mb-0 text-secondary"><b>สายงานซ้าย (LEFT)</b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="text-center">
                    <div class="widgets-icons rounded-circle mx-auto bg-light-primary text-primary mb-3">
                        <i class="bx bx-chevrons-right"></i>
                    </div>
                    <h4 class="my-1">
                        <?php if ($right_id != NULL) {  $convertedRightID = $fc->convert10digit($row_mlm->right_id);
                                $name = isset($nameright['name']) ? $nameright['name'] : 'ชื่อไม่พบ'; 
                                echo $convertedRightID;   }else{ echo "ไม่มีผู้แนะนำ"; } ?>
                    </h4>
                    <p class="mb-0 text-secondary"><?php if ($right_id != NULL) {  
                                $name = isset($nameright['name']) ? $nameright['name'] : 'ชื่อไม่พบ'; 
                                echo ' ( คุณ ' . $name . ' ) ';   }else{  echo "-"; } ?></p>
                    <p class="mb-0 text-secondary"><b>สายงานขวา (RIGHT)</b></p>
                </div>
            </div>
        </div>
    </div>
    <?php }else{ ?>
    <button type="button" class="btn btn-primary align-items-center openmodal" mIDD="<?=$id?>" id="btn_modal">
        <i class="fadeIn animated bx bx-plus-medical"></i>
        &nbsp;
        เพิ่มข้อมูลนักธุรกิจ
    </button>
    <?php
        }
    ?>
</div>

<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content " id="memberModal_content">
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    $('.openmodal').click(function(e) {
        e.preventDefault();
        let id = $(this).attr('mIDD');

        $.post("./component/membermlm/form_modal", {
            id: id
        }, (data) => {
            //console.log(id);
            $('#memberModal').modal('show');
            $('#memberModal_content').html(data);
        }, "html");
    });


});
</script>