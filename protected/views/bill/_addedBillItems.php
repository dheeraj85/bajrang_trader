 <table class="table table-bordered">
                        <tr>
                            <th colspan="10" style="text-align: center">
                                AGRAWAL TRADING COMPANY <br>
                                In Front of HJI Main GAte, Amlai <br>
                                Distt. Annuppur (M.P.)484117</th>
                        </tr>
                        <tr>
                            <td colspan="6"></td>
                            <td colspan="2" style="text-align: center">CGST</td>
                            <td colspan="2" style="text-align: center">SGST</td>
                        </tr>
                        <tr>
                            <td>#</td>
                      
                            <td>Weight</td>
                            <td>Rate</td>                            
                            <td>Price</td>
                            <td>Taxable Value</td>
                            <td>Rate</td>
                            <td>Amt</td>
                            <td>Rate</td>
                            <td>Amt</td>
                        </tr>
                        <?php
                        $c=1;
                        //print_r($bill_items);
                        foreach($bill_items as $bi){ 
                        ?>
                        <tr>
                            <td><?= $c;?></td>
                       
                            <td>
                                <?= $bi->weight;?>
                            </td>
                            <td>
                                <?= $bi->rate;?>
                            </td>
                            <td>
                                <?= $bi->amount;?>
                            </td>
                                  <td>Taxable Value</td>
                            <td>Rate</td>
                            <td>Amt</td>
                            <td>Rate</td>
                            <td>Amt</td>
                        </tr>
                        <?php $c++; } ?>
                    </table>