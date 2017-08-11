<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management' => array('itemstock/index'),
    'Indenting',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Itemstock', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemstock', 'url' => array('create')),
);
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
        ));
?>
<input type="hidden" name="id" value="<?php echo $id?>"/>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Indenting</h3>
                </div>
                <div class="panel-body">
                    <div class='row'>                                                
                        <div class='col-md-2'>
                            <label>Select</label>
                            <select name="choice_item" id="choice_item" class="form-control">
                                <?php foreach(Utils::choicetype() as $k=>$v){
                                if(Yii::app()->request->getPost('choice_item')==$k){
                                ?>
                                <option value="<?php echo $k?>" selected><?php echo $v?></option>
                                <?php }else{?>
                                <option value="<?php echo $k?>"><?php echo $v?></option>
                                <?php }}?>
                            </select>
                        </div>                 
                        <div id="itemwise_select">    
                            <div class='col-md-3'>
                                <label>Category</label>
                                <?php echo $form->dropDownList($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => '-Select-')); ?>
                            </div>
                            <div class='col-md-3'>
                                <label>Sub Category</label>
                                <select name="Itemstock[p_sub_category_id]" id="Itemstock_sub_category_id" class="form-control">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
                        </div>                         
                        <div class='col-md-2'>
                            <label>Sorting</label>
                            <select name="sorting" id="sorting" class="form-control">
                                <option value="">--Select--</option>
                                <option value="low" <?php if($_POST['sorting']=="low") { echo "selected";} ?>>--Low Qty--</option>
                            </select>
                        </div>
                        <div class='col-md-2' style="margin-top:22px;">
                          <?php echo BsHtml::submitButton('Show Availability', array('color' => BsHtml::BUTTON_COLOR_GREEN,'id'=>'showavail')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    <br/>
                      <?php
                        if(isset($_POST['Itemstock'])) {
                        $pid = $model->p_category_id;
                        $psid = $model->p_sub_category_id;
                        $item_id=$model->item_id;
                        $sort=$_POST['sorting'];
                        if(Yii::app()->request->getPost('choice_item')!="allitem"){
                        if($pid!="" && $psid==""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid and item_type in('purchase','processed','resale') order by id");   
                        }else if($pid!="" && $psid!=""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid and p_sub_category_id=$psid and item_type in('purchase','processed','resale') order by id");   
                        }else if($pid!="" && $psid!="" && $sort!=""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid and p_sub_category_id=$psid and low_qty < 0 and item_type in('purchase','processed','resale') order by id");   
                        }  
                        }else{
                        $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where item_type in('purchase','processed','resale') order by id");       
                        }
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($alist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('itemstock/itemevaluate'),
                            ));
                            ?>
                         <div class="table-responsive" style="height:200px;overflow-y:scroll;">
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>            
                                        <th>Q.A.</th>            
                                        <th>Q.R.</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($alist as $v) {
                                        $cqty=$v->getqty($v);
                                        if(!empty($_POST['sorting'])){
                                         if($v->low_qty>$cqty){    
                                        ?>
                                     <tr <?php if($v->low_qty>=$cqty){ echo "style='background-color: rgb(218, 2, 2);color:#fff;'";}?>>
                                        <td width="10%"><input type="checkbox" class="allcheckedcategory" id="checked_item_<?php echo $v->id; ?>" onchange="checkeditem(<?php echo $v->id; ?>)" name="item_id[]" value="<?php echo $v->id; ?>"></td>
                                        <td width="15%"><?php echo $v->category->name; ?></td>
                                        <td width="15%"><?php echo $v->subcategory->name; ?></td>
                                        <td width="30%"><?php echo $v->itemname; ?> (<?php echo $v->item_scale; ?>)</td>
                                        <td width="10%"><?php echo $v->brand; ?></td>
                                        <td width="10%"><?php echo $v->getqty($v); ?></td>
                                        <td width="10%"><?php echo $v->low_qty; ?></td>
                                    </tr>    
                                    <input type="hidden" name="p_category_id" id="p_category_id" value="<?php echo $model->p_category_id; ?>"/>
                                    <input type="hidden" name="p_sub_category_id" id="p_sub_category_id" value="<?php echo $model->p_sub_category_id; ?>"/>
                                    <input type="hidden" name="item_id_<?php echo $v->id; ?>" id="item_id_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>"/>
                                    <input type="hidden" name="item_name_<?php echo $v->id; ?>" id="item_name_<?php echo $v->id; ?>" value="<?php echo $v->itemname; ?>"/>
                                    <input type="hidden" name="item_brand_<?php echo $v->id; ?>" id="item_brand_<?php echo $v->id; ?>" value="<?php echo $v->brand; ?>"/>
                                    <input type="hidden" name="stock_taking_scale_<?php echo $v->id; ?>" id="stock_taking_scale_<?php echo $v->id; ?>" value="<?php echo $v->item_scale; ?>"/>
                                    <?php
                                    $c++;
                                     }
                                    }else{
                                     ?>
                                     <tr <?php if($v->low_qty>=$cqty){ echo "style='background-color: rgb(218, 2, 2);color:#fff;'";}?>>
                                        <td width="10%"><input type="checkbox" class="allcheckedcategory" id="checked_item_<?php echo $v->id; ?>" onchange="checkeditem(<?php echo $v->id; ?>)" name="item_id[]" value="<?php echo $v->id; ?>"></td>
                                        <td width="15%"><?php echo $v->category->name; ?></td>
                                        <td width="15%"><?php echo $v->subcategory->name; ?></td>
                                        <td width="30%"><?php echo $v->itemname; ?> (<?php echo $v->item_scale; ?>)</td>
                                        <td width="10%"><?php echo $v->brand; ?></td>
                                        <td width="10%"><?php echo $v->getqty($v); ?></td>
                                        <td width="10%"><?php echo $v->low_qty; ?></td>
                                    </tr>    
                                    <input type="hidden" name="p_category_id" id="p_category_id" value="<?php echo $model->p_category_id; ?>"/>
                                    <input type="hidden" name="p_sub_category_id" id="p_sub_category_id" value="<?php echo $model->p_sub_category_id; ?>"/>
                                    <input type="hidden" name="item_id_<?php echo $v->id; ?>" id="item_id_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>"/>
                                    <input type="hidden" name="item_name_<?php echo $v->id; ?>" id="item_name_<?php echo $v->id; ?>" value="<?php echo $v->itemname; ?>"/>
                                    <input type="hidden" name="item_brand_<?php echo $v->id; ?>" id="item_brand_<?php echo $v->id; ?>" value="<?php echo $v->brand; ?>"/>
                                    <input type="hidden" name="stock_taking_scale_<?php echo $v->id; ?>" id="stock_taking_scale_<?php echo $v->id; ?>" value="<?php echo $v->item_scale; ?>"/>
                                    <?php
                                    $c++;   
                                    }                                    
                                     }
                                ?>
                                </tbody>
                            </table>
                              </div><br/>
                            <input type="submit" id="indentproceed_part1" name="evaluate" value="Proceed &gt;&gt;" class="btn btn-green pull-right" />         
                            <?php $this->endWidget(); ?>
                        <?php }} ?>               
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Purchase Indent List Un Processed</h3>
                </div>
                    <div class="panel-body">
                        <div class="table-responsive" style="height:300px;overflow-y:scroll;">
                        <?php
                        $list = Itemstock::model()->findAllBySql("select * from item_stock group by item_id");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($list)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('itemstock/itemevaluatelow'),
                            ));
                            ?>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>            
                                        <th>Q.A.</th>            
                                        <th>Q.R.</th>            
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($list as $v) {
                                      if($v->stock_qty==$v->item->low_qty){  
                                        ?>
                                        <tr>
                                            <td width="10%"><input type="checkbox" class="allcheckedcategory" id="checked_item_low_<?php echo $v->id; ?>" onchange="checkeditemlow(<?php echo $v->id; ?>,<?php echo $v->item_id; ?>)" name="item_id[]" value="<?php echo $v->id; ?>"></td>
                                            <td width="40%"><?php echo $v->item->itemname; ?> (<?php echo $v->item->item_scale; ?>)</td>
                                            <td width="30%"><?php echo $v->item->brand; ?></td>
                                            <td width="10%"><?php echo $v->stock_qty; ?></td>
                                            <td width="10%"><?php echo $v->item->low_qty; ?></td>
                                        </tr>    
                                    <input type="hidden" name="p_category_id" id="p_category_id" value="<?php echo $model->p_category_id; ?>"/>
                                    <input type="hidden" name="p_sub_category_id" id="p_sub_category_id" value="<?php echo $model->p_sub_category_id; ?>"/>
                                    <input type="hidden" name="item_id_<?php echo $v->id; ?>" id="item_id_<?php echo $v->id; ?>" value="<?php echo $v->item_id; ?>"/>
                                    <input type="hidden" name="item_name_<?php echo $v->id; ?>" id="item_name_<?php echo $v->id; ?>" value="<?php echo $v->item->itemname; ?>"/>
                                    <input type="hidden" name="item_brand_<?php echo $v->id; ?>" id="item_brand_<?php echo $v->id; ?>" value="<?php echo $v->item->brand; ?>"/>
                                    <input type="hidden" name="stock_taking_scale_<?php echo $v->id; ?>" id="stock_taking_scale_<?php echo $v->id; ?>" value="<?php echo $v->stock_taking_scale; ?>"/>
                                    <?php
                                    $c++;
                                    }}
                                ?>
                                </tbody>
                            </table>
                           <br/>
                            <input type="submit" id="indentproceed_part2" name="evaluate" value="Proceed &gt;&gt;" class="btn btn-green pull-right" />         
                            <?php $this->endWidget(); ?>
                         <?php } ?>
                             </div>
                    </div>
            </div>
            </div>
            <div class="col-md-6">
                <?php
                 $uid=Yii::app()->user->id;
                 if(!empty($id)){
                 $pcimodel=Purchaseindentmaster::model()->findBySql("select * from purchase_indent_master where id=$id and is_done=0");        
                 }else{
                 $pcimodel=Purchaseindentmaster::model()->findBySql("select * from purchase_indent_master where created_by=$uid and is_done=0 order by id desc limit 1");            
                 }
                ?>
                <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Purchase Indent List Pending & Un Processed <?php if(!empty($pcimodel->id)){ ?> (Indent No : <?php echo $pcimodel->id;?>) <?php }?></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="height:350px;overflow-y:scroll;">
                 <?php
                       if(!empty($pcimodel->id)){    
                        $ilist = Purchaseindent::model()->findAllBySql("select * from purchase_indent where indent_id=$pcimodel->id order by id desc");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('itemstock/indentcomplete'),
                            ));
                            ?>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>            
                                        <th>R.Qty.</th>            
                                        <th>Require Date</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $c = 1;
                                    foreach ($ilist as $v) {
                                        ?>
                                        <tr>
                                            <td width="35%"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                            <td width="20%"><?php echo $v->item_brand; ?></td>
                                            <td width="15%"><input type="text" name="qty_req_<?php echo $v->id?>"  size="4" value="<?php echo $v->qty_req; ?>"></td>
                                            <td width="25%"> <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'name' => 'req_date_'.$v->id,
                                                'id' => 'req_date_'.$v->id,
                                                'value' => isset($v->req_date) ? $v->req_date : date('Y-m-d'),
                                                'options' => array(
                                                    'minDate'=>'0','dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                                                ),
                                                'htmlOptions' => array(
                                                    'style' => '',
                                                    //'readonly' => 'readonly'
                                                    'placeholder' => 'Require Date', 'class' => 'form-control',
                                                ),
                                            ));
                                            ?></td>
                                            <td width="5%"><a onclick='deleteitem(<?php echo $v->id?>)'><i class='fa fa-trash-o'></i></a></td>
                                        </tr>    
                                    <?php
                                    $c++;
                                    }
                                ?>
                                </tbody>
                            </table>
                            <br/>
                            <input type="submit" id="save_indent" name="evaluate" value="Finish Indent &gt;&gt;" class="btn btn-green pull-right" />         
                            <?php $this->endWidget(); ?>
                 <?php }} ?>
                            </div>
                </div>
            </div>
            </div>            
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
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    <?php if (!empty($_POST['choice_item'])) { ?>
        var choice_item = "<?php echo $_POST['choice_item']?>";
        if (choice_item == "itemwise") {
            $("#itemwise_select").show();
        } else {
            $("#itemwise_select").hide();
        }
    <?php }?>        
        
    <?php if (!empty($model->p_category_id) && !empty($model->p_sub_category_id)) { ?>
        var scid =<?php echo $model->p_sub_category_id?>;
        var cid = <?php echo $model->p_category_id?>;
        GetSCategory(cid, scid,'Purchase');
    <?php }?>   
        
    <?php if (!empty($model->p_category_id) && !empty($model->p_sub_category_id) && !empty($model->item_id)) { ?>
        var scid =<?php echo $model->p_sub_category_id?>;
        var cid = <?php echo $model->p_category_id?>;
        var item_id =<?php echo $model->item_id?>;
        Getvendoritems(cid, scid,item_id);
    <?php }?>   
               
    $("#Itemstock_p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid,'Purchase');
     });  
     
      $('#save_evaluate').click(function() {
            $(this).attr('disabled');
            $('#myModal').modal('show');
        });
     
    $("#Itemstock_sub_category_id").change(function() {
            var item_id = 0;
            var cid=$("#Itemstock_p_category_id").val();
            var scid = $(this).val();
            Getvendoritems(cid, scid,item_id);
     });
     
     $("#choice_item").change(function() {
        var choice_item = $(this).val();
        if (choice_item == "itemwise") {
            $("#itemwise_select").fadeIn(1000).slideDown();
        } else {
            $("#itemwise_select").fadeOut(1000);
        }
    });     

  });   
   
    function Getvendoritems(cid,scid,item_id) {
        $("#Itemstock_item_id").html("");
        // $(".loading4").html("<img src='<?php //echo Yii::app()->baseUrl   ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseinvoice/getitemlist'); ?>", {"cid": cid,"scid": scid}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.items, function(i, ct) {
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.itemname + '(' + ct.brand + ')</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '(' + ct.brand + ')</option>';
                }
            });
            $("#Itemstock_item_id").html(content);
        });
    }
    
   function GetSCategory(cid, scid,type) {
        $("#Itemstock_sub_category_id").html("");
        //$(".loading4").html("<img src='<?php echo Yii::app()->baseUrl ?>/img/loading.gif'>");
        $.getJSON("<?php echo $this->createUrl('purchaseitem/getSCategoryList'); ?>", {"cid": cid,"type":type}, function(data) {
            $(".loading4").html("");
            var content = "";
            content += '<option value="">--Select--</option>';
            $.each(data.scat, function(i, ct) {
                if (scid == ct.id) {
                    content += '<option value="' + ct.id + '" selected="selected">' + ct.name + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.name + '</option>';
                }
            });
            $("#Itemstock_sub_category_id").html(content);
        });
    }
    
    function checkeditem(id){
       if ($('#checked_item_'+id).is(':checked')) {
          $.getJSON("<?php echo $this->createUrl('purchaseindentmaster/checkitemexist'); ?>", {"itemid": id}, function(data) { 
              if(data.msg=="1"){
                  alert("Sorry Item Already Exist in Indent No."+data.indentno);
                  $("#indentproceed_part1").attr("disabled","disabled");
              }else{
                  $("#indentproceed_part1").removeAttr("disabled","");
              }
           });  
        }else{
                  $("#indentproceed_part1").removeAttr("disabled","");
              }
    }
    function checkeditemlow(id,itemid){
       if ($('#checked_item_low_'+id).is(':checked')) {
          $.getJSON("<?php echo $this->createUrl('purchaseindentmaster/checkitemexist'); ?>", {"itemid": itemid}, function(data) { 
              if(data.msg=="1"){
                  alert("Sorry Item Already Exist in Indent No."+data.indentno);
                  $("#indentproceed_part2").attr("disabled","disabled");
              }else{
                  $("#indentproceed_part2").removeAttr("disabled","");
              }
           });  
        }else{
                  $("#indentproceed_part2").removeAttr("disabled","");
              }
    }
     function deleteitem(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseindentmaster/deleteitem') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                location.reload();
            }
        });
    }
</script>