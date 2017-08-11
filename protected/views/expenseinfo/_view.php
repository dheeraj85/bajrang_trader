<?php
/* @var $this ExpenseinfoController */
/* @var $data Expenseinfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_head_id')); ?>:</b>
	<?php echo CHtml::encode($data->expense_head_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_no')); ?>:</b>
	<?php echo CHtml::encode($data->reg_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particular')); ?>:</b>
	<?php echo CHtml::encode($data->particular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_no')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_date')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	*/ ?>

</div>