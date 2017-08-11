<style type="text/css">
    div.clear
    {
        clear: both;
    }

    div.product-chooser{

    }

    div.product-chooser.disabled div.product-chooser-item
    {
        zoom: 1;
        filter: alpha(opacity=60);
        opacity: 0.6;
        cursor: default;
    }

    div.product-chooser div.product-chooser-item{
        padding: 11px;
        border-radius: 6px;
        cursor: pointer;
        position: relative;
        border: 1px solid #efefef;
        margin-bottom: 10px;
        margin-left: 10px;
        margin-right: 10x;
    }

    div.product-chooser div.product-chooser-item.selected{
        border: 4px solid #428bca;
        background: #efefef;
        padding: 8px;
        filter: alpha(opacity=100);
        opacity: 1;
    }

    div.product-chooser div.product-chooser-item img{
        padding: 0;
    }

    div.product-chooser div.product-chooser-item span.title{
        display: block;
        margin: 10px 0 5px 0;
        font-weight: bold;
        font-size: 12px;
    }

    div.product-chooser div.product-chooser-item span.description{
        font-size: 12px;
    }

    div.product-chooser div.product-chooser-item input{
        position: absolute;
        left: 0;
        top: 0;
        visibility:hidden;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <legend>Dashboard</legend>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="row form-group product-chooser">
            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('user/create'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/add_user.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Add Site User</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('user/admin'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/view_users.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Manage Site User's</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('menuitems/admin'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/menu-items.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Manage Menu Items</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>

            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('expenses/admin'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/expenses.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Expenses</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('reports/cash'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/cash_reports.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Cash Report</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
            <div class="col-md-2">
                <a href="<?php echo $this->createUrl('reports/sales'); ?>">
                    <div class="product-chooser-item selected">
                        <img src="<?php echo Yii::app()->baseUrl ?>/images/sales_reports.png" class="img-rounded col-xs-3 col-sm-3 col-md-12 col-lg-12" alt="Mobile and Desktop">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                            <span class="title">Sales Report</span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <button type="button" onclick="printout()" class="btn btn-primary pull-right"><i class='fa fa-print'></i> Print</button>
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Stock Critical level Notification List</h3>
    </div>
    <div class="panel-body">
        <div id="printcriticallevel">
            <h2 class="panel-title">Stock Critical level Notification List</h2><hr/>
            <div id="stocklist">
                <table class="items table table-bordered">
                    <thead>
                        <tr>
                            <th id="expenses-grid_c1">Sub Category</th>
                            <th id="expenses-grid_c2">Scale</th>
                            <th id="expenses-grid_c3">Item Name</th>
                            <th id="expenses-grid_c4">Critical Level (Qty)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($slist as $item) { ?>
                            <tr class="odd">
                                <td><?php echo $item->subcategory->item_name ?></td>
                                <td><?php echo $item->subcategory->scale->name ?></td>
                                <td><?php echo $item->unit ?></td>
                                <td><?php echo $item->qty ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/sb-admin.js"></script>
<script>
        function printout() 
        {
            var newWindow = window.open('', 'go_highway_print', 'height=500,width=700');
            newWindow.document.write('<html><head><title>Print</title>');
            newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
            newWindow.document.write('</head><body >');
            newWindow.document.write($("#printcriticallevel").html());
            newWindow.print();
        }
</script>