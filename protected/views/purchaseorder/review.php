<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management',
    'Purchase Order Review',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Itemstock', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Itemstock', 'url' => array('create')),
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-green">
                    <h3 class="panel-title">Purchase Order Review (<?php echo $model->order_no?> | Vendor : <?php echo $model->vendor->name;?> (<?php echo $model->vendor->firm_name;?>))</h3>
                </div>
                <div class="panel-body">
                    <div class='row'> 
                <div class="panel-body">
                    <div class="table-responsive">
                 <?php
                        if (!empty($ilist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('purchaseorder/orderupdate'),
                            ));
                            ?>
                            <input type="hidden" name="purchase_order_id" value="<?php echo $model->id?>"/> 
                            <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Item with Scale</th>
                                            <th>Brand</th>            
                                            <th>Q.R.</th>            
                                            <th>R.Date</th>  
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($ilist as $vs) {
                                            ?>
                                            <tr>
                                                <td width="50%"><?php echo $vs->item_name ?> (<?php echo $vs->qty_scale; ?>)</td>
                                                <td width="15%"><?php echo $vs->item_brand ?></td>
                                                <td width="15%"><input type="text" name="qty_req_<?php echo $vs->id?>"  size="4" value="<?php echo $vs->qty_req; ?>"></td>
                                                <td width="20%"> <?php
                                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                                'name' => 'req_date_'.$vs->id,
                                                'id' => 'req_date_'.$vs->id,
                                                'value' => $vs->req_date,
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
                                                <td width="5%"><a onclick='deleteitem(<?php echo $vs->id ?>,<?php echo $model->supplier_id ?>)'><i class='fa fa-trash-o'></i></a></td>
                                            </tr> 
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <input type="submit" name="generateorder" value="Save & Generate Purchase Order" class="btn btn-green" />         
                            <?php $this->endWidget(); ?>
                 <?php } ?>
                </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
     function deleteitem(id) {
        $.ajax({
            url: '<?php echo $this->createUrl('purchaseorder/deleteitem') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                 location.reload();
            }
        });
    }
</script>