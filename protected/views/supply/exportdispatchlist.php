<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Center Distributed System',
    'Dispatch Stock to Shelf/POS',
);
?>
<div class='form-css'>
    <div class='row'>
        <div class="col-lg-12">      
            <div class="box">
                <div class="box-header bg-yellow">
                    <h3 class="panel-title pull-left">Dispatch Stock to Shelf/POS</h3>            
                </div>
                <div class="panel-body">
                   
                    <div style="display: none">
                   <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                        'id' => 'dispatch-qty-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->searchExcel(),
//                        'filter' => $model,
                        'columns' => array(
//        		'id',
                            array(
                                'name' => 'p_category_id',
                                'value' => '$data->pCategory->name'
                            ),
                            array(
                                'name' => 'p_sub_category_id',
                                'value' => '$data->pSubCategory->name'
                            ),
                            array(
                                'name' => 'item_name',
                                'value' => '$data->positem->itemname'
                            ),
                            //   'barcode',
                            //  'tax_type',
                            'sale_price',
                            'total_qty',
                            
                               array('htmlOptions' => array('width'=>'320'), 'header' => 'Avl Qty in Main Stock', 'value' => '$data->availableStock($data)'),
         //                      array('htmlOptions' => array('width'=>'320'), 'header' => 'Dispatch Stock to OTS/POS', 'value' => '$data->Addtoshelf($data)'),
                            
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
                        </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(function() {
            var currentdate = new Date();
            var formatted = currentdate.getDate() + "-"
                    + (currentdate.getMonth() + 1) + "-"
                    + currentdate.getFullYear() + "-"
                    + currentdate.getHours() + "-"
                    + currentdate.getMinutes() + "-"
                    + currentdate.getSeconds();
            $("#dispatch-qty-grid").table2excel({
                exclude: "",
                name: "Dispatch Stock to Shelf/POS",
                filename: 'DispatchStockToShelf_' + formatted,
                fileext: ".xls",
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true
            });

    });
</script>