<?php
$this->breadcrumbs = array(
    'Home' => array('site/reportdashboard'),
    'Reports' => array('site/reportdashboard'),
    'Vendor Due Payment Report',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Users', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Users', 'url' => array('admin')),
);
?>
<div class='form-css'>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="panel-title">Vendor Due Payment Report
                <div class="pull-right">
                    <a href="#" onclick="vendorlist();" class="btn btn-default">All Vendor List</a>
                </div>
            </h3>
        </div>
        <div class="panel-body">           
            <div class="table-responsive" id="duevendorlist">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-left">Name</th>
                            <th class="text-left">Firm Name</th>                            
                            <th class="text-left">TIN No</th>
                            <th class="text-left">Mobile</th>
                            <th class="text-left">Email</th>
                            <th class="text-right">Balance</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($data['data']) { ?>
                            <?php foreach ($data['data'] as $order) { ?>
                                <tr>
                                    <td class="text-left"><?php echo strtoupper($order['name']); ?></td>
                                    <td class="text-left"><?php echo strtoupper($order['firmname']); ?></td>
                                    <td class="text-left"><?php echo $order['tinno']; ?></td>
                                    <td class="text-left"><?php echo $order['mobile']; ?></td>
                                    <td class="text-left"><?php echo $order['email']; ?></td>
                                    <td class="text-right"><?php echo $order['balance']; ?></td>
                                    <td class="text-right"><a href="<?php echo $this->createUrl('voucher/create', array("receiver_type" => 'vendor', "id" => 2, "receiver_id" => $order['id'])) ?>" class="btn btn-green">Pay Now</a></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td class="text-center" colspan="6"><?php echo $data['text_no_results']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive" id="vendorlist"></div>
        </div>
    </div>
</div>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/dist/js/bootstrap-datepicker.js"></script>
<script>
                        $('.datepicker').datepicker({
                            format: "yyyy-mm-dd",
                            autoclose: true
                        }).on('changeDate', function (ev) {
                            $(this).datepicker('hide');
                        });
</script>
<script>
    function printout() {
        var newWindow = window.open('', '', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/dist/css/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body >');
        newWindow.document.write($("#duevendorlist").html());
        newWindow.print();
    }
    function vendorlist() {
        $.ajax({
            url: '<?php echo $this->createUrl('reports/getvendorlist') ?>',
            type: 'get',
            success: function (response) {
                $('#duevendorlist').hide();
                $('#vendorlist').html(response);
            }
        });
    }
</script>