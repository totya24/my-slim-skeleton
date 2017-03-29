<?php
namespace App\Controllers;

use SlimFacades\View;

Class TestController
{
	public function home(){
		//$this->setMeta('title', 'Test page');
		//$this->addCss('https://unpkg.com/purecss@0.6.2/build/pure-min.css', 'pure');
		//$this->addHeaderScript('https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', 'jquery', 'before:main');
		//$this->addFooterScript('footer.js', 'footer');
	
		View::render($response, 'pages/test.twig', array());
	}
}