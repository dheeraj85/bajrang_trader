<?php

class Shoping {

    public $id;
    public $booksid;
    public $qty;
    public $glass;
    public $gprice;
    public $power;
    public $powerprice;
    public $cid;
   
    public function getProducts() {
        return Cakeaddons::model()->findByPk($this->booksid);
    }
  
    public static function addtocart(Shoping $shop) {
        if (count($_SESSION['cart']) == 0) {
            $_SESSION['cart'][] = $shop;
        } else {
            if (Shoping::checkExists($shop->booksid)) {

                $loc = Shoping::getindex($shop->booksid);
                $_SESSION['cart'][$loc]->booksid = $shop->booksid;
                $_SESSION['cart'][$loc]->glass = $shop->glass;
                $_SESSION['cart'][$loc]->gprice = $shop->gprice;
                $_SESSION['cart'][$loc]->cid = $shop->cid;
                $_SESSION['cart'][$loc]->power = $shop->power;
                $_SESSION['cart'][$loc]->powerprice = $shop->powerprice;
                $_SESSION['cart'][$loc]->qty = $shop->qty;
            } else {
                $_SESSION['cart'][] = $shop;
            }
        }
    }

    public static function updatecart(Shoping $shop) {

        $loc = Shoping::getindex($shop->booksid);
        $_SESSION['cart'][$loc]->booksid = $shop->booksid;
        $_SESSION['cart'][$loc]->glass = $shop->glass;
        $_SESSION['cart'][$loc]->gprice = $shop->gprice;
        $_SESSION['cart'][$loc]->cid = $shop->cid;
        $_SESSION['cart'][$loc]->power = $shop->power;
        $_SESSION['cart'][$loc]->powerprice = $shop->powerprice;
        $_SESSION['cart'][$loc]->qty = $shop->qty;
    }

    public static function checkExists($bookid) {
        $b = false;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $data) {
                if ($data->booksid == $bookid) {
                    $b = TRUE;
                    break;
                }
            }
            return $b;
        }
    }

    public static function getindex($bookid) {
        $b = 0;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $data) {
                if ($data->booksid == $bookid) {
                    return $b;
                    break;
                }
                $b++;
            }
        }
    }

    public static function remove($bookid) {
        $id = Shoping::getindex($bookid);
        if (count($_SESSION['cart']) == 1) {
            unset($_SESSION['cart']);
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }

    public static function get($bookid) {
        $id = Shoping::getindex($bookid);
        return $_SESSION['cart'][$id];
    }

    public static function getAll() {
        $list = array();
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $data) {
                if ($data->booksid != "") {
                    $model = new Shoping();
                    $model->booksid = $data->booksid;
                    $model->qty = $data->qty;
                    $model->glass=$data->glass;
                    $model->gprice=$data->gprice;
                    $model->cid=$data->cid;
                    $model->power=$data->power;
                    $model->powerprice=$data->powerprice;                    
                    $list[] = $model;
                }
            }
        }
        return $list;
    }

    public static function removeAll() {
        unset($_SESSION['cart']);
    }
    }
?>