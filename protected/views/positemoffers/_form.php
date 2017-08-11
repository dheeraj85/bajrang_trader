<?php
/* @var $this PositemoffersController */
/* @var $model Positemoffers */
/* @var $form BSActiveForm */
?>

<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'positemoffers-form',
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
        <label>Item Category</label>
        <select name="category" id="category" class="form-control">
            <option value="">--Select Category--</option>
            <?php
            foreach (Shelfitems::model()->findAllBySql("select * from shelf_items group by p_category_id") as $cat) {
                ?>
                <option value="<?php echo $cat->p_category_id; ?>"><?php echo Purchasecategory::model()->findByPk($cat->p_category_id)->name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class='col-md-4'>
        <label>Item Sub Category</label>
        <select name="sub_category" id="sub_category" class="form-control">
            <option value="">--Sub Category--</option>
        </select>
    </div>
    <div class='col-md-4'>
        <?php echo $form->labelex($model, 'item_id'); ?>
        <select name="Positemoffers[item_id]" id="Positemoffers_item_id" class="form-control">
            <option value="">--Item--</option>
            <?php foreach (Shelfitems::model()->findAll() as $item) { 
                if($model->item_id == $item->id){   ?>
            <option value="<?php echo $item->id; ?>" selected="selected"><?php echo Purchaseitem::model()->findByPk($item->item_id)->itemname; ?></option>
            <?php   } } ?>
        </select>
    </div>
</div><br/>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'offer_dscount'); ?>
    </div>
    <div class='col-md-4'>
        <label>From Date (Y-M-D)</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Positemoffers[from_date]',
            'id' => 'from_date',
            'value' => (isset($model->from_date))? $model->from_date : date('Y-m-d'),
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
    <div class='col-md-4'>
        <label>To Date (Y-M-D)</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Positemoffers[to_date]',
            'id' => 'to_date',
            'value' => (isset($model->to_date))? $model->to_date : date('Y-m-d'),
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'To Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'offer_description', array('maxlength' => 255)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->textFieldControlGroup($model, 'offer_code', array('maxlength' => 255)); ?>
    </div>
    <div class='col-md-4'>
        <?php echo $form->dropDownListControlGroup($model, 'status', array('empty' => '--Select Status--', 'active' => 'Active', 'end' => 'End')); ?>
    </div>
</div>
<div class='row'>
    <div class='col-md-12'>
        <?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_PRIMARY)); ?>
    </div>
</div>
<?php // echo $form->textFieldControlGroup($model,'status',array('maxlength'=>6));  ?>

<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').change(function() {
            var cid = $('#category').val();
            var itype = 'Menu';
            var scid = '';
            GetSCategory(cid, scid, itype);
        });

        $('#sub_category').change(function() {
            var cid = $('#category').val();
            var scid = $('#sub_category').val();
            GetItem(cid, scid);
        });
    });

    function GetSCategory(cid, scid, itype) {
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/getscategory'); ?>",
            data: {"cid": cid},
            success: function(data) {
                $("#sub_category").html(data);
            }
        });
    }

    function GetItem(cid, scid) {
        $("#Positemoffers_item_id").html("");
        $.getJSON("<?php echo $this->createUrl('positemoffers/getitem'); ?>", {"cid": cid, "scid": scid}, function(data) {
            var content = "";
            content += '<option value="">--Select Item--</option>';
            $.each(data.items, function(i, ct) {
//                alert(ct.i);
                if ('<?php echo $model->item_id; ?>' == ct.id) {
                    content += '<option value="' + ct.id +'" selected>' + ct.itemname + '</option>';
                } else {
                    content += '<option value="' + ct.id +'">' + ct.itemname + '</option>';
                }
            });
            $("#Positemoffers_item_id").html(content);
        });
    }
</script>
