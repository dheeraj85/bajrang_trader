<?php
/* @var $this RecipeitemsController */
/* @var $model Recipeitems */
?>

<?php
$this->breadcrumbs = array(
    'Cake Management System' => array('cakeweight/index'),
    'Recipe Items',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Recipeitems', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Recipeitems', 'url' => array('admin')),
);
?>

<style>
    .view, .delete{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Recipe Items</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Recipe Items</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'recipeitems-grid',
                        'dataProvider' => $model->search(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            'recipe_category',
                            array('htmlOptions' => array('width' => '140'), 'name' => 'category_name_id', 'value' => '$data->Category_name($data)'),
                            'description',
                            'weight_limit_kg',
                            array('htmlOptions' => array('width' => '140'), 'header' => 'Ingredients', 'type' => 'raw', 'value' => '$data->Ingredients($data)'),
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