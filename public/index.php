<?php
/**
 * File name : index.php
 * Create date : 2015-02-27 13:20
 * Modified date : 2015-02-27 13:20
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


defined('DEBUG') or define('DEBUG', FALSE);

try {
	require_once (dirname(__FILE__) . '/../app/bootstrap.php');
} catch (Exception $e) {
	$logFile = dirname(__FILE__) . '/../logs/error.log';

	$logger = new \Phalcon\Logger\Adapter\File($logFile);
	$logger->error($e->getMessage());

	if (DEBUG) {
		echo 'System exception: ['. $e->getCode() .'] ' . $e->getMessage();	
	} else {
		echo 'System error, please check the application log.';
	}
}
