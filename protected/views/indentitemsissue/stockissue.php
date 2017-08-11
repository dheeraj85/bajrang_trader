<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Indents',
    'GPU Inventory',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-red">
                    <h3 class="panel-title pull-left">GPU Inventory</h3>
                </div>
                <div class="panel-body">
                    <div class='row'> 
                        <div class="panel-body">
                            <div class="table-responsive">
                                <?php
                                if (!empty($model)) {
                                    $item_list = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' and dispatch_date!='' order by id desc");
                                    if (!empty($item_list)) {
                                        ?>
                                        <table class='table table-bordered table-responsive'>
                                            <thead>
                                                <tr>
                                                    <th>Item with Scale</th>
                                                    <th>Brand</th>                                                                 
                                                    <th>Qty. in Stock</th>  
                                                    <th>
                                                    <label>Dispatch Date <a class="update" data-title="Details" title="" data-toggle="tooltip" 
                                                    data-original-title="Kindly note dispatch date will be criteria  for issuing item for production, treat dispatch/receiving date as MRD date."><b>?</b></a>
                                                    </label>
                                                    </th>   
                                                    <th>Action</th>                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $c = 1;
                                                foreach ($item_list as $v) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $v->item_name; ?> (<?php echo $v->qty_scale; ?>)</td>
                                                        <td><?php echo $v->item_brand; ?></td>
                                                        <td> <?php echo $v->qty_for_sale; ?></td>  
                                                        <td> <?php echo $v->dispatch_date; ?></td>
                                                        <td> 
                                                            <?php if ($v->item_accepted_by_pos == 1) {
                                                                if($v->qty_for_sale>0){
                                                                ?>
                                                                <a href='#' onclick="issueitem(<?php echo $v->id; ?>)" class="btn btn-green">Issue Item</a>
                                                            <?php }} ?>  
                                                        </td>
                                                    </tr>    
                                                    <?php
                                                    $c++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                    }
                                }
                                ?>
                                 </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="IssueItemModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="itemname">Item Issue</h4>                            
                        </div>
                        <div id="error_field" class="alert bg-red" style="display:none;"></div>  
                        <div class="modal-body">
                            <?php
                            $model1 = new Indentitemsissue();
                            $form1 = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'id' => 'issueitemform',
                            ));
                            ?>
                            <input type="hidden" id="internal_id" name="internal_id">
                            <div class='row'> 
                                <div class='col-md-6'>
                                    <label>Issue Quantity</label>
                                    <?php echo $form1->textField($model1, 'issue_qty', array('maxlength' => 100,'placeholder'=>'Issue Quantity')); ?>
                                </div>
                                <div class='col-md-6'>
                                    <label>Issue Date</label>
                                 <?php
                                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name' => 'issue_date',
                                        'id' => 'issue_date',
                                        'value' => $model1->issue_date,
                                        'options' => array(
                                            'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                                        ),
                                        'htmlOptions' => array(
                                            'style' => '',
                                            //'readonly' => 'readonly'
                                            'placeholder' => 'Issue Date', 'class' => 'form-control',
                                        ),
                                    ));
                                    ?>
                                </div>
                            </div><br/>
                            <div class='row'> 
                                <div class='col-md-12'>
                                    <label>Issue Purpose</label>
                                    <?php echo $form1->textArea($model1, 'issue_purpose', array('maxlength' => 100,'placeholder'=>'Issue Purpose')); ?>
                                </div>
                            </div><br/>
                            <div class="form-group">
                                <button type="button" id="issueitem" class="btn btn-green">Issue</button>
                            </div>
                            <?php $this->endWidget(); ?>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#issueitem").click(function(){
      var form = $('#issueitemform').serialize();       
      if($("#Indentitemsissue_issue_qty").val()==""){
        $("#error_field").show();
        $("#error_field").html("Qty Required"); 
            return false;
         }else{
             $("#error_field").html("");
         }  
      if($("#issue_date").val()==""){
        $("#error_field").show();
        $("#error_field").html("Issue Date Required"); 
            return false;
         }else{
             $("#error_field").html("");
         } 
        //$("#issueitem").attr('disabled', 'disabled').html("Submiting...");
        $.ajax({
            url: '<?php echo $this->createUrl('indentitemsissue/issueitem') ?>',
            data: form+'&YII_CSRF_TOKEN=<?php echo Yii::app()->request->csrfToken; ?>',
            type: 'post',
            cache: false,
            success: function(response) {
             if(response=="1"){
                $("#issueitem").removeAttr('disabled').html('Issue');
                $('#issueitemform')[0].reset();
                window.location.reload();
            }
            else{
                alert("Issue Qty can\'t be greater than Available Qty");
            }
            }
        });
    });
});
function issueitem(id) {
    $("#internal_id").val(id);
    $("#IssueItemModal").modal('show');
}
</script>