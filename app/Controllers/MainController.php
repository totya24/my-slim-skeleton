<?php
namespace App\Controllers;

use SlimFacades\View;

Class MainController extends BaseController
{
	public function home($request, $response, $args){
		/** Example methods */
        $this->setMeta('title', 'Test page');
		$this->addCss('https://unpkg.com/purecss@0.6.2/build/pure-min.css', 'pure');
		$this->addHeaderScript('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', 'jquery', 'before:main');
		$this->addFooterScript('footer0.js', 'footer0');
		$this->addFooterScript('footer1.js', 'footer1');
        $this->addFooterScript('footer2.js', 'footer2', 'before:footer1');
        $this->addFooterScript('footer3.js', 'footer3', 'after:footer0');
    
        $data = [
            'title' => 'my slim boilerplate',
        ];
        
		View::render($response, 'pages/page.twig', $data);
	}
}