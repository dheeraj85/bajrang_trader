<?php
/* @var $this ProductionkotController */
/* @var $model Productionkot */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Production KOT',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Productionkot', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Productionkot', 'url' => array('admin')),
);
?>

<style>
    .view{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Production KOT</h3>
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
                    <h3 class="panel-title">Manage Production KOT</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'productionkot-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            'kot_no',
                            'kot_date',
                            'status',
                            'delivery_status',
                            'deliver_by',
                            array('header'=>'Action','value'=>'$data->Action($data)'),
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