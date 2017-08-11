<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Expense Masters' => array('expensemaster/admin'),
    'View Expense Master',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expensemaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Expensemaster', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Expensemaster', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Expensemaster', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Expensemaster', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border bg-primary">
                    <h3 class="panel-title">View Expense Master
                    </h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('zii.widgets.CDetailView', array(
                        'htmlOptions' => array(
                            'class' => 'table table-striped table-condensed table-hover',
                        ),
                        'data' => $model,
                        'attributes' => array(
                            // 'id',
                            'goods_service',
                            'gs_name',
                            'item_classification',
                            'hsn_sac_code',
                            'tax_percent',
                            'cess_percent',
                            'description',
                            array(
                                'label' => 'Created By',
                                'value' => $model->createdby->name,
                            ),
                            'created_date',
                        ),
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div> 