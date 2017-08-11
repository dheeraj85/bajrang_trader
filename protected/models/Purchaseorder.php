<?php

/**
 * This is the model class for table "purchase_order".
 *
 * The followings are the available columns in table 'purchase_order':
 * @property integer $id
 * @property string $order_no
 * @property string $delivery_form
 * @property string $delivery_to
 * @property string $place
 * @property string $gst_no
 * @property string $order_status
 * @property integer $is_po_supplied
 *
 * The followings are the available model relations:
 * @property PurchaseOrderItems[] $purchaseOrderItems
 */
class Purchaseorder extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase_order';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('is_po_supplied', 'numerical', 'integerOnly' => true),
            array('order_no, place', 'length', 'max' => 100),
            array('gst_no', 'length', 'max' => 20),
            array('order_status', 'length', 'max' => 9),
            array('delivery_form, delivery_to', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('order_no', 'unique'),
            array('order_no, delivery_form, delivery_to, place, gst_no', 'required'),
            array('id, order_no, delivery_form, delivery_to, place, gst_no, order_status, is_po_supplied', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'poitems' => array(self::HAS_MANY, 'Purchaseorderitems', 'purchase_order_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_no' => 'Purchase Order No',
            'delivery_form' => 'Delivery Form',
            'delivery_to' => 'Delivery To',
            'place' => 'Place',
            'gst_no' => 'GST No',
            'order_status' => 'Order Status',
            'is_po_supplied' => 'Is Po Supplied',
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
        $criteria->order="id desc";
        $criteria->compare('id', $this->id);
        $criteria->compare('order_no', $this->order_no, true);
        $criteria->compare('delivery_form', $this->delivery_form, true);
        $criteria->compare('delivery_to', $this->delivery_to, true);
        $criteria->compare('place', $this->place, true);
        $criteria->compare('gst_no', $this->gst_no, true);
        $criteria->compare('order_status', $this->order_status, true);
        $criteria->compare('is_po_supplied', $this->is_po_supplied);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Purchaseorder the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function status($data) {
        if ($data->is_po_supplied == "1") {
            ?>
            <span class="badge btn-green">Honoured</span>
        <?php } else { ?>
            <span class="badge btn-warning">Pending</span>   
            <?php
        }
    }

    public static function getpo($data) {
        echo $data->order_no;
    }

    public static function reqaction($data) {
        if ($data->order_status == "pending") {
            ?>
            <a href="<?php echo Yii::app()->createUrl('purchaseorderitems/create', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Add PO Items</button></a>
            <?php
        }
       // if ($data->order_status == "generated") {
            ?>
            <a href="<?php echo Yii::app()->createUrl('purchaseorder/printpo', array('id' => $data->id)); ?>"><button type='button' class='btn btn-green btn-sm'>Print Purchase Order</button></a>
            <?php
        //}
    }

}
