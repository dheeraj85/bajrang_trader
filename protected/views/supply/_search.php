<?php
/* @var $this IndentmasterController */
/* @var $model Indentmaster */
/* @var $form BSActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">Filter</div>
    <div class="panel-body">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'action' => Yii::app()->createUrl($this->route),
            'method' => 'get',
        ));
        ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6">
                <?php echo $form->textFieldControlGroup($model, 'id'); ?>
            </div>
            <!--            <div class="col-lg-3 col-md-3 col-sm-6">
                            <label>Indent Date</label>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'indent_date',
                'id' => 'indent_date',
                'value' => $model->indent_date,
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-5:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Indent Date', 'class' => 'form-control',
                ), //
            ));
            ?>
                        </div>-->

            <div class="col-lg-3 col-md-3 col-sm-6">
                <label>Indent Type</label>
                <?php echo $form->dropDownList($model, 'indent_type', Utils::indenttype(), array('empty' => '-Select-')); ?>

            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <label>Order Status</label>
                <?php echo $form->dropDownList($model, 'is_order_done', Utils::indentOrderStatus(), array('empty' => '-Select-')); ?>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6">
                <label>&nbsp; <br/></label>
                <?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY,)); ?>

            </div>

        </div>

        <?php //echo $form->textFieldControlGroup($model,'sync_id',array('maxlength'=>20));  ?>


        <?php //echo $form->textFieldControlGroup($model,'purchase_type',array('maxlength'=>11)); ?>
        <?php //echo $form->textFieldControlGroup($model,'created_by'); ?>
        <?php //echo $form->textFieldControlGroup($model,'created_user_role',array('maxlength'=>30)); ?>
        <?php //echo $form->textFieldControlGroup($model, 'supply_type', array('maxlength' => 7)); ?>
        <?php //echo $form->textFieldControlGroup($model,'invoice_id',array('maxlength'=>50)); ?>
        <?php //echo $form->textFieldControlGroup($model,'invoice_date'); ?>
        <?php //echo $form->textFieldControlGroup($model,'issued_to'); ?>
        <?php //echo $form->textFieldControlGroup($model,'discount',array('maxlength'=>12)); ?>
        <?php //echo $form->textFieldControlGroup($model,'remark',array('maxlength'=>255)); ?>
        <?php //echo $form->textFieldControlGroup($model,'is_indenting_done'); ?>
        <?php //echo $form->textFieldControlGroup($model, 'is_order_done'); ?>
        <?php //echo $form->textFieldControlGroup($model,'is_sync');  ?>
        <?php //echo $form->textFieldControlGroup($model,'sync_date');  ?>

        <div class="form-actions">
        </div>

        <?php $this->endWidget(); ?>


    </div>
</div>



