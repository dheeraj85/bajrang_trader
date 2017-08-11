<div class='row'>
    <div class="col-lg-12">
        <div class="col-lg-4">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Customer Discount in (%)</h3>
                </div>
                <div class="panel-body">
                    <div id="msg"></div>
                    <form id="discount-form">
                        <input type="hidden" name="cid" value="<?php echo $model->id; ?>">
                        <div class='row'>
                            <div class='col-md-12'>
                                <label>Item Category</label>
                                <select name="category" id="category" class="form-control">
                                    <option value="">--Select Category--</option>
                                    <?php
                                    foreach (Shelfitems::model()->findAllBySql("select * from shelf_items group by p_category_id") as $cat) {
                                        ?>
                                        <option value="<?php echo $cat->p_category_id; ?>"><?php echo Purchasecategory::model()->findByPk($cat->p_category_id)->name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><br/>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <label>Item Sub Category</label>
                                <select name="sub_category" id="sub_category" class="form-control">
                                    <option value="">--Sub Category--</option>
                                </select>
                            </div>
                        </div><br/>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <label>Item Name</label>
                                <select name="item_id" id="item_id" class="form-control">
                                    <option value="">--Item--</option>
                                </select>
                            </div>
                        </div><br/>
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <label>Discount (%)</label>
                                <input type="number" class="form-control" id="disc"  name="disc" placeholder="Discount in (%)">
                            </div>
                        </div><br/>
                        <div class='row'>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                <a class="pull-right" href="<?php echo Yii::app()->createUrl('customer/create'); ?>"><i class="glyphicon glyphicon-backward"></i> Back</a> 
                                <button type="button" data-loading-text="Please wait..." class="btn btn-primary btn_loading pull-left" id="save-disc">Save Discount</button>
   
                            </div>
                        </div>
                    </form>
                </div>
            </div>     
        </div>  
        <div class="col-lg-8">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Customer Discount in (%)</h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="max-height: 450px;overflow-y: scroll;">
                        <table class="table table-bordered">
                            <thead>
                            <th>S.No.</th>
                            <th>Item</th>
                            <th>Discount (%)</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                $c = 1;
                                foreach (Customerdiscount::model()->findAllByAttributes(array('customer_id' => $model->id)) as $disc) {
                                    $shelf = Shelfitems::model()->findByPk($disc->item_id);
                                    $item = Purchaseitem::model()->findByPk($shelf->item_id);
                                    ?>
                                    <tr>
                                        <td><?php echo $c++; ?></td>
                                        <td><?php echo $item->itemname; ?></td>
                                        <td>
                                            <span id="disc_label<?php echo $disc->id; ?>"><?php echo $disc->discount; ?><a href="#" class="pull-right" onclick="Edit(<?php echo $disc->id; ?>);"><i class="glyphicon glyphicon-edit"></i></a></span>
                                            <span style="display: none;" id="disc_val<?php echo $disc->id; ?>"><input class="no-print" type="number" name="disc" value="<?php echo $disc->discount; ?>" id="disc_<?php echo $disc->id; ?>"
                                                                                                                      style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                                                                                                  Update(<?php echo $disc->id ?>, this.value);"></span>
                                        </td>
                                        <td>&emsp;<a href="#" onclick="Delete(<?php echo $disc->id; ?>);"><i class="glyphicon glyphicon-remove text-danger"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>     
        </div>  
    </div>  
</div>  
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').change(function() {
            var cid = $('#category').val();
            var itype = 'Menu';
            var scid = '';
            GetSCategory(cid, scid, itype);
        });

        $('#sub_category').change(function() {
            var cid = $('#category').val();
            var scid = $('#sub_category').val();
            GetItem(cid, scid);
        });

        $('#save-disc').click(function() {
            var item_id = $("#item_id").val();
            var disc = $("#disc").val();
            if (item_id == '' || disc == '') {
                alert("First Enter Proper Detail...!!!");
            } else if (item_id != '' || disc != '') {
                SaveDiscount();
            }
        });
    });

    function GetSCategory(cid, scid, itype) {
        $.ajax({
            url: "<?php echo $this->createUrl('positemoffers/getscategory'); ?>",
            data: {"cid": cid},
            success: function(data) {
                $("#sub_category").html(data);
            }
        });
    }

    function GetItem(cid, scid) {
        $("#item_id").html("");
        $.getJSON("<?php echo $this->createUrl('positemoffers/getitem'); ?>", {"cid": cid, "scid": scid}, function(data) {
            var content = "";
            content += '<option value="">--Select Item--</option>';
            $.each(data.items, function(i, ct) {
//                alert(ct.i);
                if (item_id == ct.id) {
                    content += '<option value="' + ct.id + '" selected>' + ct.itemname + '</option>';
                } else {
                    content += '<option value="' + ct.id + '">' + ct.itemname + '</option>';
                }
            });
            $("#item_id").html(content);
        });
    }

    function SaveDiscount() {
        var $btn = $('.btn_loading').button('loading');
        var datastring = $('#discount-form').serialize();
        $.ajax({
            url: '<?php echo $this->createUrl('customer/savediscount'); ?>',
            data: datastring,
            type: 'post',
            success: function(response) {
                $btn.button('reset');
                $('#msg').show();
                $('#msg').html(response);
//                setInterval(function() {
//                }, 5000);
                    Refresh();
//                $('#msg').hide(500);
            }
        });
    }

    function Edit(id)
    {
        $('#disc_label' + id).hide();
        $('#disc_val' + id).show();
    }

    function Update(id, val)
    {
        var value = parseInt(val);
        $.ajax({
            url: "<?php echo $this->createUrl('customer/updatedisc'); ?>",
            data: {"id": id, 'value': value},
            success: function(data) {
                Refresh();
            }
        });
    }

    function Delete(id)
    {
        var r = confirm("Are you sure you want to delete selected discount detail ?");
        if (r == true) {
            $.ajax({
                url: "<?php echo $this->createUrl('customer/deletedisc'); ?>",
                data: {"id": id},
                success: function(data) {
                    Refresh();
                }
            });
        } else {
        }
    }
</script>
