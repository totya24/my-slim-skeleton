<?php
namespace App\Controllers;

use SlimFacades\App;
use SlimFacades\Request;
use App\Facades\Config;
use SlimFacades\View;

Class BaseController
{

	protected $twigEnv = null;
	protected $baseUrl = null;
	protected $assetsUrl = null;

	public function __construct(){

		$this->twigEnv = View::getEnvironment();
		$this->baseUrl = Request::getUri()->getBaseUrl();
		$this->assetsUrl = $this->baseUrl . '/assets/';

		$appData = [
			'baseUrl' => $this->baseUrl,
			'assetsUrl' => $this->assetsUrl,
			'styleSheets' => [],
			'headerScripts' => [],
			'footerScripts' => [],
			'meta' => []
		];

		$defaultAssets = Config::get('assets');
		if(!empty($defaultAssets['css'])){
			foreach($defaultAssets['css'] as $id => $css){
				$appData['styleSheets'][$id] = ($this->isExternal($css) ? '' : $this->assetsUrl) . $css;
			}
		}
		if(!empty($defaultAssets['js']['header'])){
			foreach($defaultAssets['js']['header'] as $id => $js){
				$appData['headerScripts'][$id] = ($this->isExternal($js) ? '' : $this->assetsUrl) . $js;
			}
		}
		if(!empty($defaultAssets['js']['footer'])){
			foreach($defaultAssets['js']['footer'] as $id => $js){
				$appData['footerScripts'][$id] = ($this->isExternal($js) ? '' : $this->assetsUrl) . $js;
			}
		}

		$this->twigEnv->addGlobal('app', $appData);
	}
	
	public function addCss($css = null, $id = null){
		if(empty($css)) return false;

		$appData = $this->twigEnv->getGlobals('app');
		if(is_null($id)){
			$pathInfo = pathinfo($css);
			$id = $pathInfo['filename'];
		}
		$appData['app']['styleSheets'][$id] = ($this->isExternal($css) ? '' : $this->assetsUrl) . $css;

		$this->twigEnv->addGlobal('app', $appData['app']);
	}

	public function removeCss($id){
		$appData = $this->twigEnv->getGlobals('app');
		unset($appData['app']['styleSheets'][$id]);
		$this->twigEnv->addGlobal('app', $appData['app']);
	}

	public function addFooterScript($script = null, $id = null, $order = null){
		$this->addScript($script, $id, $order, 'footerScripts');
	}
	
	public function addHeaderScript($script = null, $id = null, $order = null){
		$this->addScript($script, $id, $order, 'headerScripts');
	}

	public function addScript($script = null, $id = null, $order = null, $position = 'headerScripts'){
		if(empty($script)) return false;

		//FIXME: handle order

		$appData = $this->twigEnv->getGlobals('app');
		$scripts = $appData['app'][$position];
		if(is_null($id)){
			$pathInfo = pathinfo($script);
			$id = $pathInfo['filename'];
		}
		$scripts[$id] = ($this->isExternal($script) ? '' : $this->assetsUrl) . $script;
		
		$appData['app'][$position] = $scripts;

		$this->twigEnv->addGlobal('app', $appData['app']);
	}
	
	public function removeScript($id, $position = null){
		//TODO
	}

	public function setMeta($data, $value = null){
		$metaData = array();
		if(is_array($data)){
			$metaData = $data;
		}else {
			if(!is_null($value)){
				$metaData[$data] = $value;
			}
		}
		
		if(empty($metaData)) return false;
		
        $appData = $this->twigEnv->getGlobals('app');
		$currentMeta = $appData['app']['meta'];
        $newMeta = array_merge($currentMeta,$metaData);
		$appData['app']['meta'] = $newMeta;
        $this->twigEnv->addGlobal('app', $appData['app']);
    }

	public function isExternal($url){
		return !(strpos($url, '//') === false);
	}
	
}