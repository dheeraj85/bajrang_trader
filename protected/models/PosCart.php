<?php
class PosCart {
    
    public $id;
    public $itemid;
    public $qty; 
    public $gprice;

   
    public function getItem() {
        return Shelfitems::model()->findByAttributes(array('item_id'=>$this->itemid));
    }
  
    public static function addtocart(PosCart $shop) {
        
        if (count($_SESSION['pos_cart']) == 0) {
            $_SESSION['pos_cart'][] = $shop;
        } else {
            if (PosCart::checkExists($shop->itemid)) {
                $loc = PosCart::getindex($shop->itemid);
                $_SESSION['pos_cart'][$loc]->itemid = $shop->itemid;
                $_SESSION['pos_cart'][$loc]->gprice = $shop->gprice;        
                $_SESSION['pos_cart'][$loc]->qty = $shop->qty;
            } else {
                $_SESSION['pos_cart'][] = $shop;
            }
        }
    }

    public static function updatecart(PosCart $shop) {
        $loc = PosCart::getindex($shop->itemid);
                $_SESSION['pos_cart'][$loc]->itemid = $shop->itemid;
                $_SESSION['pos_cart'][$loc]->gprice = $shop->gprice;        
                $_SESSION['pos_cart'][$loc]->qty = $shop->qty;
    }

    public static function checkExists($itemid) {
        $b = false;
        if (!empty($_SESSION['pos_cart'])) {
            foreach ($_SESSION['pos_cart'] as $data) {
                if ($data->itemid == $itemid) {
                    $b = TRUE;
                    break;
                }
            }
            return $b;
        }
    }

    public static function getindex($itemid) {
        $b = 0;
        if (!empty($_SESSION['pos_cart'])) {
            foreach ($_SESSION['pos_cart'] as $data) {
                if ($data->itemid == $itemid) {
                    return $b;
                    break;
                }
                $b++;
            }
        }
    }

    public static function remove($itemid) {
        $id = PosCart::getindex($itemid);
        if (count($_SESSION['pos_cart']) == 1) {
            unset($_SESSION['pos_cart']);
        } else {
            unset($_SESSION['pos_cart'][$id]);
        }
    }

    public static function get($itemid) {
        $id = PosCart::getindex($itemid);
        return $_SESSION['pos_cart'][$id];
    }

    public static function getAll() {
        $list = array();
        if (!empty($_SESSION['pos_cart'])) {
            foreach ($_SESSION['pos_cart'] as $data) {
                if ($data->itemid != "") {
                    $model = new PosCart();
                    $model->itemid = $data->itemid;
                    $model->qty = $data->qty;      
                    $model->gprice=$data->gprice;                    
                    $list[] = $model;
                }
            }
        }
        return $list;
    }

    public static function removeAll() {
        unset($_SESSION['pos_cart']);
    }
    }
?>