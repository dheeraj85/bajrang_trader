<?php
/* @var $this ShelfitemsController */
/* @var $data Shelfitems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('p_sub_category_id')); ?>:</b>
	<?php echo CHtml::encode($data->p_sub_category_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode')); ?>:</b>
	<?php echo CHtml::encode($data->barcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_type')); ?>:</b>
	<?php echo CHtml::encode($data->tax_type); ?>
	<br />


</div>