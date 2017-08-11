<?php

/**
 * This is the model class for table "item_ledger".
 *
 * The followings are the available columns in table 'item_ledger':
 * @property integer $id
 * @property integer $item_id
 * @property integer $invoice_id
 * @property string $stock_type
 * @property string $debit_qty
 * @property string $credit_qty
 * @property string $balance_qty
 * @property string $dated
 * @property string $description
 */
class Itemledger extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Itemledger the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'item_ledger';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('item_id, invoice_id', 'numerical', 'integerOnly' => true),
            array('stock_type', 'length', 'max' => 8),
            array('debit_qty, credit_qty, balance_qty', 'length', 'max' => 10),
            array('dated, description', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, item_id, invoice_id, stock_type, debit_qty, credit_qty, balance_qty, dated, description', 'safe', 'on' => 'search'),
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
            'item_id' => 'Item',
            'invoice_id' => 'Invoice',
            'stock_type' => 'Stock Type',
            'debit_qty' => 'Debit Qty',
            'credit_qty' => 'Credit Qty',
            'balance_qty' => 'Balance Qty',
            'dated' => 'Dated',
            'description' => 'Description',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('item_id', $this->item_id);
        $criteria->compare('invoice_id', $this->invoice_id);
        $criteria->compare('stock_type', $this->stock_type, true);
        $criteria->compare('debit_qty', $this->debit_qty, true);
        $criteria->compare('credit_qty', $this->credit_qty, true);
        $criteria->compare('balance_qty', $this->balance_qty, true);
        $criteria->compare('dated', $this->dated, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function addCreditInLedgerFromPurchaseInvoice($item_id, $stock_type, $invoice_id, $stock_qty) {
        $il = new Itemledger();
        $il->item_id = $item_id;
        $il->stock_type = $stock_type;
        $il->invoice_id = $invoice_id;
        $il->debit_qty = 0.00;
        $il->credit_qty = $stock_qty;
        $isk = Itemstock::model()->findBySql("Select sum(stock_qty) as stock_qty from item_stock where item_id=$item_id");
        $previous_stk = isset($isk->stock_qty) ? $isk->stock_qty : 0.00;
        $il->balance_qty = $previous_stk; /// get stock position from itemstock table 
        $il->dated = date('Y-m-d H:i:s');
        $il->description = "Item ledger updated crdited qty $il->credit_qty on $il->dated by " . Yii::app()->user->getUsername();
        $il->save();
    }

    public function addDebitInLedgerOnDispatch($item_id, $stock_type, $invoice_id, $stock_qty) {
        $il = new Itemledger();
        $il->item_id = $item_id;
        $il->stock_type = $stock_type;
        $il->invoice_id = $invoice_id;
        $il->debit_qty = $stock_qty;
        $il->credit_qty = 0.00;
        $isk = Itemstock::model()->findBySql("Select sum(stock_qty) as stock_qty from item_stock where item_id=$item_id");
        $previous_stk = isset($isk->stock_qty) ? $isk->stock_qty : 0.00;
        $il->balance_qty = $previous_stk; /// get stock position from itemstock table 
        $il->dated = date('Y-m-d H:i:s');
        $il->description = "Item ledger updated debit qty $il->credit_qty on $il->dated by " . Yii::app()->user->getUsername();
        $il->save();
    }

    public function addCreditInLedgerOnInternalStockUpdate($item_id, $stock_type, $invoice_id, $stock_qty) {
        $il = new Itemledger();
        $il->item_id = $item_id;
        $il->stock_type = $stock_type;
        $il->invoice_id = $invoice_id;
        $il->debit_qty = 0.00;
        $il->credit_qty = $stock_qty;
        $isk =Shelfitems::model()->findBySql("Select total_qty from shelf_items where item_id=$item_id");
        $previous_stk = isset($isk->total_qty) ? $isk->total_qty : 0.00;
        $il->balance_qty = $previous_stk; /// get stock position from itemstock table 
        $il->dated = date('Y-m-d H:i:s');
        $il->description = "Item ledger updated crdited qty $il->credit_qty on $il->dated by " . Yii::app()->user->getUsername();
        $il->save();
    }
    public function addDebitFrmShelf($item_id, $stock_type, $invoice_id, $stock_qty,$bal_qty) {
        $il = new Itemledger();
        $il->item_id = $item_id;
        $il->stock_type = $stock_type;
        $il->invoice_id = $invoice_id;
        $il->debit_qty = 0.00;
        $il->credit_qty = $stock_qty;
        $il->balance_qty = $bal_qty; /// get stock position from itemstock table 
        $il->dated = date('Y-m-d H:i:s');
        $il->description = "Item ledger updated crdited qty $il->credit_qty on $il->dated by " . Yii::app()->user->getUsername();
        $il->save();
    }

}