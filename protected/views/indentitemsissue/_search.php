<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
        ));
?>
<div class='row'>
    <div class='col-md-3'>
        <label>From Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'from_date',
            'id' => 'from_date',
            'value'=>isset(Yii::app()->request->cookies['from_date']->value)?Yii::app()->request->cookies['from_date']->value:"",
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
    <div class='col-md-3'>
        <label>To Date</label>
        <?php
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'name' => 'to_date',
            'id' => 'to_date',
            'value'=>isset(Yii::app()->request->cookies['to_date']->value)?Yii::app()->request->cookies['to_date']->value:"",
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
        <label>Category</label>
        <?php echo $form->dropDownList($model, 'p_category_id', CHtml::listData(Purchasecategory::model()->findAllByAttributes(array("type"=>'Purchase')), 'id', 'name'), array('class' => 'form-control', 'empty' => '--Select--')); ?>
    </div>
    <div class='col-md-3' style="margin-top:22px;">     
    <button type="submit" id="button-filter" class="btn btn-red"><i class="fa fa-search"></i> Filter</button>
    </div>
</div>
<br/>
<?php $this->endWidget(); ?>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    <?php if (!empty($model->p_category_id) && !empty($model->p_sub_category_id)) { ?>
        var scid =<?php echo $model->p_sub_category_id?>;
        var cid = <?php echo $model->p_category_id?>;
        GetSCategory(cid, scid,'Purchase');
    <?php }?>  
                
    $("#Indentitemsissue_p_category_id").change(function() {
            var scid = 0;
            var cid = $(this).val();
            GetSCategory(cid, scid,'Purchase');
     });
 });  
       function GetSCategory(cid, scid,type) {
        $("#Indentitemsissue_sub_category_id").html("");
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
            $("#Indentitemsissue_sub_category_id").html(content);
        });
    }
</script>