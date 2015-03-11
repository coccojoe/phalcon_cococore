<?php
/**
 * File name : Cache.php
 * Create date : 2015-02-27 14:17
 * Modified date : 2015-02-27 14:17
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class Cache
{
	private static function _getPort($driverName) {
		$port = 0; 

		switch ($driverName) {
			case 'memcache' || 'libmemcache' :
				$port = 11211;
				break;

			case 'redis' :
				$port = 6379;
				break;

			default :
				break;
		}


		return $port;
	}


	private static function _getServerConfig($config) {
		preg_match('/^(\w)+/', $config->handler, $driver);
		$driver = empty($driver[0]) ? '' : $dirver[0];
		if (empty($driver) 
			|| !in_array($driver, array('memcache', 'libmemcached'))
		) {
			throw new Exception('error cache driver config.');	
		}		

		preg_match('/host=([\w-.]+):?(\d+)?/', $config->host, $uri);
		$host = empty($uri[1]) ? '' : $uri[1];
		if (empty($host)) {
			throw new Exception('error cache host config.');	
		}


		$port = empty($uri[2]) ? self::_getPort($dirver) : $uri[2];
		if (empty($port)) {
			throw new Exception('error cache port config.');	
		}

		$weight = empty($config->weight) 
			? DEFAULT_SERVER_WEIGHT 
			: $config->weight;

		
		return array(
			'host' => $host,
			'port' => $port,
			'weight' => $weight,
		);	
	}


	private static function _getServers($config) {
		$servers = array();

		$hostArr = explode('|', $config->host);
		foreach ($hostArr as $val) {
			if (empty($config->$val)) {
				throw new Exception(
					'error cache server \'' . $val . '\' config.'
				);
			}

			$servers[] = self::_getServerConfig($config->$val);
		}


		return $servers;
	}


	public static function getAdapterConfig($config, $isSession = FALSE) {
		$handler = empty($config->handler) ? '' : $config->handler;

		$lifetime = empty($config->lifetime) 
			? ($isSession ? DEAFULT_SESSION_LIFETIME : DEFAULT_CACHE_LIFETIME) 
			: $config->lifetime;	
		
		$prefix = empty($config->prefix) ? '' : $config->prefix;
		$persistent = empty($config->persistent) ? FALSE : TRUE;

		$adapterConfig = array();
		switch ($handler) {
			case 'memcache' :
				$host = empty($config->host) ? '' : $config->host;
				if (empty($host)) {
					throw new Exception('error cache host config.');
				}
				$port = empty($config->port) ? 11211 : $config->port;

				$adapterConfig = array(
					'host' => $host,
					'port' => $port,
					'persistent' => $persistent,
					'lifetime' => $lifetime,
					'prefix' => $prefix,
				);
				break;

			case 'libmemcached' :
				$adapterConfig = array(
					'servers' => self::_getServers($config),
					'client' => array(
						Memcached::OPT_HASH => Memcached::HASH_MD5,
						Memcached::OPT_PREFIX_KEY => $prefix,
					), 
					'lifetime' => $lifetime,
					'prefix' => $prefix,
				);
				break;

			case 'redis' :
				break;

			default :
				break;	
		}


		return $adapterConfig;
	}


	public static function factory($className, $config) {
		$cache = '';

		switch ($className) {
			case 'memcache' :
				$cache = new \Phalcon\Cache\Backend\Memcache($config); 
				break;

			case 'libmemcached' :
				$cache = new \Phalcon\Cache\Backend\Libmemcache($config); 
				break;

			case 'redis' :
				break;

			default :
				break;
		}


		return $cache; 
	}
}
