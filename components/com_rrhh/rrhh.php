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

require_once JPATH_COMPONENT . '/helpers/route.php';

if (!JFactory::getUser()->authorise('core.manage', 'com_rrhh')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

jimport('joomla.application.component.controller');

// Create the controller
$controller = JControllerLegacy::getInstance('Rrhh');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));



$controller = JControllerLegacy::getInstance('Tags');
$controller->execute(JFactory::getApplication()->input->get('task'));


// Redirect if set by the controller
$controller->redirect();


?>