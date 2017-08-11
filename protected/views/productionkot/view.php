<?php
/* @var $this ProductionkotController */
/* @var $model Productionkot */
?>

<?php
$this->breadcrumbs = array(
    'Home' => array('site/dashboard'),
    'Production KOT' => array('productionkot/create'),
    'Production KOT Detail',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Productionkot', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Productionkot', 'url' => array('create')),
    array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Productionkot', 'url' => array('update', 'id' => $model->id)),
    array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Productionkot', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Productionkot', 'url' => array('admin')),
);
?>
<div class='row'>
    <div class="col-lg-12">
        <div class="col-lg-12">
            <div class="box">
                <div class="box-header btn-primary">
                    <h3 class="panel-title">Details of Production KOT &emsp;<b><?php echo '( PKOT No. &emsp;:- &emsp;' . $model->kot_no . ')'; ?></b></h3>
                </div>
                <div class="panel-body">
                    <div class='row'>
                        <table class="table" style="background-color: #ff6600;color: #FFF;">
                            <tr>
                                <td style="border-top: none;"><h4><b>&emsp;PKot Date :-</b></h4></td>
                                <td style="border-top: none;"><h4><b><?php echo $model->kot_date; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>PKot Status :-</b></h4></td>
                                <td style="border-top: none;"><h4><b><?php echo $model->status; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Delivery Date :-</b></h4></td>
                                <td style="border-top: none;"><h4><b><?php echo $model->deliver_by; ?></b></h4></td>
                                <td style="border-top: none;"><h4><b>Delivery Type :-</b></h4></td>
                                <td style="border-top: none;"><h4><b><?php echo $model->delivery_status; ?></b></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-7 pull-left">
            <div class="box">
                <div class="box-header btn-equal">
                    <h3 class="panel-title">Production KOT Items</h3>
                </div>
                <div class="panel-body">
                    <form id="item" action="<?php echo $this->createUrl('productionkot/additems', array('pkot' => $model->id)) ?>" class="navbar-search expanded" role="search" method="post">
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
                    <?php
                    $items = Productionkotitems::model()->findAllByAttributes(array('production_kot_id' => $model->id)); //print_r($items);     
                    if (!empty($items)) {
                        ?>
                        <div class="col-lg-12" id="print_bill_ots">
                            <style>
                                @media print {
                                    .no-print{
                                        display:none; 
                                    }
                                    tr td,th {
                                        font-size:12px;  
                                    }
                                    #bill_area {
                                        /*overflow: no-display;*/
                                    }
                                    .border_on_print{
                                        border-bottom:1px dotted #000; 
                                    }
                                    .border_on_print_tb{
                                        border-bottom:1px dotted #000; 
                                        border-top: 1px dotted #000; 
                                    }
                                    *{
                                        font-family:monospace; 
                                    }
                                }

                                @media only screen{
                                    .no-screen{
                                        display:none; 
                                    }
                                    #bill_area {
                                        /*overflow: scroll;*/
                                    }
                                }
                                p.speech,.left-speech {
                                    font-size: 15px;
                                    color: #FFF;
                                    position: relative;
                                    margin-left: -15px;
                                    padding: 5px;
                                    width: 90%;
                                    height: auto;
                                    text-align: left;
                                    line-height: 20px;
                                    background-color: #fff;
                                    border: 1px solid #666;
                                    -webkit-border-radius: 10px;
                                    -moz-border-radius: 10px;
                                    border-radius: 10px;
                                    -webkit-box-shadow: 2px 2px 4px #888;
                                    -moz-box-shadow: 2px 2px 4px #888;
                                    box-shadow: 2px 2px 4px #888;
                                }

                                p.speech,.right-speech {
                                    font-size: 15px;
                                    color: #FFF;
                                    position: relative;
                                    margin-left: 10%;
                                    padding: 5px;
                                    width: 90%;
                                    height: auto;
                                    text-align: left;
                                    line-height: 20px;
                                    background-color: #fff;
                                    border: 1px solid #666;
                                    -webkit-border-radius: 10px;
                                    -moz-border-radius: 10px;
                                    border-radius: 10px;
                                    -webkit-box-shadow: 2px 2px 4px #888;
                                    -moz-box-shadow: 2px 2px 4px #888;
                                    box-shadow: 2px 2px 4px #888;
                                }

                            </style>
                            <div class="card height-14" id="bill_area">
                                <div class="card-head">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="border_on_print">#</th>
                                            <th class="border_on_print">Item</th>
                                            <th class="border_on_print">Status</th>
                                            <?php if ($model->is_added_to_shelf == '0') { ?>
                                                <th class="border_on_print">Resend</th>
                                            <?php } ?>
                                            <th class="border_on_print">Qty</th>                                      
                                            <th class="no-print">
                                                <?php if ($model->is_added_to_shelf == '0') { ?>
                                                    <?php if ($model->status == 'pending') { ?>
                                                        <a href="#" title="Delete Items">X</a>
                                                    <?php } else if ($model->status == 'done') { ?>
                                                        <a href="#" title="Add To Shelf"><i class="glyphicon glyphicon-plus"></i></a>   
                                                        <?php
                                                    } else {
                                                        
                                                    }
                                                    ?>
                                                <?php } else if ($model->is_added_to_shelf == '1') { ?>

                                                <?php } ?>

                                            </th>                                      
                                        </tr>
                                        <tbody>
                                            <?php
                                            $count = 1;
                                            $total_qty = 0;
                                            foreach ($items as $item) {
                                                $item_name = Productionkotitems::getItem($item);
                                                ?>
                                                <tr>
                                                    <td style="width:10%"><?php echo $count; ?></td>                                        
                                                    <td style="width:40%"><?php echo $item_name; ?></td>                                        
                                                    <td style="width:20%"><?php echo $item->status; ?></td> 
                                                    <?php if ($model->is_added_to_shelf == '0') { ?>
                                                        <td style="width:10%"  class="no-print">
                                                            <?php if ($item->status != 'done') { ?>
                                                                <a href="<?php echo $this->createUrl('productionkot/resend', array('id' => $item->id)) ?>"><i class="glyphicon glyphicon-refresh"></i></a>   
                                                            <?php } ?>
                                                        </td>
                                                    <?php } ?>
                                                    <td style="width:10%">
                                                        <label class="no-screen"><?php echo $item->qty; ?></label>
                                                        <input class="no-print" type="number" name="qty" value="<?php echo $item->qty; ?>" id="qty_<?php echo $item->id; ?>"
                                                               style="width:100%"  onkeyup="Javascript: if (event.keyCode == 13 || event.which == 13)
                                                                           update(<?php echo $item->id ?>, this.value);">   
                                                               <?php $total_qty = $total_qty + $item->qty; ?>
                                                    </td>      
                                                    <td style="width:10%"  class="no-print">
                                                        <?php if ($item->is_added_to_shelf == 0) { ?>
                                                            <?php if ($item->status == 'pending') { ?>
                                                        <a href="<?php echo $this->createUrl('productionkot/removeitem', array('id' => $item->id)) ?>" onclick="return confirm('Are you sure you want to delete item ?')" title="Remove Item"><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i></span></a> 
                                                            <?php } else if ($item->status == 'done') { ?>
                                                                <a href="<?php echo $this->createUrl('productionkot/addtoshelf', array('id' => $item->id)) ?>" onclick="return confirm('Are you sure you want to add item in shelf ?')" title="Add To Shelf"><span class="label label-success" style="font-size: 15px;"><b>A2S</b></span></a>   
                                                                <?php
                                                            } else {
                                                                
                                                            }
                                                            ?>
                                                        <?php } else if ($item->is_added_to_shelf == 1) { ?>
                                                            <span class="label label-success" title="<?php echo $item->qty . ' ' . $item_name; ?> Added To Shelf on <?php echo $item->added_date; ?>" style="font-size: 15px;"><b>Added To Shelf</b></span>  
                                                        <?php } ?>
                                                    </td>       
                                                </tr>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>                    
                            </div>
                        </div>
                    <?php } ?>
                </div>   
            </div>   
        </div> 
        <div class="col-lg-5 pull-right">
            <div class="box">
                <div class="box-header btn-aqua">
                    <h3 class="panel-title">Production KOT Conversations</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form id="comment_form" action="<?php echo $this->createUrl('productionkot/addcomment', array('pkot' => $model->id)) ?>" class="navbar-search expanded" role="search" method="post">
                            <input type="hidden" name="pkot" value="<?php echo $model->id; ?>">
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="3"  name="comment" id="comment"></textarea>
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" id="comment_btn" class="btn btn-aqua"><i class="glyphicon glyphicon-send"></i> Send</button>
                            </div>
                        </form>
                    </div><br/><br/>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            $comments = Productionkotcomments::model()->findAllByAttributes(array('production_kot_id' => $model->id));
                            if (!empty($comments)) {
                                ?>
                                <table class="table">
                                    <?php foreach ($comments as $comment) { ?>
                                        <tr>
                                            <?php
                                            if ($comment->from_id == Yii::app()->user->id) {
                                                ?>
                                                <td><p class="right-speech" style="background-color: #f6523d;"></span><?php echo $comment->comments; ?></p></td>
                                            <?php } else { ?>
                                                <td><p class="left-speech" style="background-color: #40c127"></span><?php echo $comment->comments; ?></p></td>
                                                    <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </table>
                            <?php } ?>
                        </div>   
                    </div>   
                </div>   
            </div> 
        </div> 
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
//        document.onkeypress = function(evt) {
//            evt = evt || window.event;
//            var charCode = evt.which || evt.keyCode;
//            var charStr = String.fromCharCode(charCode);
//            if (/[a-zA-Z]/i.test(charStr)) {
//                //alert("Letter typed");
//                $("#q").focus().val();
//            }
//        };
        ///checking focus of cursor
<?php if (!empty($val)) { ?>
            var input = $('#<?php echo 'qty_' . $val; ?>');
            input.focus().val(input.val());
<?php } else { ?>
            $("#q").focus();
<?php } ?>
    });

    function update(data, val)
    {
        var value = parseInt(val);
        if (value >= 1) {
            var id = data;
            window.location = "<?php echo Yii::app()->request->baseUrl; ?>/productionkot/updateqty/id/" + id + "/qty/" + value;
        }
    }


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
                    url: '<?php echo $this->createUrl("productionkot/getItemDetail"); ?>',
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
                window.location.href = "<?php echo $this->createUrl('productionkot/additems', array('pkot' => $model->id)); ?>&item=" + item.id;
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