<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'purchaseitem-form',
    'enableAjaxValidation' => false,
        ));



//$optionsArray = array(
//'elementId'=> 'showBarcode', /*id of div or canvas*/
//'value'=> '4797001018719', /* value for EAN 13 be careful to set right values for each barcode type */
//'type'=>'ean13',/*supported types  ean8, ean13, upc, std25, int25, code11, code39, code93, code128, codabar, msi, datamatrix*/
// 
//);
?>
<!--<div class='row'>
     <div class='col-md-6'>
<?php
//   echo '<div id="showBarcode">ss<div>'; //the same id should be given to the extension item id 
//  $this->widget('ext.barcode.Barcode', $optionsArray);
?>
         
     </div>

</div>-->

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model);   ?>
<div class='row'>
    <div class='col-lg-2'>
        <label>GST Type</label>
        <?php echo $form->dropdownlist($model, 'goods_service', Utils::goods_service(), array('options' => array($model->goods_service => array('selected' => true))), array('maxlength' => 100, 'id' => 'goods_service', 'class' => 'form-control')); ?>
    </div>
    <div class='col-lg-2'>
        <label>Item Type</label>
        <?php echo $form->dropdownlist($model, 'item_type', Utils::types(), array('options' => array($model->item_type => array('selected' => true))), array('maxlength' => 100, 'id' => 'item_type', 'class' => 'form-control')); ?>
    </div>  
    <div class='col-lg-3'>
        <label>Category</label>
        <select name="Purchaseitem[p_category_id]" id="Purchaseitem_category_id" class="form-control">
            <option value="">--Select Category--</option>
        </select>
        <?php echo $form->error($model, 'p_category_id'); ?>
    </div>
    <div class='col-lg-3'>
        <label>Sub Category</label>
        <select name="Purchaseitem[p_sub_category_id]" id="Purchaseitem_sub_category_id" class="form-control">
            <option value="">--Select Sub Category--</option>
        </select>
        <?php echo $form->error($model, 'p_sub_category_id'); ?>
    </div>
    <div class='col-lg-2'>
        <?php echo $form->numberFieldControlGroup($model, 'gst_code', array('maxlength' => 100)); ?>
    </div>
</div>
<div class='row'>
        <div class='col-lg-2'>
        <label>Item Classification</label>
        <?php echo $form->dropdownlist($model, 'item_classification', Utils::item_classify(), array('options' => array($model->item_classification => array('selected' => true))), array('maxlength' => 100, 'id' => 'item_classification', 'class' => 'form-control')); ?>
    </div>
    <div class='col-lg-2'>
        <?php echo $form->numberFieldControlGroup($model, 'gst_percent', array('maxlength' => 100)); ?>
    </div>    
    <div class='col-lg-2'>
        <?php echo $form->textFieldControlGroup($model, 'brand', array('maxlength' => 100)); ?>
    </div>
    <div class='col-lg-4'>
        <?php echo $form->textFieldControlGroup($model, 'itemname', array('maxlength' => 100)); ?>
    </div>
    <div class='col-lg-2 is_good_section'>
        <label>Item Scale</label>
        <?php echo $form->dropDownList($model, 'item_scale', CHtml::listData(Itemscale::model()->findAll(), 'type_name', 'type_name'), array('class' => 'form-control', 'empty' => '---Select Scale---')); ?>
        <?php echo $form->error($model, 'item_scale'); ?>
    </div> 
</div>
<?php echo $form->textAreaControlGroup($model, 'specification', array('maxlength' => 100)); ?>
<?php echo BsHtml::submitButton('Submit', array('color' => BsHtml::BUTTON_COLOR_AQUA, 'id' => 'btnpurchaseitem')); ?>
<?php $this->endWidget(); ?><br/>
<div class="row">
    <div class="col-lg-12">
        <legend>Item type Specification</legend>
        <div class="alert-danger" style="font-size: 15px;">
            Purchase : Item which are purchased to process and make semi finished or finished items.
        </div><br/>
        <div class="alert-success" style="font-size: 15px;">
            Processed : Items which are made inhouse and used to either make other saleable products or readily available to sell from shelf.
        </div><br/>
        <div class="alert-info" style="font-size: 15px;">
            Resale : Items which are brought from other brands or companies to sell over the counter of the Outlets.
        </div><br/>
        <div class="alert-warning" style="font-size: 15px;">
            Menu : Items which are sold from menu present at the outlet.
        </div>
    </div>
</div>
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
    $('#btnpurchaseitem').click(function() {
        $(this).attr('disabled');
        $('#myModal').modal('show');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
<?php if (!empty($model->item_type) && !empty($model->p_category_id)) { ?>
            var catid =<?php echo $model->p_category_id ?>;
            var itype = '<?php echo $model->item_type ?>';
            GetCategory(catid, itype);
<?php } ?>

<?php if (!empty($model->goods_service)) { ?>
            var goods_service = '<?php echo $model->goods_service ?>';
            Get_gst_type(goods_service);
<?php } ?>


<?php if (!empty($model->p_category_id) && !empty($model->p_sub_category_id)) { ?>
            var cid =<?php echo $model->p_category_id ?>;
            //    alert(cid);
            var scid =<?php echo $model->p_sub_category_id ?>;
            var itype = '<?php echo $model->item_type ?>';
            GetSCategory(cid, scid, itype);
<?php } ?>

        $("#Purchaseitem_item_type").change(function() {
            var itype = $(this).val();
            var catid = 0;
            Getitemtype(itype);
            GetCategory(catid, itype);
        });

        $("#Purchaseitem_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            var itype = $("#item_type").val();
            GetSCategory(cid, scid, itype);
        });


        $("#Purchaseitem_goods_service").change(function() {
            var goods_service = $(this).val();
            Get_gst_type(goods_service);
        });

    });//ready

    function GetCategory(catid, itype) {
        $("#Purchaseitem_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getCategoryListChoice'); ?>", {"type": itype}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.scat, function(i, ct) {
                if (catid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Purchaseitem_category_id").html(content);
        });
    }

    function GetSCategory(cid, scid, itype) {
        $("#Purchaseitem_sub_category_id").html("");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid, "type": itype}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select Sub Category--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Purchaseitem_sub_category_id").html(content);
        });
    }
    function Getitemtype(itype) {
        if (itype == "Processed") {
            $("#typeofproduct").show();
        } else {
            $("#typeofproduct").hide();
        }
    }

    function Get_gst_type(goods_service) {
        if (goods_service == "Services") {
            $(".is_good_section").hide();
        } else {
            $(".is_good_section").show();
        }
    }

</script>