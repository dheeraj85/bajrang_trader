<?php

/**
 * This is the model class for table "invoice_pay".
 *
 * The followings are the available columns in table 'invoice_pay':
 * @property integer $id
 * @property integer $invoice_id
 * @property string $amount
 * @property string $dated
 * @property integer $voucher_no
 *
 * The followings are the available model relations:
 * @property PurchaseInvoice $invoice
 */
class Invoicepay extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'invoice_pay';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id', 'numerical', 'integerOnly' => true),
            array('amount', 'length', 'max' => 10),
            array('voucher_no', 'length', 'max' => 100),
            array('dated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, amount, dated, voucher_no', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoice' => array(self::BELONGS_TO, 'PurchaseInvoice', 'invoice_id'),
            'vouchers' => array(self::BELONGS_TO, 'Voucher', 'voucher_no'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'amount' => 'Amount',
            'dated' => 'Dated',
            'voucher_no' => 'Voucher No',
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
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('voucher_no', $this->voucher_no);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invoicepay the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
