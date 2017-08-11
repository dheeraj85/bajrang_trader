<div class="modal-body" style="min-height: 300px;">

    <div class="row" id="status_msg"></div>
    <input type="hidden" name="customer_id" id="customer_id">
    <div class="row">
        <div class="col-lg-4">
            <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile Number">
        </div>

        <div class="col-lg-4" id="customer_info" style="display: none">
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Customer Number">
        </div>
        <div class="col-lg-4">
            <button type="button" id="find_btn" class="btn btn-success" onclick="findCashCustomer(<?php echo $id; ?>)">Find</button>
            <button type="button" style="display: none" id="save_btn" class="btn btn-success" onclick="saveCashCustomer(<?php echo $id; ?>)">Add to Customer Credit Account</button>
        </div>

    </div>
    <br/>
    <br/>
    <!-- Show New Bill-->
    <div id="show_new_bill" class="row"></div>
    <!-- Show New Bill-->

    <!-- Show Previous Bill-->
    <div id="show_previous_bill"  class="row"></div>
    <!-- Show Previous Bill-->
</div>


<script type="text/javascript">
    $(document).ready(function() {

    });

    function findCashCustomer(id) {
        var mobile = $("#mobile_no").val();
        $("#show_item_details").html('<img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/loading_icon.gif">');
        var url = '<?php echo $this->createUrl("pos/findCreditCustomer"); ?>';
        var token = '<?php echo $csrfToken; ?>';
        $.post(url, {'YII_CSRF_TOKEN': token, 'mobile': mobile, 'shelf_id': id
        }, function(data) {
            var data = jQuery.parseJSON(data);
            console.log(data.items);
            if (data.items == 'norecord') {
                $("#customer_info").css('display', 'inline');
                $("#find_btn").css('display', 'none');
                $("#save_btn").css('display', 'inline');
                $("#name").focus();
                $("#status_msg").addClass('alert alert-danger').html('No Record(s) found!!! Fill customer details below to Generate credit account ');
                getbill(id);     
                
            } else {
                $("#customer_info").css('display', 'none');
                $("#customer_id").val(data.customer.id);
                $("#find_btn").css('display', 'none');
                $("#save_btn").css('display', 'inline');
                $("#name").focus();
                $("#status_msg").addClass('alert alert-success').html('Record(s) found!!! Customer Name - ' + data.customer.full_name + ' details below to Generate credit account ');
                getbill(id);
                var c = "<legend>Previous Bill</legend><table class='table table-bordered'>";
                c += "<tr>";
                c += "<td>Bill No</td>";
                c += "<td>Amount</td>";
                c += "<td>Dated</td>";
                c += "<td>Created By</td>";
                c += "</tr>";
                $.each(data.items, function(k, v) {
                    c += "<tr>";
                    c += "<td>" + v.invoice_number + "</td>";
                    c += "<td>" + v.amount + "</td>";
                    c += "<td>" + v.order_date + " " + v.order_time + "</td>";
                    c += "<td>" + v.name + "</td>";
                    c += "</tr>";
                });
                c += "</table>";
                $("#show_previous_bill").html(c);   
      
            }
        });
    }

    var getbill = function getBillSingle(id) {
        var url = '<?php echo $this->createUrl("pos/getsinglebill"); ?>';
        $.getJSON(url, {'id': id}, function(data) {
            var c = "<table class='table table-bordered'>";
            c += "<tr>";
            c += "<td>Bill No</td>";
            c += "<td>Amount</td>";
            c += "<td>Dated</td>";
            c += "<td>Created By</td>";
            c += "</tr> <tr>";
            c += "<td>" + data.shelf_sale.invoice_number + "</td>";
            c += "<td>" + data.shelf_sale.amount + "</td>";
            c += "<td>" + data.shelf_sale.order_date + " " + data.shelf_sale.order_time + "</td>";
            c += "<td>" + data.shelf_sale.name + "</td>";
            c += "</tr>";
            c += "</table>";
            $("#show_new_bill").html(c);
        });
    }

    function saveCashCustomer(id) {
        var mobile = $("#mobile_no").val();
        var name = $("#name").val();
        var cid = $("#customer_id").val();
        $btn = $("#save_btn").button('loading');
        var url = '<?php echo $this->createUrl("pos/savecreditbill"); ?>';
        var token = '<?php echo $csrfToken; ?>';
        $.post(url, {'YII_CSRF_TOKEN': token, 'mobile': mobile, 'name': name, 'shelf_id': id, 'cid': cid}, function(data) {
            var data = jQuery.parseJSON(data);
            console.log(data.msg);
            $btn.button('reset');
            if (data.msg == 'success') {
                alert('Account has been generated successfully');
                $("#creditBillModal").modal('hide');
                        $("#credit_bill_"+id).hide();
            } else {

            }
        });
    }
</script>