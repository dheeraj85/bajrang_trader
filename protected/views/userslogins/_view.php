<?php
/* @var $this UsersloginsController */
/* @var $data Userslogins */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_type')); ?>:</b>
	<?php echo CHtml::encode($data->log_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('in_out')); ?>:</b>
	<?php echo CHtml::encode($data->in_out); ?>
	<br />


</div>