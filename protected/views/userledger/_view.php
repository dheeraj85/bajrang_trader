<?php
/* @var $this UserledgerController */
/* @var $data Userledger */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit_amt')); ?>:</b>
	<?php echo CHtml::encode($data->debit_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_amt')); ?>:</b>
	<?php echo CHtml::encode($data->credit_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('balance_amt')); ?>:</b>
	<?php echo CHtml::encode($data->balance_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>