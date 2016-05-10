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

if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
JLoader::register('RrhhHelper', dirname(__FILE__) . '/helpers/rrhh.php');

jimport('joomla.application.component.controller');

// Create the controller
$controller = JControllerLegacy::getInstance('Rrhh');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();


?>