<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $model Expenseinvoiceitems */


$this->breadcrumbs=array(
	'Expenseinvoiceitems'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('icon' => 'glyphicon glyphicon-list','label'=>'List Expenseinvoiceitems', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Expenseinvoiceitems', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#expenseinvoiceitems-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo BsHtml::pageHeader('Manage','Expenseinvoiceitems') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BsHtml::button('Advanced search',array('class' =>'search-button', 'icon' => BsHtml::GLYPHICON_SEARCH,'color' => BsHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>

        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
			'id'=>'expenseinvoiceitems-grid',
			'dataProvider'=>$model->search(),
			'filter'=>$model,
			'columns'=>array(
        		'id',
		'invoice_id',
		'item_id',
		'goods_service',
		'hsn_sac_code',
		'vendor_hsn_sac_code',
		/*
		'vendor_tax_percent',
		'unmatched_code',
		'is_reverse_charge',
		'is_reverse_item',
		'particulars',
		'rate',
		'amount',
		'discount',
		'item_tax_type',
		'tax_percent_rate',
		'tax_amt',
		'cess_rate',
		'cess_amt',
		'ut_rate',
		'ut_amt',
		'is_active',
		'is_added_to_stock',
		'is_good_return',
		'is_choice_tax',
		*/
				array(
					'class'=>'bootstrap.widgets.BsButtonColumn',
				),
			),
        )); ?>
    </div>
</div>




