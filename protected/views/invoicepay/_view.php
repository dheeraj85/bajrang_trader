<?php
/* @var $this InvoicepayController */
/* @var $data Invoicepay */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymode')); ?>:</b>
	<?php echo CHtml::encode($data->paymode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cheque_dd_txn_no')); ?>:</b>
	<?php echo CHtml::encode($data->cheque_dd_txn_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bankname')); ?>:</b>
	<?php echo CHtml::encode($data->bankname); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('branch')); ?>:</b>
	<?php echo CHtml::encode($data->branch); ?>
	<br />

	*/ ?>

</div>