<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'ticket-form',
        'enableAjaxValidation' => false,
    ));
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>
<?php  echo $form->hiddenField($model, 'status', array('value' => 'pending')); ?>

    <div class='row'>
        <div class='col-md-6'>
<?php echo $form->dropdownlistControlGroup($model, 'ticket_type', CHtml::listData(Tickettype::model()->findAll(),'id','name'), array('id' => 'ttypes', 'class' => 'form-control','empty'=>'--Select Ticket Type--')); ?>
        </div>

        <div class="col-md-6">
<?php echo $form->textFieldControlGroup($model, 'subject', array('size' => 60, 'maxlength' => 250)); ?>
        </div>

        <div class="col-md-6">
<?php echo $form->textAreaControlGroup($model, 'description', array('rows' => 4, 'cols' => 50)); ?>
        </div>

<!--        <div class="col-md-6">
<?php // echo $form->textFieldControlGroup($model, 'submitted_by'); ?>
        </div>-->

        <div class="col-md-6">
            <label>Submit Date</label>
                        <?php
                     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                         'name' => 'Ticket[submit_date]',
                         'id' => 'Ticket_submit_data',
                         'value' => isset($model->submit_date)?$model->submit_date:date('Y-m-d'),
                         'options' => array(
                             'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                         ),
                         'htmlOptions' => array(
                             'style' => '',
                             //'readonly' => 'readonly'
                             'placeholder' => 'From Date', 'class' => 'form-control',
                         ),
                     ));
                     ?>
        </div>

<!--        <div class="col-md-6">
<?php // echo $form->textFieldControlGroup($model, 'assigned_to'); ?>
        </div>-->

<!--        <div class="col-md-6">
<?php // echo $form->textFieldControlGroup($model, 'assigned_date'); ?>
        </div>-->

<!--        <div class="col-md-6">
        </div>-->

<!--        <div class="col-md-6">
<?php // echo $form->textFieldControlGroup($model, 'close_reason', array('size' => 60, 'maxlength' => 255)); ?>
        </div>-->
        <div class="col-md-12">
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'btnpurchaseitem')); ?>
            <a class="btn btn-default" href="<?php echo $this->createUrl('ticket/admin'); ?>" ><i class="fa fa-backward"></i>&nbsp;&nbsp;Back</a> 
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->