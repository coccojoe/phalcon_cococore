<?php
/**
 * File name : Action.php
 * Create date : 2015-02-27 14:16
 * Modified date : 2015-02-27 14:16
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Action
{
	protected $di;

	protected $dispatcher;

	protected $request;

	protected $controller;


	public abstract function run(); 


	public function __construct($di = '') {
		$this->di = $di;	
		$this->dispatcher = $di->getShared('dispatcher');
		$this->controller = $this->dispatcher->getActiveController();
		$this->request = $this->controller->request;
	}


	public function setConfig($config) {
		$this->_config = $config;
	}


	public function getConfig($config) {
		$this->_config = $config;
	}
	

	public static function factory($di) {
		return new static($di);	
	}


	private function _toCompatible($data, $code, $message) {
		/**
		 * status 可能的状态：
		 * 0 - 发生错误
		 * 1 - 正常
		 * 2 - 用户未登录
		 */
		$code = ($code == DEFAULT_STATUS_CODE) 
			? COMPATIBILITY_MODE_DEFAULT_STATUS_CODE
			: COMPATIBILITY_MODE_DEFAULT_EXCEPTION_CODE;

		// 临时兼容
		if ($code == '142001') {
			$code = 2;	
		}
		
		$json = array(
			'status' => $code, 
			'info' => $message,
		);

		if (is_array($data) && $data) {
			foreach ($data as $key => $val) {
				$json[$key] = $val;
			}
		}


		return $json;
	}


	public function toJson(
		$data = null, 
		$code = DEFAULT_STATUS_CODE,
		$message = DEFAULT_STATUS_MSG
	) {
		$message = Lang::translate(null, $message);
	
		$json = array(
			'code' => $code,
			'message' => $message,
			'data' => $data, 
		);

		if (COMPATIBILITY_MODE) {
			$json = $this->_toCompatible($data, $code, $message);
		}

		echo json_encode($json);
		exit;
	}
	
	
	public function __set($name, $val) {
		$method = 'set' . ucfirst($name);
		method_exists($this, $method) ? $this->$method($val) : null;		
	}


	public function __get($name) {
		$method = 'get' . ucfirst($name);


		return method_exists($this, $method) ? $this->$method($name) : null;
	}


	public static function error(
		$code = DEFAULT_EXCEPTION_CODE, 
		$className = null
	) {
		$className = empty($className) 
			? ucfirst($className) . 'Exception' 
			: 'Exception';

		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\'class not found.');	
		}
		
		throw new $className($code);
	}
}
