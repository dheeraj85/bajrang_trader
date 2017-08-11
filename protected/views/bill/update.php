<?php
$this->breadcrumbs = array(
    'Bills' => array('create'),
  //  $model->bill_no => array('view', 'id' => $model->bill_no),
    'Update Cost Bill',
);

?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Update Bill</h3>
                </div>
                <div class="panel-body">
                    <?php //echo BsHtml::pageHeader('Update', 'Bill ' . $model->id) ?>
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
