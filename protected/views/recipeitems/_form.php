<?php
/* @var $this RecipeitemsController */
/* @var $model Recipeitems */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'recipeitems-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>
<div class='row'>
    <div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>
        <?php echo $form->dropDownListControlGroup($model, 'recipe_category', Utils::recipe_category()); ?>

    </div>
    <div class='col-lg-3 col-md-4 col-sm-6 col-xs-12'>
        <?php echo $form->dropDownListControlGroup($model, 'category_name_id', CHtml::listData(Cakeflavour::model()->findAll(), 'id', 'flavour_name'), array('' => '--Select Flavour--')); ?>

    </div>
    <div class='col-lg-2 col-md-4 col-sm-6 col-xs-12'>
        <?php echo $form->textFieldControlGroup($model, 'weight_limit_kg'); ?>

    </div>
    <div class='col-lg-4 col-md-8 col-sm-6 col-xs-12'>
        <?php echo $form->textFieldControlGroup($model, 'description', array('maxlength' => 200)); ?>

    </div>
    <div class='col-lg-1 col-md-4 col-sm-6 col-xs-12' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

    </div>
</div>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        var rcat = $('#Recipeitems_recipe_category').val();
        var fid = '<?php
if ($model->category_name_id!='') {
    echo $model->category_name_id;
} else {
    echo '';
}
?>';
        GetFCategory(rcat, fid);
        $('#Recipeitems_recipe_category').change(function() {
            var rcat = $('#Categorytaxes_recipe_category').val();
            var fid = '';
            GetFCategory(rcat, fid);
        });
    });

    function GetFCategory(rcat, fid) {
        $("#Recipeitems_category_name_id").html("");
        $.getJSON("<?php echo $this->createUrl('recipeitems/getFCategoryList'); ?>", {"rcat": rcat}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Category--</option>';
            $.each(data.cat, function(i, ct) {
                if (fid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Recipeitems_category_name_id").html(content);
        });
    }
</script>
