<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Manage Expense Masters',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expensemaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expensemaster', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#expensemaster-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <a href="<?php echo $this->createUrl('expensemaster/create')?>" class="btn btn-primary">Add Expense Master</a><br/><br/>
            <div class="box box-primary">
                <div class="box-header with-border bg-primary">
                    <h3 class="panel-title">Manage Expense Masters</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
//                    $this->renderPartial('_search', array(
//                        'model' => $model,
//                    ));
                    ?>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'expensemaster-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            'goods_service',
                            array('htmlOptions' => array(), 'header' => 'Expense Head', 'value' => '$data->expenseheads->name'),
                            'gs_name',
                            'item_classification',
                            'hsn_sac_code',
                            'tax_percent',
                            /*
                              'cess_percent',
                              'description',
                              'created_by',
                              'created_date',
                             */
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