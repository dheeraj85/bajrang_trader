<?php
/* @var $this ItemstockController */
/* @var $data Itemstock */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particulars')); ?>:</b>
	<?php echo CHtml::encode($data->particulars); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_qty')); ?>:</b>
	<?php echo CHtml::encode($data->stock_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_taking_scale')); ?>:</b>
	<?php echo CHtml::encode($data->stock_taking_scale); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_mrd')); ?>:</b>
	<?php echo CHtml::encode($data->is_mrd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mrd_no')); ?>:</b>
	<?php echo CHtml::encode($data->mrd_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('make_date')); ?>:</b>
	<?php echo CHtml::encode($data->make_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ready_date')); ?>:</b>
	<?php echo CHtml::encode($data->ready_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discard_date')); ?>:</b>
	<?php echo CHtml::encode($data->discard_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	*/ ?>

</div>