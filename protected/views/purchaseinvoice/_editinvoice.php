<div class="panel-body">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'editpurchaseinvoice-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <input type="hidden" name="id" id="id" value="<?php echo $model->id?>"/>
    <div class='row'>
        <div class='col-lg-3'>
            <?php echo $form->dropdownlistControlGroup($model, 'invoice_type', Utils::itype(), array('maxlength' => 100, 'id' => 'invoice_type', 'class' => 'form-control')); ?>
        </div>        
        <div class='col-lg-3' id="invoicetype_cash" style="display:none;">
            <?php echo $form->textFieldControlGroup($model, 'vendor_name', array('maxlength' => 50)); ?>
        </div>        
        <div class='col-lg-6' id="invoicetype_supplier">
            <label>Select Vendor </label>
            <select id="Purchaseinvoice_vendor_id" name="Purchaseinvoice[vendor_id]" class="form-control select2">
                <option value="">-Select-</option>
                <?php
                foreach (Vendor::model()->findAllBySql("select * from vendor where id!=1 and is_active=1") as $iset) {
                    if ($model->vendor_id == $iset->id) {
                        ?>
                        <option value="<?php echo $iset->id ?>" selected="selected"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>)</option>
                    <?php } else { ?>
                        <option value="<?php echo $iset->id ?>"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>)</option>
                    <?php
                    }
                }
                ?>    
            </select>
        </div>             
        <div class='col-lg-3'>
        <?php echo $form->textFieldControlGroup($model, 'invoice_no', array('maxlength' => 50)); ?>
        </div>
 </div>  
    <div class="row">
        <div class='col-lg-3'>
            <label>Invoice Date<span class="required">*</span></label><br/>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'Purchaseinvoice[invoice_date]',
                'id' => 'invoice_date',
                'value' => $model->invoice_date,
                'options' => array(
                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Invoice Date', 'class' => 'form-control',
                ),
            ));
            ?>
        </div>                         
        <div class='col-lg-3'>
        <?php echo $form->dropdownlistControlGroup($model, 'discount_type', Utils::discount_type(), array('maxlength' => 100, 'id' => 'discount_type', 'class' => 'form-control')); ?>
        </div>
        <div class='col-lg-3'>
            <label>Tax type <a class="update" data-title="Details" title="" data-toggle="tooltip" data-original-title="F1- Tax format for taxing every item separately in a bill,F2- Single tax for all items in the bill"><b>?</b></a></label>
        <?php echo $form->dropdownlist($model, 'invoice_format', Utils::invoice_format(), array('maxlength' => 100, 'id' => 'invoice_format', 'class' => 'form-control')); ?>
        </div> 
         <div class='col-lg-3'>
        <?php echo $form->dropDownListControlGroup($model, 'received_by', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('class' => 'form-control', 'empty' => '-Select-')); ?>  
        </div>
    </div>
    <div class="row"> 
        <div class='col-lg-3 pull-right' style="margin-top:22px;" align="right">
        <?php echo BsHtml::Button('Save', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'editpurchaseinvoice')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editpurchaseinvoice').click(function() {
        var c=confirm("if you change tax type all the entries in this bill will be deleted.Click Ok to proceed");    
        if(c==true){
        var form = $('#editpurchaseinvoice-form').serialize();
        //alert(form);
        $("#editpurchaseinvoice").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/saveinvoice') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#editpurchaseinvoice").removeAttr('disabled').html('Save');
                $('#myModal4').modal('hide');
                window.location.reload();
            }
        });
        }else{
        
        }
    });
        $("#invoice_type").change(function() {
            var input_type = $(this).val();
            if (input_type == "Cash") {
                $("#invoicetype_cash").show();
                $("#invoicetype_supplier").hide();
                var invoice_vendor_id = "1";
                $.ajax({
                    url: '<?php echo $this->createUrl('purchaseinvoice/getvendorname') ?>',
                    data: {'id': invoice_vendor_id},
                    type: 'get',
                    cache: false,
                    success: function(response) {
                        $("#pendingpo_itemlist").html(response);
                        $('#myModal4').modal('show');
                    }
                });
            } else {
                $("#invoicetype_supplier").show();
                $("#invoicetype_cash").hide();
            }
        });
    });
</script>