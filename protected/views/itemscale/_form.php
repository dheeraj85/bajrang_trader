<?php
/* @var $this ItemscaleController */
/* @var $model Itemscale */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'itemscale-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model);  ?>

<label>Goods Scale Type<a class="update" data-title="Details" title="" data-toggle="tooltip" 
data-original-title="Add Description of Goods Types
for eg. Raw Material can be any item supplied by vendor or
purchased in cash from market to process or to resell."><b>?</b></a></label>
 <?php
if (Yii::app()->user->isSA() == 'sa') {?>
<?php echo $form->dropdownlist($model, 'scale_type', Utils::stypes(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<?php }else{?>
<?php echo $form->dropdownlist($model, 'scale_type', Utils::stypes_gpu(), array('maxlength' => 100, 'id' => 'select', 'class' => 'form-control')); ?>
<?php }?>
<br/>
<?php echo $form->textFieldControlGroup($model, 'type_name', array('maxlength' => 20)); ?>

<?php echo $form->textAreaControlGroup($model, 'description', array('maxlength' => 200)); ?>

<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'btnscale')); ?>

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
    $('#btnscale').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>