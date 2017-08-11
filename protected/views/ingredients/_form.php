<?php
/* @var $this IngredientsController */
/* @var $model Ingredients */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'ingredients-form',
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
        <?php echo $form->hiddenField($model, 'recipe_item_id',array('value'=>$rid)); ?>

    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <select class="js-example-basic-single">
        <?php foreach (Purchaseitem::model()->findAll() as $item) { ?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->itemname; ?></option>      
          <?php } ?>    
        </select>
        <?php // echo $form->dropDownListControlGroup($model, 'item_id',CHtml::listData(Purchaseitem::model()->findAll(),'id','itemname'),array('empty'=>'--Select Item--')); ?>

    </div>

    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <?php echo $form->textFieldControlGroup($model, 'weight_in_gm'); ?>

    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12'>
        <?php echo $form->textFieldControlGroup($model, 'description', array('maxlength' => 200)); ?>

    </div>
    <div class='col-lg-3 col-md-3 col-sm-6 col-xs-12' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
$(document).ready(function(){
    $('.js-example-basic-single').select2();
});
</script>
