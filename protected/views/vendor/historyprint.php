<?php
/* @var $this EmployeesalaryController */
/* @var $model Employeesalary */


$this->breadcrumbs = array(
    'Home' => array('site/cmsdashboard'),
    'Vendor Ledger'=>array('paymenthistory','id'=>$id),
    'Print Voucher',
);
?>
<div class="row">
    <div class="container">
        <button class="btn btn-sm btn-info" id="btnPrint">Print Voucher</button><br/>
        <div id="printorder" style="padding:10px;width:750px;background-color:#fff;"> 
            <table width="100%">
                <tbody>
                    <tr>
                        <td width="15%" align="left"> 
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bg-logo.png" class="img-circle" style="width:100%;">
                        </td>
                        <td width="10%"></td>
                        <td width="35%"><h3><u><?php echo $model->voucher->voucher_name ?></u></h3></td>
                        <td width="40%" align="right">
                            10, Caravs Complex, Station Road, <br/>
                            South Civil Lines, Sadar, Jabalpur, M.P. 482001<br/>
                            Phone: 076126 20657 <br/>
                            website : theovenclassics.com
                        </td>
                    </tr> 
            </table>
            <br/>
            <table width="100%" class="format_table">
                <tr>
                    <td style="border:1px solid #333;padding:5px;" width="15%"><b>Paid To :</b></td>                
                    <td style="border:1px solid #333;padding:5px;" width="40%" align="left"><?php echo $model->reqstatus($model); ?></td>
                    <td style="border:1px solid #333;padding:5px;" width="23%" align="left"><b>Voucher No : <?php echo $model->voucher_no?></b> </td>
                    <td style="border:1px solid #333;padding:5px;" width="8%"><b>Date :</b></td>  
                    <td style="border:1px solid #333;padding:5px;" width="15%" align="left"><?php echo $model->dated ?></td>
                </tr>
            </table><br/>
            <table width="100%" class="format_table">
                <tr>
                    <td style="border:1px solid #333;padding:5px;" width="80%"><b>PARTICULARS </b></td>                
                    <td style="border:1px solid #333;padding:5px;" width="20%" align="right"><b>AMOUNT</b></td>  
                </tr>
                <tr>
                    <td style="border:1px solid #333;padding:5px;" width="80%">
                       <?php echo $model->remark; ?>
                    </td>
                    <td style="border:1px solid #333;padding:5px;" width="20%" align="right">
                        <b><?php echo $model->amount ?></b>
                    </td>
                </tr>
                <tr style="height:120px;">
                    <td style="border:1px solid #333;padding:5px;" width="80%">
                         <b>Mode of Payment : <?php echo strtoupper($model->payment_mode); ?></b><br/><br/>
                        <?php
                        if ($model->payment_mode == "cheque") {
                            ?>
                            <table width="100%">
                                <tr>
                                    <td width="20%"><b>Cheque No: </b></td>
                                    <td width="40%"><?php echo $model->c_number_t_num_utr_num; ?></td>
                                    <td width="20%"><b>Dated: </b></td>
                                    <td width="40%"><?php echo $model->payment_date; ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                        <?php
                        if ($model->payment_mode == "neft" || $model->payment_mode == "rtgs") {
                            ?>
                            <table width="100%">
                                <tr>
                                    <td><b>Account No: </b> <?php echo $model->account_no; ?><br/><br/>
                                    <b>Bank Name: </b><?php echo $model->bank_card_name; ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                    </td>
                    <td style="border:1px solid #333;padding:5px;" width="20%" align="right">

                    </td>
                </tr>
                <tr>
                    <td style="border:1px solid #333;padding:5px;" width="80%" align="left">
                        <table width="100%">
                            <tr>
                                <td width="30%"><b>Total Amount in Words : </b></td>
                                <td width="70%"><?php echo Utils::convert_number_to_words($model->amount); ?> Only</td>
                            </tr>
                        </table>
                    </td>
                    <td style="border:1px solid #333;padding:5px;" width="20%" align="right">
                        <b><?php echo $model->amount ?></b>
                    </td>
                </tr>
            </table>
            <br/>
          
            <table width="100%">
                <tr>
                <td><b>Prepared By:</b></td>
                <td align="left"><?php echo $model->users->name; ?></td>
                <td><b>Received By: </b></td>
                <td align="left"><?php echo $model->received_by ?></td>
                <td><b>Received Mobile No: </b></td>
                <td align="left"><?php echo $model->received_mobileno ?></td>               
            </tr>
            </table>
        </div>
    </div>
</div><br/><br/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script type="text/javascript">
    $(function() {
        $("#btnPrint").click(function() {
            var contents = $("#printorder").html();
            var frame1 = $('<iframe />');
            frame1[0].name = "frame1";
            frame1.css({"position": "absolute", "top": "-1000000px"});
            $("body").append(frame1);
            var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
            frameDoc.document.open();
            //Create a new HTML document.
            frameDoc.document.write('<html><head><title>Print</title>');
            frameDoc.document.write('</head><body>');
            //Append the external CSS file.
            frameDoc.document.write("<link href='<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css' rel='stylesheet' type='text/css' />");
            //Append the DIV contents.
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function() {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                frame1.remove();
            }, 500);
        });
    });
</script>