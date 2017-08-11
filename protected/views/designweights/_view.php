<?php
/* @var $this DesignweightsController */
/* @var $data Designweights */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('design_id')); ?>:</b>
	<?php echo CHtml::encode($data->design_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight_for_design')); ?>:</b>
	<?php echo CHtml::encode($data->weight_for_design); ?>
	<br />


</div>