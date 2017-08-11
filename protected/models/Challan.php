<?php

/**
 * This is the model class for table "challan".
 *
 * The followings are the available columns in table 'challan':
 * @property integer $id
 * @property integer $purchase_invoice_id
 * @property string $purchase_order_item
 * @property integer $challan_no
 * @property string $challan_date
 * @property integer $purchase_order_id
 * @property string $ex_station
 * @property string $truck_wagon_no
 * @property integer $customer_id
 *
 * The followings are the available model relations:
 * @property PurchaseOrder $purchaseOrder
 * @property PurchaseInvoice $purchaseInvoice
 * @property ChallanItems[] $challanItems
 * @property KataParchy[] $kataParchies
 */
class Challan extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'challan';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('purchase_invoice_id, challan_no, purchase_order_id, customer_id', 'numerical', 'integerOnly' => true),
            array('purchase_order_item', 'length', 'max' => 100),
            array('ex_station', 'length', 'max' => 150),
            array('truck_wagon_no', 'length', 'max' => 255),
            array('challan_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('challan_no', 'unique'),
            array('challan_date, ex_station, truck_wagon_no', 'required'),
            array('id, purchase_invoice_id, purchase_order_item, challan_no, challan_date, purchase_order_id, ex_station, truck_wagon_no, customer_id', 'safe', 'on' => 'search'),
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
            'purchaseinvoice' => array(self::BELONGS_TO, 'Purchaseinvoice', 'purchase_invoice_id'),
            'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
            'challan' => array(self::HAS_MANY, 'Challanitems', 'challan_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Challan No',
            'purchase_invoice_id' => 'Purchase Invoice',
            'purchase_order_item' => 'Purchase Order Item',
            //'challan_no' => 'Challan No',
            'challan_date' => 'Challan Date',
            'purchase_order_id' => 'Purchase Order',
            'ex_station' => 'Ex Station',
            'truck_wagon_no' => 'Truck Wagon No',
            'customer_id' => 'Customer',
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
        $criteria->order = "id desc";
        $criteria->compare('id', $this->id);
        $criteria->compare('purchase_invoice_id', $this->purchase_invoice_id);
        $criteria->compare('purchase_order_item', $this->purchase_order_item, true);
        $criteria->compare('challan_no', $this->challan_no);
        $criteria->compare('challan_date', $this->challan_date, true);
        $criteria->compare('purchase_order_id', $this->purchase_order_id);
        $criteria->compare('ex_station', $this->ex_station, true);
        $criteria->compare('truck_wagon_no', $this->truck_wagon_no, true);
        $criteria->compare('customer_id', $this->customer_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Challan the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public static function getpo($data) {
        $po_data=explode("-", $data->purchase_order_item);
        echo Purchaseorder::model()->findByPk($po_data[0])->order_no;  
    }
    
    public static function reqaction($data) {
        ?>
        <?php if ($data->is_cancel == 0) {?>
        <a href="<?php echo Yii::app()->createUrl('challanitems/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Add Challan Items</button></a>
        <?php }else{?>
        <a href="#"><button type='button' class='btn btn-green btn-sm disabled'>Add Challan Items</button></a>
        <?php }?>
        <?php if ($data->is_cancel == 0) {?>
        <a href="<?php echo Yii::app()->createUrl('challan/printchallan', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Print Challan</button></a>
        <?php }else{?>
        <a href="#"><button type='button' class='btn btn-green btn-sm disabled'>Print Challan</button></a>        
        <?php }?>
        <?php if ($data->is_cancel == 0) {?>
        <a href="#name" onclick="cancel_challan(<?php echo $data->id?>)" class='btn btn-primary btn-sm'><i class='fa fa-trash'></i> Cancel</a> 
        <?php }else{?>
        <a href="#name" class='btn btn-primary btn-sm disabled'><i class='fa fa-trash'></i> Cancel</a> 
        <?php }?>
        <?php if ($data->is_cancel == 0) {?>
        <a href="<?php echo Yii::app()->createUrl('challan/update', array('id' => $data->id)); ?>" class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i> Edit</a> 
        <?php }else{?>
        <a href="#name" class='btn btn-primary btn-sm disabled'><i class='fa fa-pencil'></i> Edit</a>
        <?php }?>
        <?php
    }

}
