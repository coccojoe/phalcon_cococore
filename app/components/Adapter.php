<?php
/**
 * File name : Adapter.php
 * Create date : 2015-02-27 14:25
 * Modified date : 2015-02-27 14:25
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Adapter
{
	protected $config;


	public function __construct($config) {
		$this->config = $config;
	}


	public static function factory($className, $config) {
		$className = ucfirst($className) . 'Adapter';
		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');
		}	

		return new $className($config);
	}


	public function __call($func, $args) {
		return call_user_func_array(array($this, $func), $args);
	}
}
