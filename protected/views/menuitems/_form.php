<?php
/* @var $this MenuitemsController */
/* @var $model Menuitems */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'menuitems-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);  ?>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAllByAttributes(array('type' => 'Menu')), 'id', 'name'), array('empty' => '--Select Category--')); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->labelex($model, 'p_sub_category_id'); ?>
        <select name="Menuitems[p_sub_category_id]" id="p_sub_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
    </div>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'item_id', CHtml::listData(Purchaseitem::model()->findAllByAttributes(array('id' => $model->item_id)), 'id', 'itemname'), array('empty' => '--Select Item--')); ?>
    </div>
</div>

<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'barcode', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'tax_type', array('empty' => '--Select Tax Type--','inclusive'=>'Inclusive','exclusive'=>'Exclusive')); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'sale_price', array('maxlength' => 15)); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-12'>
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php // echo $form->textFieldControlGroup($model, 'barcode', array('maxlength' => 100)); ?>
<?php // echo $form->textFieldControlGroup($model, 'is_active'); ?>


<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var cid = $('#Menuitems_p_category_id').val();
        var itype = 'Menu';
        var scid = '<?php echo $model->p_sub_category_id ?>';
        GetSCategory(cid, scid, itype);

        $('#Menuitems_p_category_id').change(function() {
            var cid = $('#Menuitems_p_category_id').val();
            var itype = 'Menu';
            var scid = '';
            GetSCategory(cid, scid, itype);
        });
    });

    function GetSCategory(cid, scid, itype) {
        $("#p_sub_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid, "type": itype}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Sub Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#p_sub_category_id").html(content);
        });
    }
</script>