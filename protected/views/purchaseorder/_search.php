<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

<div class='row'>  
    <div class='col-md-3'>     
     <?php echo $form->textFieldControlGroup($model,'order_no'); ?> 
    </div>
        <div class='col-md-3'>
        <label>Order Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Purchaseorder[order_date]',
            'id' => 'Purchaseorder_order_date',
            'value'=>$model->order_date,
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
    <div class='col-md-3'>    
        <label class="control-label" for="input-order-status">Order Status</label>
        <select name="Purchaseorder[is_po_supplied]" id="Purchaseorder_is_po_supplied" class="form-control">
            <option value="0" <?php if ($model->order_status == 0) echo "selected"; ?>>Pending</option>
            <option value="1" <?php if ($model->order_status == 1) echo "selected"; ?>>Honoured</option>
        </select>
    </div>
    <div class='col-md-3' style="margin-top:23px;">
    <button type="submit" id="button-filter" class="btn btn-green"><i class="fa fa-search"></i> Filter</button>
</div>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>