<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Challan' => array('challan/admin'),
        //'Purchase Order List',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Challan', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Challan', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#challan-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .update,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">   
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">
                        <div class="pull-left">Challan List</div>
                        <a href="<?php echo $this->createUrl('challan/create'); ?>" class="btn btn-primary pull-right">Add Challan</a>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="search-form" style="display:none">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'challan-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            'id',
                            //'purchase_invoice_id',
                            'customer.full_name',
                            'challan_date',
                            array('htmlOptions' => array('width' => '120'), 'header' => 'Purchase Order No', 'value' => 'Challan::getpo($data)'),
                            'purchaseinvoice.id',
                            'ex_station',
                            'truck_wagon_no',
                            array('htmlOptions' => array('width' => '340'), 'header' => 'Action', 'value' => 'Challan::reqaction($data)'),
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
<script type="text/javascript">
function cancel_challan(id){
$.ajax({
        url: '<?php echo Yii::app()->createUrl('purchaseinvoice/cancel_challan') ?>',
        data: 'id=' + id,
        success: function(response) {
           if(response=="1"){
            alert("Kata Parchy already generated.Please cancel the Kata Parchy first");    
            }else{
            window.location.reload();
           }
        }
    });
}
</script>