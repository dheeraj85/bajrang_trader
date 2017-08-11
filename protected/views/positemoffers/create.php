<?php
/* @var $this PositemoffersController */
/* @var $model Positemoffers */
?>

<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'POS Item Offers',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Positemoffers', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Positemoffers', 'url' => array('admin')),
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
                    <h3 class="panel-title">Add POS Item Offers</h3>
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
                    <h3 class="panel-title">Manage POS Item Offers</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'positemoffers-grid',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            array('name'=>'item_id','value'=>'$data->getitem($data)'),
//                            'item_id',
                            'offer_dscount',
                            'offer_description',
                            'offer_code',
                            'from_date',
                            'to_date',
                            'status',
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