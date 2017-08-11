<?php
/* @var $this ShapedesignController */
/* @var $model Shapedesign */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'shapedesign-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model);  ?>
<?php echo $form->hiddenField($model, 'shape_id'); ?>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'design_name', array('maxlength' => 150)); ?>

    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'design_description', array('maxlength' => 250)); ?>

    </div>
    <div class="col-lg-3">
        <label>Design Complexity</label>
        <select name="design_complexity_id" id="design_complexity_id" class="form-control" >
            <option value="">--Design Code--</option>
            <?php foreach (Designcomplexity::model()->findAll() as $design) { 
                if($model->design_complexity_id==$design->id) { ?>
            <option value="<?php echo $design->id; ?>" selected="selected"><?php echo $design->design_code . '('. $design->rate .')'?></option>                                                
                <?php }else { ?>
                <option value="<?php echo $design->id; ?>"><?php echo $design->design_code . '('. $design->rate .')'?></option>                                                
                
                <?php } } ?>  
        </select>
    </div>
</div>
<div class='row'>
    <div class='col-md-6'>
        <?php echo $form->fileFieldControlGroup($model, 'design_img', array('maxlength' => 50)); ?>

    </div>
    <div class='col-md-6' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>

    </div>
</div>




<?php // echo $form->textFieldControlGroup($model,'design_added_by',array('maxlength'=>8));  ?>
<?php // echo $form->textFieldControlGroup($model,'added_by_id'); ?>

<?php $this->endWidget(); ?>
<script>
    function getamt() {
        var id = $('#design_complexity_id').val();
        $.ajax({
            url: '<?php echo $this->createUrl('aos/getdesignrate'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#design_complexity_rate').val(response);
              
            }
        });
    }
</script>