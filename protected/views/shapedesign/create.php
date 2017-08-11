<?php
/* @var $this ShapedesignController */
/* @var $model Shapedesign */
?>

<?php
$this->breadcrumbs=array(
	'Cake Management System'=>array('cakeweight/index'),
	'Cake Shape'=>array('cakeshape/create'),
	'Shape Design',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Shapedesign', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Shapedesign', 'url'=>array('admin')),
);
?>
<style>
    .view, .delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <div class="pull-left">
                        <h3 class="panel-title">Add Cake Shape Design for &emsp;<b><?php echo Cakeshape::model()->findByPk($model->shape_id)->shape_name; ?></b></h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?php echo $this->createUrl('cakeshape/create') ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Cake Shape Design</h3>
                </div>
                <div class="panel-body">
                    <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'shapedesign-grid',
			'dataProvider'=>$model->search(),
//			'filter'=>$model,
			'columns'=>array(
//        		'id',
//		'shape_id',
		'design_name',
//		'design_img',
		'design_description',
		'design_complexity.design_code',
//		'design_added_by',
                            array('htmlOptions' => array('width' => '140'), 'header' => 'Image', 'name' => 'design_img', 'type' => 'raw', 'value' => '$data->Getimg($data)'),
                            array('htmlOptions' => array('width' => '140'), 'header' => 'Shape', 'type' => 'raw', 'value' => '$data->Shapedesignweight($data)'),
		/*
		'added_by_id',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  