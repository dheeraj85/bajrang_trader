<form id="chllan_form_filter"> 
    <div class="row">
        <div class="col-lg-2" >
            <label>Date From</label>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'bill_from_date',
                'name' => 'Bill[bill_from_date]',
                //       'value' => isset($model->regdate) ? $model->regdate : date('Y-m-d'),
                'options' => array(
                    'onSelect' => 'js:function(selectedDate) {
                        $("#Bill_bill_from_date").datepicker("option", "maxDate", selectedDate);
                  }',
                    'dateFormat' => 'dd-mm-yy',
                    'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    'placeholder' => 'From Date',
                    'class' => 'form-control',
                    'required' => 'required',
                ),
            ));
            ?>

        </div>

        <div class="col-lg-2"> 
            <label>Date To</label>
            <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'attribute' => 'bill_to_date',
                'name' => 'Bill[bill_to_date]',
                //       'value' => isset($model->regdate) ? $model->regdate : date('Y-m-d'),
                'options' => array(
                    'onSelect' => 'js:function(selectedDate) {
                        $("#Bill_bill_from_date").datepicker("option", "maxDate", selectedDate);
                  }',
                    'dateFormat' => 'dd-mm-yy',
                    'changeYear' => 'true', 'changeMonth' => 'true', 'yearRange' => '-90:+1'
                ),
                'htmlOptions' => array(
                    'style' => '',
                    //'readonly' => 'readonly'
                    'placeholder' => 'Issue Date', 'class' => 'form-control',
                    'ng-model' => 'formInfo.to_date'
                ),
            ));
            ?>

        </div>
        <div class="col-lg-3">
            <label>Purchase Orders</label>          
            <select class="form-control" id="purchase_order" name="purchase_order" onchange="getOrderItems(this.value)">

            </select>
        </div>
        <div class="col-lg-3">
            <label>Item</label>
            <select class="form-control" id="order_items" name="order_items">

            </select>
        </div>
        <div class="col-lg-2" style="margin-top: 21px;">
            <button class="btn btn-primary" type="button" onclick="getChallanList()">Show Challan</button>
        </div>
    </div>
</form>






