<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management' => array('itemstock/index'),
    'Purchase Indent List',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseindentmaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseindentmaster', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchaseindentmaster-grid').yiiGridView('update', {
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
                <div class="box-header bg-green">
                    <h3 class="panel-title">Purchase Indent List</h3>
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
                        'id' => 'purchaseindentmaster-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            // 'id',
                            array('htmlOptions' => array('width' => '90'), 'header' => 'Indent No.', 'name' => 'id', 'type' => 'raw', 'value' => 'Purchaseindentmaster::getindent($data)'),
                            array('htmlOptions' => array(), 'header' => 'Created By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            'indend_date',
                            array('htmlOptions' => array(), 'header' => 'Status', 'name' => 'is_done', 'type' => 'raw', 'value' => 'Purchaseindentmaster::reqaction($data)'),
                            array('htmlOptions' => array(), 'header' => 'Action', 'name' => 'is_done', 'type' => 'raw', 'value' => 'Purchaseindentmaster::action($data)'),
                        //'is_done',
//                array(
//                    'class' => 'bootstrap.widgets.BsButtonColumn',
//                ),
                        ),
                    ));
                    ?>
                </div>
            </div>  
        </div>
    </div>
</div>
<div id="load_model"></div>
<script type="text/javascript">
    function authreview(id, url) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('purchaseorder/authreview') ?>',
            data: 'id=' + id + '&url=' + url,
            success: function(response) {
                $("#load_model").html(response);
            }
        });
    }
</script>