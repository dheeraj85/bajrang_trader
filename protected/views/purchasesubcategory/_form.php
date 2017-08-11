<?php
/* @var $this PurchasesubcategoryController */
/* @var $model Purchasesubcategory */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchasesubcategory-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<label>Category</label>
 <?php
if (Yii::app()->user->isSA() == 'sa' || Yii::app()->user->isCPS() == 'cps') {?>
<?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Purchasecategory::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '---Select Category---')); ?>
<?php }else{?>
<?php echo $form->dropDownList($model, 'category_id', CHtml::listData(Purchasecategory::model()->findAllByAttributes(array("type"=>'Processed')), 'id', 'name'), array('class' => 'form-control', 'empty' => '---Select Category---')); ?>
<?php }?>
<br/>
<?php echo $form->textFieldControlGroup($model, 'name', array('maxlength' => 100)); ?>
<label>Item Type</label>
 <?php
if (Yii::app()->user->isSA() == 'sa' || Yii::app()->user->isCPS() == 'cps') {?>
<?php echo $form->dropdownlist($model, 'type', Utils::types(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<?php }else{?>
<?php echo $form->dropdownlist($model, 'type', Utils::types_gpu(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<?php }?>
<br/>
<?php echo $form->textAreaControlGroup($model, 'description', array('maxlength' => 200)); ?>

<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'btnsubcategory')); ?>
<?php $this->endWidget(); ?>
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
    $('#btnsubcategory').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>