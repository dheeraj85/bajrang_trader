<?php
/* @var $this CalculatepayoutController */
/* @var $data Calculatepayout */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kata_parchy_id')); ?>:</b>
	<?php echo CHtml::encode($data->kata_parchy_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('load_wgt')); ?>:</b>
	<?php echo CHtml::encode($data->load_wgt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_mode')); ?>:</b>
	<?php echo CHtml::encode($data->payment_mode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('payment_date')); ?>:</b>
	<?php echo CHtml::encode($data->payment_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('c_number_t_num_utr_num')); ?>:</b>
	<?php echo CHtml::encode($data->c_number_t_num_utr_num); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_no')); ?>:</b>
	<?php echo CHtml::encode($data->account_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bank_card_name')); ?>:</b>
	<?php echo CHtml::encode($data->bank_card_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remark')); ?>:</b>
	<?php echo CHtml::encode($data->remark); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dated')); ?>:</b>
	<?php echo CHtml::encode($data->dated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_paid')); ?>:</b>
	<?php echo CHtml::encode($data->is_paid); ?>
	<br />

	*/ ?>

</div>