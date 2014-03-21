<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Yii App',
	'language'=>'zh_cn',
	'theme'=>'default',
	'timeZone'=>'Asia/Shanghai',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
		'admin'=>array(
			'class' => 'application.modules.admin.AdminModule'		
		)
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(			
			'urlFormat'=>'path',
			'showScriptName'=>false,			
			'urlSuffix'=>'.htm',
			'rules'=>array(	
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
				'class'=>'system.db.CDbConnection',
				//'connectionString'=>'sqlite:protected/data/phonebook.db',
				'connectionString'=>'mysql:host=localhost;dbname=yii',
				'username'=>'root',
				'password'=>'123456',
				'emulatePrepare'=>true,  // needed by some MySQL installations
				'charset'=>'utf8',
				'tablePrefix' => 'yii_',
		),
		
		//Configure SESSION 
		'session'=>array(
				'class'=>'CDbHttpSession',
				'connectionID' => 'db',
				'sessionTableName' => 'yii_session',
				'timeout'=>3600,    //default 1440 seconds
				'autoStart'=>true,								
				'sessionName'=>'SeYINa',	
		),
		
		//Configure Authorization Manager
		/* 'authManager' => array(
			'class'	=> 'CDbAuthManager',
			'connectID' => 'db'
		), */
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);