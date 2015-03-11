<?php
/**
 * File name : Dispatcher.php
 * Create date : 2015-02-27 19:07
 * Modified date : 2015-02-27 19:07
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class Dispatcher extends \Phalcon\Mvc\Dispatcher
{	
	public function beforeNotFoundAction() {
		echo 'haha';

		return false;
	}
}
