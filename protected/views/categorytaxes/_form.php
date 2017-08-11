<?php
/* @var $this CategorytaxesController */
/* @var $model Categorytaxes */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'categorytaxes-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);  ?>

<div class='row'>
    <div class='col-md-2'>
        <?php echo $form->dropDownListControlGroup($model, 'pos_type', Utils::postype()); ?>
    </div>
    <div class='col-md-3'>
        <?php echo $form->dropDownListControlGroup($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAllByAttributes(array('type' => 'Menu')), 'id', 'name'), array('empty' => '--Select Category--')); ?>
    </div>
    <div class='col-md-3'>
        <label>Item Sub Category</label>
        <select name="Categorytaxes[p_sub_category_id]" id="Categorytaxes_p_sub_category_id" class="form-control">
            <option value="">--Sub Category--</option>
        </select>
    </div>
    <div class='col-md-3'>
        <?php echo $form->dropDownListControlGroup($model, 'tax_id', CHtml::listData(Postaxes::model()->findAll(), 'id', 'tax_name'), array('empty' => '--Select Tax Type--')); ?>
    </div>
    <div class='col-md-1' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>


<?php $this->endWidget(); ?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var cid = $('#Categorytaxes_p_category_id').val();
        var itype = 'Menu';
        var scid = '<?php
if (!empty($model->p_sub_category_id)) {
    echo $model->p_sub_category_id;
} else {
    echo '';
}
?>';
        GetSCategory(cid, scid, itype);


        $('#Categorytaxes_pos_type').change(function() {
            var type = $('#Categorytaxes_pos_type').val();
            GetCategory(cid, type);
        });

        $('#Categorytaxes_p_category_id').change(function() {
            var cid = $('#Categorytaxes_p_category_id').val();
            var itype = 'Menu';
            var scid = '';
            GetSCategory(cid, scid, itype);
        });
    });

    function GetCategory(cid, type) {
        $("#Categorytaxes_p_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getCategoryList'); ?>", {"type": type}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (cid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Categorytaxes_p_category_id").html(content);
        });
    }

    function GetSCategory(cid, scid, itype) {
        $("#Categorytaxes_p_sub_category_id").html("");
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
            $("#Categorytaxes_p_sub_category_id").html(content);
        });
    }
</script>

