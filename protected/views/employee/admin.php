<?php
/* @var $this EmployeeController */
/* @var $model Employee */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Human Resource' => array('employee/index'),
    'Manage Employee Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Employee', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Employee', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#employee-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Manage Employee Details</h3>
                </div>
                <div class="panel-body table-responsive">
                     <div class="search-form">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'employee-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
                       // 'filter' => $model,
                        'columns' => array(
                            //'id',
                            'empcode',
                            'empname',
                            'fname',
                            'dob',
                            'contact',
                            'address',
                            array('htmlOptions' => array(), 'header' => 'Designation', 'name' => 'designation_id', 'type' => 'raw', 'value' => '$data->designation->name'),
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->users->name'),
                            /* 'is_active',
                              'created_by',
                              'created_date',
                             */
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