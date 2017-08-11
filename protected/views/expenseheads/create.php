<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Account Management System' => array('expenseheads/index'),
    'Expense Heads',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Expenseheads', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Expenseheads', 'url' => array('admin')),
);
?>
<style>
    .view,.delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
    <div class="col-lg-12">      
    <div class="col-lg-5">
         <div class="box">
        <div class="box-header btn-primary">
            <h3 class="panel-title">Add Expense Head</h3>
        </div>
        <div class="panel-body">
             <?php $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
    </div> 
      <div class="col-lg-7">
       <div class="box">
        <div class="box-header btn-primary">
            <h3 class="panel-title">Manage Expense Heads</h3>
        </div>
        <div class="panel-body">
            <?php
            $this->widget('bootstrap.widgets.BsGridView', array(
                'id' => 'expenseheads-grid',
                'type' => 'bordered',
                'dataProvider' => $model->search(),
//			'filter'=>$model,
                'columns' => array(
//        		'id',
                    'name',
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