<?php

/**
 * This is the model class for table "voucher_type".
 *
 * The followings are the available columns in table 'voucher_type':
 * @property integer $id
 * @property string $voucher_name
 * @property string $payment_receiver_type
 * @property string $voucher_nature
 * @property string $description
 */
class Vouchertype extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'voucher_type';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('voucher_name, description', 'length', 'max' => 100),
            array('payment_receiver_type', 'length', 'max' => 12),
            array('voucher_nature', 'length', 'max' => 6),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('voucher_name','unique'),
            array('voucher_name, payment_receiver_type, voucher_nature, description', 'required'),
            //array('id, voucher_name, payment_receiver_type, voucher_nature, description', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'voucher_name' => 'Voucher Name',
            'payment_receiver_type' => 'Receiver Type',
            'voucher_nature' => 'Voucher Nature',
            'description' => 'Description',
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
        $criteria->order = 'id DESC';
        $criteria->compare('id', $this->id);
        $criteria->compare('voucher_name', $this->voucher_name, true);
        $criteria->compare('payment_receiver_type', $this->payment_receiver_type, true);
        $criteria->compare('voucher_nature', $this->voucher_nature, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'PageSize' => 20,)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Vouchertype the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
