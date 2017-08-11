<?php
/* @var $this UsersController */
/* @var $model Users */


$this->breadcrumbs=array(
    'Home'=>array('site/dashboard'),
    'Manage Account',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Users', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type='text/css'>
    .view{
        display:none; 
    }
</style>
<div class='form-css'>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="panel-title">Manage Account</h3>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div>
        <!-- search-form -->

        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'users-grid',
            'type'=>'bordered',
            'dataProvider' => $model->search(),
            //'filter' => $model,
            'columns' => array(
                //'id',
                'name',
                'mobile',
                'email',
                'password_hash',
                'auth_password',
                'role',
                //'password',
                /*
                  'role',
                  'logged_in',
                  'logged_out',
                  'is_active',
                 */
                array('htmlOptions' => array('width' => '100'), 'header' => 'Status', 'name' => 'status', 'type' => 'raw', 'value' => 'Users::request($data)'),
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>
</div>