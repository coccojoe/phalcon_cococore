<?php
/**
 * File name : DbTable.php
 * Create date : 2015-03-05 11:00
 * Modified date : 2015-03-05 11:00
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class DbTable extends \Phalcon\Mvc\Model
{
	protected $dbConfig;

	protected $tableName;


	public function setDbConfig($config) {
		$this->dbConfig = $config;
	}


	public static function factory($className, $config) {
		$className = ucfirst($className) . 'Table';
		if (!class_exists($className)) {
			throw new Exception('\'' . $className . '\' class not found.');
		}	

		$table = new $className();
		$table->setDbConfig($config); 


		return $table;
	}


	public function init($flag = '') {
		$prefix = empty($this->dbConfig->prefix) ? '' : $this->dbConfig->prefix;
		$this->setSource($prefix . $this->tableName);

		if (!empty($flag) && empty($this->dbConfig->$flag)) {
			throw new Exception(
				'\'' . $flag . '\' database config not found.'
			);	
		}
		$config = empty($flag) ? $this->dbConfig : $this->dbConfig->$flag;
		$this->getDI()->set('db', DbDriver::factory($config));
	

		return $this;
	}
}
