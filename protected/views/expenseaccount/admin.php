<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Manage Expense Accounts',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expenseaccount', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expenseaccount', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#expenseaccount-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .view,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <a href="<?php echo $this->createUrl('expenseaccount/create') ?>" class="btn btn-primary">Add Expense Account</a><br/><br/>
            <div class="box">
                <div class="box-header with-border bg-primary">
                    <h3 class="panel-title">Manage Expense Accounts</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                    <br/>
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'expenseaccount-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            //'expense_heads_id',
                            array('htmlOptions' => array(), 'header' => 'Expense Head', 'name' => 'expense_heads_id', 'type' => 'raw', 'value' => '$data->expenseheads->name'),
                            //'name',
                            'firm_name',
                            'mobile',
                            'email',
                            'gstin_no',
                            'description',
                            //'contact_no',
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            /*
                              'email',
                              'gstin_no',
                              'pan_no',
                              'address',
                              'created_by',
                              'created_date',
                              'description',
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
</div>