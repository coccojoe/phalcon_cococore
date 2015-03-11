<?php
/**
 * File name : GoodsService.php
 * Create date : 2015-03-02 14:01
 * Modified date : 2015-03-02 14:01
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


class GoodsService extends Service
{
	public function getGoodsInfoById($id, $fields = '*') {
		$model = Model::factory('goods');
		$goodsInfo = $model->getGoodsInfoById($id, $fields);
		$model = null;

		if (empty($goodsInfo)) {
			throw new GoodsException('102001');	
		}


		return $goodsInfo;
	}
}
