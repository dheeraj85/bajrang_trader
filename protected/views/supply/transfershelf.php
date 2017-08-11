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
                    <h3 class="panel-title pull-left">Dispatch Stock to Shelf/Store</h3>            
                </div>
                <div class="panel-body">
                    <div class="search-form">
                        <?php
                        $this->renderPartial('_searchShelfItems', array(
                            'model' => $model,
                        ));
                        ?>
                    </div>
                    <?php
                    $this->widget('bootstrap.widgets.BsGridView', array(
                    //    'id' => 'dispatch-qty-grid',
                        'type'=>'bordered',
                        'dataProvider' => $model->search(),
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
                            
                     //          array('htmlOptions' => array('width'=>'100'), 'header' => 'Avl Qty in Shelf', 'value' => '$data->availableInShelf($data)'),
                               array('htmlOptions' => array('width'=>'100'), 'header' => 'Avl Qty in CDS', 'value' => '$data->availableStock($data)'),
                             array('htmlOptions' => array('width'=>'180'), 'header' => 'Dispatch Stock to Shelf/Store', 'value' => '$data->Addtoshelf($data)'),
                            
//                            array(
//                                'class' => 'bootstrap.widgets.BsButtonColumn',
//                            ),
                        ),
                    ));
                    ?>
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

            <!-- Modal -->
            <div id="myItemModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="itemname"></h4>
                            <h4>                            
                                <span id="dispatch_qty" class="label label-success"></span>
                            </h4>
                        </div>
                        <div class="modal-body" id="show_item_details">
                        </div>
                    </div>
                </div>
            </div>
            
              <!-- View Items Modal -->
            <div id="myDispatchModal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="itemname"></h4>
                            <h4>
                                <span id="req_qty" class="badge badge-warning"></span> &nbsp;&nbsp; | &nbsp;&nbsp;
                                <span id="dispatch_qty" class="badge badge-success"></span>
                            </h4>
                        </div>
                        <div class="modal-body" id="show_dispathc_items">
                        </div>
                    </div>
                </div>
            </div>
<!--<script src="<?php //echo Yii::app()->request->baseUrl; ?>/bs/js/jquery.js"></script>-->
