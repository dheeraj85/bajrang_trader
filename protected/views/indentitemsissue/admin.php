<?php
/* @var $this IndentitemsissueController */
/* @var $model Indentitemsissue */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Indents' => array('indentmaster/index'),
    'Issue Item List',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Indentitemsissue', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Indentitemsissue', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#indentitemsissue-grid').yiiGridView('update', {
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
                <div class="box-header bg-red">
                    <h3 class="panel-title">Issue Item List</h3>
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
                        'type' => 'bordered',
                        'id' => 'indentitemsissue-grid',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //'id',
                            //'internal_id',
                            array('htmlOptions' => array(), 'header' => 'Category', 'name' => 'p_category_id', 'type' => 'raw', 'value' => 'Indentitemsissue::getcategory($data)'),
                            array('htmlOptions' => array(), 'header' => 'Sub Category', 'name' => 'p_sub_category_id', 'type' => 'raw', 'value' => 'Indentitemsissue::getscategory($data)'),
                            //'item_id',
                            'item_name',
                            'item_brand',
                            'issue_qty',
                            'issue_date',
                            'issue_purpose',
                            array('htmlOptions' => array(), 'header' => 'Issued By', 'name' => 'created_by', 'type' => 'raw', 'value' => '$data->createdby->name'),
                        /* 'created_by',
                          'created_user_role',
                          'is_issue_done',
                         */
                        //  array(
                        //    'class' => 'bootstrap.widgets.BsButtonColumn',
                        //),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>