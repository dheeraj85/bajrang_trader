<?php
/* @var $this PostaxesController */
/* @var $data Postaxes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_name')); ?>:</b>
	<?php echo CHtml::encode($data->tax_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_percent')); ?>:</b>
	<?php echo CHtml::encode($data->tax_percent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>