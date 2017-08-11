<?php
$this->breadcrumbs = array(
    'Home' => array('site/cpsdashboard'),
    'Inventory Management',
    'Indent Review',
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
                    <h3 class="panel-title">Indent Review</h3>
                </div>
                <div class="panel-body">
                    <div class='row'> 
                <div class="panel-body">
                    <div class="table-responsive">
                 <?php
                       if(!empty($model)){    
                        $ilist = Purchaseindent::model()->findAllBySql("select * from purchase_indent where indent_id=$model->id order by id desc");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('purchaseindentmaster/indentupdate'),
                            ));
                            ?>
                            <input type="hidden" name="indent_id" value="<?php echo $model->id?>"/> 
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
                            </div><br/>
                            <a href="<?php echo $this->createUrl('purchaseindentmaster/additemindent',array("id"=>$id)); ?>" class="btn btn-green">Add Item</a>
                            <input type="submit" name="updateindent" value="Update" class="btn btn-green" />         
                            <input type="submit" name="generateorder" value="Generate Indent" class="btn btn-green" />         
                            <?php $this->endWidget(); ?>
                 <?php }} ?>
                </div>
                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
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