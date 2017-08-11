<?php
if (!empty($date)) {
    ?>
    <table class="table table-bordered">
        <thead>
        <th colspan="2" style="text-align: center;"> For Contra Safe</th>
    </thead>
    <?php
    $total = 0.00;
    $c = 0;
    foreach (Cashdrawer::model()->findAllByAttributes(array('txn_type' => 'closing', 'date' => $date)) as $closing) {
        $cash_counter = Cashcounter::model()->findByPk($closing->counter_id);
        $total = $total + $closing->final_closing;
        $c++;
        ?>
        <tr>
            <td><?php echo $cash_counter->counter_name; ?></td>
            <td><?php echo $closing->final_closing; ?></td>
        </tr>
        <?php
    }
    ?>
    <tr>
        <td><b>Consolidated Counter Closing Total</b></td>
        <td><b><?php echo $total; ?></b></td>
    </tr>
    <?php
    $opening = count(Cashdrawer::model()->findAllByAttributes(array('txn_type' => 'opening', 'date' => $date)));
    if ($total != 0) { ?>
        <tr>
            <td colspan="2"><a href='<?php echo $this->createUrl("voucher/create/9?receiver_type=others&closing_amt=$total"); ?>' onclick="return confirm('Are you sure you want to Enter Into Outlet Day Closing Procedure, Once You Proceed the Amount Displayed in (Consolidated Counter Closing Total) will be saved as OUTLET DAY CLOSING AMOUNT ?');" class='btn btn-primary pull-right btn-lg' <?php if($opening!=$c){ echo 'disabled'; }else{} ?>>Create Contra /Bank Deposit Voucher For Settling Closing Amount</a></td>
        </tr>
    <?php } ?>
    </table>
    <?php
}
?>
