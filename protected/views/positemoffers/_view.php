<?php
/* @var $this PositemoffersController */
/* @var $data Positemoffers */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offer_dscount')); ?>:</b>
	<?php echo CHtml::encode($data->offer_dscount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('offer_description')); ?>:</b>
	<?php echo CHtml::encode($data->offer_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_date')); ?>:</b>
	<?php echo CHtml::encode($data->from_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_date')); ?>:</b>
	<?php echo CHtml::encode($data->to_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>