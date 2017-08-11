<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
<div class='row'>
    <div class='col-md-3'>
        <?php echo $form->dropDownListControlGroup($model, 'employee_id', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('empty' => '--Select Employee--')); ?>
    </div>
    <div class='col-md-3'>
        <label>Month</label>
        <?php echo $form->dropdownlist($model, 'month', Utils::year_name(), array('maxlength' => 100, 'id' => 'salary_month', 'class' => 'form-control')); ?>
    </div>
    <div class='col-md-3'>
        <label>Year</label>
        <select id="Employeesalary_year" name="Employeesalary[year]" class="form-control">
            <option value="">-Select-</option>
            <?php foreach (Utils::years() as $y) {
            if($model->year==$y){
                ?>
            <option value="<?php echo $y?>" selected="selected"><?php echo $y?></option>
            <?php }else{ ?>
                <option value="<?php echo $y?>"><?php echo $y?></option>
            <?php }}?>    
       </select>
    </div>
    <div class="col-md-3" style="margin-top:20px;">
        <?php echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>
</div>
<?php $this->endWidget(); ?>