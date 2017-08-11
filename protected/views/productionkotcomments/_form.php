<?php
/* @var $this ProductionkotcommentsController */
/* @var $model Productionkotcomments */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id' => 'productionkotcomments-form',
//            'action' => $this->createUrl('productionkotcomments/create'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'production_kot_id'); ?>
<?php echo $form->hiddenField($model, 'from_id', array('value' => Yii::app()->user->id)); ?>

<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'to_id', CHtml::listData(Users::model()->findAllBySql("select * from users where role='kpos'"), 'id', 'name')); ?>
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
    <div class='col-md-8'>
        <?php echo $form->textAreaControlGroup($model, 'comments', array('rows' => 3, 'maxlength' => 255)); ?>
    </div>
</div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#productionkotcomments-form").submit(function(){
            $(".btn").attr('disabled', 'disabled');
        });
        $(".delete").click(function(){
            return confirm("Are you sure you want to delete this data?");
        });
    });
</script>
