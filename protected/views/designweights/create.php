<?php
/* @var $this DesignweightsController */
/* @var $model Designweights */
?>

<?php
$this->breadcrumbs=array(
	'Designweights'=>array('index'),
	'Create',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Designweights', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Designweights', 'url'=>array('admin')),
);

$shape_design = Shapedesign::model()->findByPk($model->design_id);
?>

<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <div class="pull-left">
                    <h3 class="panel-title">Add Cake Shape Design Weight in kg</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="<?php echo $this->createUrl('shapedesign/create',array('sid'=>$shape_design->shape_id)) ?>"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
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
                    <h3 class="panel-title">Cake Shape Design Weight in kg</h3>
                </div>
                <div class="panel-body">
                    <style>
                        #round {
                            margin-left: -2px;
                            margin-top: 5px;
                            color: white;
                        }
                        .round-button-circle {
                            text-align: center;
                            width: 50px;
                            height:0;
                            padding-bottom: 50px;
                            border-radius: 50px;
                            border:1px solid #cfdcec;
                            /*overflow:hidden;*/
                        }   
                    </style>
                    <?php
                    $data = Designweights::model()->findAllByAttributes(array('design_id'=>$model->design_id));
                    if (!empty($data)) {
                        ?>
                        <div class="row">
                            <?php foreach ($data as $val) { ?>
                                <div class="col-lg-1 col-md-2 col-sm-3 col-xs-4">
                                    <div class="round-button-circle bg-primary">
                                        <a class="btn" id="round" href="<?php echo $this->createUrl('designweights/update', array('id' => $val->id)) ?>"><b><?php echo $val->weight_for_design ?></b></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-dismissable"><h5>No Records Found...</h5></div>
                    <?php } ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  