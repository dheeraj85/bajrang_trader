<?php
/* @var $this BillController */
/* @var $data Bill */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_no')); ?>:</b>
	<?php echo CHtml::encode($data->bill_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_date')); ?>:</b>
	<?php echo CHtml::encode($data->bill_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_from_date')); ?>:</b>
	<?php echo CHtml::encode($data->bill_from_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_to_date')); ?>:</b>
	<?php echo CHtml::encode($data->bill_to_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_order_id')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_order_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bill_type')); ?>:</b>
	<?php echo CHtml::encode($data->bill_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('print_type')); ?>:</b>
	<?php echo CHtml::encode($data->print_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added_on')); ?>:</b>
	<?php echo CHtml::encode($data->added_on); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particulars')); ?>:</b>
	<?php echo CHtml::encode($data->particulars); ?>
	<br />

	*/ ?>

</div>