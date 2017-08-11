<?php
/* @var $this KataparchyController */
/* @var $data Kataparchy */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('challan_id')); ?>:</b>
	<?php echo CHtml::encode($data->challan_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('order_no')); ?>:</b>
	<?php echo CHtml::encode($data->order_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_name')); ?>:</b>
	<?php echo CHtml::encode($data->item_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_code')); ?>:</b>
	<?php echo CHtml::encode($data->item_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('load_weight')); ?>:</b>
	<?php echo CHtml::encode($data->load_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('net_weight')); ?>:</b>
	<?php echo CHtml::encode($data->net_weight); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_wagon_no')); ?>:</b>
	<?php echo CHtml::encode($data->truck_wagon_no); ?>
	<br />

	*/ ?>

</div>