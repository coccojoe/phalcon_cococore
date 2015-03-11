<?php
/**
 * File name : BaseException.php
 * Create date : 2015-01-19 16:42
 * Modified date : 2015-03-03 16:09
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 异常基类 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class BaseException extends Exception
{
	protected $codes;


	protected abstract function exceptions();


	private function _setBaseException() {
		return array(
			'100' => 'params error.',
			'200' => 'success.',
			'301' => 'moved permanently.',
			'400' => 'bad request.',
			'403' => 'forbidden.',
			'404' => 'not found.',
			'408' => 'request timeout.',
			'500' => 'server error.',
			'600' => 'failed.',
			'601' => 'records not found.'
		);
	}
	

	public function __construct($code = '500') {
		parent::__construct();

		// 索引为数字时，不能用array_merge，否则合并后会重新索引。
		$this->codes = $this->_setBaseException() + $this->exceptions();
		
		$this->code = empty($code) ? DEFAULT_EXCEPTION_CODE : $code;
		$this->message = isset($this->codes[$code]) ? $this->codes[$code] : '';
	}
}
