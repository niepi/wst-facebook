<?php
/**
 * WST_Facebook
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

require_once '../WST/facebook.php';
require_once '../lib/spyc-0.5/spyc.php';

class FacebookApp extends WST_Facebook{


	protected $content;


	/**
	 * Default function that is called before any action
	 *
	 * @return void
	 * @author Alexander Thomas
	 */
	function init(){


		$this->content = Spyc::YAMLLoad('content.yaml');

		// echo "<pre>";
		// var_dump($this->content['questions']);
	}

	/**
	 * Default action
	 *
	 * @return void
	 * @author Alexander Thomas
	 */
	function indexAction(){
		
		$this->view->example_value = 'Hello World';
		
		//render() triggers template rendering process for this action
		$this->render();
	}

	function quizAction(){
        //$quiz = require_once('quiz.php');
        $this->view->quiz = require('content.php');        
        // $this->view->quiz = $quiz;
        $this->render();
	}

}
