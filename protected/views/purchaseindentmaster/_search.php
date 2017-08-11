<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
<div class='row'>  
    <div class='col-md-3'>     
     <?php echo $form->textFieldControlGroup($model,'id'); ?> 
    </div>
    <div class='col-md-3'>
        <label>Indent Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'Purchaseindentmaster[indend_date]',
            'id' => 'Purchaseindentmaster_indend_date',
            'value'=>$model->indend_date,
            'options' => array(
                'dateFormat' => 'yy-mm-dd', 'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
            ),
            'htmlOptions' => array(
                'style' => '',
                //'readonly' => 'readonly'
                'placeholder' => 'Indent Date', 'class' => 'form-control',
            ),
        ));
        ?>
    </div>
    <div class='col-md-3'>    
        <label class="control-label" for="input-order-status">Status</label>
        <select name="Purchaseindentmaster[is_done]" id="Purchaseindentmaster_is_done" class="form-control">
            <option value="0" <?php if ($model->is_done == 0) echo "selected"; ?>>Indenting</option>
            <option value="1" <?php if ($model->is_done == 1) echo "selected"; ?>>Review</option>
            <option value="2" <?php if ($model->is_done == 2) echo "selected"; ?>>Finished</option>
        </select>
    </div>
    <div class='col-md-3' style="margin-top:23px;">
    <button type="submit" id="button-filter" class="btn btn-green"><i class="fa fa-search"></i> Filter</button>
    </div>
</div>
<div style="clear:both"></div><br/>
<?php $this->endWidget(); ?>