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

class RrhhModelCargos extends JModelItem{
	
	protected $msg;

	public function getMsg()
	{
		if (!isset($this->msg))
		{
			$this->msg = 'Rrhh';
		}
		return $this->msg;
	}

} ?>