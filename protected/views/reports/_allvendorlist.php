<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-left">Name</th>
            <th class="text-left">Firm Name</th>                            
            <th class="text-left">TIN No</th>
            <th class="text-left">Mobile</th>
            <th class="text-left">Email</th>
            <th class="text-right">Balance</th>
            <th class="text-right">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($data['data']) { ?>
            <?php foreach ($data['data'] as $order) { ?>
                <tr>
                    <td class="text-left"><?php echo strtoupper($order['name']); ?></td>
                    <td class="text-left"><?php echo strtoupper($order['firmname']); ?></td>
                    <td class="text-left"><?php echo $order['tinno']; ?></td>
                    <td class="text-left"><?php echo $order['mobile']; ?></td>
                    <td class="text-left"><?php echo $order['email']; ?></td>
                    <td class="text-right"><?php echo $order['balance']; ?></td>
                    <td class="text-right"><a href="<?php echo $this->createUrl('voucher/create',array("receiver_type"=>'vendor',"id"=>2,"receiver_id"=>$order['id'])) ?>" class="btn btn-green">Pay Now</a></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td class="text-center" colspan="6"><?php echo $data['text_no_results']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>