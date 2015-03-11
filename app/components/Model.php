<?php
/**
 * File name : Model.php
 * Create date : 2015-02-27 14:23
 * Modified date : 2015-02-27 14:23
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Model
{
	protected $managerName;

	private $_manager;

	private $_adapter;


	public function getManager() {
		return $this->_manager;
	}


	public function getAdapter() {
		return $this->_adapter;
	}


	public function __construct() {
		if (empty($this->managerName)) {
			throw new Exception('Error manager name.');	
		}

		$this->_manager = Manager::factory($this->managerName);	
		$this->_adapter = $this->manager->adapter;	
	}


	public static function factory($className) {
		$className = ucfirst($className) . 'Model';
		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');
		}	


		return new $className();
	}


	public function __get($name) {
		$method = 'get' . ucfirst($name);


		return method_exists($this, $method) ? $this->$method($name) : null;
	}


	public function __call($func, $params) {
		if (!method_exists($this->adapter, $func)) {
			throw new Exception(
				'the \'' . $func . '()\' method not found in class \'' 
				. get_class($this->adapter) . '\''
			);
		}
		
		return call_user_func_array(array($this->adapter, $func), $params);
	}
}
