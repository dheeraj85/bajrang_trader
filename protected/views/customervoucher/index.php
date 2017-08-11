<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Vouchers',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Voucher', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Voucher', 'url' => array('admin')),
);
?>
<section class="content">
<div class="row">
 <div class="col-lg-12">   
    <legend>Debit Vouchers</legend>
<?php
foreach ($dlist as $ls){
?>
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <br/><br/>
            <div class="inner">
                <p><?php echo $ls->voucher_name;?></p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/voucher.png" alt="<?php echo $ls->voucher_name;?>">
            </div>
            <a href="<?php echo $this->createUrl('voucher/create',array("receiver_type"=>$ls->payment_receiver_type,"voucher_type_id"=>$ls->id)) ?>" class="small-box-footer">Add <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->  
<?php } ?>
    <br/>
        <legend>Credit Vouchers</legend>
        <?php
foreach ($clist as $ls){
?>
    <div class="col-lg-3 col-xs-4">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <br/><br/>
            <div class="inner">
                <p><?php echo $ls->voucher_name;?></p>
            </div>
            <div class="icon">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/dist/img/voucher.png" alt="<?php echo $ls->voucher_name;?>">
            </div>
            <a href="<?php echo $this->createUrl('voucher/create',array("receiver_type"=>$ls->payment_receiver_type,"voucher_type_id"=>$ls->id)) ?>" class="small-box-footer">Add <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div><!-- ./col -->  
<?php } ?>
    </div> 
</div>  
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">     
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Vouchers List</h3>
                </div>
                <div class="panel-body">

                    <div class="search-form">
                        <?php
                        $this->renderPartial('_search', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <!-- search-form -->

                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'voucher-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        //'filter' => $model,
                        'columns' => array(
                            //array('htmlOptions' => array(), 'header' => 'Record No.', 'name' => 'id', 'type' => 'raw', 'value' => '$data->id'),
                            array('htmlOptions' => array(), 'header' => 'Voucher No', 'name' => 'id', 'type' => 'raw', 'value' => '$data->voucher_no'),
                            array('htmlOptions' => array(), 'header' => 'Voucher Type', 'name' => 'voucher_type_id', 'type' => 'raw', 'value' => '$data->voucher->voucher_name'),
                            array('htmlOptions' => array(), 'header' => 'Receiver / Expense Head', 'name' => 'receiver_id', 'value' => 'Voucher::reqstatus($data)'),
                            'amount',
                            'dated',
                            'payment_mode',
                            array('htmlOptions' => array(), 'header' => 'Counter', 'name' => 'counter_id', 'type' => 'raw', 'value' => '$data->counter->counter_name'),
                            array('htmlOptions' => array(), 'header' => 'Action', 'value' => 'Voucher::action($data)'),
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>    
</section>    