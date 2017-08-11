<?php

class Common {

    public static function getItemBarcode($valueArray) {
        $elementId = $valueArray['itemId'] . "_bcode"; /* the div element id */
        $value = $valueArray['barocde'];
        $type = 'ean13'; /* you can set the type dynamically if you want valueArray eg - $valueArray['type'] */
        $settings = array(
            'output' => 'css' /* css, bmp, canvas note- bmp and canvas incompatible wtih IE */,
            /* if the output setting canvas */
            'posX' => 10,
            'posY' => 30,
            /* */
            'bgColor' => '#fff', /* background color */
            'color' => '#000000', /* "1" Bars color */
            'barWidth' => 1.5,
            'barHeight' => 60,
            'moduleSize' => 5,
            'addQuietZone' => 0, /* Quiet Zone Modules */
        );
        self::getBarcode(array('elementId' => $elementId, 'value' => $value, 'type' => $type, 'settings' => $settings));
        return CHtml::tag('div', array('id' => $elementId));
    }

    /**
     * This function returns the item barcode
     */
    public static function getBarcode($optionsArray) {

        Yii::app()->getController()->widget('ext.barcode.Barcode', $optionsArray);
    }

}
