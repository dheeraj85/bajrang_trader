<?php
/* @var $this CategorytaxesController */
/* @var $model Categorytaxes */
?>

<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'Category Taxes',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Categorytaxes', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Categorytaxes', 'url' => array('admin')),
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
                    <h3 class="panel-title">Add Category Taxes</h3>
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
                    <h3 class="panel-title">Manage Category Taxes</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'categorytaxes-grid',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            array(
                                'name' => 'pos_type',
                                'value' => '$data->getPOSType($data)'
                            ),
                            array(
                                'name' => 'p_category_id',
                                'value' => '$data->pCategory->name'
                            ),
                            array(
                                'name' => 'p_sub_category_id',
                                'value' => '$data->pSubCategory->name'
                            ),
                            array(
                                'name' => 'tax_id',
                                'value' => '$data->taxtype->tax_name'
                            ),
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