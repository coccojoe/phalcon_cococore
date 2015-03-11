<?php
/**
 * File name : GetAction.php
 * Create date : 2015-03-07 15:20
 * Modified date : 2015-03-07 15:20
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class GetAction extends Action
{
	private function _get() {
		$id = $this->dispatcher->getParam('id', 'int');
		if (empty($id)) {
			throw new GoodsException('101001');
		}

		$rs = Service::factory('goods', $this->di)->getGoodsInfoById($id);
		if (!$rs) {
			throw new GoodsException('600');	
		}

		$this->toJson();	
	}


	public function run() {
		try {
			$this->_get();
		} catch (Exception $e) {
			$this->toJson(null, $e->getCode(), $e->getMessage());
		}
	}
}
