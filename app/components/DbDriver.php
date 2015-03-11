<?php
/**
 * File name : DbDriver.php
 * Create date : 2015-03-05 16:53
 * Modified date : 2015-03-05 16:53
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class DbDriver
{
	private static function _getDriverName($config) {
		preg_match('/^\w+/', $config->dsn, $driver);
		if (empty($driver[0])) {
			throw new Exception('error database driver.');
		}


		return $driver[0];
	}


	private static function _getHost($config, $driver) {
		if (in_array($driver, array('mysql', 'postgresql'))) {
			preg_match('/host=([\w-.:]+)/', $config->dsn, $host);
			if (empty($host[1])) {
				throw new Exception('error host of database config.');
			}

			return $host[1];
		}	
	}


	private static function _getDbName($config) {
		preg_match('/dbname=(\w+)/', $config->dsn, $dbname);
		if (empty($dbname[1])) {
			throw new Exception('error dbname of database config.');
		}	


		return $dbname[1];
	}


	private static function _getUserName($config, $driver) {
		if (in_array($driver, array('mysql', 'oracle', 'postgresql')) 
			&& empty($config->username)
		) {
			throw new Exception('error username of database config.');
		}	


		return $config->username;
	} 


	private static function _getPassword($config, $driver) {
		$password = '';
		if (in_array($driver, array('mysql', 'oracle', 'postgresql'))) {
			$password = empty($config->password) ? '' :  $config->password;
		}


		return $password;
	}


	private static function _getPrefix($config) {
		return empty($config->prefix) ? '' : $config->prefix;
	}


	private static function _getCharset($config) {
		return empty($config->charset) ? 'utf8' : $config->charset;
	}


	private static function _getTimeout($config) {
		return empty($config->timeout) 
			? DEFAULT_TIMEOUT_LIMIT 
			: $config->timeout;
	}


	private static function _checkConfig($config) {
		$driver = self::_getDriverName($config);


		return array(
			'driver' => $driver,
			'host' => self::_getHost($config, $driver),
			'username' => self::_getUserName($config, $driver),
			'password' => self::_getPassword($config, $driver),
			'dbname' => self::_getDbName($config),
			'prefix' => self::_getPrefix($config),
			'charset' => self::_getCharset($config),
			'timeout' => self::_getTimeout($config),
		);
	}	


	public static function factory($config) {
		$config = self::_checkConfig($config);	

		$driver = '';
		switch ($config['driver']) {
			case 'mysql' :
				$driver = new \Phalcon\Db\Adapter\Pdo\Mysql($config);
				break;

			case 'oracle' :
				$driver = new \Phalcon\Db\Adapter\Pdo\Oracle($config);
				break;

			case 'sqlite' :
				$driver = new \Phalcon\Db\Adapter\Pdo\Postgrepsql($config);
				break;

			case 'postgresql' :
				$driver = new \Phalcon\Db\Adapter\Pdo\Sqlite($config);
				break;
		}		


		return $driver;
	}
}
