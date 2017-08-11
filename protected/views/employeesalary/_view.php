<?php
/* @var $this EmployeesalaryController */
/* @var $data Employeesalary */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee_id')); ?>:</b>
	<?php echo CHtml::encode($data->employee_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month')); ?>:</b>
	<?php echo CHtml::encode($data->month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_mode')); ?>:</b>
	<?php echo CHtml::encode($data->payment_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_no')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('total_present_days')); ?>:</b>
	<?php echo CHtml::encode($data->total_present_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_absent_days')); ?>:</b>
	<?php echo CHtml::encode($data->total_absent_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_leave_days')); ?>:</b>
	<?php echo CHtml::encode($data->total_leave_days); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('advance')); ?>:</b>
	<?php echo CHtml::encode($data->advance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('insentive')); ?>:</b>
	<?php echo CHtml::encode($data->insentive); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ta')); ?>:</b>
	<?php echo CHtml::encode($data->ta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('da')); ?>:</b>
	<?php echo CHtml::encode($data->da); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hra')); ?>:</b>
	<?php echo CHtml::encode($data->hra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('salary_deduction')); ?>:</b>
	<?php echo CHtml::encode($data->salary_deduction); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reamark')); ?>:</b>
	<?php echo CHtml::encode($data->reamark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_salary')); ?>:</b>
	<?php echo CHtml::encode($data->total_salary); ?>
	<br />

	*/ ?>

</div>