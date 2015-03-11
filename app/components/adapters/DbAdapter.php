<?php
/**
 * File name : DbAdapter.php
 * Create date : 2015-03-03 12:25
 * Modified date : 2015-03-03 12:25
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class DbAdapter extends Adapter
{
	protected $connect;


	public function setConnect($val) {	
		if ($val && empty($this->config[$val])) {
			throw new Exception('error database config.');
		}	

		$dbConfig = $val ? $this->config[$val] : $this->config;

		$driver = DbDriver::factory($dbConfig);
	}


	public function __construct($config) {
		parent::__construct($config);
	}
}
