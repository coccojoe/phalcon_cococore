<?php
/**
 * File name : Lang.php
 * Create date : 2015-03-07 04:27
 * Modified date : 2015-03-07 04:27
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class Lang
{
	public static function translate(
		$file = null, 
		$content, 
		$params = array()
	) {
		$configFile = APP_ROOT . '/../conf/app.ini';
		$appConfig = new \Phalcon\Config\Adapter\Ini($configFile);
		$language = empty($appConfig->application->language) 
			? DEFAULT_LANGUAGE : 
			$appConfig->application->language;

		$message = array();

		// 载入语言文件，默认lang.php配置列表文件
		if (empty($file)) {
			$langFile = APP_ROOT . '/lang/' . $language . '/lang.php';

			$imports = file_exists($langFile) 
				? require_once($langFile) 
				: array(); 
			foreach ($imports as $val) {
				$e = APP_ROOT . '/lang/' . $language . '/' . $val . '.php'; 
				$message += file_exists($e) 
					? require_once($e) 
					: array(); 
			}
		} else {
			$path = APP_ROOT . '/lang/' . $language . '/' . $file. '.php'; 	
			$message += file_exists($path) ? require_once($path) : array(); 
		}

		$translate = new \Phalcon\Translate\Adapter\NativeArray(array(
			'content' => $message,
		));
		

		return $translate->_($content, $params);	
	}
}
