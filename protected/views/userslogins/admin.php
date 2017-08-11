<?php
/* @var $this UsersloginsController */
/* @var $model Userslogins */


$this->breadcrumbs = array(
    'Home'=>array('site/dashboard'),
   // 'Userslogins' => array('index'),
    'View User Logs',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Userslogins', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Userslogins', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#userslogins-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type='text/css'>
    .view,.update{
        display:none; 
    }
</style>
<div class='form-css'>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="panel-title">View Logs</h3>
    </div>
    <div class="panel-body">
        <div class="search-form">
            <div class="well">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                'action' => Yii::app()->createUrl($this->route),
                'method' => 'get',
            ));
            ?>
            <div class='row'>
                <div class='col-md-4'>
                    <label>Users</label>
                    <?php echo $form->dropDownList($model, 'user_id', CHtml::listData(Users::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '---Select Category---')); ?>
                </div>
                <div class='col-md-3'>
                    <label class="control-label" for="input-date-start">Date Start</label>
                    <div class="input-group date">
                        <input type="text" name="filter_date_start" id="datestart" style="width:240px;" class="datepicker form-control" value="<?php echo $filter_date_start; ?>" placeholder="Select Start Date">
                    </div>
                </div>           
                <div class='col-md-3'>
                    <label class="control-label" for="input-date-start">Date End</label>
                    <div class="input-group date">
                        <input type="text" name="filter_date_end" id="datestart" style="width:240px;" class="datepicker form-control" value="<?php echo $filter_date_end; ?>" placeholder="Select End Date">
                    </div>
                </div>   
                <div class='col-md-2'>
                    <label class="control-label" for="input-date-start"></label>
                    <div class="input-group date">
                         <div style="padding-top:5px;"></div>
                         <button type="submit" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Filter</button>                                 
                    </div>
                </div>
                </div>
        <?php $this->endWidget(); ?>
        </div>
        </div>
        <br/>
        <!-- search-form -->
        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'userslogins-grid',
            'type'=>'bordered',
            'dataProvider' => $model->search($model->user_id,$filter_date_start,$filter_date_end),
            //'filter' => $model,
            'columns' => array(
                //'id',
                array('htmlOptions' => array('width' => '150'), 'header' => 'Users', 'name' => 'user_id', 'type' => 'raw', 'value' => '$data->user->name'),
                'log_type',
                'in_out',
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                ),
            ),
        ));
        ?>
</div>
</div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap-datepicker.js"></script>
<script>
    $('.datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true
    }).on('changeDate', function(ev) {
       // $(this).datepicker('hide');
    });
</script>