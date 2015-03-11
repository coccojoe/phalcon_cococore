<?php
/**
 * File name : Manager.php
 * Create date : 2015-02-27 14:17
 * Modified date : 2015-02-27 14:17
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Manager
{
	protected $adapterName;

	protected $configFile = '';

	private $_config;

	private $_adapter;

	private $_adapterType = 'db';


	public function setConfig(\Phalcon\Config\Adapter\Ini $val) {
		$this->_config = $val;
	}


	public function __construct() {
		$file = APP_ROOT . '/../conf/' . $this->configFile . '.ini'; 
		if (!file_exists($file)) {
			throw new Exception('\'' . $file . '\' file not found.');
		}
		$this->setConfig(new \Phalcon\Config\Adapter\Ini($file));

		$this->_adapterType = empty($this->_config->common->adapter)
			? $this->_adapterType
			: $this->_config->common->adapter; 
		$type = $this->_adapterType;
		$adapterConfig = $this->_config->$type;
		if (empty($adapterConfig)) {
			throw new Exception($this->adapterName . 'adapter config error.');	
		}

		$adapterName = $this->adapterName . ucfirst($this->_adapterType);
		$this->_adapter = Adapter::factory($adapterName, $adapterConfig);
	}


	public function getConfig() {
		return $this->_config;
	}


	public function setAdapter(Adapter $adapter) {
		$this->_adapter = $adapter;
	}


	public function getAdapter() {
		return $this->_adapter;
	}


	public static function factory($className) {
		$className = ucfirst($className) . 'Manager';
		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');
		}	


		return new $className();
	}


	public function __set($name, $val) {
		$method = 'set' . ucfirst($name);
		method_exists($this, $method) ? $this->$method($val) : null;		
	}


	public function __get($name) {
		$method = 'get' . ucfirst($name);


		return method_exists($this, $method) ? $this->$method($name) : null;
	}


	public function __call($func, $args) {
		return call_user_func_array(array($this, $func), $args);
	}
}
