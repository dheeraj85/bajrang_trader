<?php

/**
 * This is the model class for table "purchase_order_items".
 *
 * The followings are the available columns in table 'purchase_order_items':
 * @property integer $id
 * @property integer $purchase_order_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_code
 * @property string $qty_req
 * @property string $qty_scale
 * @property string $rate
 * @property string $amount
 * @property string $req_date
 *
 * The followings are the available model relations:
 * @property PurchaseOrder $purchaseOrder
 */
class Purchaseorderitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_order_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('purchase_order_id, item_id', 'numerical', 'integerOnly' => true),
            array('item_name', 'length', 'max' => 100),
            array('item_code', 'length', 'max' => 50),
            array('qty_req, rate, amount', 'length', 'max' => 20),
            array('qty_scale', 'length', 'max' => 25),
            array('req_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('item_id, item_name, item_code,rate, amount', 'required'),
            array('id, purchase_order_id, item_id, item_name, item_code, qty_req, qty_scale, rate, amount, req_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'purchaseorder' => array(self::BELONGS_TO, 'Purchaseorder', 'purchase_order_id'),
            'items' => array(self::BELONGS_TO, 'Purchaseitem', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'purchase_order_id' => 'Purchase Order',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_code' => 'Item Code',
            'qty_req' => 'Qty Req',
            'qty_scale' => 'Qty Scale',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'req_date' => 'Req Date',
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
        $criteria->compare('purchase_order_id', $this->purchase_order_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_code', $this->item_code, true);
        $criteria->compare('qty_req', $this->qty_req, true);
        $criteria->compare('qty_scale', $this->qty_scale, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('req_date', $this->req_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseorderitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getordersitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $totalamt=0.0;
        $i= 1;
        foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $i . "</td><td>" . $lists->item_code . "</td>";
            echo "<td>" . $lists->items->gst_code . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->qty_req . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->rate . "</td>";
            echo "<td align='right'>1</td>";
            echo "<td align='right'>" . $lists->qty_scale . "</td>";
            $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";
            echo "<td><a title='remove' onclick=itemdelete(" . $lists->id . "," . $data . ")><i class='fa fa-trash-o'></i></a>";
            if ($lists->items->goods_service == "Good") {
                echo $edititem;
            } "</td>";
            echo "</tr>";
            $i++;
            $itemrate=$lists->qty_req*$lists->rate;
            $mitem_amt=$mitem_amt+$itemrate;
        }
        $cgst_ratio=$lists->items->gst_percent/2;
        $sgst_ratio=$lists->items->gst_percent/2;
        $tax_amt=$mitem_amt*$lists->items->gst_percent/100;
        $cgst_amt=$tax_amt/2;
        $sgst_amt=$tax_amt/2;
        echo "<tr>";
        echo "<td><b>CGST ".$cgst_ratio."% </b></td>";
        echo "<td><b>" . $cgst_amt . "</b></td>";
        echo "<td><b>SGST ".$sgst_ratio."% </b></td>";
        echo "<td><b>" . $sgst_amt . "</b></td>";
        echo "</tr>";
        $totalamt=$mitem_amt+$tax_amt;
        echo "<tr>";
        echo "<td colspan='5'><b>Total (in Words)- " . Utils::convert_number_to_words($totalamt) . "</b></td>";
        echo "<td colspan='4' align='right'><b>" . $totalamt . "</b></td></tr>";
    }
    
    public static function getordersitems_print($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $totalamt=0.0;
        $i= 1;
        foreach (Purchaseorderitems::model()->findAllByAttributes(array("purchase_order_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $i . "</td><td>" . $lists->item_code . "</td>";
            echo "<td>" . $lists->items->gst_code . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->qty_req . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->rate . "</td>";
            echo "<td align='right'>1</td>";
            echo "<td align='right'>" . $lists->qty_scale . "</td>";
            echo "</tr>";
            $i++;
            $itemrate=$lists->qty_req*$lists->rate;
            $mitem_amt=$mitem_amt+$itemrate;
        }
        $cgst_ratio=$lists->items->gst_percent/2;
        $sgst_ratio=$lists->items->gst_percent/2;
        $tax_amt=$mitem_amt*$lists->items->gst_percent/100;
        $cgst_amt=$tax_amt/2;
        $sgst_amt=$tax_amt/2;
        echo "<tr>";
        echo "<td><b>CGST ".$cgst_ratio."% </b></td>";
        echo "<td><b>" . $cgst_amt . "</b></td>";
        echo "<td><b>SGST ".$sgst_ratio."% </b></td>";
        echo "<td><b>" . $sgst_amt . "</b></td>";
        echo "</tr>";
        $totalamt=$mitem_amt+$tax_amt;
        echo "<tr>";
        echo "<td colspan='4'><b>Total (in Words)- " . Utils::convert_number_to_words($totalamt) . "</b></td>";
        echo "<td colspan='4' align='right'><b>" . $totalamt . "</b></td></tr>";
    }

}
