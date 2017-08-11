<?php
/* @var $this VendorbankdetailsController */
/* @var $model Vendorbankdetails */


$this->breadcrumbs = array(
    'Home'=>array('site/dashboard'),
    'Vendor Details'=>array('vendor/admin'),
    'Manage Vendor Bank Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendorbankdetails', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendorbankdetails', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendorbankdetails-grid').yiiGridView('update', {
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
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Add Vendor Bank Details ( Vendor Name : <?php echo Vendor::model()->findByPk($vid)->firm_name; ?> )</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->renderPartial('_form', array(
                        'model' => $model,'vid'=>$vid,
                    ));
                    ?>
                </div>
            </div>     
        </div>  
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header with-border bg-green">
                    <h3 class="panel-title">Manage Vendor Bank Details</h3>
                </div>
                <div class="panel-body table-responsive">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'vendorbankdetails-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search($vid),
                       // 'filter' => $model,
                        'columns' => array(
                           // 'id',
                            'account_name',
                            'account_no',
                            'bank_name',
                            'branch',
                            'ifsc',
                            array('htmlOptions' => array(), 'header' => 'Vendor Name', 'name' => 'vendor_id', 'type' => 'raw', 'value' => '$data->vendor->name'),
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->users->name'),
                            /*
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