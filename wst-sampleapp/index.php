<?php
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

/**
 * Configure your Facebook data
 */
$fb = array();
$fb['needed'] = false; //If false the Facebook API is not initialized - useful for development
$fb['appid'] = '340863595924270';
$fb['secret'] = '22aa6163ea2bda6d074582900f2e2dd1';

/**
 * Configure your database connection. 
 * If you do so there will be a $this->db object using adodb to allow accessing your database.
 */
$db = array();
$db['needed'] = false; //If false no database connection will be established.
$db['driver'] = 'mysqli';
$db['server'] = 'localhost';
$db['user'] = 'root';
$db['passwd'] = '';
$db['name'] = 'mysql';
$db['options'] = array('port'=> 3306, 'debug' => true);

date_default_timezone_set('Europe/Vienna'); //Define the timezone (Mandatory scince PHP 5.3)



##################################################################
# Relax. From here on we handle the rest for you.
##################################################################

/** Determine the environment and the include paths*/
$dirname = dirname(__FILE__) . '/';

$pathLibrary = $dirname . "../lib/";
$pathWST = $dirname . "../WST/";
set_include_path(get_include_path() . PATH_SEPARATOR . $pathLibrary . PATH_SEPARATOR . $pathWST);

require_once 'FacebookApp.php';
$facebookapp =  new FacebookApp();

//Initialize Facebook API if needed.
if($fb['needed'] == true){
	$facebookapp->initFacebook($fb['appid'], $fb['secret']);
}

//Set up databae connection if needed.
if($db['needed'] === true){
	$facebookapp->initDB($db['driver'], $db['server'], $db['user'], $db['passwd'], $db['name'], $db['options']);
}

//Evaluate current Action (default is indexAction())
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] . 'Action' : 'indexAction';

try{
 	$facebookapp->$action();
}catch(WST_Facebook_Exception $e){
	$facebookapp->log('error', $e->getMessage());
	$facebookapp->errorAction();
}
