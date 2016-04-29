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

jimport('joomla.application.component.controller');

// Create the controller
$controller = JControllerLegacy::getInstance('Rrhh');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();


?>