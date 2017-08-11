<?php
if (!empty($sale)) {
    $customer = Customer::model()->findByPk($sale->customer_id);
    ?>
    <style>
        @media print {
            * {
                font-size: 11px;
            }
            table td,th {
                font-size:10px;  
            }
            #bill_area {
                overflow: no-display;
            }
            .border_on_print{
                border-bottom:1px dotted #000; 
            }
            .border_on_print_tb{
                border-bottom:1px dotted #000; 
                border-top: 1px dotted #000; 
            }
            *{
                font-family:monospace; 
            }
            .doNotShowOnPrint{
                display:none; 
            }
        }
    </style>

    <div class="row">
        <div class="col-xs-12">
            <?php
            $items = Offshelfsaleitems::model()->findAllByAttributes(array('shelf_sale_id' => $sale->id)); //print_r($items);     
            if (!empty($items)) {
                ?>
                <table class="table table-bordered">
                        <tr>
                        <td colspan="4" style="text-align: center">
                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/bg-logo.png" alt="LOGO" style="width:90px;height:90px;">  
                        </td>
                        <td colspan="13" style="text-align: center;">
                            <b style="font-size: 14px;">
                                <?php echo Globalpreferences::getValueByParamName('company_name'); ?>
                            </b>
                            <br>
                            <?php echo Globalpreferences::getValueByParamName('company_addr1'); ?>                           
                            <br>
                            <?php echo Globalpreferences::getValueByParamName('company_addr2'); ?>                        

                            &emsp;&phone; 
                            <?php echo Globalpreferences::getValueByParamName('company_contact'); ?>  
                        </td>
                    </tr>


                    <tr>
                        <th colspan="17" style="text-align: center"><?php echo $sale->invoice_type. "(".Yii::app()->session['print_type'].")";?></th>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <table style="width: 100%">
                                <tr>
                                    <td>GSTIN</td>
                                    <td> <?php echo Globalpreferences::getValueByParamName('company_gstin'); ?></td>
                                </tr>
                                <tr>
                                    <td>Invoice No</td>
                                    <td> <?php echo $sale->invoice_number; ?></td>
                                </tr>
                                <tr>
                                    <td>Invoice Date</td>
                                    <td> <?php echo date('d-m-Y', strtotime($sale->order_date)); ?></td>
                                </tr>
                            </table>
                        </td>
                        <td colspan="10">
                            <table style="width: 100%">
                                <tr>
                                    <td>Place of Supply State code</td>
                                    <td> <?php echo Yii::app()->params['company_state_code']; ?></td>
                                </tr>
                                <tr>
                                    <td>Place of Supply State </td>
                                    <td> <?php echo Yii::app()->params['company_state']; ?></td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="7" style="text-align: center;font-size: 13px;font-weight: bold;background: #babdb6">Details of Receiver (Billed to)</td>
                        <td colspan="10" style="text-align: center;font-size: 13px;font-weight: bold;background: #babdb6">Details of Consignee (Shipped to)</td>
                    </tr>
                      
                    <tr>
                        <td colspan="7">   
                            <?php if($sale->txn_type=='customer') {?>
                            <table style="width: 100%;border:0px" border="0">
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo $customer->full_name; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Address:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->address; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State Code:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state_code; ?></td>
                                </tr>                                               
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">GSTIN:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->gstin_no; ?></td>
                                </tr>                                               
                            </table>
                            
                               <?php } else if($sale->txn_type=='special_cash') { ?>
                             <table style="width: 100%;border:0px">
                               <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo ucfirst($sale->customer_name); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Mobile:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->customer_mobile; ?></td>
                                </tr>
                            </table>
                                <?php } ?>
                  
                        </td>
                        <td colspan="10">
                            <?php 
                            if(!empty($sale->customer_id)){
                            if($sale->is_consignee_same=='Y') { ?>
                            <table style="width: 100%;border:0px">
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo $customer->full_name; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Address:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->address; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State Code:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->state_code; ?></td>
                                </tr>                                               
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">GSTIN:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $customer->gstin_no; ?></td>
                                </tr>                                               
                            </table>
                            <?php }else { ?>
                                  <table style="width: 100%;border:0px">
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo $sale->consignee_name; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Address:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->consignee_address; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->consignee_state; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">State Code:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->consignee_state_code; ?></td>
                                </tr>                                               
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">GSTIN:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->consignee_gstin_code; ?></td>
                                </tr>                                               
                            </table>
                            <?php } } else if($sale->txn_type=='special_cash') { ?>
                             <table style="width: 100%;border:0px">
                               <tr>
                                    <td style="font-size: 10px;font-weight: bold">Name:</td>
                                    <td style="font-size: 10px;font-weight: bold"><?php echo ucfirst($sale->customer_name); ?></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 10px;font-weight: bold">Mobile:</td>
                                    <td style="font-size: 10px;font-weight: bold"> <?php echo $sale->customer_mobile; ?></td>
                                </tr>
                            </table>
                                <?php } ?>
                        </td>
                    </tr>

                    
                       <?php if ($sale->supply_state_code === Globalpreferences::getValueByParamName('place_of_supply_state_code')) { ?>
                        <?php $this->renderPartial('_printsgst', array('sale' => $sale, 'items' => $items)); ?>
                    <?php } else { ?>
                        <?php $this->renderPartial('_printigst', array('sale' => $sale, 'items' => $items)); ?>
                    <?php } ?>
                    
                </table>
    <?php } ?>
        </div>
    </div>


<?php } ?>
<script type="text/javascript">
    window.print();
</script>

