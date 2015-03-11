<?php
/**
 * File name : SessionAdapter.php
 * Create date : 2015-03-08 19:08
 * Modified date : 2015-03-08 19:08
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *  Please keep this mark, tks!
 */


abstract class SessionAdapter
{
	public static function factory($className, $config = array()) {
		$adapter = '';

		$adapterConfig = Cache::getAdapterConfig($config);
		switch ($className) {
			case 'memcache' :
				$adapter = 
					new \Phalcon\Session\Adapter\Memcache($adapterConfig);
				break;

			case 'libmemcached' :
				$adapter = 
					new \Phalcon\Session\Adapter\Libmemcached($adapterConfig);
				break;

			default :
				$prefix = empty($config->prefix) ? '' : $config->prefix;
				$adapterConfig = array('unique' => $prefix);
				$adapter = new \Phalcon\Session\Adapter\Files($adapterConfig);
				break;	
		}	
		

		return $adapter;
	}
}
