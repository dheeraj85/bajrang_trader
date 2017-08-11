<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<?php echo $form->textFieldControlGroup($model, 'goods_service', array('maxlength' => 8)); ?>
<?php echo $form->textFieldControlGroup($model, 'gs_name', array('maxlength' => 50)); ?>
<?php echo $form->textFieldControlGroup($model, 'hsn_sac_code', array('maxlength' => 50)); ?>
<div class="form-actions">
<?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>
</div>
<?php $this->endWidget(); ?>
