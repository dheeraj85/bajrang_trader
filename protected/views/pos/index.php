<div class="row">
    <div class="col-md-12">
        <div class="card1">
            <div class="card-head">
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#<?php // echo $this->createUrl("pos/ots_items");  ?>">OTS</a></li>
                    <li><a href="<?php echo $this->createUrl("pos/menu_items"); ?>">MENU  <sup class="badge style-danger"></sup></a></li>
                    <li><a href="<?php echo $this->createUrl("pos/aos_items"); ?>">AOS  <sup class="badge style-danger"></sup></a></li>
                </ul>
            </div><!--end .card-head -->
            <div class="tab-content">
                <div class="tab-pane active" id="first4">
                    <div class="col-md-8">
                        <ul class="header-nav">
                            <li class="col-lg-2"><div style="font-size:14px;font-weight:bold;">OTS ITEMS</div></li>
                            <li class="col-lg-10 pull-right">
                                <form action="<?php echo $this->createUrl('pos/addToCart') ?>" class="navbar-search expanded" role="search">
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <span class="typeahead__query">
                                                <input style="width:420px;" class="form-control js-typeahead-input"
                                                       name="q"
                                                       type="search"
                                                       autofocus
                                                       autocomplete="off">
                                            </span>
                                            <span class="typeahead__button">
                                                <button type="submit">
                                                    <i class="typeahead__search-icon"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <legend></legend>

                        <div class="card-body no-padding height-5">      
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="card" onclick="additem(1, 1, 135)">
                                    <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/cappuccino.jpg" alt="" />
                                    <div class="card-body small-padding text-center">
                                        <span class="text-default-dark">Cappuccino</span>
                                    </div>
                                </div><!--end .card -->
                            </div><!--end .col -->
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="card" onclick="additem(2, 1, 150)">
                                    <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/chocolate-cream.jpg" alt="" />
                                    <div class="card-body small-padding text-center">
                                        <span class="text-primary-dark">Chocolate ice cream</span>
                                    </div>
                                </div><!--end .card -->
                            </div><!--end .col -->
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="card" onclick="additem(3, 1, 125)">
                                    <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/coffee.jpg" alt="" />
                                    <div class="card-body small-padding text-center">
                                        <span class="text-accent-dark">Coffee</span>
                                    </div>
                                </div><!--end .card -->
                            </div><!--end .col -->
                            <div class="col-lg-3 col-md-3 col-xs-6">
                                <div class="card" onclick="additem(4, 1, 200)">
                                    <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/coffee-cafe-latte.jpg" alt="" />
                                    <div class="card-body small-padding text-center">
                                        <span class="text-danger">Coffee Cafe Latte</span>
                                    </div>
                                </div><!--end .card -->
                            </div><!--end .col -->
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="card height-14">
                            <div class="card-head">
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="5" align="center"><h4>The Oven Classic - Outlet </h4></td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Qty</th>                                      
                                        <th>Rate</th>                                      
                                        <th>Price</th>                                      
                                        <th><a href="#" title="Delete Items">X</a></th>                                      
                                    </tr>
                                    <?php
                                    $items = PosCart::getAll(); //print_r($items);                        
                                    $count = 1;
                                    foreach ($items as $item) {
                                        ?>
                                        <tr>
                                            <td style="width:7%"><?php echo $count; ?></td>                                        
                                            <td style="width:53%"><?php echo $item->getItem()->positem->itemname; ?></td>                                        
                                            <td style="width:10%">
                                                <input type="text" name="qty" value="<?php echo $item->qty; ?>" 
                                                       style="width:90%" tabindex="<?php echo $count; ?>" onkeypress="update(<?php echo $item->itemid ?>, this.value)">                                            
                                            </td>     
                                            <td style="width:15%"><?php $sale_price = $item->getItem()->sale_price;
                                    echo $sale_price;
                                        ?>
                                            </td>       
                                            <td style="width:20%"><?php echo $sale_price * $item->qty; ?></td>       
                                            <td style="width:5%">
                                                <a href="<?php echo $this->createUrl('pos/removeToCart', array('id' => $item->itemid)) ?>" onclick="return confirm('Are you sure want to remove ?')">&times;</a>   
                                            </td>       
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </table>
                            </div>        
                        </div><!--end .card -->	
                        <div class="card height-2"><br/>
                            <div id="new_btn" class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #333;font-size:15px;">
                                <span class="pull-left"><i class="fa fa-edit fa-fw"></i></span> New
                            </div>
                            <div id="reset_btn" class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="border-right:1px solid #333;font-size:15px;">
                                <span class="pull-left"><i class="fa fa-remove fa-fw"></i></span> Clear
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="font-size:15px;">
                                <span class="pull-left"><i class="fa fa-print fa-fw"></i></span> Print
                            </div>  
                        </div>
                    </div><!--end .col -->

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function update(data, value)
    {
        //   var value = obj.value;
        var id = data;
        window.location = "<?php echo Yii::app()->request->baseUrl; ?>/pos/updateCart/id/" + id + "/qty/" + value;
    }
</script>
<script type="text/javascript">
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
                    url: '<?php echo $this->createUrl("pos/getItemDetail"); ?>',
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
                window.location.href = "<?php echo $this->createUrl('pos/addToCart') ?>?item=" + item.id;
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
