<?php
/* @var $this ProductionkotitemsController */
/* @var $model Productionkotitems */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Production KOT' => array('productionkot/create'),
    'Production KOT Items',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Productionkotitems', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Productionkotitems', 'url' => array('admin')),
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
                    <h3 class="panel-title">Add Production KOT Items for KOT NO :- <?php echo $model->productionkot->kot_no; ?></h3>
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
                    <h3 class="panel-title">Manage Production KOT Items</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'productionkotitems-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
//                            array('name'=>'production_kot_id','value'=>'$data->productionkot->kot_no'),
                            array('name'=>'menu_item_id','value'=>'$data->getItem($data)'),
//                            'production_kot_id',
//                            'menu_item_id',
                            'qty',
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