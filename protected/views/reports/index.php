 <link href="<?php echo Yii::app()->request->baseUrl; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
<div id="printorder" class="alert1 alert-success" style="display:none;"></div>
<div id="printkot" class="alert1 alert-success" style="display:none;"></div>
<div class="c1">
    <div class="pos">
        <div id="pos">
            <form action="#" id="pos-sale-form" method="post">
                <input type="hidden" name="types" id="types" value="<?php echo $_SESSION['type']?>"/>
                <input type="hidden" name="table_no" value="<?php echo $_SESSION['tableno']?>"/>
                <div id="leftdiv">
                    <div id="left-top">
                        <div class="no-print">
                            <table>
                                <tr>
                                    <td><p class="help-block">Fields with <span class="required" style="color:#c40000;">*</span> are required.</p></td>
                                    <td width="110"></td>
                                    <td><button type="button" class="btn btn-primary" id="add_new"><i class="fa fa-book"></i> New Order</button></td>
                                </tr>
                            </table>                         
                            <br/>
                            <div class="form-group" id="ui">
                                <div class="input-group" style="background-color:#f5f5f5;">
                                    <table>
                                        <tr>
                                            <?php
                                            foreach (Utils::types() as $t => $v) {
                                                ?>
                                                <td>
                                                    <?php if ($_SESSION['type'] == $t) {
                                                        ?>  
                                                        <button type="button" class="btn btn-default disabled" onclick="tokentype(<?php echo $t; ?>)"><?php echo $v; ?></option>
                                                        <?php } else {
                                                            ?>
                                                       <button type="button" class="btn btn-default"  onclick="tokentype(<?php echo $t; ?>)"><?php echo $v; ?></button>
                                                            <?php }
                                                        ?>
                                                </td>
                                                <td width="10"></td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group" id="ui">
                                <table>
                                    <tr>
                                         <td>
                                        <div class="input-group" style="width:110px;">
                                                <select name="tableno" id="tableno" class="form-control" onchange="tabletake(this.value)">
                                                     <option value="">Table No.</option>
                                                    <?php
                                                    foreach (Utils::tables() as $t => $v) {
                                                        if ($_SESSION['tableno'] == $t) {
                                                            ?>  
                                                            <option value="<?php echo $t; ?>" selected><?php echo $v; ?></option>
                                                        <?php } else {
                                                            ?>
                                                            <option value="<?php echo $t; ?>"><?php echo $v; ?></option>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                         </div>
                                    </td>
                                        <td> <div class="input-group">
                                                <input type="text" name="customername" class="form-control pos-tip ui-autocomplete-input" id="cname" value="<?php if(!empty($_SESSION['user']['cname'])){
                                                echo $_SESSION['user']['cname'];    
                                                }else{ 
                                                echo "Shri Ganesh";    
                                                }
                                                ?>" placeholder="Customer Name">
                                                <div class="input-group-addon" style="padding: 2px 5px;"><span id="error_name" style="color:#c40000;"></span></div>
                                            </div></td>
                                        <td></td>
                                        <td>
                                            <div class="input-group">
                                                <input type="text" name="mobileno" maxlength="10" class="form-control pos-tip ui-autocomplete-input" id="mobileno" value="<?php if(!empty($_SESSION['user']['cname'])){
                                                echo $_SESSION['user']['mobileno'];    
                                                }else{ 
                                                echo "8888888888";    
                                                }
                                                ?>" placeholder="Mobile Name">
                                                <div class="input-group-addon" style="padding: 2px 5px;"><span id="error_mobileno" style="color:#c40000;"></span></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>                          
                        </div>
                    </div>
                    <div id="print">
                        <div id="left-middle" style="height: 106px; min-height: 285px;">
                            <div id="product-list" class="ps-container" style="height: 101px; min-height: 280px;overflow-y:scroll;">
                                <table class="table items table-striped table-bordered table-condensed table-hover" id="" style="margin-bottom: 0;">
                                    <thead>
                                        <tr>
                                            <th width="40%">Product</th>
                                            <th width="15%">Price</th>
                                            <th width="15%">Qty</th>
                                            <th width="20%">Subtotal</th>
                                            <th width="10%">
                                                <i class="fa fa-trash-o"></i>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($show)) { ?>
                                            <?php
                                            $count = 1;
                                            $sum = 0;
                                            $tprice = 0;
                                            foreach ($show as $s) {
                                                ?> 
                                                <tr class="first odd">
                                                    <td>
                                                        <?php echo $s->getProducts()->item_name ?>(<?php echo $s->getProducts()->sizes ?>)
                                                    </td>
                                                    <td class="movewishlist">
                                                        <?php echo $s->getProducts()->price ?>
                                                    </td>
                                                    <td class="a-center movewishlist">     
                                                      <select id="qty" onchange="update(<?php echo $s->booksid ?>,<?php echo $s->cid ?>, this)">
                                                                    <?php for ($i = 1; $i <= 20; $i++) { ?>
                                                                        <?php if ($s->qty == $i) { ?>
                                                                            <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                                                        <?php } else { ?>
                                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                      </select>
                                                    <?php //echo $s->qty ?>
                                                    </td>
                                                    <td class="a-right movewishlist">
                                                        <span class="cart-price">
                                                            <span class="price">Rs. 
                                                                <?php
                                                                $tprice = $s->getProducts()->price * $s->qty;
                                                                echo $tprice;
                                                                ?>
                                                            </span>
                                                        </span>
                                                    </td>
                                                    <td class="a-center last">
                                                        <a class="button remove-item" title="Remove item" href="<?php echo $this->createUrl('reports/ajaxdelete/pid/' . $s->booksid . '/cid/' . $s->cid) ?>">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a></td>
                                                </tr>
                                                <?php
                                                $sum = $sum + $tprice;
                                            }
                                        }
                                        ?>
                                </table>
                                <div style="clear:both;"></div>
                          </div>
                        </div>
                        <div style="clear:both;"></div>
                        <?php if(!empty($_SESSION['type']) && $_SESSION['type']=="2"){?>
                        <div id="left-bottom">
                            <div class="clearfix"></div>
                            <div id="botbuttons" style="text-align:center;">
                                <div class="btn-group btn-group-justified">                                    
                                    <div class="btn-group">
                                        <div class="btn-group btn-group-justified">
                                            <div class="btn-group">
                                                  <button type="button" class="btn btn-danger" id="cancel_order"><i class="fa fa-book"></i> Cancel Order</button>
                                            </div>
                                             <div class="btn-group">
                                                <button type="button" class="btn btn-primary disabled" id="print_kot"><i class="fa fa-print"></i> Print KOT</button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success" id="payment"><i class="fa fa-cart-plus"></i> Add Order</button>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <?php }else{?>
                          <div id="left-bottom">
                            <table id="totalTable" style="width:100%; float:right; padding:5px; color:#000; background: #FFF;">
                                <tbody><tr>
                                        <td style="padding: 5px 10px;">Items</td>
                                        <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;"><span id="titems"><?php
                                        $show = Shoping::getAll();
                                        echo count($show)
                                        ?></span></td>
                                        <td style="padding: 5px 10px;">Total</td>
                                        <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;"><span id="total"><?php echo $sum; ?></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="padding: 5px 10px;">Order Tax</td>
                                        <td colspan="2" class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;">
                                            <?php
                                             $tax=Taxrates::model()->findByAttributes(array("isactive"=>1));
                                             $paytax=$sum*$tax->rate/100;
                                             $payamt=$sum+$paytax;
                                            ?>
                                            <input name="tax" id="taxrate" class="form-control" value="<?php echo round($tax->rate);?>" readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 5px 10px; border-top: 1px solid #666; font-weight:bold; background:#333; color:#FFF;" colspan="2">Total Payable</td>
                                        <td class="text-right" style="padding:5px 10px 5px 10px; font-size: 14px;border-top: 1px solid #666; font-weight:bold; background:#333; color:#FFF;" colspan="2"><?php echo $payamt?>
                                            <input type="hidden" name="netamount" id="gtotal_price" value="<?php echo $payamt?>"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="clearfix"></div>
                            <div id="botbuttons" style="text-align:center;">
                                <div class="btn-group btn-group-justified">                                    
                                    <div class="btn-group">
                                        <div class="btn-group btn-group-justified">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger" id="cancel_order"><i class="fa fa-book"></i> Cancel Order</button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary disabled" id="print_bill"><i class="fa fa-print"></i> Print Order</button>
                                            </div>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success" id="payment"><i class="fa fa-cart-plus"></i> Save Order</button>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </form>                   
            <div id="cp">
                <div id="cpinner">
                    <div class="quick-menu">
                        <div id="proContainer">
                            <div id="ajaxproducts">
                                <?php
                                $clist = Category::model()->findAll();
                                if (!empty($clist)) {
                                    foreach ($clist as $c) {
                                        ?>
                                        <a href="#" onclick="getlist(<?php echo $c->id; ?>)">
                                            <button class="btn btn-default" 
                                                    data-container="body">
                                                <span><?php echo $c->name ?></span>
                                            </button>
                                        </a>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-danger">No Category Found !!!</div>
<?php } ?>
                                <div id="itemlist" style="height: 308px; min-height: 515px;">

                                </div>
                                <div class="btn-group btn-group-justified">

                                </div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
    </div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootbox.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/pos/js/pos.ajax.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    getlist(<?php echo $cid?>);    
//    $("#taxrate").change(function(){
//       var taxrate=$(this).val();
//       var sum='<?php //echo $sum?>';
//       var paytax=sum*taxrate/100;
//       var payamt=eval(sum)+eval(paytax);
//       $("#taxrate_print").html(Math.round(taxrate));
//       $("#gtotal").html(payamt);
//       $("#gstotal").html(payamt);
//       $("#gtotal_price").val(payamt);
//       $("#payamt_print").val();
//    });//taxrate
    
    $('#add_new').click(function () {
     $("#pos-sale-form")[0].reset();
      $.ajax({
       url:'<?php echo $this->createUrl('reports/orderreset') ?>',
       success:function(response){  
           window.location="<?php echo $this->createUrl('reports/index') ?>";
       }    
       });
    });
    $('#cancel_order').click(function () {
     $("#pos-sale-form")[0].reset();
      $.ajax({
       url:'<?php echo $this->createUrl('reports/orderreset') ?>',
       success:function(response){  
           window.location="<?php echo $this->createUrl('reports/index') ?>";
       }    
       });
    });
    $('#print_bill').click(function () {
       $.ajax({
       url:'<?php echo $this->createUrl('reports/printorder') ?>',
       success:function(response){   
          // alert(response);
          $("#printorder").html(response);
          Popup($('#printorder').html());          
       }    
       });
    });
    
    $('#print_kot').click(function () {
       $.ajax({
       url:'<?php echo $this->createUrl('reports/printkot') ?>',
       success:function(response){   
          // alert(response);
          $("#printkot").html(response);
          Popup($('#printkot').html());          
       }    
       });
    });
    
    $("#mobileno").blur(function(){
       var cname=$("#cname").val();
       var mobileno=$("#mobileno").val();
       $.ajax({
       url:'<?php echo $this->createUrl('reports/cusorders') ?>',
       data:'cname='+cname+'&mobileno='+mobileno,
       success:function(response){        
           
       }    
       });
    });
    
    $("#payment").click(function(){
        var cname=$("#cname").val();
        var mobileno=$("#mobileno").val();
        var sum='<?php echo $sum?>';
        if(cname==""){
           $("#error_name").html("*");
           return false;
        }else{
            $("#error_name").html(""); 
        }
        if(mobileno==""){
           $("#error_mobileno").html("*"); 
           return false;
        }else{
          $("#error_mobileno").html("");   
        }        
        if(sum==""){
           bootbox.alert('<div class="alert1 alert-danger">Please select atleast one item from Category Section !!!</div>');
           return false;
        }else{
            
        }        
     var dataString=$("#pos-sale-form").serialize();
     //alert(dataString);
     $.ajax({
       url:'<?php echo $this->createUrl('reports/payorders') ?>',
       data:dataString,
       type:'POST',
       success:function(response){
          // alert(response);
           $("#pos-sale-form")[0].reset();
           $("#print_bill").removeClass("disabled").addClass("btn btn-primary");
           $("#print_kot").removeClass("disabled").addClass("btn btn-primary");
           $("#success").show();   
           bootbox.alert('<div class="alert1 alert-success">Your Order Saved Successfully !!!</div>');
           $("#payment").attr("disabled","disabled");
       }
   });
        
    });//payment
});
function getlist(id){
   $.ajax({
       url:'<?php echo $this->createUrl('reports/getlist')?>',
       data:'cid='+id,
       success:function(response){
           $("#itemlist").html(response);
       }
   });
}

function tokentype(type){
 window.location="<?php echo $this->createUrl('reports/index')?>/type/"+type;
}
function tabletake(tno){
  var type=$("#types").val();  
 window.location="<?php echo $this->createUrl('reports/index')?>/type/"+type+"/table_no/"+tno;
}

  function Popup(data) {
        var mywindow = window.open('', 'go_highway_print', 'height=500,width=700');
        mywindow.document.write('<html><head><title>Print</title>');
        mywindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        //alert(data);
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');
        mywindow.print();
        mywindow.close();
        //return true;
    }
function update(data,cid, obj)
    {
        // alert(obj);
        var value = obj.value;
        var catid=cid;
        var id = data;
        //alert(send_data);
        window.location="<?php echo $this->createUrl('reports/editcart')?>/id/"+id+"/category_id/"+catid+"/qty/"+value;       
    }
</script>