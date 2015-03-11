<?php
/**
  File name : GoodsException.php
 * Create date : 2015-03-03 15:27
  Modified date : 2015-03-11 14:57
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 *
 *	101xxx 参数类错误
 *	102xxx 结果类错误
 *	 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class GoodsException extends BaseException
{
	protected function exceptions() {
		return array(
			'101001' => 'error goods id.', 
		);	
	}
}
