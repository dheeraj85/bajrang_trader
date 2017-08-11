<?php
/* @var $this MenuitemsController */
/* @var $data Menuitems */
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('barcode')); ?>:</b>
	<?php echo CHtml::encode($data->barcode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemname')); ?>:</b>
	<?php echo CHtml::encode($data->itemname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('brand')); ?>:</b>
	<?php echo CHtml::encode($data->brand); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_image')); ?>:</b>
	<?php echo CHtml::encode($data->item_image); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('item_unit')); ?>:</b>
	<?php echo CHtml::encode($data->item_unit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_scale')); ?>:</b>
	<?php echo CHtml::encode($data->item_scale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('specification')); ?>:</b>
	<?php echo CHtml::encode($data->specification); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_price')); ?>:</b>
	<?php echo CHtml::encode($data->unit_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	*/ ?>

</div>