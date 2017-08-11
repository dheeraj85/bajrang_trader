<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'expensemaster-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>
<div class='row'>
    <div class='col-lg-3'>
        <label>GST Type</label>
        <?php echo $form->dropdownlist($model, 'goods_service', Utils::goods_service(), array('options' => array($model->goods_service => array('selected' => true))), array('maxlength' => 100, 'id' => 'goods_service', 'class' => 'form-control')); ?>
    </div>
    <div class='col-lg-3'>
       <?php echo $form->dropDownListControlGroup($model, 'expense_heads_id', CHtml::listData(Expenseheads::model()->findAll(), 'id', 'name'), array('empty' => '--Select--')); ?>
    </div>
    <div class='col-lg-3'>
       <?php echo $form->textFieldControlGroup($model, 'gs_name', array('maxlength' => 50)); ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->numberFieldControlGroup($model, 'hsn_sac_code', array('maxlength' => 100)); ?>
    </div>
</div>    
<div class='row'>
    <div class='col-lg-3'>
        <label>Item Classification</label>
        <?php echo $form->dropdownlist($model, 'item_classification', Utils::item_classify(), array('options' => array($model->item_classification => array('selected' => true))), array('maxlength' => 100, 'id' => 'item_classification', 'class' => 'form-control')); ?>
     </div>
    <div class='col-lg-3'>
        <?php echo $form->numberFieldControlGroup($model, 'tax_percent', array('maxlength' => 100)); ?>
    </div>
    <div class='col-lg-3'>
        <?php echo $form->numberFieldControlGroup($model, 'cess_percent', array('maxlength' => 100)); ?>  
    </div>
</div>   
<?php echo $form->textAreaControlGroup($model, 'description', array('maxlength' => 100)); ?>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,'id' => 'btnexpenseitem')); ?>
<?php $this->endWidget(); ?>
<div id="myModal" style="padding:30px " class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body btn btn-info">
                Please wait while we are saving information. 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#btnexpenseitem').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>