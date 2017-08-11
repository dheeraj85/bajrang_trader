<?php
/* @var $this BankdetailsController */
/* @var $data Bankdetails */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_no')); ?>:</b>
	<?php echo CHtml::encode($data->account_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_holder')); ?>:</b>
	<?php echo CHtml::encode($data->account_holder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_name')); ?>:</b>
	<?php echo CHtml::encode($data->bank_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ifsc')); ?>:</b>
	<?php echo CHtml::encode($data->ifsc); ?>
	<br />


</div>