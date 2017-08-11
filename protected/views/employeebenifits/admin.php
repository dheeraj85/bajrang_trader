<?php
/* @var $this EmployeebenifitsController */
/* @var $model Employeebenifits */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource' => array('employee/index'),
    'Employee Benefits',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employeebenifits', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employeebenifits', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employeebenifits-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style>
    .view,.delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <a href="<?php echo $this->createUrl('employeebenifits/create'); ?>" class="btn btn-primary pull-right">Add Employee Benefit</a>
            <div style="clear:both"></div>
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Manage Employee Benefits</h3>
                </div>
                <div class="panel-body">
                    <div class="search-form">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <!-- search-form -->
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'employeebenifits-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            array('htmlOptions' => array('width' => '140'), 'name' => 'employee_id', 'type' => 'raw', 'value' => '$data->employee->empname'),
//                      'employee_id',
                            'txn_type',
                            array('htmlOptions' => array(), 'header' => 'Month', 'name' => 'month', 'type' => 'raw', 'value' => 'Employeebenifits::request($data)'),
                            //'month',
                            'year',
                            'amount',
                            'interest',
                            'dated',
                            'voucher_no',
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>    
    </div>  
</div>  