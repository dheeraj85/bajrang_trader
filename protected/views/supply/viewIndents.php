<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Internal Indent',
    'Manage Indent',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Indentmaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Indentmaster', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#indentmaster-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-yellow">
                    <h3 class="panel-title">View Indent List</h3>
                </div>
                <div class="panel-body">
                    <?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button btn btn-default')); ?>
                    <div class="search-form" style="display:none">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div><!-- search-form -->
                    <!-- search-form -->
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'indentmaster-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->searchCDS(),
                       // 'filter' => $model,
                        'columns' => array(
                            'id',
                        //    'sync_id',
                            'indent_date',
                            'indent_type',
                            'supply_type',
                            'invoice_id',
                            'purchase_type',
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            array('htmlOptions' => array(), 'header' => 'Order Status', 'name' => 'is_order_done', 'type' => 'raw', 'value' => 'Indentmaster::orderStatus($data)'),
                            array('htmlOptions' => array(), 'header' => 'Action', 'name' => 'is_done', 'type' => 'raw', 'value' => 'Indentmaster::actionCDS($data)'),
                        /*
                          'created_user_role',
                          'invoice_date',
                          'issued_to',
                          'discount',
                          'remark',
                          'is_indenting_done',
                          'is_order_done',
                          'is_sync',
                          'sync_date',
                         */
                        //  array(
                        //      'class' => 'bootstrap.widgets.BsButtonColumn',
                        // ),
                        ),
                    ));
                    ?>
                </div>
            </div>  
        </div>
    </div>
</div>