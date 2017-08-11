<?php
$this->breadcrumbs = array(
    'POS Management System' => array('positemoffers/index'),
    'Counter Day Opening',
);
?>

<div class="col-lg-12" id="alert"></div>
<style>
    .view, .delete{
        display: none;
    }
    .error, .help-inline{
        color: #d10409;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Opening to counter</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'cashdrawer-form',
                        // Please note: When you enable ajax validation, make sure the corresponding
                        // controller action is handling ajax validation correctly.
                        // There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                    ));
                    ?>

                    <p class="help-block">Fields with <span class="required">*</span> are required.</p>

                    <?php // echo $form->errorSummary($model); ?>

                    <div class='row'>
                        <div class='col-md-4'>
                            <?php echo $form->dropDownListControlGroup($model, 'counter_id', CHtml::listData(Cashcounter::model()->findAll(), 'id', 'counter_name'), array('empty' => '--Select Counter--','required'=>'required')); ?>
                        </div>
                        <div class='col-md-4'>
                            <?php echo $form->dropDownListControlGroup($model, 'user_to', CHtml::listData(Users::model()->findAllByAttributes(array('role' => 'pos')), 'id', 'name'), array('empty' => '--Select User--','required'=>'required')); ?>
                        </div>
                        <div class='col-md-4'>
                            <?php // echo $form->dropDownListControlGroup($model, 'txn_type', array('' => '--Select Type--', 'opening' => 'Opening', 'closing' => 'Closing', 'handover' => 'Handover')); ?>
                            <?php echo $form->dropDownListControlGroup($model, 'txn_type', array('opening' => 'Opening')); ?>
                        </div>
                    </div><br/>
                    <div class='row'>
                        <div class='col-md-4'>
                            <?php echo $form->labelex($model, 'date'); ?>
                            <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'name' => 'Cashdrawer[date]',
                                'id' => 'Cashdrawer_date',
                                'value' => (isset($model->date)) ? $model->date : date('Y-m-d'),
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
                            <?php echo $form->error($model, 'date'); ?>
                        </div>
                        <div class='col-md-4'>
                            <?php echo $form->textFieldControlGroup($model, 'cash'); ?>
                        </div>
                        <div class='col-md-4'>
                            <?php echo $form->textAreaControlGroup($model, 'remark', array('rows' => 2)); ?>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md-12'>
                            <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
                        </div>
                    </div>

                    <?php $this->endWidget(); ?>
                </div>
            </div>     
        </div>  
    </div> 
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage POS Counters</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_search_counter',array(
                'model'=>$model,
            )); ?><br/>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'cashdrawer-grid',
                        'dataProvider' => $model->searchcounter(),
//			'filter'=>$model,
                        'columns' => array(
//        		'id',
                            array('name' => 'counter_id', 'value' => '$data->counter->counter_name'),
                            'txn_type',
                            'date',
                            'cash',
                            array('name' => 'user_from', 'value' => '$data->userfrom->name'),
                            array('name' => 'user_to', 'value' => '$data->userto->name'),
                            'remark',
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>
<!--<script src="<?php // echo Yii::app()->request->baseUrl;    ?>/bs/js/jquery.js"></script>-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#Cashdrawer_counter_id').change(function() {
            GetOpening();
            GetValidate();
        });

        $('#Cashdrawer_txn_type').change(function() {
            GetValidate();
        });

        $('#Cashdrawer_date').change(function() {
            GetOpening();
            GetValidate();
        });
    });

    function GetValidate() {
        var datastring = $('#cashdrawer-form').serialize();
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/countervalidation'); ?>",
            data: datastring,
            type: 'post',
            success: function(data) {
                if (data != '') {
                    $('.btn').attr('disabled', 'disabled');
                    $("#alert").html(data);
                    setInterval(function() {
                        $("#alert").html("");
                    }, 10000);
                } else if (data == '') {
                    $("#alert").html("");
                    $('.btn').removeAttr('disabled');
                }
            }
        });
    }

    function GetOpening() {
        var datastring = $('#cashdrawer-form').serialize();
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/counteropening'); ?>",
            data: datastring,
            type: 'post',
            success: function(data) {
                if (data == '') {
                    $("#alert").html('<h4 class="alert alert-danger" style="text-align: center;color: black;">First You Have To Enter The Closing Amount Of This Counter</h4>');
                } else {
                    $("#Cashdrawer_cash").val(data);
                }
            }
        });
    }
</script>
