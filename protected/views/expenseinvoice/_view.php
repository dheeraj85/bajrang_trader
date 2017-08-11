<?php
/* @var $this ExpenseinvoiceController */
/* @var $data Expenseinvoice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense_heads_id')); ?>:</b>
	<?php echo CHtml::encode($data->expense_heads_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_type')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gstin_no')); ?>:</b>
	<?php echo CHtml::encode($data->gstin_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_gstn_compliant')); ?>:</b>
	<?php echo CHtml::encode($data->is_gstn_compliant); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('compliants_category')); ?>:</b>
	<?php echo CHtml::encode($data->compliants_category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_of_supply')); ?>:</b>
	<?php echo CHtml::encode($data->place_of_supply); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('state_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_no')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_date')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_name')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vendor_id')); ?>:</b>
	<?php echo CHtml::encode($data->vendor_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('received_by')); ?>:</b>
	<?php echo CHtml::encode($data->received_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discount_type')); ?>:</b>
	<?php echo CHtml::encode($data->discount_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_amount')); ?>:</b>
	<?php echo CHtml::encode($data->total_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_discount')); ?>:</b>
	<?php echo CHtml::encode($data->total_discount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('round_off')); ?>:</b>
	<?php echo CHtml::encode($data->round_off); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_added_to_stock')); ?>:</b>
	<?php echo CHtml::encode($data->is_added_to_stock); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_reviewed')); ?>:</b>
	<?php echo CHtml::encode($data->is_reviewed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review_point')); ?>:</b>
	<?php echo CHtml::encode($data->review_point); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('review_desc')); ?>:</b>
	<?php echo CHtml::encode($data->review_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_wagon_no')); ?>:</b>
	<?php echo CHtml::encode($data->truck_wagon_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('truck_wagon_owner_name')); ?>:</b>
	<?php echo CHtml::encode($data->truck_wagon_owner_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_name')); ?>:</b>
	<?php echo CHtml::encode($data->driver_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_contact')); ?>:</b>
	<?php echo CHtml::encode($data->driver_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_lic_no')); ?>:</b>
	<?php echo CHtml::encode($data->driver_lic_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rr_no')); ?>:</b>
	<?php echo CHtml::encode($data->rr_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transport_name')); ?>:</b>
	<?php echo CHtml::encode($data->transport_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dispatch_from')); ?>:</b>
	<?php echo CHtml::encode($data->dispatch_from); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dispatch_to')); ?>:</b>
	<?php echo CHtml::encode($data->dispatch_to); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crossing')); ?>:</b>
	<?php echo CHtml::encode($data->crossing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_by')); ?>:</b>
	<?php echo CHtml::encode($data->created_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_by')); ?>:</b>
	<?php echo CHtml::encode($data->updated_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>