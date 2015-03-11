<?php
/**
 * File name : bootstrap.php
 * Create date : 2015-02-27 14:28
 * Modified date : 2015-02-27 14:28
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


defined('APP_ROOT') or define('APP_ROOT', dirname(__FILE__));

// 加载常量定义
require_once(APP_ROOT .'/../conf/const.php');

// 加载系统配置
$configFile = APP_ROOT .'/../conf/app.ini';
if (!file_exists($configFile)) {
	throw new Exception('\'' . $file . '\' file not found.');
}
$config = new \Phalcon\Config\Adapter\Ini($configFile);

// 加载组件目录
$importDirs = function() use ($config) {
	$importDirs = array();

	if (empty($config->import)) {
		throw new Exception('error import section config.');
	}

	foreach ($config->import as $e) {
		$importDirs[] = APP_ROOT . '/' . $e;		
	}


	return $importDirs;
};

$loader = new \Phalcon\Loader();
$loader->registerDirs($importDirs())->register();


$di = new \Phalcon\DI\FactoryDefault();

// 配置发器与事件监听
$di->set('dispatcher', function() use ($di) {
	$eventManager = $di->getShared('eventsManager');
	$listener = new Listener();
	$eventManager->attach('dispatch', $listener);

	$dispatcher = new \Phalcon\Mvc\Dispatcher();
	$dispatcher->setEventsManager($eventManager);


	return $dispatcher;
});

// 配置会话
$di->set('session', function() use ($config) {
	$handler = empty($config->session->handler) 
		? '' 
		: $config->session->handler;
	$adapter = SessionAdapter::factory($handler, $config->session);
	$adapter->start();


	return $adapter;
});

// 配置主题与视图
if (!empty($config->application->theme) 
	&& !empty($config->application->themesDir)
) {
	$viewsDir = $config->application->themesDir . '/' 
		. $config->application->theme;
}
$di->set('view', function() use ($viewsDir){
	$view = new \Phalcon\Mvc\View();
	$view->setViewsDir($viewsDir);


	return $view;
});;

// 配置应用根目录
$di->set('url', function() {
	$url = new \Phalcon\Mvc\Url();
	$url->setBaseUri(APP_ROOT);


	return $url;
});


$application = new \Phalcon\Mvc\Application($di);
echo $application->handle()->getContent();
