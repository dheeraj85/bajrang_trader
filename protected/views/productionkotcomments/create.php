<?php
/* @var $this ProductionkotcommentsController */
/* @var $model Productionkotcomments */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Production KOT' => array('productionkot/create'),
    'Production KOT Comment',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Productionkotcomments', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Productionkotcomments', 'url' => array('admin')),
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
                    <h3 class="panel-title">Add Production KOT Comments for KOT NO :- <?php echo $model->productionkot->kot_no; ?></h3>
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
                    <h3 class="panel-title">Manage Production KOT Comments</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'productionkotcomments-grid',
                        'dataProvider' => $model->search(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
//                            array('name'=>'production_kot_id','value'=>'$data->productionkot->kot_no'),
                            array('name'=>'from_id','value'=>'$data->userfrom->name'),
                            array('name'=>'to_id','value'=>'$data->userto->name'),
//                            'production_kot_id',
//                            'from_id',
//                            'to_id',
                            'comments',
                            'dated',
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