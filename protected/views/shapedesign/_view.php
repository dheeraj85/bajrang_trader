<?php
/* @var $this ShapedesignController */
/* @var $data Shapedesign */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shape_id')); ?>:</b>
	<?php echo CHtml::encode($data->shape_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('design_name')); ?>:</b>
	<?php echo CHtml::encode($data->design_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('design_img')); ?>:</b>
	<?php echo CHtml::encode($data->design_img); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('design_description')); ?>:</b>
	<?php echo CHtml::encode($data->design_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('design_added_by')); ?>:</b>
	<?php echo CHtml::encode($data->design_added_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('added_by_id')); ?>:</b>
	<?php echo CHtml::encode($data->added_by_id); ?>
	<br />


</div>