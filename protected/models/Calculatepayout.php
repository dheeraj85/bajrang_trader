<?php

/**
 * This is the model class for table "calculate_payout".
 *
 * The followings are the available columns in table 'calculate_payout':
 * @property integer $id
 * @property integer $kata_parchy_id
 * @property integer $customer_id
 * @property string $load_wgt
 * @property string $rate
 * @property string $amount
 * @property string $remark
 * @property string $dated
 * @property integer $is_paid
 *
 * The followings are the available model relations:
 * @property KataParchy $kataParchy
 * @property Customer $customer
 */
class Calculatepayout extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'calculate_payout';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('kata_parchy_id, customer_id, is_paid', 'numerical', 'integerOnly' => true),
            array('load_wgt', 'length', 'max' => 12),
            array('rate', 'length', 'max' => 10),
            array('amount', 'length', 'max' => 20),
            array('remark', 'length', 'max' => 255),
            array('dated', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, kata_parchy_id, customer_id, load_wgt, rate, amount, remark, dated, is_paid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'kataparchy' => array(self::BELONGS_TO, 'Kataparchy', 'kata_parchy_id'),
            'customer' => array(self::BELONGS_TO, 'Purchaseinvoice', 'customer_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'kata_parchy_id' => 'Kata Parchy',
            'customer_id' => 'Customer',
            'load_wgt' => 'Net Weight in MT',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'remark' => 'Remark',
            'dated' => 'Dated',
            'is_paid' => 'Is Paid',
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
        $criteria->compare('kata_parchy_id', $this->kata_parchy_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('load_wgt', $this->load_wgt, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('is_paid', $this->is_paid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }
    
    public function searchprint() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->order="id desc";
        $criteria->compare('id', $this->id);
        $criteria->compare('kata_parchy_id', $this->kata_parchy_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('load_wgt', $this->load_wgt, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('remark', $this->remark, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('is_paid', $this->is_paid);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => FALSE
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Calculatepayout the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function farmername($data) {
        echo $data->customer->vendor_name . "<br/>" . $data->customer->land_owner;
    }

    public static function address($data) {
        ?>
        Vill.-<?php echo $data->customer->village ?><br/>
        Dist.-<?php echo $data->customer->district ?> <?php echo $data->customer->state ?>
        <?php
    }

    public static function item($data) {
        echo $data->kataparchy->item_name;
    }

    public static function reqaction($data){
        if ($data->is_paid == 0) {
            ?>
            <a href="<?php echo Yii::app()->createUrl('calculatepayout/paynow', array('id' => $data->id,'kata_parchy_id'=>$data->kata_parchy_id)); ?>"><button type='button' class='btn btn-green btn-sm'>Pay Now</button></a>
            <?php
        }else{
            echo "<label class='badge alert-success' style='opacity:0.8'>Paid</label>";
        ?>
            <a href="<?php echo Yii::app()->createUrl('calculatepayout/print', array('id' => $data->id,'kata_parchy_id'=>$data->kata_parchy_id)); ?>"><button type='button' class='btn btn-primary btn-sm'>Print</button></a>
    <?php }}
}
