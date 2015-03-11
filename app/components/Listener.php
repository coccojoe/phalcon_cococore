<?php
/**
 * File name : Listener.php
 * Create date : 2015-02-27 19:22
 * Modified date : 2015-02-27 19:39
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


use \Phalcon\Config\Adapter\Ini as AdapterIni;

class Listener 
{
	public function beforeDispatchLoop($event, $dispatcher) {
		$keyParams = array();
		$params = $dispatcher->getParams();
		foreach($params as $key => $val) {
			($key & 1) ? $keyParams[$params[$key - 1]] = $val : null;	
		}

		$dispatcher->setParams($keyParams);
	}


	public function beforeNotFoundAction($event, $dispatcher) {
		$di = $dispatcher->getDI();

		// 加载系统配置
		$configFile = APP_ROOT .'/../conf/app.ini';
		if (!file_exists($configFile)) {
			throw new Exception('app config file not found.');	
		}
		$config = new AdapterIni($configFile);

		// 加载当前控制器对应的actions目录
		$actionsPath = APP_ROOT . '/' . $config->import->controllersDir
			. '/' . $dispatcher->getControllerName() . '/';
				
		$loader = new \Phalcon\Loader();
		$loader->registerDirs(array($actionsPath))->register(); 
		$actions = $dispatcher->getActiveController()->actions();
		$actionName = $dispatcher->getActionName();
		
		// 实例化对应action 
		$error = empty($actions[$actionName]) ? true : false;
		if (!$error) {
			$act = $actions[$actionName]::factory($di);
			$act->config = $config;				
			$act->run();
		}
		

		return $error;
	}


	public function beforeException($event, $dispatcher, $exception) {
		throw $exception;


		return false;
	}
}
