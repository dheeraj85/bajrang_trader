<div class="row">
    <div class="col-md-12">
        <div class="card1">
            <div class="card-head">
                <ul class="nav nav-tabs nav-justified">
                    <li><a href="<?php echo $this->createUrl("pos/ots_items"); ?>">OTS</a></li>
                    <li class="active"><a href="#<?php // echo $this->createUrl("pos/menu_items");  ?>">MENU  <sup class="badge style-danger"></sup></a></li>
                    <li><a href="<?php echo $this->createUrl("pos/aos_items"); ?>">AOS  <sup class="badge style-danger"></sup></a></li>
                </ul>
            </div><!--end .card-head -->
            <div class="tab-content">

                <div class="tab-pane active" id="third4">
                    <div class="col-md-8">
                        <style>
                            .boxShadow_red { 
                                box-shadow: 0 0 35px #0091ea;
                                padding:10px 15px 10px 15px;
                                height:100px; 
                                background-color:#00b0ff ;
                                color: #fff;
                                font-size:22px; 
                                font-weight: bold;
                            }
                            .twitter-typeahead{
                                width:100%;
                            }

                            .twitter-typeahead .tt-query,
                            .twitter-typeahead .tt-hint {
                                margin-bottom: 0;
                            }
                            .tt-dropdown-menu {
                                min-width: 160px;
                                margin-top: 2px;
                                padding: 5px 0;
                                background-color: #fff;
                                border: 1px solid #ccc;
                                border: 1px solid rgba(0,0,0,.2);
                                *border-right-width: 2px;
                                *border-bottom-width: 2px;
                                -webkit-border-radius: 6px;
                                -moz-border-radius: 6px;
                                border-radius: 6px;
                                -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                                -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                                box-shadow: 0 5px 10px rgba(0,0,0,.2);
                                -webkit-background-clip: padding-box;
                                -moz-background-clip: padding;
                                background-clip: padding-box;
                                width:100%;        
                            }

                            .tt-suggestion {
                                display: block;
                                padding: 3px 20px;
                            }

                            .tt-suggestion.tt-is-under-cursor {
                                color: #fff;
                                background-color: #0081c2;
                                background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
                                background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
                                background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
                                background-image: -o-linear-gradient(top, #0088cc, #0077b3);
                                background-image: linear-gradient(to bottom, #0088cc, #0077b3);
                                background-repeat: repeat-x;
                                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0)
                            }

                            .tt-suggestion.tt-is-under-cursor a {
                                color: #fff;
                            }

                            .tt-suggestion p {
                                margin: 0;
                            }
                        </style>

                        <ul class="header-nav">
                            <li class="col-lg-3"><div style="font-size:14px;font-weight:bold;">MENU ITEMS</div></li>
                            <li class="col-lg-9 pull-right">
                                <form class="navbar-search expanded" role="search" id="searchItem">
                                    <div class="form-group">
                                        <input type="text" style="width:450px;" class="form-control" name="query" id="query" placeholder="Start typing something to search...">
                                        <button type="button" class="btn btn-icon-toggle" onclick="getSearchItems()"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </li>
                        </ul>
                        <legend></legend>


                        <div class="card-body no-padding height-5" id="show_categories">    

                        </div>       

                        <div class="card-body no-padding height-5" id="show_subcategories" style="display: none">  

                        </div>
                        <div class="card-body no-padding height-5" id="show_items" style="display: none">  

                        </div>
                    </div>
                    <div class="col-md-4" id="show_cart_items">
                        <div class="card height-14">
                            <div class="card-head">
                                <table class="table height-1" style="background-color:#91d0fd;">
                                    <tr>
                                        <td><b>Bill No : </b></td>
                                        <td>TOC-001</td>
                                        <td width="10"></td>
                                        <td><b>Date & Time : </b></td>
                                        <td><?php echo date('d-m-Y h:m:s') ?></td>
                                    </tr>
                                </table>
                                <div id="cart_items">
                                    <?php print_r($cart_items); ?>
                                </div> 
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
            </div><!--end .card-body -->
        </div>
        <br/>
    </div><!--end .col -->

</div><!--end .row -->  

<script>


    $(document).ready(function() {

        showCategories();
    }); //======ready

    function showCategories() {
        var url = '<?php echo $this->createUrl("pos/getCats"); ?>';
        $.getJSON(url, function(data) {
            var content = '';
            $.each(data.cats, function(k, v) {
                content += '<div class="col-lg-3 col-md-3 col-xs-6">';
                content += '<div class="card" onclick="showSubCategories(' + v.id + ')">';
                content += '<div class="card-body small-padding text-center boxShadow_red">';
                content += '<span class="text-default-bright">' + v.name + '</span>';
                content += '</div>    </div></div>';
            }); //alert(cat_id);
            $("#show_subcategories").css('display', 'none');
            $("#show_items").css('display', 'none');
            $("#show_categories").html(content).slideDown(1000);
        });
    }
    ///show sub category
    function showSubCategories(cat_id) {
        var url = '<?php echo $this->createUrl("pos/getSubcats"); ?>';
        $.getJSON(url, {'cat': cat_id}, function(data) {
            var content = '<div class="row"><div class="btn-group btn-breadcrumb">';
            content += '<a href="#" class="btn btn-primary" onclick="showCategories()"> ' + data.category + ' </a>';
            content += '</div> </div>';
            $.each(data.subcats, function(k, v) {
                content += '<div class="col-lg-3 col-md-3 col-xs-6">';
                content += '<div class="card" onclick="showMenuItems(' + v.id + ',' + cat_id + ' )">';
                content += '<div class="card-body small-padding text-center boxShadow_red">';
                content += '<span class="text-default-bright">' + v.name + '</span>';
                content += '</div>    </div></div>';
            });
//alert(cat_id);
            $("#show_categories").css('display', 'none');
            $("#show_items").css('display', 'none');
            $("#show_subcategories").html(content).slideDown(1000);
        });
    }
    function showMenuItems(subcat_id, cat_id) {
        var url = '<?php echo $this->createUrl("pos/getMenuItems"); ?>';
        $.getJSON(url, {'cat': cat_id, 'sub_cat': subcat_id}, function(data) {
            var content = '<div class="row"><div class="btn-group btn-breadcrumb">';
            content += '<a href="#" class="btn btn-primary" onclick="showCategories()"> ' + data.cat_name + ' </a>';
            content += '<a href="#" class="btn btn-primary" onclick="showSubCategories(' + cat_id + ')"> ' + data.subcat_name + ' </a>';
            content += '</div> </div><br/>';
            if (data.msg == 'no') {
                // alert('no');
                content += ' <div class="col-lg-12 alert alert-danger">No Items Available</div>';
            } else {
                $.each(data.menu, function(k, v) {
                    content += '<div class="col-lg-3 col-md-3 col-xs-6">';
                    content += '<div class="card" onclick="addOrderInCart(' + v.id + ',1)">';
                    content += '<div class="card-body small-padding text-center">';
                    content += ' <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/' + v.item_image + ' " alt="" />';
                    content += '<span class="text-default-black" style="font-weight:bold">' + v.itemname + '</span>';
                    content += '</div>    </div></div>';
                });
            }
            //alert(cat_id);
            $("#show_subcategories").css('display', 'none');
            $("#show_items").html(content).slideDown(1000);
        });
    }

    function addOrderInCart(itemid, qty) {
        //alert(itemid);
        var url = '<?php echo $this->createUrl("pos/addToCart"); ?>';
        $.getJSON(url, {'item': itemid, 'qty': qty}, function(data) {
            $("#show_cart_items").html(data).show();
        });
    }

    function getSearchItems() {
        var url = '<?php echo $this->createUrl("pos/getSearchItems"); ?>';
        $.getJSON(url, $("#searchItem").serialize(), function(data) {
            var content = "<h4>Filtered Items </h4>";
            if (data.msg == 'no') {
                content += ' <div class="col-lg-12 alert alert-danger">No Items Available</div>';
            } else {
                $.each(data.menu, function(k, v) {
                    content += '<div class="col-lg-3 col-md-3 col-xs-6">';
                    content += '<div class="card" onclick="addOrderInCart(' + v.id + ',1)">';
                    content += '<div class="card-body small-padding text-center">';
                    content += ' <img class="img-responsive" src="<?php echo Yii::app()->request->baseUrl; ?>/uploads/Itemimage/' + v.item_image + ' " alt="" />';
                    content += '<span class="text-default-black" style="font-weight:bold">' + v.itemname + '</span>';
                    content += '</div>    </div></div>';
                });
            }
            $("#show_categories").css('display', 'none');
            $("#show_subcategories").css('display', 'none');
            $("#show_items").html(content).slideDown(1000);
        });
    }
</script>