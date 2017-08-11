<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Special Customer Sale' => array('offshelfsale/create'),
    'Special Customer Sale Detail',
);

$customer = Customer::model()->findByPk($model->customer_id);
?>
<div class='row'>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Details of Special Customer Sale &emsp;
                        <b>
                            <?php if (empty($model->invoice_number)) { ?>
                                <?php echo '( MEMO No. &emsp;:- &emsp;' . $model->memo_number . ')'; ?>
                            <?php } else { ?>
                                <?php echo '( INVOICE No. &emsp;:- &emsp;' . $model->invoice_number . ')'; ?>
                            <?php } ?>

                            <label class="pull-right">
                                Place of Supply :- <?= $model->supply_state_code; ?>&nbsp; | &nbsp;
                                Party GSTIN :- <?= $model->customer->gstin_no; ?>&nbsp; | &nbsp;
                                &nbsp; | &nbsp; State :- <?= $model->customer->state; ?>
                            </label> 
                        </b>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class='row'>
                        <table class="table" style="background-color: #ff6600;color: #FFF;">
                            <tr>

                                <?php if (empty($model->invoice_number)) { ?>
                                    <td style="border-top: none;"><h5><b>&emsp;Memo Number :- &nbsp;&nbsp;<?php echo $model->memo_number; ?></b></h5></td>
                                <?php } else if (!empty($model->invoice_number)) { ?>
                                    <td style="border-top: none;"><h5><b>&emsp;Invoice Number :- &nbsp;&nbsp;<?php echo $model->invoice_number; ?></b></h5></td>
                                <?php } ?>
                                <?php if ($model->txn_type == 'customer') { ?>
                                    <td style="border-top: none;"><h5><b>Party Name :-&nbsp;&nbsp;<?php echo $customer->full_name; ?></b></h5></td>
                                    <td style="border-top: none;"><h5><b>Contact No :-&nbsp;&nbsp;<?php echo $customer->mobile_no; ?></b></h5></td>
                                    <td style="border-top: none;"><h5><b>Tax Type :-&nbsp;&nbsp;<?php echo $model->tax_type; ?></b></h5></td>

                                <?php } else { ?>
                                    <td style="border-top: none;"><h5><b>Customer Name :-&nbsp;&nbsp;<?php echo $model->customer_name; ?></b></h5></td>
                                    <td style="border-top: none;"><h5><b>Contact No :-&nbsp;&nbsp;<?php echo $model->customer_mobile; ?></b></h5></td>
                                    <td style="border-top: none;"><h5><b>Tax Type :-&nbsp;&nbsp;<?php echo $model->tax_type; ?></b></h5></td>

                                <?php } ?>
                            </tr>
                            <tr>
                                <td style="border-top: none;"><h5><b>Store Name :-&nbsp;&nbsp;<?php echo $customer->party_store_name; ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Order Date :-&nbsp;&nbsp;<?php echo $model->order_date; ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Order Time :-&nbsp;&nbsp;<?php echo $model->order_time; ?></b></h5></td>
                                <td style="border-top: none;"><h5><b>Remark :-&nbsp;&nbsp;<?php echo $model->comment; ?></b></h5></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>

        .alert {
            padding: 10px;
            background-color: #f44336; /* Red */
            color: white;
            margin-bottom: 15px;
            font-size: 22px;
            text-align: center;
        }

        /* The close button */
        .closebtn {
            margin-top: 5px;
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        /* When moving the mouse over the close button */
        .closebtn:hover {
            color: black;
        }
    </style>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-equal">
                    <h3 class="panel-title">Special Customer Sale Items</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <?php if (Yii::app()->user->hasFlash('special_c')) { ?>
                            <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display = 'none';">&times;</span> 
                                <?php echo Yii::app()->user->getFlash('special_c'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if (empty($model->invoice_number)) { ?>
                        <form id="item" action="<?php echo $this->createUrl('offshelfsale/additems', array('sid' => $model->id)) ?>" class="navbar-search expanded" role="search" method="post">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <span class="typeahead__query">
                                        <input style="width:100%;" class="form-control js-typeahead-input"
                                               name="q"
                                               id="q" 
                                               type="search"                                                      
                                               autocomplete="off">
                                    </span>
                                    <span class="typeahead__button">
                                        <button type="submit">
                                            <i class="typeahead__search-icon"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form><br/>
                    <?php } ?> 

                    <?php if ($model->supply_state_code === Globalpreferences::getValueByParamName('place_of_supply_state_code')) { ?>
                        <?php $this->renderPartial('_sgst', array('model' => $model, 'items' => $items)); ?>
                    <?php } else { ?>
                        <?php $this->renderPartial('_igst', array('model' => $model, 'items' => $items)); ?>
                    <?php } ?>


                </div>   
            </div>   
        </div> 
    </div>
</div>
<script type="text/javascript">
    function saveReverseCharges() {
        // alert('hh');
        $(".btn").button('loading');
        $("#charges_added").fadeIn();
        var url = '<?php echo $this->createUrl("offshelfsale/savereversecharges"); ?>';
        $.post(url, $("#reverse_charges").serialize(), function(res) {
            $(".btn").button('reset');
            var res = jQuery.parseJSON(res);
            if (res.msg == 'success') {
                $("#charges_added").html('Charges Added..').addClass('.text-success').fadeOut(4000);
            }
        });
    }

    $(document).ready(function() {
        $(".alert").delay(5000).fadeOut("slow");
        document.onkeypress = function(evt) {
            evt = evt || window.event;
            var charCode = evt.which || evt.keyCode;
            var charStr = String.fromCharCode(charCode);
            if (/[a-zA-Z]/i.test(charStr)) {
                //alert("Letter typed");
                $("#q").focus().val();
            }
        }
        ///checking focus of cursor
<?php if (!empty($val)) { ?>
            var input = $('#<?php echo 'qty_' . $val; ?>');
            input.focus().val(input.val());
            $('#<?php echo 'qty_' . $val; ?>').select();
<?php } else { ?>
            $("#q").focus();
<?php } ?>
    });
    function update(data, val, type) {
        var value = parseFloat(val);
        //alert(data);
        //alert(val);
        if (value > 0) {
            var id = data;
            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/offshelfsale/updateqty/id/" + id + "/value/" + value + "/type/" + type;
        }
    }
    $(".checkData").click(function() {
//as per selection of textbox value will be selected
        $(this).select();
    });
    typeof $.typeahead({
        input: ".js-typeahead-input",
        minLength: 1,
        order: "asc",
        maxItem: false,
        highlight: false,
        hint: true,
//                        backdrop: {
//                            "background-color": "#fff"
//                        },
        backdropOnFocus: true,
        source: {
            ajax: function(query) {
                return {
                    type: "GET",
                    url: '<?php echo $this->createUrl("offshelfsale/getItemDetail"); ?>',
                    path: "data",
                    data: {
                        q: "{{query}}"
                    },
                    callback: {
                        done: function(data) {
                            return data;
                        }
                    }
                }
            }

        },
        callback: {
            onClick: function(node, a, item, event) {
                // You can do a simple window.location of the item.href
                //   alert(JSON.stringify(item));
//                var item = $("#q").val();
//                alert(item);
//                $("#q").focus().val();
                window.location.href = "<?php echo $this->createUrl('offshelfsale/additems', array('sid' => $model->id)); ?>&item=" + item.id;
            },
            onSendRequest: function(node, query) {
                console.log('request is sent')
            },
            onReceiveRequest: function(node, query) {
                console.log('request is received')
            }
        },
        debug: true
    });

</script>