<?php
/* @var $this PositemoffersController */
/* @var $model Cashdrawer */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl('positemoffers/searchcounter'),
    'method' => 'get',
        ));
?>

<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'counter_id', CHtml::listData(Cashcounter::model()->findAll(), 'id', 'counter_name'), array('empty' => '--Select Counter--')); ?>
    </div>
    <div class='col-md-4' style="margin-top: 25px;">
<?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>
</div>

<?php $this->endWidget(); ?>
