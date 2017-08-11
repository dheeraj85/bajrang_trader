<div class="col-md-8">
<ul class="header-nav">
    <li class="col-lg-3"><div style="font-size:14px;font-weight:bold;">OTS ITEMS</div></li>
    <li class="col-lg-9 pull-right">
        <form class="navbar-search expanded" role="search">
            <div class="form-group">
                <input style="width:450px;" id="user_v1-query" class="form-control js-typeahead-car_v1" name="car_v1[query]" type="search" placeholder="Search Products" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-icon-toggle"><i class="fa fa-search"></i></button>
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
                <table class="table height-1" style="background-color:#91d0fd;">
                    <tr>
                        <td><b>Bill No : </b></td>
                        <td>TOC-001</td>
                        <td width="10"></td>
                        <td><b>Date & Time : </b></td>
                        <td><?php echo date('d-m-Y H:i:s') ?></td>
                    </tr>
                </table>
                <div id="cart_items">
                    
                    
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
    </div>
<!--end .col -->