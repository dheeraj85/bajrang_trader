<style type="text/css">
    .view,.update,.delete{
        display:none; 
    }
</style>
<div class="panel panel-default">
    <button type="button" onclick="printout()" class="btn btn-primary pull-right"><i class='fa fa-print'></i> Print</button>
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Cash Report</h3>
    </div>
    <div class="panel-body">
        <div class="search-form">           
            <div class="well">
                <div class="row" style="overflow-y:scroll;height:460px;">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'accountsetting-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->search(),
                        // 'filter' => $model,
                        'columns' => array(
                            //'id',
                            array('htmlOptions' => array('width' => ''), 'header' => 'Order Date', 'value' => 'date("d-m-Y",strtotime($data->dated))'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Cash Counter', 'value' => '$data->ccounter($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Open', 'value' => '$data->dayopen($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Sales', 'value' => '$data->daysales($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Deposit', 'value' => '$data->deposit($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Operations Account', 'value' => '$data->operation($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Close', 'value' => '$data->dayclose($data)'),
                            /*
                              'dated',
                              'remarks',
                             */
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
                </div>
                <div class="row" id="printsearch" style="display:none;">
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'accountsetting-grid',
                        'type' => 'bordered',
                        'dataProvider' => $model->printsearch(),
                        // 'filter' => $model,
                        'columns' => array(
                            //'id',
                            array('htmlOptions' => array('width' => ''), 'header' => 'Order Date', 'value' => 'date("d-m-Y",strtotime($data->dated))'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Open', 'value' => '$data->dayopen($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Sales', 'value' => '$data->daysales($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Deposit', 'value' => '$data->deposit($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Operations Account', 'value' => '$data->operation($data)'),
                            array('htmlOptions' => array('width' => '', 'valign' => 'middle'), 'header' => 'Day Close', 'value' => '$data->dayclose($data)'),
                            ),
                    ));
                    ?>
                </div>
            </div>
           
        </div>
        <div class="table-responsive">
           
        </div>
    </div>
</div>
<script>
    function printout() {
       var newWindow = window.open('', 'go_highway_print', 'height=500,width=700');
        newWindow.document.write('<html><head><title>Print</title>');
        newWindow.document.write('<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/theme/pos/styles/helpers/bootstrap.min.css" type="text/css" />');
        newWindow.document.write('</head><body >');
        newWindow.document.write($("#printsearch").html());
        newWindow.print();
    }
</script>