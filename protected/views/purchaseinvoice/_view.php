<?php
/* @var $this PurchaseinvoiceController */
/* @var $data Purchaseinvoice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_no')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_date')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('received_by')); ?>:</b>
	<?php echo CHtml::encode($data->received_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_added_to_stock')); ?>:</b>
	<?php echo CHtml::encode($data->is_added_to_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reviewed')); ?>:</b>
	<?php echo CHtml::encode($data->is_reviewed); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('review_point')); ?>:</b>
	<?php echo CHtml::encode($data->review_point); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review_desc')); ?>:</b>
	<?php echo CHtml::encode($data->review_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>