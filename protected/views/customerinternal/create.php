<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('pos/ots_items'),
    'Manage Customer',
);
?>

<style>
    .view{
        display: none;
    }
</style>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Add Internal Customer</h3>
                </div>
                <div class="panel-body">
                    <?php $this->renderPartial('_form', array('model' => $model)); ?>
                </div>
            </div>     
        </div>  
    </div>  
    <div class='row'>
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-info">
                    <h3 class="panel-title">Manage Internal Customer</h3>
                </div>
                <div class="panel-body">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'customer-grid',
                        'dataProvider' => $model->searchInternalCustomer(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
//		'type',
                            'full_name',
                            'mobile_no',
                            'email_id',
//		'address',
                            'party_store_name',
                            /*
                              'landline',
                              'email_id',
                              'regdate',
                             */
                            array('header' => 'Action', 'value' => '$data->ActionForInternal($data)'),
                            array(
                                'class' => 'bootstrap.widgets.BsButtonColumn',
                            ),
                        ),
                    ));
                    ?>
                </div>
            </div>     
        </div>  
    </div>  
</div>  
<script type="text/javascript">
$(".delete").click(function(){
    return confirm("Are you sure you want to delete customer ?");
});
</script>