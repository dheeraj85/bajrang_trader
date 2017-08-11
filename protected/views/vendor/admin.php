<?php
/* @var $this VendorController */
/* @var $model Vendor */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vendor Management' => array('vendor/index'),
    'Manage Vendor Details',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendor', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendor', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendor-grid').yiiGridView('update', {
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
                    <h3 class="panel-title">Manage Vendor Details</h3>
                </div>
                <div class="panel-body table-responsive">
                      <?php
                    $this->renderPartial('_search', array(
                        'model' => $model,
                    ));
                    ?>
                    <br/>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'vendor-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            'name',
                            'firm_name',
                            'mobile',
                            //'contact_no',
                            'email',
                            'tin_no',
                            'pan_no',
                            'address',
                            //array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->users->name'),
                            array('htmlOptions' => array('width' => '90'), 'header' => 'Bank Details', 'type' => 'raw', 'value' => 'Vendor::bankdetails($data)'),
                            //array('htmlOptions' => array('width' => '80'), 'header' => 'Item Supply', 'type' => 'raw', 'value' => 'Vendor::itemsupply($data)'),
                            //'created_by',
                            /*
                              'created_date',
                             */
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                            ),
                        ),
                    ));
                    ?>
                    <div id="itemstock-excel" style="display:none">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'vendor-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->searchPrint(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            array('htmlOptions' => array(), 'header' => 'Name', 'value' => '$data->name'),
                            array('htmlOptions' => array(), 'header' => 'Firm Name', 'value' => '$data->firm_name'),
                            array('htmlOptions' => array(), 'header' => 'Mobile No', 'value' => '$data->mobile'),
                            array('htmlOptions' => array(), 'header' => 'Contact No', 'value' => '$data->contact_no'),
                            array('htmlOptions' => array(), 'header' => 'Email', 'value' => '$data->email'),
                            array('htmlOptions' => array(), 'header' => 'Tin No', 'value' => '$data->tin_no'),
                            array('htmlOptions' => array(), 'header' => 'Pan No', 'value' => '$data->pan_no'),
                            array('htmlOptions' => array(), 'header' => 'Address', 'value' => '$data->address'),
                            array('htmlOptions' => array(), 'header' => 'Created By', 'value' => '$data->users->name'),
                        ),
                    ));
                    ?>
                    </div>                    
                </div>
            </div>
        </div>  
    </div>
</div>