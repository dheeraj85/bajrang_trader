<?php
/* @var $this ChallanController */
/* @var $data Challan */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('challan_no')); ?>:</b>
	<?php echo CHtml::encode($data->challan_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('challan_date')); ?>:</b>
	<?php echo CHtml::encode($data->challan_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purchase_order_id')); ?>:</b>
	<?php echo CHtml::encode($data->purchase_order_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ex_station')); ?>:</b>
	<?php echo CHtml::encode($data->ex_station); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_wagon_no')); ?>:</b>
	<?php echo CHtml::encode($data->truck_wagon_no); ?>
	<br />


</div>