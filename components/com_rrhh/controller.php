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

class RrhhController extends JControllerLegacy
{

	public function display($cachable = true, $urlparams = false){
				
		$document	= JFactory::getDocument();

		// Set the default view name and format from the Request.
		$vName	 = JRequest::getCmd('view', 'cargos');
		$vFormat = $document->getType();
		$lName	 = JRequest::getCmd('layout', 'default');

		if ($view = $this->getView($vName, $vFormat)) {
			// Do any specific processing by view.
			if($vName != "close"){
			
				switch ($vName) {
					
					case 'areas': 
						
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')){
							$this->setRedirect(JRoute::_('index.php', false));
							return;
						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						if($lName == 'default'){
							$model = $this->getModel('areas');
						}else{
							$model = $this->getModel('area');
						}
						break;
							
					case 'cargos':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						if($lName == 'default'){
							$model = $this->getModel('cargos');
						}else{
							$model = $this->getModel('cargo');
						}
						break;
						
					case 'empleados':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
							$model = $this->getModel('empleados');
						
						break;
					
					case 'funcionarios':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						if($lName == 'default'){
							$model = $this->getModel('funcionarios');
						}else{
							$model = $this->getModel('funcionario');
						}
						break;
						
					case 'rrhh':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						$model = $this->getModel('rrhh');
						
						break;	
					
					case 'rrhh_cargo':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						$model = $this->getModel('rrhh_cargo');
						
						break;
					
					case 'sucesion':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						$model = $this->getModel('sucesion');
						
						break;
					
					case 'tags':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						$model = $this->getModel('tags');
						
						break;
					
					case 'tag':
					
						if(!JFactory::getUser()->authorise('core.manage', 'com_rrhh')) {

							$this->setRedirect(JRoute::_('index.php', false));
							return;

						}//If the user is already logged in, redirect to the profile page.
						
						// The user is a guest, load the registration model and show the registration page.
						$model = $this->getModel('tag');
						
						break;
					
					
					default:
					
						$this->setRedirect(JRoute::_('index.php', false));
						
						return;

				}
				
				$view->setModel($model, true);
				$view->setLayout($lName);

				// Push document object into the view.
				$view->assignRef('document', $document);
				$view->display();
				
			}else{
				
				// Check for edit form.
				parent::display();

				return $this;
				
			}
			// Push the model into the view (as default).
			
		}		
	}

}

?>