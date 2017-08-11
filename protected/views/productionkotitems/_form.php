<?php
/* @var $this ProductionkotitemsController */
/* @var $model Productionkotitems */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id' => 'productionkotitems-form',
//            'action' => $this->createUrl('productionkotitems/create'),
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php // echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'production_kot_id'); ?>

<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->labelEx($model, 'menu_item_id'); ?>
        <?php // echo $form->dropDownListControlGroup($model,'menu_item_id'); ?>
        <select id="Productionkotitems_menu_item_id" name="Productionkotitems[menu_item_id]" class="form-control">
            <option value="">--Select Item--</option>
            <?php
            foreach (Shelfitems::model()->findAll() as $shelf) {
                $item = Purchaseitem::model()->findByPk($shelf->item_id);
            ?>
                <option value="<?php echo $shelf->id; ?>"><?php echo $item->itemname; ?></option>
            <?php } ?>
        </select>
        <?php echo $form->error($model, 'menu_item_id'); ?>
        </div>
        <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'qty', array('maxlength' => 15)); ?>
        </div>
        <!--    <div class='col-md-3'>
    <?php //echo $form->dropDownListControlGroup($model, 'status', array('' => '--Select--', 'pending' => 'Pending', 'accept' => 'Accept', 'reject' => 'Reject', 'done' => 'Done')); ?>
                </div>-->
            <div class='col-md-4' style="margin-top: 25px;">
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#productionkotitems-form").submit(function(){
            $(".btn").attr('disabled', 'disabled');
        });
        $(".delete").click(function(){
            return confirm("Are you sure you want to delete this data?");
        });
    });
</script>
