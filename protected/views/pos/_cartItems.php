       <div class="card height-14">
            <div class="card-head">
                <table class="table height-1" style="background-color:#91d0fd;">
                    <tr>
                        <td><b>Bill No : </b></td>
                        <td>TOC-001</td>
                        <td width="10"></td>
                        <td><b>Date & Time : </b></td>
                        <td><?php echo date('d-m-Y h:m:s') ?></td>
                    </tr>
                </table>
                <div id="cart_items">
                    <?php print_r($cart_items);?>
                </div> 
            </div>        
        </div><!--end .card -->	
        <div class="card height-2">
            <br/>
            <div id="new_btn" class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #333;font-size:15px;">
                <span class="pull-left"><i class="fa fa-edit fa-fw"></i></span> New
            </div>
            <div id="reset_btn" class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #333;font-size:15px;">
                <span class="pull-left"><i class="fa fa-remove fa-fw"></i></span> Clear
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="font-size:15px;">
                <span class="pull-left"><i class="fa fa-print fa-fw"></i></span> Print
            </div>  
        </div>