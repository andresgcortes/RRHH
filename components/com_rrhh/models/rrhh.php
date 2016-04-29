<?php
/**
* @package Author
* @author 
* @website 
* @email 
* @copyright 
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.modelitem');
class RrhhModelRrhh extends JModelItemLegacy
{
	protected $msg;

	public function getMsg()
	{
		if (!isset($this->msg))
		{
			$this->msg = 'Rrhh';
		}
		return $this->msg;
	}

}


?>