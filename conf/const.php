<?php
/**
 * File name : const.php
 * Create date : 2015-03-02 14:54
 * Modified date : 2015-03-02 14:54
 * Author : VE B2C TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


defined('TIME_NOW') or define('TIME_NOW', time());

defined('DEFAULT_SESSION_LIFETIME') or define('DEFAULT_SESSION_LIFETIME', 3600);

defined('DEFAULT_CACHE_LIFETIME') or define('DEFAULT_CACHE_LIFETIME', 5);

defined('DEFAULT_LANGUAGE') or define('DEFAULT_LANGUAGE', 'zh_cn');

defined('DEFAULT_TIMEOUT_LIMIT') or define('DEFAULT_TIMEOUT_LIMIT', 2);


// 兼容模式
defined('COMPATIBILITY_MODE') or define('COMPATIBILITY_MODE', TRUE);

defined('COMPATIBILITY_MODE_DEFAULT_STATUS_CODE') 
	or define('COMPATIBILITY_MODE_DEFAULT_STATUS_CODE', 1);
defined('COMPATIBILITY_MODE_DEFAULT_STATUS_MSG') 
	or define('COMPATIBILITY_MODE_DEFAULT_STATUS_MSG', 'success.');

defined('COMPATIBILITY_MODE_DEFAULT_EXCEPTION_CODE') 
	or define('COMPATIBILITY_MODE_DEFAULT_EXCEPTION_CODE', 0);
defined('COMPATIBILITY_MODE_DEFAULT_EXCEPTION_MSG') 
	or define('COMPATIBILITY_MODE_DEFAULT_EXCEPTION_MSG', 'server error.');

defined('COMPATIBILITY_MODE_EXCEPTION_CODE_NOT_LOGIN') 
	or define('COMPATIBILITY_MODE_EXCEPTION_CODE_NOT_LOGIN', 2);


// 配置状态码
defined('DEFAULT_STATUS_CODE') or define('DEFAULT_STATUS_CODE', '200');
defined('DEFAULT_STATUS_MSG') or define('DEFAULT_STATUS_MSG', 'success.');


// 配置异常
defined('DEFAULT_EXCEPTION_CODE') or define('DEFAULT_EXCEPTION_CODE', '500');
defined('DEFAULT_EXCEPTION_MSG') 
	or define('DEFAULT_EXCEPTION_MSG', 'server error.');

defined('DEFAULT_SERVER_WEIGHT') or define('DEFAULT_SERVER_WEIGHT', 1);
