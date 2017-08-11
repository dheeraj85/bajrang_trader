<?php
/* @var $this ItemledgerController */
/* @var $data Itemledger */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stock_type')); ?>:</b>
	<?php echo CHtml::encode($data->stock_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit_qty')); ?>:</b>
	<?php echo CHtml::encode($data->debit_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_qty')); ?>:</b>
	<?php echo CHtml::encode($data->credit_qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance_qty')); ?>:</b>
	<?php echo CHtml::encode($data->balance_qty); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>