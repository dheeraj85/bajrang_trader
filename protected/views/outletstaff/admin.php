<?php
/* @var $this OutletstaffController */
/* @var $model Outletstaff */

$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Manage Outlet Staff',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Outletstaff', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Outletstaff', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#outletstaff-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .view,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Manage Outlet Staffs</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'outletstaff-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
                        //  'filter' => $model,
                        'columns' => array(
                           // 'id',
                          //  'created_by',
                            'first_name',
                            'last_name',
                            'mobile_no',
                            'address',
                            'loginid',
                            'password',
                            'staff_role',
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->users->name'),
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