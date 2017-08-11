<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->textFieldControlGroup($model, 'empname', array('maxlength' => 100)); ?>
    </div>
    <div class='col-md-3'>
        <label>Mobile No.</label>
        <?php echo $form->textField($model, 'contact', array('maxlength' => 50,'placeholder'=>'Enter Mobile No.')); ?>
    </div>
    <div class='col-md-3'>    
        <?php echo $form->dropDownListControlGroup($model, 'designation_id', CHtml::listData(Designation::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class='col-md-3' style="margin-top:23px;">
    <button type="submit" id="button-filter" class="btn btn-primary"><i class="fa fa-search"></i> Filter</button>
    </div>
</div>

<?php $this->endWidget(); ?>