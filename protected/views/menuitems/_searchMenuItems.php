<?php
/* @var $this ShelfitemsController */
/* @var $model Shelfitems */
/* @var $form BSActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

<!--<div class="row">
    <div class="col-lg-6">
    <?php //echo $form->textFieldControlGroup($model,'p_category_id'); ?>
    <?php //echo $form->textFieldControlGroup($model,'p_sub_category_id'); ?>
    <?php //echo $form->textFieldControlGroup($model,'item_name',array('placeholder'=>'Enter Item name to search')); ?>       
    </div>
      <div class="col-lg-6">
          <label>&nbsp;</label> <br>
         <?php //echo BsHtml::submitButton('Search',  array('color' => BsHtml::BUTTON_COLOR_PRIMARY,));?>
          <a href="<?php// echo $this->createUrl('supply/exportdispatchlist'); ?>" class="btn btn-green" target="_blank"><i class='fa fa-download'></i> Export List</a>
    </div>
</div>-->
    
<?php $this->endWidget(); ?>


