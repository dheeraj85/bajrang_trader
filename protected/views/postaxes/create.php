<?php
/* @var $this PostaxesController */
/* @var $model Postaxes */
?>

<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'POS Taxes',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Postaxes', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Postaxes', 'url' => array('admin')),
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
                    <h3 class="panel-title">Add POS Taxes</h3>
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
                    <h3 class="panel-title">Manage POS Taxes</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'postaxes-grid',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            'tax_name',
                            'tax_percent',
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