<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Indents' => array('indentmaster/index'),
    'Indent Review',
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
                <div class="box-header bg-red">
        <h3 class="panel-title">Internal Indent List</h3>
    </div>
    <div class="panel-body">
        <div class="search-form">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div>
        <!-- search-form -->
        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'indentmaster-grid',
            'type' => 'bordered',
            'dataProvider' => $model->searchGpu(),
            //'filter' => $model,
            'columns' => array(
                'id',
                'sync_id',
                'indent_date',
                'indent_type',
                'purchase_type',
                array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                array('htmlOptions' => array(), 'header' => 'Status', 'name' => 'is_done', 'type' => 'raw', 'value' => 'Indentmaster::reqaction($data)'),
                array('htmlOptions' => array(), 'header' => 'Action', 'name' => 'is_done', 'type' => 'raw', 'value' => 'Indentmaster::actiongpu($data)'),
                /*
                  'created_user_role',
                  'supply_type',
                  'invoice_id',
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