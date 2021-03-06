<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Indents',
    'Internal Indent',
);
$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Indentmaster', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Indentmaster', 'url' => array('admin')),
);
?>
<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
        ));
?>
<input type="hidden" name="indent_id" value="<?php echo $id?>"/>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-aqua">
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
                                            <div class='col-md-3'>
                             <label>Item Name</label>
                             <input type="text" name="item_name" id="item_name" value="<?php echo $item_name;?>" placeholder="Enter Itemname to search" class="form-control">
                         </div>
                        <div id="itemwise_select">    
                            <div class='col-md-3'>
                                <label>Category</label>
                               <?php echo $form->dropDownList($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAll(), 'id', 'name'), array('class' => 'form-control select2', 'empty' => '--Select--')); ?>
                            </div>
                            <div class='col-md-2'>
                                <label>Sub Category</label>
                                <select name="Itemstock[p_sub_category_id]" id="Itemstock_sub_category_id" class="form-control select2">
                                    <option value="">--Select--</option>
                                </select>
                            </div>
<!--                            <div class='col-md-2'>
                                <label>Item</label>     
                                <select id="Itemstock_item_id" name="Itemstock[item_id]" class="form-control select2">
                                    <option value="">Select</option>
                                </select>
                            </div>-->
                        </div> 
                         <div class='col-md-1'>
                            <label>Indent</label>
                            <select name="indent_type" id="indent_type" class="form-control">
                                <?php foreach(Utils::indenttype() as $k=>$v){
                                if(Yii::app()->request->getPost('indent_type')==$k){
                                ?>
                                <option value="<?php echo $k?>" selected><?php echo $v?></option>
                                <?php }else{?>
                                <option value="<?php echo $k?>"><?php echo $v?></option>
                                <?php }}?>
                            </select>
                        </div> 
                        <div class='col-md-1'>
                            <label>P type</label>
                            <select name="purchase_type" id="purchase_type" class="form-control">
                                <?php foreach(Utils::purchasetype() as $k=>$v){
                                if(Yii::app()->request->getPost('purchase_type')==$k){
                                ?>
                                <option value="<?php echo $k?>" selected><?php echo $v?></option>
                                <?php }else{?>
                                <option value="<?php echo $k?>"><?php echo $v?></option>
                                <?php }}?>
                            </select>
                        </div>  
                        <div class='col-md-1' style="margin-top:22px;">
                          <?php echo BsHtml::submitButton('Show Availability', array('color' => BsHtml::BUTTON_COLOR_AQUA,'id'=>'showavail')); ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                    <br/>
                      <?php
                        if (isset($_POST['Itemstock'])) {
                        $pid = $model->p_category_id;
                        $psid = $model->p_sub_category_id;
                        $item_id=$model->item_id;
                        if($_POST['choice_item']!="allitem"){
                        if($pid!="" && $psid==""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid order by id");   
                        }else if($pid!="" && $psid!=""  && $item_id==""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid and p_sub_category_id=$psid order by id");   
                        }else if($pid!="" && $psid!="" && $item_id!=""){
                         $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item where p_category_id=$pid and p_sub_category_id=$psid and id=$item_id order by id");   
                        }  
                        }else{
                        $alist = Purchaseitem::model()->findAllBySql("select * from purchase_item pi join item_stock ist on ist.item_id=pi.id where pi.itemname like '%$item_name%'order by pi.id");       
                        }
                        if (!empty($alist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('outletindent/itemevaluate'),
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
                                        $cqty=$v->getstockqty($v);
                                        ?>
                                     <tr <?php if($v->low_qty>=$cqty){ echo "style='background-color: rgb(218, 2, 2);color:#fff;'";}?>>
                                        <td width="10%"><input type="checkbox" class="allcheckedcategory" id="checked_item_<?php echo $v->id; ?>" onchange="checkeditem(<?php echo $v->id; ?>)" name="item_id[]" value="<?php echo $v->id; ?>"></td>
                                        <td width="15%"><?php echo $v->category->name; ?></td>
                                        <td width="15%"><?php echo $v->subcategory->name; ?></td>
                                        <td width="30%"><?php echo $v->itemname; ?> (<?php echo $v->item_scale; ?>)</td>
                                        <td width="10%"><?php echo $v->brand; ?></td>
                                        <td width="10%"><?php echo $v->getstockqty($v); ?></td>
                                        <td width="10%"><?php echo $v->low_qty; ?></td>
                                    </tr>    
                                    <input type="hidden" name="category_id_<?php echo $v->id; ?>" id="category_id" value="<?php echo $v->p_category_id; ?>"/>
                                    <input type="hidden" name="sub_category_id_<?php echo $v->id; ?>" id="sub_category_id" value="<?php echo $v->p_sub_category_id; ?>"/>
                                    <input type="hidden" name="item_id_<?php echo $v->id; ?>" id="item_id_<?php echo $v->id; ?>" value="<?php echo $v->id; ?>"/>
                                    <input type="hidden" name="item_name_<?php echo $v->id; ?>" id="item_name_<?php echo $v->id; ?>" value="<?php echo $v->itemname; ?>"/>
                                    <input type="hidden" name="item_brand_<?php echo $v->id; ?>" id="item_brand_<?php echo $v->id; ?>" value="<?php echo $v->brand; ?>"/>
                                    <input type="hidden" name="stock_taking_scale_<?php echo $v->id; ?>" id="stock_taking_scale_<?php echo $v->id; ?>" value="<?php echo $v->item_scale; ?>"/>
                                    <?php
                                    $c++;
                                    }
                                ?>
                                    <input type="hidden" name="choice_item" id="choice_item" value="<?php echo $_POST['choice_item']; ?>"/>
                                    <input type="hidden" name="indent_type" id="indent_type" value="<?php echo $_POST['indent_type']; ?>"/>
                                    <input type="hidden" name="purchase_type" id="purchase_type" value="<?php echo $_POST['purchase_type']; ?>"/>
                                    <input type="hidden" name="p_category_id" id="p_category_id" value="<?php echo $model->p_category_id; ?>"/>
                                    <input type="hidden" name="p_sub_category_id" id="p_sub_category_id" value="<?php echo $model->p_sub_category_id; ?>"/>
                                    <input type="hidden" name="id" value="<?php echo $id?>"/>
                                </tbody>
                            </table>
                              </div><br/>
                            <input type="submit" id="indentproceed_part1" name="evaluate" value="Proceed &gt;&gt;" class="btn btn-aqua pull-right" />         
                            <?php $this->endWidget(); ?>
                        <?php }} ?>               
                </div>
            </div>
                <?php
                 $uid=Yii::app()->user->id;
                 if(!empty($id)){
                 $pcimodel=Indentmaster::model()->findBySql("select * from internal_indent_master where id=$id and is_indenting_done=0");        
                 }else{
                 $pcimodel=Indentmaster::model()->findBySql("select * from internal_indent_master where created_by=$uid and is_indenting_done=0 order by id desc limit 1");            
                 }
                ?>
                <div class="box">
                <div class="box-header bg-aqua">
                    <h3 class="panel-title">Internal Indent List <?php if(!empty($pcimodel->sync_id)){ ?> (Indent No : <?php echo $pcimodel->sync_id;?>) <?php }?></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="height:350px;overflow-y:scroll;">
                 <?php
                       if(!empty($pcimodel->id)){    
                        $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$pcimodel->sync_id' order by id desc");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('outletindent/indentcomplete'),
                            ));
                            ?>
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>            
                                        <th>Item Purpose</th>            
                                        <th>R.Qty</th>            
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
                                            <td width="30%"><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                            <td width="20%"><?php echo $v->item_brand; ?></td>
                                            <td width="15%">
                                            <select name="item_purpose_<?php echo $v->id?>" class="form-control" id="item_purpose_<?php echo $v->id?>">
                                                <?php
                                                foreach (Utils::itempurpose() as $k => $vs) {
                                                        ?>
                                                     <option value="<?php echo $k ?>"><?php echo $vs ?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                            </td>                                            
                                            <td width="10%"><input type="text" name="qty_required_<?php echo $v->id?>"  class="form-control" size="4" value="<?php echo $v->qty_required; ?>"></td>
                                            <td width="20%"> <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'name' => 'req_date_'.$v->id,
                                                'id' => 'req_date_'.$v->id,
                                                'value' => $v->req_date,
                                                'options' => array(
                                                    'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
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
                            <input type="submit" id="save_indent" name="evaluate" value="Finish Indent &gt;&gt;" class="btn btn-aqua pull-right" />         
                            <?php $this->endWidget(); ?>
                 <?php }} ?>
                             </div>
                    <br/>
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
    <?php if(Yii::app()->request->getPost('choice_item')=="allitem") {?>
            $("#itemwise_select").hide();
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
          $.getJSON("<?php echo $this->createUrl('outletindent/checkitemexist'); ?>", {"itemid": id}, function(data) { 
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
     function deleteitem(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('outletindent/deleteitem') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                location.reload();
            }
        });
    }
</script>