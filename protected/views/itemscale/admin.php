<?php
/* @var $this ItemscaleController */
/* @var $model Itemscale */


$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Scales & Measures',
    'Scales',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Itemscale', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemscale', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#itemscale-grid').yiiGridView('update', {
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
            <div class="col-lg-5">
                <div class="box box-primary">
                    <div class="box-header with-border bg-aqua">
                        <h3 class="panel-title">Add Scale's & Measures</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->renderPartial('_form', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                </div>
            </div> 
            <div class="col-lg-7">
                <div class="box box-primary">
                    <div class="box-header with-border bg-aqua">
                        <h3 class="panel-title">Manage Scale's & Measures</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.BsGridView', array(
                            'id' => 'itemscale-grid',
                            'type' => 'bordered',
                            'dataProvider' => $model->search(),
                            //'filter' => $model,
                            'columns' => array(
                                // 'id',
                                'scale_type',
                                'type_name',
                                'description',
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
</div>