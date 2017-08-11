<?php
/* @var $this VendorController */
/* @var $model Vendor */


$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vendor Management' => array('vendor/index'),
    'Vendor Ledger',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Vendor', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Vendor', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#vendor-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Vendor Ledger</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'purchaseinvoice-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                    <div class='row'>     
                        <div class='col-md-5'>
                            <label>Select Vendor </label>
                            <select id="Purchaseinvoice_vendor_id" name="Purchaseinvoice[vendor_id]" class="form-control select2">
                                <option value="">-Select-</option>
                                <?php
                                foreach (Vendor::model()->findAllByAttributes(array("is_active" => 1)) as $iset) {
                                    if ($model->vendor_id==$iset->id) {
                                        ?>
                                        <option value="<?php echo $iset->id ?>" selected="selected"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>)</option>
                                    <?php } else { ?>
                                        <option value="<?php echo $iset->id ?>"><?php echo $iset->name ?> (<?php echo $iset->firm_name ?>)</option>
                                <?php }
                            } ?>    
                            </select>
                        </div>
                        <div class='col-md-5' style="padding-top:23px;">
                            <?php echo BsHtml::submitButton('Show', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'btninvoice')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    <br/>
                    <?php if(!empty($list)){?>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Name</b></td>
                            <td><b>Firm Name</b></td>
                            <td><b>Mobile No</b></td>
                            <td><b>Email</b></td>
                            <td><b>TIN No</b></td>
                            <td><b>Invoice Balance</b></td>
                             <td><b>Action</b></td>
                        </tr>
                        <tr>
                            <td><?php echo $list->name;?></td>
                            <td><?php echo $list->firm_name;?></td>
                            <td><?php echo $list->mobile;?></td>
                            <td><?php echo $list->email;?></td>
                            <td><?php echo $list->tin_no;?></td>
                            <td><?php echo $list->vendor_bal;?></td>
                             <td><a target="_blank" href="<?php echo Yii::app()->createUrl('vendor/paymenthistory', array('id' => $list->id)); ?>" class="btn btn-green">Invoice Payment History</a>&nbsp;
                             <a target="_blank" href="<?php echo Yii::app()->createUrl('vendor/polist', array('id' => $list->id)); ?>" class="btn btn-green">Vendor PO List</a></td>
                        </tr>
                    </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title"> <?php if(!empty($list)){?><?php echo $list->name;?> (Firm : <?php echo $list->firm_name;?>) <?php }?>Invoice List</h3>
                </div>
                  <br/>
                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                        'id' => 'searchinvoice-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
                <input type="hidden" id="vendor_id" name="vendor_id" value="<?php if(!empty($list)){?><?php echo $list->id; }?>"/>
                <div class='col-md-5'>
                    <label>From Date</label>
                        <?php
                     $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                         'name' => 'from_dated',
                         'id' => 'from_dated',
                         'value' => Yii::app()->request->getPost('from_dated'),
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
                <div class='col-md-5'>
                    <label>To Date</label>
                    <?php
                  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                      'name' => 'to_dated',
                      'id' => 'to_dated',
                      'value' => Yii::app()->request->getPost('to_dated'),
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
                <div class='col-md-2' style="padding-top:23px;">
                    <?php echo BsHtml::Button('Filter', array('color' => BsHtml::BUTTON_COLOR_GREEN, 'id' => 'searchinvoice')); ?>
                </div>
                 <?php $this->endWidget(); ?>
                <div style="clear:both"></div>
                <br/>
                <div class="panel-body table-responsive" id="history_invoiceresult">
                  <?php if(!empty($list->id)){?>
                    <table class="table table-bordered">
                        <tr>
                            <td><b>Invoice No.</b></td>
                            <td><b>Invoice Date</b></td>
                            <td><b>Total Amount</b></td>
                            <td><b>Paid Amount</b></td>
                            <td><b>Balance Amount</b></td>
                            <td><b>Action</b></td>
                        </tr>
                        <?php 
                        $criteria = new CDbCriteria;
                        $criteria->order = 'id DESC';
                        if($list->id=="1"){
                         $plist=Purchaseinvoice::model()->findAllByAttributes(array("invoice_type"=>'cash',"is_reviewed"=>1),$criteria);   
                        }else{
                         $plist=Purchaseinvoice::model()->findAllByAttributes(array("vendor_id"=>$list->id,"is_reviewed"=>1),$criteria);   
                        }
                        foreach($plist as $invlist){
                            ?>
                        <tr>
                            <td><a href="#" onclick="reviewpost(<?php echo $invlist->id;?>);"><?php echo $invlist->invoice_no;?></a></td>
                            <td><?php echo $invlist->invoice_date;?></td>
                            <td><?php echo $invlist->total_amount;?></td>
                            <td><?php echo $invlist->getamount($invlist);?></td>
                            <td><?php echo $invlist->getbalance($invlist);?></td>
                            <td>
                                <a href="#" onclick="paydetails(<?php echo $invlist->id;?>);" class="btn btn-green">Pay Details</a>
                                <?php if($invlist->getbalance($invlist)>0){ ?>
                                <a href="<?php echo $this->createUrl('voucher/create',array('id'=>2,'receiver_type'=>'vendor','receiver_id'=>$invlist->vendor_id))?>" class="btn btn-green">Pay Now</a>
                                <?php }else{?>
                                <a href="#" class="btn btn-green disabled">Pay Now</a>
                                <?php }?>
                            </td>
                        </tr>
                       <?php }?> 
                    </table>
                    <?php }?>
                </div>
                <div class="panel-body table-responsive" id="invoiceresult"></div>
            </div>
        </div>      
    </div>
</div>
<div class="modal fade" id="myModal8" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Pay Details</h4>
      </div>
      <div class="modal-body">
          <div id="invoicepaydetails"></div> 
      </div>      
    </div>
  </div>
</div>
<div class="modal fade" id="myModal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Item Details</h4>
      </div>
      <div class="modal-body">
          <div id="invoicedetails"></div> 
      </div>      
    </div>
  </div>
</div>
<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Invoice Payment</h4>
      </div>
      <div id="error_field" class="alert bg-red" style="display:none;"></div>  
      <div class="modal-body">
         <?php
          $model1=new Invoicepay();
          $form1 = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
              'id' => 'invoicepayform',
          ));
          ?>
         <input type="hidden" id="invoice_id" name="invoice_id">
         <div class='row'>                    
             <div class='col-md-6'>
               <label>Amount</label>
                <?php echo $form1->textField($model1, 'amount', array('maxlength' => 100)); ?>
             </div>
             <div class='col-md-6'>
                 <label>Pay Date</label>
                <?php
                 $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                     'name' => 'dated',
                     'id' => 'dated',
                     'value' => $model1->dated,
                     'options' => array(
                         'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                     ),
                     'htmlOptions' => array(
                         'style' => '',
                         //'readonly' => 'readonly'
                         'placeholder' => 'Pay Date', 'class' => 'form-control',
                     ),
                 ));
                 ?>
             </div>
         </div><br/>
         <div class='row'>           
             <div class='col-md-6'>     
                 <label>Voucher No</label>
                <?php echo $form1->textField($model1, 'voucher_no', array('maxlength' => 100)); ?>
             </div>  
         </div>
         <br/>
        <div class="form-group">
            <button type="button" id="payinvoice" class="btn btn-green">Pay</button>
        </div>
      <?php $this->endWidget(); ?>
      </div>      
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
   $('#searchinvoice').click(function() {
            searchresult();
   });
   $('#paymode').change(function() {
        var pay_mode=$(this).val();
        if(pay_mode=="Cash"){
            $("#paid_other_no").hide();
            $("#paid_other_cash").hide();
        }else{
            $("#paid_other_no").show();
            $("#paid_other_cash").show();  
        }
   });
    
   $('#payinvoice').click(function() {
    var form = $('#invoicepayform').serialize();
    if($("#Invoicepay_amount").val()==""){
        $("#error_field").show();
        $("#error_field").html("Amount Required");
        $("#Invoicepay_amount").focus();
       return false;
    }else{
        $("#error_field").html("");
    }
    if($("#Invoicepay_voucher_no").val()==""){
        $("#error_field").show();
        $("#error_field").html("Voucher No. Required");
        $("#Invoicepay_voucher_no").focus();
        return false;
    }else{
       $("#error_field").html(""); 
    }
    $("#payinvoice").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('vendor/payinvoice') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
                $("#payinvoice").removeAttr('disabled').html('Pay');
                $('#invoicepayform')[0].reset();
                $('#myModal7').modal('hide');
                searchresult();
            }
        });
    });
    });
    function reviewpost(id){
       $.ajax({
            url: '<?php echo $this->createUrl('vendor/getinvoicedata') ?>',
            data: {'invoice_id': id},
            success: function(response) {
                $('#invoicedetails').html(response);
                $('#myModal6').modal('show');
            }
        });  
    }
    function paydetails(id){
       $.ajax({
            url: '<?php echo $this->createUrl('vendor/getpayinvoicedata') ?>',
            data: {'invoice_id': id},
            success: function(response) {
                $('#invoicepaydetails').html(response);
                $('#myModal8').modal('show');
            }
        });  
    }
    function invoicepay(id){
                $("#invoice_id").val(id);
                $('#myModal7').modal('show');
    }
    
    function searchresult(){
    var form = $('#searchinvoice-form').serialize();
    $.ajax({
            url: '<?php echo $this->createUrl('vendor/searchinvoice') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
             $("#history_invoiceresult").hide();   
             $("#invoiceresult").html(response);   
            }
        });
    }
</script>