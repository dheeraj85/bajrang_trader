<?php
if (!empty($list)) {
    ?>
    <article class="module width_full">
        <div class="module_content" id="show_content">
            <fieldset>
                <table class="table table-bordered">             
                    <tbody>
                    <th>Voucher No</th>
                    <th>Amount (Rs.)</th>
                    <th>Dated</th>
                    </thead>
                    <tbody>
                      <?php  foreach($list as $invlist){?>
                        <tr>
                            <td><?php echo $invlist->vouchers->voucher_no;?></td>
                            <td><?php echo $invlist->amount;?></td>
                            <td><?php echo $invlist->dated;?></td>
                        </tr>
                      <?php }?> 
                    </tbody>
                </table>
            </fieldset>
        </div>
    </article>
<?php } ?>