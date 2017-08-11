<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function init() {
        parent::init();
        $this->CheckMACValid();
    }

    protected function initAjaxCsrfToken() {

        Yii::app()->clientScript->registerScript('AjaxCsrfToken', ' $.ajaxSetup({
                         data: {"' . Yii::app()->request->csrfTokenName . '": "' . Yii::app()->request->csrfToken . '"},
                         cache:false
                    });', CClientScript::POS_HEAD);
    }
//
//    public function GetMAC() {
//        ob_start();
//        system('getmac');
//        $Content = ob_get_contents();
//        ob_clean();
//        return substr($Content, strpos($Content, '\\') - 20, 17);
//    }

    protected function CheckMACValid() {
        ob_start();
        system('getmac');
        $Content = ob_get_contents();
        ob_clean();
        $mac_address = substr($Content, strpos($Content, '\\') - 20, 17);
        $check_mac_valid = Globalpreferences::getAllValueByParamName('company_id');
        if ($check_mac_valid->is_active == 0) {
            if (md5($mac_address) == $check_mac_valid->value) {
                //echo "Valid";
                Globalpreferences::model()->model()->updateByPk($check_mac_valid->id, array('is_active' => 1));
            } else {
                echo "<h2> You are not authorized to access this application </h2>"
                . "<p>Please contact administrator for support to access this application.</p>"
                . "<p>For Assistance Call: 8109715695</p>";
                exit();
            }
       }else{
             //$license_expire_date=date('Y-m-d', strtotime('today + 90 days'));
//             $start_date=Globalpreferences::getValueByParamName('software_date');                     
//             $present=date('Y-m-d');                     
//             if ($start_date<=$present) {
//                echo "<h2> Your GBOOKS software license is expired.</h2>"
//                . "<p>Please contact <a href='http://www.cics.co.in' target='_blank'>Central India Consultancy Services (CICS)</a> to renew your license.</p>"
//                . "<p>For Assistance Call: 8109715695</p>";
//                exit(); 
//             }
        }
    }

}

