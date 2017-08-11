<?php
/* @var $this DesigncomplexityController */
/* @var $model Designcomplexity */
?>

<?php
$this->breadcrumbs=array(
	'Cake Management System'=>array('cakeweight/index'),
	'Design Complexity',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designcomplexity', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designcomplexity', 'url'=>array('admin')),
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
                    <h3 class="panel-title">Add Design Complexity</h3>
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
                    <h3 class="panel-title">Manage Design Complexity</h3>
                </div>
                <div class="panel-body">
                    <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'designcomplexity-grid',
			'dataProvider'=>$model->search(),
//			'filter'=>$model,
			'columns'=>array(
//        		'id',
		'design_code',
		'description',
		array('htmlOptions' => array('width' => '140'), 'header' => 'Rates', 'name' => 'rate', 'type' => 'raw', 'value' => '$data->rate'),
//                            'rate',
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