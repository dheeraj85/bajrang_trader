<?php
/* @var $this VendoritemsupplyController */
/* @var $model Vendoritemsupply */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'vendoritemsupply-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<input type="hidden" name="Vendoritemsupply[vendor_id]" value="<?php echo $vid ?>"/>
<div class='row'>
    <div class='col-md-6'>
        <label>Category</label>
        <?php echo $form->dropDownList($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '---Select Category---')); ?>
    </div>
    <div class='col-md-6'>
        <label>Sub Category</label>
        <select name="Vendoritemsupply[p_sub_category_id]" id="Vendoritemsupply_sub_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
    </div>
</div>
<br/>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_GREEN)); ?>
<?php $this->endWidget(); ?>
<?php
$pitem = Purchaseitem::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
if (!empty($pitem)) {
    ?>
    <br/>
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'enableAjaxValidation' => false,
        'action' => $this->createUrl('vendoritemsupply/itemevaluate', array('vid' => $vid)),
    ));
    ?>
    <input type='button' value='Select All' id='Allcheck'>&nbsp;<input type='button' value='Deselect All' id='Allcheck2'>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>#</th>
<!--                <th>S No.</th>-->
                <th>Item with Scale</th>
                <th>Brand</th>            
            </tr>
        </thead>
        <tbody>
            <?php
            $c = 1;
            foreach ($pitem as $v) {
                ?>
                <tr>
                    <td width="10%"><input type="checkbox" class="allcheckedcategory" name="purchase_item_id_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>"></td>
<!--                    <td width="10%"><?php //echo $c; ?></td>-->
                    <td width="60%"><?php echo $v->itemname; ?> (<?php echo $v->item_scale; ?>)</td>
                    <td width="30%"><?php echo $v->brand; ?></td>
                </tr>    
            <input type="hidden" name="p_category_id" id="p_category_id" value="<?php echo $model->p_category_id; ?>"/>
            <input type="hidden" name="p_sub_category_id" id="p_sub_category_id" value="<?php echo $model->p_sub_category_id; ?>"/>
            <input type="hidden" name="vendor_id" value="<?php echo $vid ?>"/>
            <?php
            $c++;
        }
        ?>
    </tbody>
    </table>

    <input type="submit" id="save_evaluate" name="evaluate" value="Save & Submit" class="btn btn-green" />         
    <?php $this->endWidget(); ?>
<?php } ?>
<div id="myModal" style="padding:30px " class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body btn btn-info">
                Please wait while we are saving information. 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
<?php if (!empty($model->p_category_id)) { ?>
            var cid =<?php echo $model->p_category_id ?>;
            var scid =<?php echo $model->p_sub_category_id ?>;
            GetSCategory(cid, scid,'Purchase');
<?php } ?>
        $("#Vendoritemsupply_p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid,'Purchase');
        });
        $('#save_evaluate').click(function() {
            $(this).attr('disabled');
            $('#myModal').modal('show');
        });
        $("#Allcheck").click(function() {
<?php foreach ($pitem as $v) { ?>
                $('input:checkbox[name=purchase_item_id_<?php echo $v->id; ?>]').attr('checked', true);
<?php } ?>
        });
        $("#Allcheck2").click(function() {
<?php foreach ($pitem as $v) { ?>
                $('input:checkbox[name=purchase_item_id_<?php echo $v->id; ?>]').attr('checked', false);
<?php } ?>
        });
    });//ready

    function GetSCategory(cid, scid,type) {
        $("#Vendoritemsupply_sub_category_id").html("");
        $(".loading4").html("<img src='<?php echo Yii::app()->baseUrl ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid,"type":type}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="0">--Select Sub Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Vendoritemsupply_sub_category_id").html(content);
        });
    }
</script>