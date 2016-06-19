<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * The Tags List Controller
 *
 * @since  3.1
 */
class rrhhControllerFuncionario extends JControllerForm{	
	
	public function __construct($config = array()){

		parent::__construct($config);
		
		$this->registerTask('apply', 	'save');
		$this->registerTask('save2', 	'save');
		
	}
		
	function save($key = NULL, $urlVar = NULL){
				
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		
		$app	= JFactory::getApplication();
		$model	= $this->getModel();
		$form	= $model->getForm();
		$data	= JRequest::getVar('jform', array(), 'post', 'array');				
		$id		= JRequest::getInt('id_cargo');
		$option	= JRequest::getCmd('option');
						
		/*if (!JFactory::getUser()->authorise('core.create', $option)){
			JFactory::getApplication()->redirect('index.php', JText::_('JERROR_ALERTNOAUTHOR'));
			return;
		}*/
				
		// Validate the posted data.
		$return = $model->validate($form, $data);
		
		if ($return === false) {
			// Get the validation messages.
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_rrhh.edit.funcionario.data', $data);

			// Redirect back to the edit screen.
			$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=funcionarios&layout=edit&tmpl=component', false));
			
			return false;
		
		}
		
		$return = $model->save($data);
		
		if ($return === false){
			
			$errors	= $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
				if ($errors[$i] instanceof Exception) {
					$app->enqueueMessage($errors[$i]->getMessage(), 'warning');
				} else {
					$app->enqueueMessage($errors[$i], 'warning');
				}
			}

			// Save the data in the session.
			$app->setUserState('com_rrhh.edit.funcionario.data', $data);

			// Save failed, go back to the screen and display a notice.
			$message = JText::sprintf('Error al Guardar la información', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=funcionarios&layout=edit&tmpl=component', false));
			
			return false;
		
		}		
	
		// Set the redirect based on the task.
		switch ($this->getTask()){
			
			case 'apply':
				$message = JText::_('Cargo Guardado Correctamente');
				$this->setRedirect('index.php?option=com_rrhh&view=funcionarios&tmpl=component&layout=edit&id_user='.$model->GetState('funcionarios.id'), $message);
				break;
			
			case 'save2':
				$message = JText::_('Cargo Guardado Correctamente');
				$this->setRedirect('index.php?option=com_rrhh&tmpl=component&view=empleados&layout=edit&funcionarios=1&id_user='.$model->GetState('funcionario.id'), $message);
				break;

			case 'save':			
			default:
				$this->setRedirect('index.php?option=com_rrhh&view=close');
				break;
		}

		return true;
	}
	
	public function delete(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		$db 	= JFactory::getDbo();
		        
		$query 	= $db->getQuery(true)
			->delete($db->quoteName('#__core_user'))
			->where('id_user = '. $ids[0]);
	    $db->setQuery($query);
	    $db->execute();
			
		$message = JText::_('Funcionario Borrado Correctamente');
								
		$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=funcionarios&layout=default'), $message);
		
		return false; 		
		
	}
	
	public function sucesion(){
		
		$id_tiempo 	= JRequest::getVar('id_tiempo');
		$id_cargo 	= JRequest::getVar('id_cargo');
		$id_user 	= JRequest::getVar('id_user');
		
		$db 	= JFactory::getDbo();
		
		$sucesion = new stdClass;
		$sucesion->id_tiempo 	= $id_tiempo;
		$sucesion->id_cargo 	= $id_cargo;
		$sucesion->id_user		= $id_user;

		if (!$db->InsertObject('#__core_cargos_rel_users', $sucesion, 'id_user')) {
		    echo $db->stderr();
		    return false;
		}	
				
		echo $this->getSucesion($id_user); 
		
		die(); 		
				
	}
	
	public function sucesiond(){
		
		$id_tiempo 	= JRequest::getVar('id_tiempo');
		$id_user 	= JRequest::getVar('id_user');
		
		$db 	= JFactory::getDbo();
		        
		$query 	= $db->getQuery(true)
			->delete($db->quoteName('#__core_cargos_rel_users'))
			->where('id_user = '. $id_user . ' AND id_tiempo = '. $id_tiempo);
	    $db->setQuery($query);
	    $db->execute();		
		
		echo $this->getSucesion($id_user); 

		die(); 				
		
	}
	
	public function getSucesion($id_user){
		
		$sucesiones = ''; 
		$html = ''; 
		
		$db 	= JFactory::getDbo();
			
		$query = $db->getQuery(true);		
		$query->select('b.alias, b.color, c.nombre as cargo, d.nombre as area, a.id_tiempo');
		$query->from('#__core_cargos_rel_users AS a');
		$query->join('inner','#__core_tiempos AS b ON a.id_tiempo = b.id_tiempo');
		$query->join('inner','#__core_cargos AS c ON c.id_cargo = a.id_cargo');
		$query->join('inner','#__core_areas AS d ON d.id_area = c.id_area');
		$query->where('a.id_user = '. $id_user);
		$query->order('b.id_tiempo ASC');
		$db->setQuery($query);	
		$sucesiones = $db->loadObjectList();
				
		if(!empty($sucesiones)){
		
			foreach($sucesiones AS $sucesion){
									
				$html.= '<li style="list-style: none; display: flex;">
					<div class="fl" style="margin-right: 5%; width: 6%">
						<a class="hasTooltip sucesiond" href="javascript:void(0);" style="float: left; margin-top: 3px;" data-tiempo="'. $sucesion->id_tiempo .'" >
							<span class="icon-delete"></span>
						</a>										
						<div style="width: 100%; height: 20px; background: '. $sucesion->color .'; color:#fff; line-height: 21px; text-align: center; margin-left: 25px;">
							<span>'. $sucesion->alias .'</span>
						</div>
					</div>
					<div class="fl nombre" style="margin-right: 5%; ; width: 40%">'. $sucesion->area .'</div>
					<div class="fl nombre" style="margin-right: 5%; width: 50%">'. $sucesion->cargo .'</div>
				</li>'; 		
			}	
	
		}else{
		
			$html = '<h3>No hay Plan de Sucesión</h3>'; 	
		}
		
		return $html; 	
	}
	
}
	