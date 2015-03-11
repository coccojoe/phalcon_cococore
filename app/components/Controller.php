<?php
/**
  File name : Controller.php
 * Create date : 2015-02-27 14:13
  Modified date : 2015-03-06 18:10
 * Author : MYCOCO TEAM, (m)Coco
 * Express : 
 * 
 * -----------------------------
 *	Please keep this mark, tks!
 */


abstract class Controller extends \Phalcon\Mvc\Controller
{
	abstract protected function actions();
}
