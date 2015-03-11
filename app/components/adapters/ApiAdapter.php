<?php
/**
 * File name : ApiAdapter.php
 * Create date : 2015-03-03 12:28
 * Modified date : 2015-03-03 12:28
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class ApiAdapter extends Adapter
{
	public function init($which = '') {
		$which = empty($which) ? 'deafult' : $which;	
	}
}
