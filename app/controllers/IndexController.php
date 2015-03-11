<?php
/**
 * File name : IndexController.php
 * Create date : 2015-02-27 15:56
 * Modified date : 2015-02-27 15:56
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class IndexController extends Controller
{
	public function actions() {
		return array(
			'index' => 'IndexAction',
			'get' => 'GetAction',
		);
	}
}
