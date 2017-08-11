<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Purchase Invoice' => array('purchaseinvoice/admin'),
    'Invoice Entry',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Purchaseinvoice', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Purchaseinvoice', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#purchaseinvoice-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<style type="text/css">
    .view,.delete{
        display:none; 
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Add Purchase Invoice</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'purchaseinvoice-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
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
                    </div><br/> 
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
                            <?php echo BsHtml::submitButton('Save', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'btnpurchaseinvoice')); ?>
                        </div>
                    </div>
                </div> <!-- panel body close -->
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </div>
</div>
<div class='row'>
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header bg-green">
                <h3 class="panel-title">Purchase Invoice List</h3>
            </div>
            <div class="panel-body table-responsive">
                <?php
                $this->renderPartial('_search', array(
                    'model' => $model,
                ));
                ?>
                    <?php if (!empty($list)) { ?>
                    <table class="items table table-bordered">
                        <thead>
                            <tr>
                                <th id="purchaseinvoice-grid_c2">Purchase In-ward</th>
                                <th id="purchaseinvoice-grid_c3">Invoice Date</th>
                                <th id="purchaseinvoice-grid_c0">Type</th>
                                <th id="purchaseinvoice-grid_c1">Name of Farmer</th>
                                <th id="purchaseinvoice-grid_c1">Farmer Father Name</th>
                                <th id="purchaseinvoice-grid_c1">Village</th>
                                <th id="purchaseinvoice-grid_c1">District</th>
                                <th id="purchaseinvoice-grid_c1">State</th>
                                <th id="purchaseinvoice-grid_c8">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $data) {
                                ?>
                                <tr <?php
                                    $exist_kp=Kataparchy::model()->countByAttributes(array("purchase_invoice_id"=>$data->id));
                                    if ($data->is_conflict_bill_accepted == 1) {
                                        echo "style='background-color:#dd4b39;color:#fff;'";
                                    }else if($exist_kp>0){
                                        echo "style='background-color:#ddba39;color:#fff;'";
                                    }else{
                                        echo "style='background-color:#fff;color:#000;'";
                                    }
                                    ?>>
                                    <td><?php echo $data->id?></td>
                                    <td><?php echo $data->invoice_date ?></td>
                                    <td><?php echo $data->invoice_type; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($data->vendor_name)) {
                                            echo $data->vendor_name;
                                        } else {
                                            if (isset($data->vendor->name)) {
                                                echo $data->vendor->name . " ( " . $data->vendor->firm_name . " )";
                                            }
                                        }
                                        ?> 
                                    </td>
                                    <td><?php echo $data->land_owner ?></td>
                                    <td><?php echo $data->village ?></td>
                                    <td><?php echo $data->district ?></td>
                                    <td><?php echo $data->state ?></td>
                                    <?php
                                    if ($data->is_conflict_bill_accepted == 0) {?>
                                    <td width="240">   
                                        <a href="<?php echo Yii::app()->createUrl('challan/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'><i class='fa fa-plus'></i> Challan</button></a>
                                        <?php
                                        $check_exist_challan=Challan::model()->findByAttributes(array("purchase_invoice_id"=>$data->id));
                                        if (!empty($check_exist_challan)) {
                                            ?>
                                            <a href="<?php echo Yii::app()->createUrl('kataparchy/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'><i class='fa fa-plus'></i> Kata Parchy</button></a>
                                            <?php
                                        } else {
                                            ?>
                                            <button type='button' class='btn btn-green btn-sm disabled'><i class='fa fa-plus'></i> Kata Parchy</button>
                                            <?php
                                        }
                                        ?>
                                        <a href="<?php echo Yii::app()->createUrl('purchaseinvoice/update', array('id' => $data->id)) ?>" class='btn btn-green btn-sm'><i class='fa fa-pencil'></i> Edit</a>
                                        <a href="<?php echo Yii::app()->createUrl('kataparchy/print', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'><i class='fa fa-print'></i> Kata Parchy</button></a>
                                        <a href="<?php echo Yii::app()->createUrl('purchaseinvoice/view', array('id' => $data->id)) ?>" class='btn btn-green btn-sm'><i class='fa fa-eye'></i> View</a>
                                        <a href="#name" onclick="cancel_invoice(<?php echo $data->id?>)" class='btn btn-primary btn-sm'><i class='fa fa-trash'></i> Cancel</a> 
                                    </td>
                                    <?php }else{?>
                                    <td width="240"> 
                                    <button type='button' class='btn btn-green btn-sm disabled'><i class='fa fa-plus'></i> Kata Parchy</button>
                                    <a href="<?php echo Yii::app()->createUrl('purchaseinvoice/update', array('id' => $data->id)) ?>" class='btn btn-green btn-sm disabled'><i class='fa fa-pencil'></i> Edit</a>
                                    <a href="<?php echo Yii::app()->createUrl('purchaseinvoice/view', array('id' => $data->id)) ?>" class='btn btn-green btn-sm'><i class='fa fa-eye'></i> View</a>
                                    </td>
                                    <?php }?>  
                                </tr>

    <?php } ?>
                        </tbody>
                    </table> 
                    <div id="itemstock-excel" style="display:none;">
                        <table class="items table table-bordered">
                            <thead>
                                <tr>
                                    <th id="purchaseinvoice-grid_c2">Purchase In-ward</th>
                                    <th id="purchaseinvoice-grid_c3">Invoice Date</th>
                                    <th id="purchaseinvoice-grid_c0">Type</th>
                                    <th id="purchaseinvoice-grid_c1">Name of Farmer</th>
                                    <th id="purchaseinvoice-grid_c1">Farmer Father Name</th>
                                    <th id="purchaseinvoice-grid_c1">Village</th>
                                    <th id="purchaseinvoice-grid_c1">District</th>
                                    <th id="purchaseinvoice-grid_c1">State</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $data) {
                                    ?>
                                    <tr <?php
                                    if ($data->total_amount == "") {
                                        echo "style='background-color:#00a65a;color:#fff;'";
                                    } else if ($data->total_amount != "") {
                                        echo "style='background-color:#f0ad4e;color:#fff;'";
                                    } else if ($data->is_added_to_stock == 0 && $data->is_reviewed == 1) {
                                        echo "style='background-color:#428bca;color:#fff;'";
                                    } else {
                                        echo "style='background-color:#fff;color:#333;'";
                                    }
                                    ?>>
                                        <td><?php echo $data->id ?></td>
                                        <td><?php echo $data->invoice_date ?></td>
                                        <td><?php echo $data->invoice_type; ?></td>
                                        <td>
                                            <?php
                                            if (!empty($data->vendor_name)) {
                                                echo $data->vendor_name;
                                            } else {
                                                if (isset($data->vendor->name)) {
                                                    echo $data->vendor->name . " ( " . $data->vendor->firm_name . " )";
                                                }
                                            }
                                            ?> 
                                        </td>
                                        <td><?php echo $data->land_owner ?></td>
                                        <td><?php echo $data->village ?></td>
                                        <td><?php echo $data->district ?></td>
                                        <td><?php echo $data->state ?></td>
                                    </tr>
                    <?php } ?>
                            </tbody>
                        </table> 
                    </div>    
<?php } ?>                    
<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
            </div>
        </div>
    </div>      
</div>

<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" style="width:900px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Invoice Review</h4>
            </div>
            <div class="modal-body">
                <div id="invoicedetails"></div> 
                <br/> 
                <?php
                $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                    'id' => 'reviewform',
                ));
                ?>
                <input type="hidden" id="invoice_id" name="invoice_id">
                <input type="hidden" id="is_conflict_bill_accepted" name="is_conflict_bill_accepted">
                <div class="form-group">
                    <label>
                        <input type="radio" name="review_rating" id="optionsRadios1" value="1" checked="">
                        Rating 1
                    </label>            
                    <label>
                        <input type="radio" name="review_rating" id="optionsRadios2" value="2">
                        Rating 2
                    </label>            
                    <label>
                        <input type="radio" name="review_rating" id="optionsRadios3" value="3">
                        Rating 3
                    </label>             
                    <label>
                        <input type="radio" name="review_rating" id="optionsRadios4" value="4">
                        Rating 4
                    </label>
                    <label>
                        <input type="radio" name="review_rating" id="optionsRadios5" value="5">
                        Rating 5
                    </label>
                </div>
                <div class="form-group">
                    <textarea maxlength="100" placeholder="Review Description" class="form-control" rows="5" name="review_desc" id="review_desc"></textarea>
                </div>
                <div class="form-group">
                    <button type="button" id="givereview" class="btn btn-green">Review & Process</button>
                    <button type="button" onclick="printreview()" class="btn btn-green">Print</button>
                </div>
<?php $this->endWidget(); ?>
            </div>      
        </div>
    </div>
</div>
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="pendingpo_itemlist"></div> 
        </div>
    </div>
</div>
<div id="load_model"></div>
<div class="modal fade" id="myModal5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="pendingpo_items"></div> 
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/bootbox.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    //  $("#state_code_div").hide();
    $("#Purchaseinvoice_vendor_id").change(function() {
        var invoice_vendor_id = $(this).val();
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/getvendor_gstnno') ?>',
            data: {'id': invoice_vendor_id},
            type: 'get',
            cache: false,
            success: function(response) {
                if (response != "") {
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


    $("#invoice_type").change(function() {
        var input_type = $(this).val();
        if (input_type == "cash") {
            $("#invoicetype_cash").show();
            $("#cash_vendor").show();
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
            $("#cash_vendor").hide();
        }
    });

    $("#Purchaseinvoice_vendor_id").change(function() {
        var input_type = $("#invoice_type").val();
        if (input_type == "cash") {
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
                //$("#vendor_gstin_no").html(response.tin_no);
            }
        });
    });

    $('#givereview').click(function() {
        var is_conflict_bill_accepted = $("#is_conflict_bill_accepted").val();
        if (is_conflict_bill_accepted == "" || is_conflict_bill_accepted == "0") {
            checkreviewmodal();
            return false;
        }

        var form = $('#reviewform').serialize();
        $("#givereview").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseinvoice/givereview') ?>',
            data: form + '&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>' + '&is_conflict_bill_accepted=1',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#givereview").removeAttr('disabled').html('Review & Process');
                $('#reviewform')[0].reset();
                window.location.reload();
            }
        });
    });
});

function checkreviewmodal() {
    $("#myModal_Review").modal('show');
}

function confirm_yes(value) {
    $("#myModal_Review").modal('hide');
    $("#is_conflict_bill_accepted").val(value);
}

function confirm_no(value) {
    $("#myModal_Review").modal('hide');
    $("#is_conflict_bill_accepted").val(value);
}

function reviewpost(id) {
    $.ajax({
        url: '<?php echo $this->createUrl('purchaseinvoice/getinvoicedataforreview') ?>',
        data: {'invoice_id': id},
        success: function(response) {
            $('#invoicedetails').html(response);
            $("#invoice_id").val(id);
            $('#myModal3').modal('show');
        }
    });
}
function pendingpolist(id) {
    $.ajax({
        url: '<?php echo $this->createUrl('purchaseinvoice/getpoitems') ?>',
        data: {'id': id},
        type: 'get',
        cache: false,
        success: function(response) {
            $("#pendingpo_items").html(response);
            $('#myModal5').modal('show');
        }
    });
}

function addtostock(id) {
    $(this).attr('disabled', 'disabled').html("Submiting...");
    $.ajax({
        url: '<?php echo $this->createUrl('purchaseinvoice/addtostock') ?>',
        data: {'invoice_id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
        type: 'post',
        success: function(response) {
            $(this).removeAttr('disabled').html('Add to Stock');
            $(this).attr('disabled');
            $('#myModal').modal('show');
            window.location.reload();
        }
    });
}
function authpurchasereview(id) {
    $.ajax({
        url: '<?php echo Yii::app()->createUrl('purchaseinvoice/authreview') ?>',
        data: 'id=' + id,
        success: function(response) {
            $("#load_model").html(response);
        }
    });
}
function cancel_invoice(id){
$.ajax({
        url: '<?php echo Yii::app()->createUrl('purchaseinvoice/cancel_invoice') ?>',
        data: 'id=' + id,
        success: function(response) {
           if(response=="1"){
            alert("Challan already generated.Please cancel the Challan first");    
            }else{
            window.location.reload();
           }
        }
    });
}
function printreview() {
    var newWindow = window.open('', 'print', 'height=500,width=700');
    newWindow.document.write('<html><head><title>Print</title>');
    newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
    newWindow.document.write('</head><body>');
    newWindow.document.write($("#invoicedetails").html());
    newWindow.print();
}
</script>