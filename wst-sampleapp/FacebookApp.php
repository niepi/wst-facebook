/**
 * wst-facebook
 *
 * LICENSE
 *
 * This source file is subject to the new CC-GNU LGPL
 * It is available through the world-wide-web at this URL:
 * http://creativecommons.org/licenses/LGPL/2.1/
 *
 * @category   wst-facebook
 * @copyright  Copyright (c) 2009 Thomas Niepraschk (me@thomas-niepraschk.net), Alexander fanatique* Thomas (me@alexander-thomas.net)
 * @license    http://creativecommons.org/licenses/LGPL/2.1/
 */

<?php

require_once '../WST/facebook.php';

class FacebookApp extends WST_Facebook{

	function init(){
		$this->view->assign('hostname','http://f8.niepi.org/wst-sampleapp');
		$this->view->assign('fbuserid',$this->fbuserid);
	}

	function indexAction(){
		$this->render();
	}
}
 