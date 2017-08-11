<?php
/* @var $this ProductionkotcommentsController */
/* @var $data Productionkotcomments */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('production_kot_id')); ?>:</b>
	<?php echo CHtml::encode($data->production_kot_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('from_id')); ?>:</b>
	<?php echo CHtml::encode($data->from_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('to_id')); ?>:</b>
	<?php echo CHtml::encode($data->to_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />


</div>