<?php
/* @var $this VouchertypeController */
/* @var $data Vouchertype */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_name')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_receiver_type')); ?>:</b>
	<?php echo CHtml::encode($data->payment_receiver_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('voucher_nature')); ?>:</b>
	<?php echo CHtml::encode($data->voucher_nature); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>