<?php

/**
 * This is the model class for table "kata_parchy".
 *
 * The followings are the available columns in table 'kata_parchy':
 * @property integer $id
 * @property string $grn_no
 * @property integer $purchase_invoice_id
 * @property integer $challan_id
 * @property string $order_no
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_code
 * @property string $load_weight
 * @property string $net_weight
 * @property string $vendor_name
 *
 * The followings are the available model relations:
 * @property Challan $challan
 * @property PurchaseInvoice $purchaseInvoice
 */
class Kataparchy extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'kata_parchy';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('purchase_invoice_id, challan_id, item_id', 'numerical', 'integerOnly' => true),
            array('grn_no, order_no, item_name', 'length', 'max' => 100),
            array('item_code', 'length', 'max' => 50),
            array('load_weight, net_weight', 'length', 'max' => 10),
            array('vendor_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, grn_no, purchase_invoice_id, challan_id, order_no, item_id, item_name, item_code, load_weight, net_weight, vendor_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'challan' => array(self::BELONGS_TO, 'Challan', 'challan_id'),
            'purchaseinvoice' => array(self::BELONGS_TO, 'Purchaseinvoice', 'purchase_invoice_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'grn_no' => 'Grn No',
            'purchase_invoice_id' => 'Purchase Invoice',
            'challan_id' => 'Challan',
            'order_no' => 'Order No',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_code' => 'Item Code',
            'load_weight' => 'Load Weight',
            'net_weight' => 'Net Weight',
            'vendor_name' => 'Vendor Name',
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
        $criteria->compare('grn_no', $this->grn_no, true);
        $criteria->compare('purchase_invoice_id', $this->purchase_invoice_id);
        $criteria->compare('challan_id', $this->challan_id);
        $criteria->compare('order_no', $this->order_no, true);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_code', $this->item_code, true);
        $criteria->compare('load_weight', $this->load_weight, true);
        $criteria->compare('net_weight', $this->net_weight, true);
        $criteria->compare('vendor_name', $this->vendor_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Kataparchy the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

     public static function getitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $load_weight = 0.0;
        $net_weight = 0.0;
        foreach (Kataparchy::model()->findAllByAttributes(array("purchase_invoice_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $lists->grn_no . "</td>";
            echo "<td>" . $lists->challan_id . "</td>";
            echo "<td>" . $lists->item_code . "</td>";
            echo "<td>" . $lists->order_no . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->vendor_name . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->load_weight . "</td>";
            echo "<td align='right'>" . $lists->net_weight . "</td>";
            echo "<td align='right'>" . $lists->kata_parchi_date . "</td>";
            $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";
            echo "<td><a title='remove' onclick=itemdelete(" . $lists->id . "," . $data . ")><i class='fa fa-trash-o'></i></a>";
            echo $edititem . "</td>";
            echo "</tr>";
            $load_weight=$load_weight+$lists->load_weight;
            $net_weight=$net_weight+$lists->net_weight;
        }
        echo "<tr>";
        echo "<td colspan='6'><b>Total Weight in MT </b></td>";
        echo "<td align='right'><b>" . $load_weight . "</b></td>";
        echo "<td align='right'><b>" . $net_weight . "</b></td>";
        echo "</tr>";
    }

    public static function getitems_print($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $load_weight = 0.0;
        $net_weight = 0.0;
        foreach (Kataparchy::model()->findAllByAttributes(array("purchase_invoice_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $lists->grn_no . "</td>";
            echo "<td>" . $lists->challan_id . "</td>";
            echo "<td>" . $lists->item_code . "</td>";
            echo "<td>" . $lists->order_no . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->vendor_name . "</td>";
            echo "<td align='right'>" . $lists->load_weight . "</td>";
            echo "<td align='right'>" . $lists->net_weight . "</td>";
            echo "</tr>";
            $load_weight=$load_weight+$lists->load_weight;
            $net_weight=$net_weight+$lists->net_weight;
        }
        echo "<tr>";
        echo "<td colspan='6'><b>Total Weight in MT </b></td>";
        echo "<td align='right'><b>" . $load_weight . "</b></td>";
        echo "<td align='right'><b>" . $net_weight . "</b></td>";
        echo "</tr>";
    }
}
