<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\Utilities\ArrayHelper;
/**
 * The Tags List Controller
 *
 * @since  3.1
 */
class rrhhControllerCargo extends JControllerForm{	
	
	public function __construct($config = array()){

		parent::__construct($config);
		
		$this->registerTask('apply', 	'save');
		$this->registerTask('unpublish', 'publish');

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
			$app->setUserState('com_rrhh.cargo.global.data', $data);

			// Redirect back to the edit screen.
			$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=cargos&layout=edit&tmpl=component', false));
			
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
			$app->setUserState('com_rrhh.cargo.global.data', $data);

			// Save failed, go back to the screen and display a notice.
			$message = JText::sprintf('Error al Guardar la información', $model->getError());
			$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=cargos&layout=edit&tmpl=component', false));
			
			return false;
		
		}		
	
		// Set the redirect based on the task.
		switch ($this->getTask()){
			
			case 'apply':
				$message = JText::_('Cargo Guardado Correctamente');
				$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=cargo&tmpl=component&layout=edit&id_cargo='.$model->GetState('cargos.id')), $message);
				break;

			case 'save':
			default:
				$this->setRedirect('index.php?option=com_rrhh&view=close');
				break;
		}

		return true;
	}
        
    function cambioPosicionAjax(){

    	$idarea = JRequest::getVar('nuevo_orden');
        $value = 1;
           
            $db = JFactory::getDbo();
            $query = $db->getQuery(true)
			->select('id_cargo, ordering')
			->from($db->quoteName('#__core_cargos'))
                        //->where($db->quoteName('id_area').' IN ('.implode(',', $idarea).')');
                        ->where($db->quoteName('level')."=".$db->quote($value))
                        ->order('ordering', 'ASC');
            $db->setQuery($query);
            $countList = $db->loadObjectList();

            $ListArray = array();
            $i = 0;
            foreach ($countList as $v){
                $ListArray [$i] = $v->ordering;
                $i++;
            }
            
            $p = 0;
            foreach ($idarea as $vidArea) {
                
                $query1 = $db->getQuery(true)
                            ->select('count(id_cargo)')
                            ->from($db->quoteName('#__core_cargos'))
                            ->where($db->quoteName('level')."=".$db->quote($value))
                            ->where($db->quoteName('id_cargo')."=".$db->quote($vidArea));
                $db->setQuery($query1);
                $countPos = $db->loadResult();
                
                if($countPos >0){
                   
                     //echo "ID = ".$vidArea." POS=".$ListArray[$p]."<br/>";
                    // Fields to update.
                   
                    $query = $db->getQuery(true);
                    $fields = array(
                        $db->quoteName('ordering') . ' = ' .$ListArray[$p]
                    );
                    
                    $conditions = array(
                            $db->quoteName('id_cargo') . ' = '.$vidArea
                     );
                    
                    $query->update($db->quoteName('#__core_cargos'))->set($fields)->where($conditions);
 
                    $db->setQuery($query);
                    $result = $db->execute();
                    print_r($result);
                    
                    $p++;
                }
                
            }
           
            exit;
           
	}
	
	public function getArea(){
		
		$document = JFactory::getDocument();

	    $document->setMimeEncoding('text/html');

		$model	= $this->getModel(); // JModelForm
		$form 	= $model->getForm();
		$html 	= $form->getLabel('parent_id'). $form->getInput('parent_id');
		
		echo $html;
		
		die();
	
	}
	
	public function publish(){
		
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		$values = array('publish' => 0, 'unpublish' => 1);
		$task   = $this->getTask();
		$value  = ArrayHelper::getValue($values, $task, 1, 'int');
		
		if (empty($ids)){
			JError::raiseWarning(500, JText::_('No se selecciono un Cargo'));
		}else{
			// Get the model.
			/** @var BannersModelBanner $model */
			$model = $this->getModel();

			// Change the state of the records.
			if (!$model->stick($ids, $value)){
				JError::raiseWarning(500, $model->getError());
			}else{
				
				if ($value == 1){
					$ntext = 'Cargo Deshabilitado';
				}else{
					$ntext = 'Cargo Habilitado';
				}

				$this->setMessage(JText::plural($ntext, count($ids)));
			}
		}

		$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=cargos'));
		
		return true; 
				
	}
        
    public function delete(){
		
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		$ids    = $this->input->get('cid', array(), 'array');
		$db 	= JFactory::getDbo();
        $query 	= $db->getQuery(true)
			->select('count(id_cargo)')
			->from($db->quoteName('#__core_cargos'))
			->where('parent_id = '. $ids[0]);
        
        $db->setQuery($query);
        $countList = $db->loadResult();
   
    	
        if($countList == 0){
			
			$query 	= $db->getQuery(true)
				->delete($db->quoteName('#__core_cargos'))
				->where('id_cargo = '. $ids[0]);
	        $db->setQuery($query);
	        $db->execute();
			
			$message = JText::_('Cargo Borrada Correctamente');
				
		}else{

			$message = JText::_('No se puede Borrar el cargo porque tiene un ');			
		}    
				
		$this->setRedirect(JRoute::_('index.php?option=com_rrhh&view=cargos&layout=default'), $message);
		
		return false; 		
		
	}
		
}
	