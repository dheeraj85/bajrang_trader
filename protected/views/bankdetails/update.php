<?php
/* @var $this BankdetailsController */
/* @var $model Bankdetails */
?>

<?php
$this->breadcrumbs=array(
	'Home' => array('site/cmsdashboard'),
	'Bank Details'=>array('admin'),
	'Update Bank Detail',
);

$this->menu=array(
    array('icon' => 'glyphicon glyphicon-list','label'=>'List Bankdetails', 'url'=>array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign','label'=>'Create Bankdetails', 'url'=>array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt','label'=>'View Bankdetails', 'url'=>array('view', 'id'=>$model->id)),
    array('icon' => 'glyphicon glyphicon-tasks','label'=>'Manage Bankdetails', 'url'=>array('admin')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="box">
                    <div class="box-header btn-primary">
                        <h3 class="panel-title">Update Bank Details</h3>
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