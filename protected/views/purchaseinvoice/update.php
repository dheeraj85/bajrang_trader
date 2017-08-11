<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice' => array('purchaseinvoice/admin'),
    'Update Purchase Invoice',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseinvoice', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Purchaseinvoice', 'url' => array('view', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Purchaseinvoice', 'url' => array('admin')),
);
?>
<div class='form-css'>
<div class='row'>
    <div class="col-lg-12">      
        <div class="box">
            <div class="box-header bg-green">
                <h3 class="panel-title">Update Purchase Invoice</h3>
            </div><br/>
            <div id="success_msg"></div>
            <div class="panel-body">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'editpurchaseinvoice-form',
                    'enableAjaxValidation' => false,
                ));
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $model->id ?>"/>
                <p class="help-block">Fields with <span class="required">*</span> are required.</p>
                <div class='row'>
                    <div class='col-lg-2'>
                        <?php echo $form->dropdownlistControlGroup($model, 'invoice_type', Utils::itype(), array('maxlength' => 100, 'id' => 'invoice_type', 'class' => 'form-control')); ?>
                    </div>        
                    <div class='col-lg-4' id="invoicetype_cash" style="display:none;">
                        <?php echo $form->textFieldControlGroup($model, 'vendor_name', array('maxlength' => 50)); ?>
                    </div>    
                    <div class='col-lg-4' id="invoicetype_supplier">
                        <label>Select Vendor </label>
                        <select id="Purchaseinvoice_vendor_id" name="Purchaseinvoice[vendor_id]" class="form-control select2">
                            <option value="">-- Type/Select Vendor Name Showing in the Bill/Invoice --</option>
                            <?php
                            foreach (Vendor::model()->findAllBySql("select * from vendor where is_active=1") as $iset) {
                                if ($model->vendor_id == $iset->id) {
                                    ?>
                                    <option value="<?php echo $iset->id ?>" selected="selected"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>) - <?= $iset->tin_no; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $iset->id ?>"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>)- <?= $iset->tin_no; ?></option>
                                    <?php
                                }
                            }
                            ?>    
                        </select>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'land_owner', array('maxlength' => 255)); ?>  
                    </div> 
                    <div class='col-lg-2'>
                        <label id="gstin_label">Vendor GSTIN No</label>
                        <input type="text" class="form-control" name="Purchaseinvoice[gstin_no]" id="Purchaseinvoice_gstin_no" value="" placeholder="Vendor GSTIN No"/>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'invoice_no', array('maxlength' => 50)); ?>
                    </div> 
                </div>
                 <div class="row">                                               
                        <div class='col-lg-2'>
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
                        <div class='col-lg-2'>
                            <label>Supplies Classification</label><br/>
                            <?php foreach (Utils::scaled() as $k => $v) { ?>
                                <input type="radio" name="is_gstn_compliant" value="<?php echo $k; ?>" <?php
                                if ($model->is_gstn_compliant == $k) {
                                    echo "checked";
                                }
                                ?>/> <?php echo $v; ?>
                            <?php } ?>
                        </div> 
                        <div class='col-lg-2' id="compliant_type" style="display:none;">
                        <?php echo $form->dropDownListControlGroup($model, 'compliants_category_id', CHtml::listData(Gstcompliantscategory::model()->findAll(), 'id', 'name'), array('empty' => '--Select--')); ?>
                        </div>  
                        <div class='col-lg-2'>
                            <label>Place of Supply</label><br/>
                            <?php foreach (Utils::scaled() as $k => $v) { ?>
                                <input type="radio" name="place_of_supply" value="<?php echo $k; ?>" <?php
                                       if ($model->place_of_supply == $k) {
                                           echo "checked";
                                       }
                                       ?>/> <?php echo $v; ?>
                            <?php } ?>
                        </div> 
                        <div class='col-lg-2' id="state_code" style="display:none;">
                            <label>State</label><br/>
                            <?php echo $form->dropDownList($model, 'state_code', CHtml::listData(Gststatecodes::model()->findAll(), 'state_code', 'state_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
                        </div>                                               
                    </div> 
                <div class="row" id="cash_vendor" style="display:none;">
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'pass_provider', array('maxlength' => 255)); ?>  
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'village', array('maxlength' => 255)); ?>  
                    </div> 
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'district', array('maxlength' => 255)); ?>  
                    </div>
                    <div class='col-lg-2'>
                        <label>State</label><br/>
                        <?php echo $form->dropDownList($model, 'state', CHtml::listData(Gststatecodes::model()->findAll(), 'state_name', 'state_name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
                    </div>
                    <div class='col-lg-2'>
                        <label>Validity Pass From<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'Purchaseinvoice[validity_of_pass_from]',
                            'id' => 'validity_of_pass_from',
                            'value' => $model->validity_of_pass_from,
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Validity Pass From', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                    <div class='col-lg-2'>
                        <label>Validity Pass To<span class="required">*</span></label><br/>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'name' => 'Purchaseinvoice[validity_of_pass_to]',
                            'id' => 'validity_of_pass_to',
                            'value' => $model->validity_of_pass_to,
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                            ),
                            'htmlOptions' => array(
                                'style' => '',
                                //'readonly' => 'readonly'
                                'placeholder' => 'Validity Pass To', 'class' => 'form-control',
                            ),
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'rr_no', array('maxlength' => 50)); ?>  
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'truck_wagon_no', array('maxlength' => 50)); ?>  
                    </div> 
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'truck_wagon_owner_name', array('maxlength' => 50)); ?>  
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'driver_name', array('maxlength' => 50)); ?>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'driver_contact', array('maxlength' => 50)); ?>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'driver_lic_no', array('maxlength' => 50)); ?>
                    </div>
                </div>
                <div class="row">
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'transport_name', array('maxlength' => 50)); ?>
                    </div> 
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'dispatch_from', array('maxlength' => 50)); ?>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'dispatch_to', array('maxlength' => 50)); ?>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->textFieldControlGroup($model, 'crossing', array('maxlength' => 50)); ?>
                    </div>
                    <div class='col-lg-2'>
                        <?php echo $form->dropDownListControlGroup($model, 'received_by', CHtml::listData(Employee::model()->findAll(), 'id', 'empname'), array('class' => 'form-control', 'empty' => '-Select-')); ?>  
                    </div>
                    <div class='col-lg-1 pull-right' style="margin-top:22px;" align="right">
                        <?php echo BsHtml::Button('Update', array('color' => "btn btn-primary", 'id' => 'editpurchaseinvoice')); ?>
                    </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
</div>    
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    <?php if(!empty($model->is_gstn_compliant)){?>
         var is_gstn_compliant=<?php echo $model->is_gstn_compliant?>;
         if (is_gstn_compliant == '1') {
            $("#compliant_type").show();
        }
        else {
            $("#compliant_type").hide();
        }    
    <?php }?>
    <?php if(!empty($model->place_of_supply)){?>
        var place_of_supply=<?php echo $model->place_of_supply?>;
        if (place_of_supply == '1') {
            $("#state_code").show();
        }
        else {
            $("#state_code").hide();
        }
    <?php }?>
    <?php if(!empty($model->invoice_type)){?>
        var input_type = '<?php echo $model->invoice_type?>';
        if (input_type == "cash") {
            $("#invoicetype_cash").show();
            $("#cash_vendor").show();
            $("#invoicetype_supplier").hide();
        } else {
            $("#invoicetype_supplier").show();
            $("#invoicetype_cash").hide();
            $("#cash_vendor").hide();
        }
    <?php }?>

    $("#invoice_type").change(function() {
        var input_type = $(this).val();
        if (input_type == "cash") {
            $("#invoicetype_cash").show();
            $("#cash_vendor").show();
            $("#invoicetype_supplier").hide();
        } else {
            $("#invoicetype_supplier").show();
            $("#invoicetype_cash").hide();
            $("#cash_vendor").hide();
        }
    });

    $("#Purchaseinvoice_vendor_id").change(function() {
        var invoice_vendor_id = $(this).val();
         $.ajax({
                url: '<?php echo $this->createUrl('purchaseinvoice/getvendor_gstnno') ?>',
                data: {'id': invoice_vendor_id},
                type: 'get',
                cache: false,
                success: function(response) {
                   if(response!=""){
                      $("#Purchaseinvoice_gstin_no").val(response); 
                   } else {
                        $("#Purchaseinvoice_gstin_no").val("Un-Registerd");
                    }
                }
            });            
    });

    $('input:radio[name=is_gstn_compliant]').change(function() {
        if (this.value == '1') {
            $("#compliant_type").show();
        }
        else {
            $("#compliant_type").hide();
        }
     });

    $('input:radio[name=place_of_supply]').change(function() {
        if (this.value == '1') {
            $("#state_code").show();
        }
        else {
            $("#state_code").hide();
        }
     });

    $("#Purchaseinvoice_vendor_id").change(function() {
        var input_type = $("#invoice_type").val();
        if (input_type == "Cash") {
            var invoice_vendor_id = "1";
        } else {
            var invoice_vendor_id = $(this).val();
        }
        $("#invoice_vendor_id").val(invoice_vendor_id);
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
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#editpurchaseinvoice').click(function() {
        var form = $('#editpurchaseinvoice-form').serialize();
        //alert(form);
        //return false;
        $("#editpurchaseinvoice").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/saveinvoice') ?>',
            data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#editpurchaseinvoice").removeAttr('disabled').html('Save');
                $("#success_msg").html("<div class='alert alert-success'>Invoice Details updated Successfully.</div>");
                setInterval(function() {
                    window.location.href = "<?php echo $this->createUrl('purchaseinvoice/admin') ?>";
                }, 1000);
            }
        });
    });
});
</script>