<?php

/**
 * This is the model class for table "purchase_invoice_items".
 *
 * The followings are the available columns in table 'purchase_invoice_items':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $p_category_id
 * @property integer $p_sub_category_id
 * @property integer $item_id
 * @property string $particulars
 * @property string $v_qty
 * @property integer $v_scale
 * @property string $input_type
 * @property integer $c_unit_value
 * @property string $stock_qty
 * @property string $stock_taking_scale
 * @property string $rate
 * @property string $amount
 * @property string $discount
 * @property string $is_mrd
 * @property integer $mrd_no
 * @property string $make_date
 * @property string $ready_date
 * @property string $discard_date
 * @property string $schedule_date
 * @property string $remarks
 * @property integer $is_active
 * @property integer $is_added_to_stock
 * @property integer $is_good_return
 */
class Purchaseinvoiceitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_invoice_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id, p_category_id, p_sub_category_id, item_id, v_scale, c_unit_value, mrd_no, is_active, is_added_to_stock, is_good_return', 'numerical', 'integerOnly' => true),
            array('particulars', 'length', 'max' => 200),
            array('v_qty, stock_qty, stock_taking_scale', 'length', 'max' => 10),
            array('input_type', 'length', 'max' => 7),
            array('rate, amount, discount', 'length', 'max' => 12),
            array('is_mrd', 'length', 'max' => 11),
            array('remarks', 'length', 'max' => 100),
            array('make_date, ready_date, discard_date, schedule_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, p_category_id, p_sub_category_id, item_id, particulars, v_qty, v_scale, input_type, c_unit_value, stock_qty, stock_taking_scale, rate, amount, discount, is_mrd, mrd_no, make_date, ready_date, discard_date, schedule_date, remarks, is_active, is_added_to_stock, is_good_return', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoice' => array(self::BELONGS_TO, 'Purchaseinvoice', 'invoice_id'),
            'item' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
            'scale' => array(self::BELONGS_TO, 'Itemscale', 'v_scale'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'p_category_id' => 'P Category',
            'p_sub_category_id' => 'P Sub Category',
            'item_id' => 'Item',
            'particulars' => 'Particulars',
            'v_qty' => 'V Qty',
            'v_scale' => 'V Scale',
            'input_type' => 'Input Type',
            'c_unit_value' => 'C Unit Value',
            'stock_qty' => 'Stock Qty',
            'stock_taking_scale' => 'Stock Taking Scale',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'discount' => 'Discount',
            'is_mrd' => 'Is Mrd',
            'mrd_no' => 'Mrd No',
            'make_date' => 'Make Date',
            'ready_date' => 'Ready Date',
            'discard_date' => 'Discard Date',
            'schedule_date' => 'Schedule Date',
            'remarks' => 'Remarks',
            'is_active' => 'Is Active',
            'is_added_to_stock' => 'Is Added To Stock',
            'is_good_return' => 'Is Good Return',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('p_category_id', $this->p_category_id);
        $criteria->compare('p_sub_category_id', $this->p_sub_category_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('v_qty', $this->v_qty, true);
        $criteria->compare('v_scale', $this->v_scale);
        $criteria->compare('input_type', $this->input_type, true);
        $criteria->compare('c_unit_value', $this->c_unit_value);
        $criteria->compare('stock_qty', $this->stock_qty, true);
        $criteria->compare('stock_taking_scale', $this->stock_taking_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('is_mrd', $this->is_mrd, true);
        $criteria->compare('mrd_no', $this->mrd_no);
        $criteria->compare('make_date', $this->make_date, true);
        $criteria->compare('ready_date', $this->ready_date, true);
        $criteria->compare('discard_date', $this->discard_date, true);
        $criteria->compare('schedule_date', $this->schedule_date, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_added_to_stock', $this->is_added_to_stock);
        $criteria->compare('is_good_return', $this->is_good_return);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseinvoiceitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function gettax($data) {
        foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $data->id)) as $itax) {
            $taxes = Invoicesettings::model()->findByPk($itax->invoice_settings_id);
            echo "<label>" . $taxes->label . "(%)</label> " . number_format($itax->tax_percent, '1') . "&nbsp;&nbsp;:&nbsp;";
            $taxamt = $data->amount * $itax->tax_percent / 100;
            echo $taxamt . "<br/>";
        }
    }

    public static function getdiscount($data) {
        echo $data->discount;
    }

    public static function getgrossamt($data) {
        $invoice_data = Purchaseinvoice::model()->findByPk($data->invoice_id);
        if ($invoice_data->invoice_format == "F2") {
            echo $data->amount - $data->discount;
        } else {
            $mtaxamt = 0.0;
            foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $data->id)) as $itax) {
                $taxamt = $data->amount * $itax->tax_percent / 100;
                $mtaxamt = $mtaxamt + $taxamt;
            }
            echo $data->amount + $mtaxamt - $data->discount;
        }
    }

    public static function gettotalamt($data) {
        $invoice_itemdata = Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id));
        $mamt = 0.0;
        foreach ($invoice_itemdata as $item) {
            $mamt = $mamt + $item->amount - $item->discount;
        }
        echo $mamt;
    }

    public static function getinvoiceitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        $rctax = 0.0;
        foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
            echo "<tr><td>" . $lists->item->itemname;
            if (!empty($lists->stock_taking_scale)) {
                echo "(" . $lists->item->item_scale . ")";
            }
            if ($lists->item->item_classification == "Reverse-Charge") {
                echo "<span class='badge pull-right' style='background-color: #dd4b39'>RC</span>";
            }else{            
            if ($lists->unmatched_code == "1") {
                echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
            }    
            }
            "</td>";
            echo "<td align='right'>" . $lists->v_qty . "</td>";
            echo "<td align='right'>" . $lists->rate . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->amount . "</td>";
            if ($data->place_of_supply == "1") {
                if($lists->is_choice_tax=="1"){
                echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";    
                }else{
                echo "<td align='right'>" . $lists->tax_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->tax_amt . "</td>";
            } else {
                if($lists->is_choice_tax=="1"){
                echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }else{
                echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'>" . $lists->cess_rate . "</td>";
            echo "<td align='right'>" . $lists->cess_amt . "</td>";
            if($data->discount_type=="item_discount"){
            echo "<td align='right'>" . $lists->discount . "</td>";
            }
            echo "<td align='right'>" . $lists->tax_amt . "</td>";
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt  + $lists->tax_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo $lists->amount + $mtaxamt  + $lists->tax_amt + $lists->cess_amt;
            if (!empty($data->vendor_id)) {
                $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . "," . $data->vendor_id . "," . $data->place_of_supply . ",'" . $lists->goods_service . "'," . $data->state_code . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";
            } else {
                $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . "," . $data->place_of_supply . ",'" . $lists->goods_service . "'," . $data->state_code . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";            
            }
            echo "</td>";
            echo "<td><a title='remove' onclick=itemdelete(" . $lists->id . "," . $data->id . ")><i class='fa fa-trash-o'></i></a>";
            if ($lists->item->goods_service == "Good") {
            echo $edititem ;
            } "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        if ($data->place_of_supply == "1") {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='11'><b>Total</b></td>";
            } else {
                echo "<td colspan='10'><b>Total</b></td>";
            }
        } else {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='12'><b>Total</b></td>";
            } else {
                echo "<td colspan='11'><b>Total</b></td>";
            }
        }
        echo "<td align='right'><b>" . $mitem_amt . "</b></td></tr>";
    }

    public static function getinvoiceitemsgpu($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Itemstock::model()->findAllByAttributes(array("id" => $data->id), $criteria) as $lists) {
            echo "<tr><td>" . $lists->item->itemname . "(" . $lists->item->item_scale . ")" . "-" . $lists->item->brand . "</td>";
            $mtaxamt = 0.0;
            echo "<td>";
            foreach (Processeditemtax::model()->findAllByAttributes(array("processed_item_id" => $lists->id)) as $itax) {
                $taxes = Invoicesettings::model()->findByPk($itax->invoice_settings_id);
                // if(count($taxes)){
                echo "<label>" . $taxes->label . "(%)</label> " . number_format($itax->tax_percent, '1') . "&nbsp;&nbsp;:&nbsp;";
                $taxamt = $lists->amount * $itax->tax_percent / 100;
                $mtaxamt = $mtaxamt + $taxamt;
                echo $taxamt . "<br/>";
                // }
            }
            echo "</td>";
            echo "<td>" . $lists->discount . "</td>";
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt - $lists->discount;
            echo "<td>";
            echo $lists->amount + $mtaxamt - $lists->discount;
            echo "</td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='3'><b>Total</b></td>";
        echo "<td><b>" . $mitem_amt . "</b></td></tr>";
    }

    public static function getinvoiceitemsreview($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
            echo "<tr><td>" . $lists->item->itemname;
            if (!empty($lists->stock_taking_scale)) {
                echo "(" . $lists->item->item_scale . ")";
            }
            if ($lists->unmatched_code == "1") {
                echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
            }
            "</td>";
            echo "<td align='right'>" . $lists->v_qty . "</td>";
            echo "<td align='right'>" . $lists->rate . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->amount . "</td>";
            if ($data->place_of_supply == "1") {
                if($lists->is_choice_tax=="1"){
                echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";    
                }else{
                echo "<td align='right'>" . $lists->tax_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->tax_amt . "</td>";
            } else {
                if($lists->is_choice_tax=="1"){
                echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }else{
                echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'>" . $lists->cess_rate . "</td>";
            echo "<td align='right'>" . $lists->cess_amt . "</td>";
            if($data->discount_type=="item_discount"){
            echo "<td align='right'>" . $lists->discount . "</td>";
            }
            echo "<td align='right'>" . $lists->tax_amt . "</td>";
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo $lists->amount + $mtaxamt  + $lists->tax_amt + $lists->cess_amt;
            echo "</td>";
            echo "</tr>";
        }        
        echo "<tr>";
        if ($data->place_of_supply == "1") {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='11'><b>Total</b></td>";
            } else {
                echo "<td colspan='10'><b>Total</b></td>";
            }
        } else {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='12'><b>Total</b></td>";
            } else {
                echo "<td colspan='11'><b>Total</b></td>";
            }
        }
        echo "<td align='right'><b>" . $mitem_amt . "</b></td></tr>";
    }

    public static function getbilltotalamt($data) {
        $mamt = 0.0;
        $mtax = 0.0;
        $bamt = 0.0;
        $tshare = 0.0;
        $namt = 0.0;
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id,"is_reverse_item"=>0), $criteria) as $lists) {
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            $mtaxamt = 0.0;
            $mamt = $mitem_amt;
        }
        echo "<tr><td><b>Item Total Amount (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $mamt . "</b></td></tr>";
        $totalbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $data->id, "type" => "tax"));
        if (!empty($totalbilltax)) {
            $tshare = $mamt * $totalbilltax->tax_percent / 100;
            echo "<tr><td>" . $totalbilltax->label . "(+) " . number_format($totalbilltax->tax_percent, "1") . "(%)</td><td>" . $tshare . "</td></tr>";
        }
        foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $data->id, "type" => "others")) as $itax) {
            $mtax = $mtax + $itax->tax_percent;
            echo "<tr><td>" . $itax->label . "(+)</td>";
            echo "<td colspan='3'></td>";
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            echo "<td colspan='7'></td>";
            echo "<td class='text-right'>" . $itax->tax_percent . "</td><td class='text-right'><a title='remove' onclick='deletetax(" . $itax->id . "," . $data->id . ")'><i class='fa fa-trash-o'></i></a></td></tr>";
        }
        $bamt = $mamt + $mtax + $tshare+$data->round_off;
        echo "<tr><td><b>Round Off Amount (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $data->round_off . "</b></td></tr>";
        echo "<tr><td><b>Invoice Total (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $bamt . "</b></td></tr>";
        echo "<tr><td><b>Amount of Tax Subject to Reverse Charge</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td>";
        $tax_per_amt=0.0;
        foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $data->id)) as $itax) {
                $reverse_percent=Invoicesettings::model()->findByAttributes(array('label'=>$itax->label))->value;
                if($data->place_of_supply=="1"){
                    $rev_tax_amt=$itax->tax_percent*$reverse_percent/100;
                    $rev_tax_rate=$itax->tax_percent*$reverse_percent/100;
                    echo "<label>".$itax->label."</label><br/>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr>";
                    echo "<td align='right'>IGST Rate</td>";
                    echo "<td align='right'>IGST Amt.</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='right'>".$rev_tax_rate." %</td>";
                    echo "<td align='right'>".$rev_tax_amt."</td>";
                    echo "</tr>";
                    echo "</table>";
                    $tax_per_amt=$tax_per_amt+$rev_tax_amt;
                }else{
                   $cgst_tax_amt=($itax->tax_percent*$reverse_percent/100)/2; 
                   $sgst_tax_amt=($itax->tax_percent*$reverse_percent/100)/2; 
                   $cgst_tax_rate=$reverse_percent/2; 
                   $sgst_tax_rate=$reverse_percent/2; 
                   echo "<label>".$itax->label."</label><br/>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr>";
                    echo "<td align='right'>CGST Rate</td>";
                    echo "<td align='right'>CGST Amt.</td>";
                    echo "<td align='right'>SGST Rate</td>";
                    echo "<td align='right'>SGST Amt.</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='right'>".$cgst_tax_rate." %</td>";
                    echo "<td align='right'>".$cgst_tax_amt."</td>";
                    echo "<td align='right'>".$sgst_tax_rate." %</td>";
                    echo "<td align='right'>".$sgst_tax_amt."</td>";
                    echo "</tr>";
                    echo "</table>";
                   $tax_per_amt=$tax_per_amt+$cgst_tax_amt+$sgst_tax_amt;
                }                
            }
        echo "</td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $tax_per_amt . "</b></td></tr>";
    }

    public static function getbilltotalamtreview($data) {
        $mamt = 0.0;
        $mtax = 0.0;
        $bamt = 0.0;
        $tshare = 0.0;
        $namt = 0.0;
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Purchaseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id,"is_reverse_item"=>0), $criteria) as $lists) {
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt  + $lists->tax_amt + $lists->cess_amt;
            $mtaxamt = 0.0;
            $mamt = $mitem_amt;
        }
        echo "<tr><td><b>Item Total Amount (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $mamt . "</b></td></tr>";
        $totalbilltax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $data->id, "type" => "tax"));
        if (!empty($totalbilltax)) {
            $tshare = $mamt * $totalbilltax->tax_percent / 100;
            echo "<tr><td>" . $totalbilltax->label . "(+) " . number_format($totalbilltax->tax_percent, "1") . "(%)</td><td>" . $tshare . "</td></tr>";
        }
        foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $data->id, "type" => "others")) as $itax) {
            $mtax = $mtax + $itax->tax_percent;
            echo "<tr><td>" . $itax->label . "(+)</td>";
            echo "<td colspan='3'></td>";
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            echo "<td colspan='7'></td>";
            echo "<td class='text-right'>" . $itax->tax_percent . "</td></tr>";
        }
        $bamt = $mamt + $mtax + $tshare+$data->round_off;
        echo "<tr><td><b>Round Off Amount (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $data->round_off . "</b></td></tr>";
        echo "<tr><td><b>Invoice Total (Rs.)</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $bamt . "</b></td></tr>";
        echo "<tr><td><b>Amount of Tax Subject to Reverse Charge</b></td>";
        echo "<td colspan='3'></td>";
        echo "<td>";
        $tax_per_amt=0.0;
        foreach (Invoicebilltax::model()->findAllByAttributes(array("invoice_id" => $data->id)) as $itax) {
                $reverse_percent=Invoicesettings::model()->findByAttributes(array('label'=>$itax->label))->value;
                if($data->place_of_supply=="1"){
                    $rev_tax_amt=$itax->tax_percent*$reverse_percent/100;
                    $rev_tax_rate=$itax->tax_percent*$reverse_percent/100;
                    echo "<label>".$itax->label."</label><br/>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr>";
                    echo "<td align='right'>IGST Rate</td>";
                    echo "<td align='right'>IGST Amt.</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='right'>".$rev_tax_rate." %</td>";
                    echo "<td align='right'>".$rev_tax_amt."</td>";
                    echo "</tr>";
                    echo "</table>";
                    $tax_per_amt=$tax_per_amt+$rev_tax_amt;
                }else{
                   $cgst_tax_amt=($itax->tax_percent*$reverse_percent/100)/2; 
                   $sgst_tax_amt=($itax->tax_percent*$reverse_percent/100)/2; 
                   $cgst_tax_rate=$reverse_percent/2; 
                   $sgst_tax_rate=$reverse_percent/2; 
                   echo "<label>".$itax->label."</label><br/>";
                    echo "<table class='table table-bordered'>";
                    echo "<tr>";
                    echo "<td align='right'>CGST Rate</td>";
                    echo "<td align='right'>CGST Amt.</td>";
                    echo "<td align='right'>SGST Rate</td>";
                    echo "<td align='right'>SGST Amt.</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td align='right'>".$cgst_tax_rate." %</td>";
                    echo "<td align='right'>".$cgst_tax_amt."</td>";
                    echo "<td align='right'>".$sgst_tax_rate." %</td>";
                    echo "<td align='right'>".$sgst_tax_amt."</td>";
                    echo "</tr>";
                    echo "</table>";
                   $tax_per_amt=$tax_per_amt+$cgst_tax_amt+$sgst_tax_amt;
                }                
            }
        echo "</td>";
        echo "<td align='right'></td>";
        echo "<td align='right'></td>";
        echo "<td colspan='7'></td>";
        echo "<td class='text-right'><b>" . $tax_per_amt . "</b></td></tr>";
        echo "<tr><td colspan='15'><b>Total (in Words)- " . Utils::convert_number_to_words($bamt) . "</b></td></tr>";
    }

    public static function getgross_amt($data) {
        $invoice_data = Purchaseinvoice::model()->findByPk($data->invoice_id);
        if ($invoice_data->invoice_format == "F2") {
            return $data->amount - $data->discount;
        } else {
            $mtaxamt = 0.0;
            foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $data->id)) as $itax) {
                $taxamt = $data->amount * $itax->tax_percent / 100;
                $mtaxamt = $mtaxamt + $taxamt;
            }
            return $data->amount + $mtaxamt;
        }
    }

//    public function getgrossamt($data) {
//       $invoice_data=  Purchaseinvoice::model()->findByPk($data->invoice_id);
//        if($invoice_data->invoice_format=="F2"){
//        $total_tax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $data->invoice_id));    
//        if (!empty($total_tax)) {
//           $tamt=$data->amount-$data->discount; 
//           $btax = $tamt * $total_tax->tax_percent / 100;
//           echo $tamt + $btax;
//        } else {
//            echo $data->amount-$data->discount;
//        }
//        }else{
//        $mtaxamt = 0.0;
//        foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $data->id)) as $itax) {
//            $taxamt = $data->amount * $itax->tax_percent / 100;
//            $mtaxamt = $mtaxamt + $taxamt;
//        }
//        echo $mtaxamt;
//        }
//    }

    public static function getgross_amt2($data) {
        $invoice_data = Purchaseinvoice::model()->findByPk($data->invoice_id);
        if ($invoice_data->invoice_format == "F2") {
            $total_tax = Invoicebilltax::model()->findByAttributes(array("invoice_id" => $data->invoice_id));
            if (!empty($total_tax)) {
                $btax = $data->amount * $total_tax->tax_percent / 100;
                return $data->amount + $btax - $data->discount;
            } else {
                return $data->amount - $data->discount;
            }
        } else {
            $mtaxamt = 0.0;
            foreach (Invoiceitemtax::model()->findAllByAttributes(array("invoice_item_id" => $data->id)) as $itax) {
                $taxamt = $data->amount * $itax->tax_percent / 100;
                $mtaxamt = $mtaxamt + $taxamt;
            }
            return $mtaxamt;
        }
    }

}
