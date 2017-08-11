<?php
/* @var $this ItemscaleController */
/* @var $model Itemscale */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Scales & Measures',
    //'Scales'=>array('admin'),
    //$model->id=>array('view','id'=>$model->id),
    'Update Scales',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Itemscale', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemscale', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Itemscale', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Itemscale', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="box box-primary">
                    <div class="box-header bg-aqua">
                        <h3 class="panel-title">Update Scale's & Measures</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        $this->renderPartial('_form', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>