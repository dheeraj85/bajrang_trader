<?php
/* @var $this ProductionkotController */
/* @var $data Productionkot */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kot_no')); ?>:</b>
	<?php echo CHtml::encode($data->kot_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kot_date')); ?>:</b>
	<?php echo CHtml::encode($data->kot_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deliver_by')); ?>:</b>
	<?php echo CHtml::encode($data->deliver_by); ?>
	<br />


</div>