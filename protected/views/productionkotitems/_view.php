<?php
/* @var $this ProductionkotitemsController */
/* @var $data Productionkotitems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('production_kot_id')); ?>:</b>
	<?php echo CHtml::encode($data->production_kot_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_item_id')); ?>:</b>
	<?php echo CHtml::encode($data->menu_item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qty')); ?>:</b>
	<?php echo CHtml::encode($data->qty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>