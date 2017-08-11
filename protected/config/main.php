<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Agrawal Trading Application',
    'defaultController' => 'site/login',
    // preloading 'log' component
    'preload' => array('log'),
    'aliases' => array(
        'bootstrap' => 'ext.bootstrap',
    ),
    // autoloading model and component classes
    'import' => array(
        'bootstrap.behaviors.*',
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
        'application.models.*',
        'application.components.*',
    ),
    'theme' => 'bootstrap',
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
        ),
    'request'=>array(
             //   'class'=>'application.components.HttpRequest',
                'enableCsrfValidation'=>FALSE,
                //'enableCookieValidation'=>true,
               // 'noCsrfValidationRoutes'=>array('pos/index'),
            ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
           'connectionString' => 'mysql:host=localhost;dbname=traders',
        //  'connectionString' => 'mysql:host=localhost;dbname=bajrang_gst',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',                    
                    'levels' => 'error, warning,trace',
                    'categories' => '!application.site.*',
                ),
//                array(
//                    'class' => 'CWebLogRoute',
//                    'levels' => 'info,error, warning',
//                ),
                   array(
                    'class' => 'CFileLogRoute',
                    'categories' => 'application.site.*',
                    'levels' => 'info',
                    'logFile'=>'application_site.log',   
                //    'filter' => 'CLogFilter',
                ),
            // uncomment the following to show log messages on web pages
            // array( 'class'=>'CWebLogRoute',),
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'sgst_tax_percent_ratio' => '50',
        'cgst_tax_percent_ratio' => '50',
        //toc
        'subject' => 'Subject to Anuppur Jurisdiction',  
        'company_name' => 'AGRAWAL TRADING COMPANY',  
        'company_addr1' => 'In Front of HJI Main Gate, Amlai',
        'company_addr2' => 'Distt. Annuppur (M.P.)484117',
        'company_gstin' => '23AEHPA3109B1ZI',
        'company_pan' => 'AEHPA3109B',
        'company_contact' => '(07652) 286875',
        'company_mobile' => '9826649360',
        
        
//        'subject' => 'Subject to Anuppur Jurisdiction',  
//        'company_name' => 'JAI BAJRANG TRADING COMPANY',  
//        'company_addr1' => 'Vill: Bargawan, Amlai',
//        'company_addr2' => 'Distt. Annuppur (M.P.)484117',
//        'company_gstin' => '23ASHPD17431Z1',
//        'company_pan' => 'AEHPA3109B',
//        'company_contact' => '(07652) 286637',
//        'company_mobile' => '9826649360',
     
        //kasa
//        'company_name' => 'The Oven Classics <br>A unit of Kasa Fine Foods',
//        'company_addr1' => '309/3, NH30 Tilhari',
//        'company_addr2' => 'Jabalpur (MP), 482020',
//        'company_gstin' => '23ASZPG7575M1ZS',
//        'company_contact' => '0761-2606311',
        'company_state_code'=>23,
        'company_state'=>'Madhya Pradesh'
    ),
);
