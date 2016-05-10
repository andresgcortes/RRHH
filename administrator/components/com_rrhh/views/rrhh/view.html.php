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

class RrhhViewRrhh extends JViewLegacy{
	function display ($tpl = null)
	{
		// Assign data to the view
		$this->msg = $this->get('Msg');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}

		$this->addToolBar()

;		// Display the view
		parent::display($tpl);
	}

	protected function addToolbar(){

		// Initialise variables.
	
		$canDo	= RrhhHelper::getActions(0);

		JToolBarHelper::title(JText::_( 'COM_RRHH' ), 'generic.png' );
	    
		if ($canDo->get('core.admin')) {

			JToolBarHelper::preferences('com_rrhh');

		}

	}//function

} ?>