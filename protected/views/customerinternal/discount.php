<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Manage Customer' => array('customer/create'),
    'View Customer and Customer Discount',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">View Customer</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-condensed table-hover">
                        <tr>
                            <td><b>Full Name</b></td>
                            <td><?php echo $model->full_name; ?></td>
                            <td><b>Mobile No</b></td>
                            <td><?php echo $model->mobile_no; ?></td>
                        </tr>
                        <tr>
                            <td><b>Land line No</b></td>
                            <td><?php echo $model->landline; ?></td>
                            <td><b>Email Id</b></td>
                            <td><?php echo $model->email_id; ?></td>
                        </tr>
                        <tr>
                            <td><b>Store Name</b></td>
                            <td><?php echo $model->party_store_name; ?></td>
                            <td><b>Registration Date</b></td>
                            <td><?php echo $model->regdate; ?></td>
                        </tr>
                        <tr>
                            <td><b>Address</b></td>
                            <td colspan="3"><?php echo $model->address; ?></td>
                        </tr>
                    </table> 
                </div>
            </div>     
        </div>  
    </div> 
    <div id="detail"></div>
</div>  

<script src="<?php echo Yii::app()->request->baseUrl; ?>/front/libs/jquery/jquery-1.11.2.min.js"></script>
        <script type="text/javascript">
    $(document).ready(function() {
        Refresh();
    });

    function Refresh() {
        var id = '<?php echo $model->id; ?>';
        $.ajax({
            url: '<?php echo $this->createUrl('customer/getdiscount'); ?>',
            data: {'id': id},
            type: 'post',
            success: function(response) {
                $('#detail').html(response);
            }
        });
    }
</script>