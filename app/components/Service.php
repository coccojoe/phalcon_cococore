<?php
/**
 * File name : Service.php
 * Create date : 2015-03-02 14:04
 * Modified date : 2015-03-02 14:04
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Service
{
	protected $di;


	public function setDI(\Phalcon\DI $di) {
		$this->di = $di;
	}


	public function getDI() {
		return $this->di;
	}


	public function __construct($di) {
		$this->setDI($di);
	}


	public static function factory($className, $di = null) {
		$className = ucfirst($className) . 'Service';
		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');	
		}

		return new $className($di);
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
