<?php

/**
 * This is the model class for table "challan_items".
 *
 * The followings are the available columns in table 'challan_items':
 * @property integer $id
 * @property integer $challan_id
 * @property integer $item_id
 * @property string $item_name
 * @property string $item_code
 * @property string $weight
 * @property string $rate
 * @property string $amount
 * @property string $added_date
 *
 * The followings are the available model relations:
 * @property Challan $challan
 */
class Challanitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'challan_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('challan_id, item_id', 'numerical', 'integerOnly' => true),
            array('item_name', 'length', 'max' => 100),
            array('item_code', 'length', 'max' => 50),
            array('weight, rate', 'length', 'max' => 10),
            array('amount', 'length', 'max' => 20),
            array('added_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, challan_id, item_id, item_name, item_code, weight, rate, amount, added_date', 'safe', 'on' => 'search'),
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
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'challan_id' => 'Challan',
            'item_id' => 'Item',
            'item_name' => 'Item Name',
            'item_code' => 'Item Code',
            'weight' => 'Weight',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'added_date' => 'Added Date',
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
        $criteria->compare('challan_id', $this->challan_id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('item_name', $this->item_name, true);
        $criteria->compare('item_code', $this->item_code, true);
        $criteria->compare('weight', $this->weight, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('added_date', $this->added_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Challanitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        foreach (Challanitems::model()->findAllByAttributes(array("challan_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $lists->challan->truck_wagon_no . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->weight . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->rate . "</td>";
            echo "<td align='right'>" . $lists->amount . "</td>";
            $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";
            echo "<td><a title='remove' onclick=itemdelete(" . $lists->id . "," . $data . ")><i class='fa fa-trash-o'></i></a>";
            echo $edititem."</td>";
            echo "</tr>";
            $itemrate = $lists->weight * $lists->rate;
            $mitem_amt = $mitem_amt +$itemrate;
        }
        echo "<tr>";
        echo "<td colspan='4'><b>Total (in Words)- " . Utils::convert_number_to_words($mitem_amt) . "</b></td>";
        echo "<td align='right'><b>" . $mitem_amt . "</b></td>";
        echo "</tr>";
    }

    public static function getitems_print($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        foreach (Challanitems::model()->findAllByAttributes(array("challan_id" => $data), $criteria) as $lists) {
            echo "<tr><td>" . $lists->challan->truck_wagon_no . "</td>";
            echo "<td>" . $lists->item_name . "</td>";
            echo "<td>" . $lists->weight . "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->rate . "</td>";
            echo "<td align='right'>" . $lists->amount . "</td>";
            echo "</tr>";
            $itemrate = $lists->weight * $lists->rate;
            $mitem_amt = $mitem_amt +$itemrate;
        }
        echo "<tr>";
        echo "<td colspan='4'><b>Total (in Words)- " . Utils::convert_number_to_words($mitem_amt) . "</b></td>";
        echo "<td align='right'><b>" . $mitem_amt . "</b></td>";
        echo "</tr>";
    }

}
