<?php
$this->breadcrumbs = array(
    'Home' => array('site/gpudashboard'),
    'Internal Indent',
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
                <div class="box-header bg-red">
                    <h3 class="panel-title">Indent Review</h3>
                </div>
                <div class="panel-body">
                    <div class='row'> 
                <div class="panel-body">
                    <div class="table-responsive">
                 <?php
                       if(!empty($model)){    
                        $ilist = Indentitems::model()->findAllBySql("select * from internal_indent_items where sync_id='$model->sync_id' order by id desc");   
                        //$list = Itemstock::model()->findAllByAttributes(array("p_category_id" => $model->p_category_id, "p_sub_category_id" => $model->p_sub_category_id));
                        if (!empty($ilist)) {
                            ?>
                            <br/>
                            <?php
                            $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
                                'enableAjaxValidation' => false,
                                'action' => $this->createUrl('indentmaster/indentupdate'),
                            ));
                            ?>
                            <input type="hidden" name="sync_id" value="<?php echo $model->sync_id?>"/> 
                            <table class='table table-bordered'>
                                <thead>
                                    <tr>
                                        <th>Item with Scale</th>
                                        <th>Brand</th>            
                                        <th>Item Purpose</th>            
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
                                        <input type="hidden" name="id" value="<?php echo $model->id;?>"/>
                                </tbody>
                            </table>                          
                            <a href="<?php echo $this->createUrl('indentmaster/additemindent',array("id"=>$model->id)); ?>" class="btn btn-red">Add Item</a>
                            <input type="submit" name="updateindent" value="Update" class="btn btn-red" />         
                            <input type="submit" name="generateorder" value="Generate Order" class="btn btn-red" />         
                            <?php $this->endWidget(); ?>
                 <?php }} ?>
                              </div><br/>
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
            url: '<?php echo $this->createUrl('indentmaster/deleteitem') ?>',
            data: {'id': id, 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            type: 'post',
            success: function(response) {
                location.reload();
            }
        });
    }
</script>