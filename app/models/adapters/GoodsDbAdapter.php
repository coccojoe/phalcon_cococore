<?php
/**
 * File name : GoodsDbAdapter.php
 * Create date : 2015-03-04 11:15
 * Modified date : 2015-03-07 14:26
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class GoodsDbAdapter extends DbAdapter implements GoodsInterface
{
	public function getGoodsInfoById($id, $fields = '*') {
		$table = DbTable::factory('goods', $this->config)->init();
		$rowset = $table->findFirst(array(
			'columns' => $fields,
			'conditions' => 'id = :id:',
			'bind' => array('id' => $id),
		)); 


		return $rowset;		
	}
}
