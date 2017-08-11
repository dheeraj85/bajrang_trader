<?php
/* @var $this ExpenseinvoiceitemsController */
/* @var $data Expenseinvoiceitems */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::encode($data->item_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('goods_service')); ?>:</b>
	<?php echo CHtml::encode($data->goods_service); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hsn_sac_code')); ?>:</b>
	<?php echo CHtml::encode($data->hsn_sac_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_hsn_sac_code')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_hsn_sac_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_tax_percent')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_tax_percent); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('unmatched_code')); ?>:</b>
	<?php echo CHtml::encode($data->unmatched_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reverse_charge')); ?>:</b>
	<?php echo CHtml::encode($data->is_reverse_charge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reverse_item')); ?>:</b>
	<?php echo CHtml::encode($data->is_reverse_item); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particulars')); ?>:</b>
	<?php echo CHtml::encode($data->particulars); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?>:</b>
	<?php echo CHtml::encode($data->discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_tax_type')); ?>:</b>
	<?php echo CHtml::encode($data->item_tax_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_percent_rate')); ?>:</b>
	<?php echo CHtml::encode($data->tax_percent_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_amt')); ?>:</b>
	<?php echo CHtml::encode($data->tax_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cess_rate')); ?>:</b>
	<?php echo CHtml::encode($data->cess_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cess_amt')); ?>:</b>
	<?php echo CHtml::encode($data->cess_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ut_rate')); ?>:</b>
	<?php echo CHtml::encode($data->ut_rate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ut_amt')); ?>:</b>
	<?php echo CHtml::encode($data->ut_amt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
	<?php echo CHtml::encode($data->is_active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_added_to_stock')); ?>:</b>
	<?php echo CHtml::encode($data->is_added_to_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_good_return')); ?>:</b>
	<?php echo CHtml::encode($data->is_good_return); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_choice_tax')); ?>:</b>
	<?php echo CHtml::encode($data->is_choice_tax); ?>
	<br />

	*/ ?>

</div>