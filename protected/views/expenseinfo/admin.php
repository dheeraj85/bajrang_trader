<?php
/* @var $this ExpenseinfoController */
/* @var $model Expenseinfo */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Account Management System' => array('expenseheads/index'),
    'Expense Reconciliation',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expenseinfo', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expenseinfo', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#expenseinfo-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<style>
    .view,.update{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Expense Reconciliation</h3>
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
                        'id' => 'expenseinfo-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            //'expense_head_id',
                            //array('htmlOptions' => array('width' => '140'), 'name' => 'expense_head_id', 'type' => 'raw', 'value' => '$data->expensehead->name'),
                            'name',
                            'reg_no',
                            'particular',
                            'voucher_no',
                            'voucher_date',
                            array('htmlOptions' => array('width' => '140'), 'name' => 'expense_nature_id', 'type' => 'raw', 'value' => '$data->expensenature->name'),
                            //'created_by',
                            array('htmlOptions' => array('width' => '140'), 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                            array('htmlOptions' => array('width' => '140'), 'header' => 'Action','name' => 'expense_nature_id', 'type' => 'raw', 'value' => 'Expenseinfo::accountaction($data)'),
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
<div id="load_model"></div>
<script type="text/javascript">    
    function authpurchasereview(id) {    
    $.ajax({
        url: '<?php echo Yii::app()->createUrl('expenseinfo/authreview') ?>',
        data:'id='+id,
        success: function(response) {             
             $("#load_model").html(response);
        }
    });
    }
</script>