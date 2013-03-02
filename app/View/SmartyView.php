<?php
/**
* CakePHP Smarty view class
*
* This class will allow using Smarty with CakePHP
*
*/

/**
* Include Smarty.
*/
//App::import('Vendor', 'Smarty', array('file' => 'smarty'.DS.'Smarty.class.php'));
App::uses('View', 'View');
App::import('Vendor', null, array('file' => 'smarty'.DS.'Smarty.class.php'));

/**
* CakePHP Smarty view class
*
* This class will allow using Smarty with CakePHP
*
* @package smartyview
* @subpackage view
* @since CakePHP v 2.0
*/
class SmartyView extends View
{
//	public $ext = '.tpl';
	
	function __construct (Controller $controller = null) {
		parent::__construct($controller);
//		echo $controller->view;
		
		$this->Smarty = new Smarty();
		$this->ext= '.tpl';
		$this->Smarty->compile_dir = TMP.'smarty'.DS.'compile'.DS;
		$this->Smarty->cache_dir = TMP.'smarty'.DS.'cache'.DS;
		$this->Smarty->error_reporting = 'E_ALL & ~E_NOTICE';
		$this->Smarty->debugging = true;
		$this->Smarty->caching = 0;
		$this->Smarty->clearCompiledTemplate();
        $this->Smarty->setPluginsDir(array(APP . 'Vendor' . DS . 'smarty' . DS . 'plugins' . DS));
	}
	
    public function _render($viewFile, $data = array()) {
//    	pr($viewFile);
//		pr($data);   	
        if (preg_match('/\.ctp$/', $viewFile)) {
            return parent::_render($viewFile, $data);
        }

		if (empty($data)) {
			$data = $this->viewVars;
		}
		foreach($data as $key => $value)
		{
			if(!is_object($key))
			{
				$this->Smarty->assign($key, $value);
			}
		}
//pr($this->viewVars);
        $this->Smarty->assignByRef('view', $this);
        $this->Smarty->assignByRef('this', $this);
		
		$res = $this->Smarty->fetch($viewFile);
        
        return $res;
    }	

}

?>
	