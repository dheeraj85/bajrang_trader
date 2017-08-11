<?php

/**
 * This is the model class for table "invoice_bill_tax".
 *
 * The followings are the available columns in table 'invoice_bill_tax':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $invoice_settings_id
 * @property string $tax_percent
 *
 * The followings are the available model relations:
 * @property PurchaseInvoice $invoice
 * @property InvoiceSettings $invoiceSettings
 */
class Invoicebilltax extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'invoice_bill_tax';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id, invoice_settings_id', 'numerical', 'integerOnly' => true),
            array('tax_percent', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, invoice_settings_id, tax_percent', 'safe', 'on' => 'search'),
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
            'invoiceSettings' => array(self::BELONGS_TO, 'Invoicesettings', 'invoice_settings_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'invoice_settings_id' => 'Invoice Settings',
            'tax_percent' => 'Tax Percent',
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
        $criteria->compare('invoice_settings_id', $this->invoice_settings_id);
        $criteria->compare('tax_percent', $this->tax_percent, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invoicebilltax the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
