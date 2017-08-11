<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Account Management System' => array('expenseheads/index'),
    'Bank Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Bankdetails', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Bankdetails', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#bankdetails-grid').yiiGridView('update', {
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
            <div class="col-lg-4">
                <div class="box">
                    <div class="box-header  btn-primary">
                        <h3 class="panel-title">Add Bank Detail</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->renderPartial('_form', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                </div>
            </div> 
            <div class="col-lg-8">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Manage Bank Details</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->widget('bootstrap.widgets.BsGridView', array(
                            'id' => 'bankdetails-grid',
                            'type'=>'bordered',
                            'dataProvider' => $model->search(),
                            //'filter' => $model,
                            'columns' => array(
                                //'id',
                                'account_no',
                                'account_holder',
                                'bank_name',
                                'branch',
                                'ifsc',
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