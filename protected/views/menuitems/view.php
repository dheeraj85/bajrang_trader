<?php
/* @var $this MenuitemsController */
/* @var $model Menuitems */
?>

<?php
$this->breadcrumbs = array(
    'Menuitems' => array('index'),
    $model->id,
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Menuitems', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Menuitems', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Menuitems', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Menuitems', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Menuitems', 'url' => array('admin')),
);
?>

<?php // echo BsHtml::pageHeader('View', 'Menuitems ' . $model->id) ?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <div class="pull-left">
                        <h3 class="panel-title">View Menu Item</h3>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-default" href="<?php echo $this->createUrl('menuitems/create') ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                    </div>
                </div>
                <div class="panel-body">
<?php
$this->widget('zii.widgets.CDetailView', array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data' => $model,
    'attributes' => array(
//		'id',
        array(
            'name' => 'p_category_id',
            'value' => $model->pCategory->name
        ),
        array(
            'name' => 'p_sub_category_id',
            'value' => $model->pSubCategory->name
        ),
        'itemname',
        'brand',
        'item_unit',
        'item_scale',
        'specification',
        'unit_price',
//		'is_active',
        array(
            'label' => 'Item Image',
            'type' => 'raw',
            'value' => CHtml::image(Yii::app()->baseUrl . "/Itemimage/" . $model->item_image, 'alt', array("width" => "100px", "height" => "100px")),
        ),
    ),
));
?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  
