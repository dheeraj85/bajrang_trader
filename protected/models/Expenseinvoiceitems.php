<?php

/**
 * This is the model class for table "expense_invoice_items".
 *
 * The followings are the available columns in table 'expense_invoice_items':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $item_id
 * @property string $goods_service
 * @property integer $hsn_sac_code
 * @property string $vendor_hsn_sac_code
 * @property integer $vendor_tax_percent
 * @property integer $unmatched_code
 * @property integer $is_reverse_charge
 * @property integer $is_reverse_item
 * @property string $particulars
 * @property string $rate
 * @property string $amount
 * @property string $discount
 * @property string $item_tax_type
 * @property string $tax_percent_rate
 * @property string $tax_amt
 * @property string $cess_rate
 * @property string $cess_amt
 * @property string $ut_rate
 * @property string $ut_amt
 * @property integer $is_active
 * @property integer $is_added_to_stock
 * @property integer $is_good_return
 * @property integer $is_choice_tax
 *
 * The followings are the available model relations:
 * @property ExpenseInvoice $invoice
 * @property ExpenseMaster $item
 */
class Expenseinvoiceitems extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'expense_invoice_items';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id, item_id, hsn_sac_code, vendor_tax_percent, unmatched_code, is_reverse_charge, is_reverse_item, is_active, is_added_to_stock, is_good_return, is_choice_tax', 'numerical', 'integerOnly' => true),
            array('goods_service', 'length', 'max' => 8),
            array('vendor_hsn_sac_code', 'length', 'max' => 50),
            array('particulars', 'length', 'max' => 200),
            array('rate, amount, discount', 'length', 'max' => 12),
            array('item_tax_type', 'length', 'max' => 9),
            array('tax_percent_rate, tax_amt, cess_rate, cess_amt, ut_rate, ut_amt', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, item_id, goods_service, hsn_sac_code, vendor_hsn_sac_code, vendor_tax_percent, unmatched_code, is_reverse_charge, is_reverse_item, particulars, rate, amount, discount, item_tax_type, tax_percent_rate, tax_amt, cess_rate, cess_amt, ut_rate, ut_amt, is_active, is_added_to_stock, is_good_return, is_choice_tax', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'invoice' => array(self::BELONGS_TO, 'Expenseinvoice', 'invoice_id'),
            'item' => array(self::BELONGS_TO, 'Expensemaster', 'item_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'item_id' => 'Item',
            'goods_service' => 'Goods Service',
            'hsn_sac_code' => 'Hsn Sac Code',
            'vendor_hsn_sac_code' => 'Vendor Hsn Sac Code',
            'vendor_tax_percent' => 'Vendor Tax Percent',
            'unmatched_code' => 'Unmatched Code',
            'is_reverse_charge' => 'Is Reverse Charge',
            'is_reverse_item' => 'Is Reverse Item',
            'particulars' => 'Particulars',
            'rate' => 'Rate',
            'amount' => 'Amount',
            'discount' => 'Discount',
            'item_tax_type' => 'Item Tax Type',
            'tax_percent_rate' => 'Tax Percent Rate',
            'tax_amt' => 'Tax Amt',
            'cess_rate' => 'Cess Rate',
            'cess_amt' => 'Cess Amt',
            'ut_rate' => 'Ut Rate',
            'ut_amt' => 'Ut Amt',
            'is_active' => 'Is Active',
            'is_added_to_stock' => 'Is Added To Stock',
            'is_good_return' => 'Is Good Return',
            'is_choice_tax' => 'Is Choice Tax',
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
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('goods_service', $this->goods_service, true);
        $criteria->compare('hsn_sac_code', $this->hsn_sac_code);
        $criteria->compare('vendor_hsn_sac_code', $this->vendor_hsn_sac_code, true);
        $criteria->compare('vendor_tax_percent', $this->vendor_tax_percent);
        $criteria->compare('unmatched_code', $this->unmatched_code);
        $criteria->compare('is_reverse_charge', $this->is_reverse_charge);
        $criteria->compare('is_reverse_item', $this->is_reverse_item);
        $criteria->compare('particulars', $this->particulars, true);
        $criteria->compare('rate', $this->rate, true);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('discount', $this->discount, true);
        $criteria->compare('item_tax_type', $this->item_tax_type, true);
        $criteria->compare('tax_percent_rate', $this->tax_percent_rate, true);
        $criteria->compare('tax_amt', $this->tax_amt, true);
        $criteria->compare('cess_rate', $this->cess_rate, true);
        $criteria->compare('cess_amt', $this->cess_amt, true);
        $criteria->compare('ut_rate', $this->ut_rate, true);
        $criteria->compare('ut_amt', $this->ut_amt, true);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_added_to_stock', $this->is_added_to_stock);
        $criteria->compare('is_good_return', $this->is_good_return);
        $criteria->compare('is_choice_tax', $this->is_choice_tax);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Expenseinvoiceitems the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getinvoiceitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
            echo "<tr><td>" . $lists->item->gs_name;
            if ($lists->item->item_classification == "Reverse-Charge") {
                echo "<span class='badge pull-right' style='background-color: #dd4b39'>RC</span>";
            } else {
                if ($lists->unmatched_code == "1") {
                    echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
                }
            }
            "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->amount . "</td>";
            if ($data->place_of_supply == "1") {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->tax_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->tax_amt . "</td>";
            } else {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'>" . $lists->cess_rate . "</td>";
            echo "<td align='right'>" . $lists->cess_amt . "</td>";
            if ($data->discount_type == "item_discount") {
                echo "<td align='right'>" . $lists->discount . "</td>";
            }
            echo "<td align='right'>" . $lists->tax_amt . "</td>";
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            $edititem = "&nbsp;&nbsp;<a title='edit' onclick=edititem(" . $lists->id . "," . $data->place_of_supply . ",'" . $lists->goods_service . "'," . $data->state_code . ")><i class='edit_invoice_item fa fa-pencil'></i></a>";
            echo "</td>";
            echo "<td><a title='remove' onclick=itemdelete(" . $lists->id . "," . $data->id . ")><i class='fa fa-trash-o'></i></a>".$edititem."</td>";
            echo "</tr>";
        }
        echo "<tr>";
        if ($data->place_of_supply == "1") {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='9'><b>Total</b></td>";
            } else {
                echo "<td colspan='8'><b>Total</b></td>";
            }
        } else {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='10'><b>Total</b></td>";
            } else {
                echo "<td colspan='10'><b>Total</b></td>";
            }
        }
        echo "<td align='right'><b>" . $mitem_amt . "</b></td></tr>";
    }
    
    public static function getinvoiceitemsreview($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
            echo "<tr><td>" . $lists->item->gs_name;
            if ($lists->item->item_classification == "Reverse-Charge") {
                echo "<span class='badge pull-right' style='background-color: #dd4b39'>RC</span>";
            } else {
                if ($lists->unmatched_code == "1") {
                    echo "<span class='badge pull-right' style='background-color: #dd4b39'>C</span>";
                }
            }
            "</td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            echo "<td align='right'>" . $lists->amount . "</td>";
            if ($data->place_of_supply == "1") {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->tax_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->tax_amt . "</td>";
            } else {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->tax_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'>" . $lists->cess_rate . "</td>";
            echo "<td align='right'>" . $lists->cess_amt . "</td>";
            if ($data->discount_type == "item_discount") {
                echo "<td align='right'>" . $lists->discount . "</td>";
            }
            echo "<td align='right'>" . $lists->tax_amt . "</td>";
            $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
            echo "</td>";            
            echo "</tr>";
        }
        echo "<tr>";
        if ($data->place_of_supply == "1") {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='9'><b>Total</b></td>";
            } else {
                echo "<td colspan='8'><b>Total</b></td>";
            }
        } else {
            if ($data->discount_type == "item_discount") {
                echo "<td colspan='10'><b>Total</b></td>";
            } else {
                echo "<td colspan='10'><b>Total</b></td>";
            }
        }
        echo "<td align='right'><b>" . $mitem_amt . "</b></td></tr>";
    }
    
    public static function getreverseinvoiceitems($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        echo "<tr><td colspan='2'><b>Amount of Tax Subject to Reverse Charge</b></td>
                <td class='text-right'><b>CGST Rate</b></td>
                <td class='text-right'><b>CGST Amt.</b></td>
                <td class='text-right'><b>SGST Rate</b></td>
                <td class='text-right'><b>SGST Amt.</b></td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                </tr>";
        foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id,"is_reverse_item"=>1), $criteria) as $lists) {
            echo "<tr><td colspan='2'></td>";
            //echo Yii::app()->params['sgst_tax_percent_ratio']cgst_tax_percent_ratio;
            if ($data->place_of_supply == "1") {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->reverse_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->reverse_amt . "</td>";
            } else {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->reverse_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            if ($data->discount_type == "item_discount") {
                echo "<td align='right'></td>";
            }
            echo "<td align='right'></td>";
            $mitem_amt = $mitem_amt + $mtaxamt + $lists->reverse_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo "<b>".$mitem_amt."</b>";
            echo "</td>";
            echo "<td align='right' style='color:#fff;'>AAA</td>";
            echo "</tr>";
        }
    }

    public static function getreverseinvoiceitemsreview($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $ritem_amt = 0.0;
         foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
              $mitem_amt = $mitem_amt + $lists->amount + $lists->tax_amt + $lists->cess_amt;
        }
        $bamt = $mitem_amt+$data->round_off;
        echo "<tr><td colspan='2'><b>Round Off (Rs.)</b></td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right'><b>" . $data->round_off . "</b></td></tr>";
        
        echo "<tr><td colspan='2'><b>Expense Invoice Total (Rs.)</b></td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right'><b>" . $bamt . "</b></td></tr>";
        
        echo "<tr><td colspan='2'><b>Amount of Tax Subject to Reverse Charge</b></td>
                <td class='text-right'><b>CGST Rate</b></td>
                <td class='text-right'><b>CGST Amt.</b></td>
                <td class='text-right'><b>SGST Rate</b></td>
                <td class='text-right'><b>SGST Amt.</b></td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                <td class='text-right' style='color:#fff;'>SG</td>
                </tr>";
        foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id,"is_reverse_item"=>1), $criteria) as $lists) {
            echo "<tr><td colspan='2'></td>";
            if ($data->place_of_supply == "1") {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->reverse_percent_rate . "</td>";
                }
                echo "<td align='right'>" . $lists->reverse_amt . "</td>";
            } else {
                if ($lists->is_choice_tax == "1") {
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->vendor_tax_percent * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                } else {
                    echo "<td align='right'>" . $lists->reverse_percent_rate * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['cgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_percent_rate * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                    echo "<td align='right'>" . $lists->reverse_amt * Yii::app()->params['sgst_tax_percent_ratio'] / 100 . "</td>";
                }
            }
            echo "<td align='right'></td>";
            echo "<td align='right'></td>";
            if ($data->discount_type == "item_discount") {
                echo "<td align='right'></td>";
            }
            echo "<td align='right'></td>";
            $ritem_amt = $ritem_amt + $lists->reverse_amt + $lists->cess_amt;
            echo "<td align='right'>";
            echo "<b>".$ritem_amt."</b>";
            echo "</td>";
            echo "</tr>";
        }
            echo "<tr><td colspan='15'><b>Total (in Words)- " . Utils::convert_number_to_words($mitem_amt) . "</b></td></tr>";
    }
    
    public static function getbilltotalamt($data) {
        $criteria = new CDbCriteria;
        $criteria->order = "id desc";
        $mitem_amt = 0.0;
        $mtaxamt = "";
        foreach (Expenseinvoiceitems::model()->findAllByAttributes(array("invoice_id" => $data->id), $criteria) as $lists) {
              $mitem_amt = $mitem_amt + $lists->amount + $mtaxamt + $lists->tax_amt + $lists->cess_amt;
        }
        $bamt = $mitem_amt+$data->round_off;
        echo "<tr><td colspan='2'><b>Expense Invoice Total (Rs.)</b></td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>CGST</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right' style='color:#fff;'>SG</td>";
        echo "<td class='text-right'><b>" . $bamt . "</b></td><td align='right' style='color:#fff;'>AAA</td></tr>";
    }
}
