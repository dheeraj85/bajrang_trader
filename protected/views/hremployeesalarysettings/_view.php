<?php
/* @var $this HremployeesalarysettingsController */
/* @var $data Hremployeesalarysettings */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_ctc')); ?>:</b>
	<?php echo CHtml::encode($data->total_ctc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('per_day_ctc')); ?>:</b>
	<?php echo CHtml::encode($data->per_day_ctc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pf_deduction')); ?>:</b>
	<?php echo CHtml::encode($data->pf_deduction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other_deduction')); ?>:</b>
	<?php echo CHtml::encode($data->other_deduction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hra')); ?>:</b>
	<?php echo CHtml::encode($data->hra); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('earned_leaves')); ?>:</b>
	<?php echo CHtml::encode($data->earned_leaves); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lwp')); ?>:</b>
	<?php echo CHtml::encode($data->lwp); ?>
	<br />

	*/ ?>

</div>