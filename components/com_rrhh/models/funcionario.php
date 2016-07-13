<?php

defined('_JEXEC') or die('=;)');

class RrhhModelFuncionario extends JModelAdmin{

	public function getTable($type = 'Funcionarios', $prefix = 'RrhhTable', $config = array()){
		return JTable::getInstance($type, $prefix, $config);

	}
	
	public function getForm($data = array(), $loadData = true){

		// Get the form.
		$form = $this->loadForm('com_rrhh.funcionarios', 'funcionarios', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form)) {

			return false;

		}

		return $form;

	}

  	protected function loadFormData() {

        // Check the session for previously entered form data.

        $data = JFactory::getApplication()->getUserState('com_rrhh.edit.funcionario.data', array());

		if (empty($data)) {

           $data = $this->getItem();

        }

        return $data;

    }
	
	public function Save($data){
		
		$user = JFactory::getUser();
		$table = $this->gettable();
		$key = $table->getKeyName();
		$pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
		$isNew = true;
		
		$datenow 	= JFactory::getDate();
		$datenow	= $datenow->format('Y-m-d H:s', true);		
		$file		= JRequest::getVar('jform', array(), 'files', 'array');				
		
 		$data['modificated_by'] = $user->id;
 		$data['modificated'] 	= $datenow;			 				
		
		$data['cpt'] = array(); 
		
		if(!empty($data['CPT_PN1_VE'])){
			$data['cpt'] = array( 
				'CPT_PN1_VE' => $data['CPT_PN1_VE']
			);
		}
		if(!empty($data['CPT_PN2_ARP'])){
			$data['cpt'] = array( 
				'CPT_PN2_ARP' => $data['CPT_PN2_ARP']
			);
		}
		if(!empty($data['CPT_PN2_AFN'])){
			$data['cpt'] = array( 
				'CPT_PN2_AFN' => $data['CPT_PN2_AFN']
			);
		}
		if(!empty($data['CPT_ER1_LE'])){
			$data['cpt'] = array( 
				'CPT_ER1_LE' => $data['CPT_ER1_LE']
			);
		}
		if(!empty($data['CPT_ER1_LE'])){
			$data['cpt'] = array( 
				'CPT_ER1_LE' => $data['CPT_ER1_LE']
			);
		}
		if(!empty($data['CPT_ER3_LD'])){
			$data['cpt'] = array( 
				'CPT_ER3_LD' => $data['CPT_ER3_LD']
			);
		}
		if(!empty($data['CPT_CO1_IMO'])){
			$data['cpt'] = array( 
				'CPT_CO1_IMO' => $data['CPT_CO1_IMO']
			);
		}
		if(!empty($data['CPT_CO2_AAO'])){
			$data['cpt'] = array( 
				'CPT_CO2_AAO' => $data['CPT_CO2_AAO']
			);
		}
		if(!empty($data['CPT_CO3_ICR'])){
			$data['cpt'] = array( 
				'CPT_CO3_ICR' => $data['CPT_CO3_ICR']
			);
		}
		if(!empty($data['CPT_CO4_MI'])){
			$data['cpt'] = array( 
				'CPT_CO4_MI' => $data['CPT_CO4_MI']
			);
		}
		
		$data['cpt'] = json_encode($data['cpt']); 
		
		if ($pk > 0){
			
			$table->load($pk);
			$isNew = false;
			
		}else{
			
			$data['created_by'] 	= $user->id;
 			$data['created'] 		= $datenow;

		}

		// Bind the data.
		if (!$table->bind($data)){
			$this->setError($table->getError());
			return false;
		}

		// Prepare the row for saving
		$this->prepareTable($table);

		// Check the data.
		if (!$table->check()){
			$this->setError($table->getError());
			return false;
		}
		
		// Store the data.
		if (!$table->store()){
			$this->setError($table->getError());
			return false;
		}

		// Clean the cache.
		$this->cleanCache();

		// Trigger the onContentAfterSave event.		
		$pkName = $table->getKeyName();

		if (isset($table->$pkName)){
			$this->setState($this->getName(). '.id', $table->$pkName);
		}
	
		if(!empty($file)){
			$this->SaveDocument($table->$pkName, $file); 
		}
		
		$this->setState($this->getName() . '.new', $isNew);

		return true;
		
	} 
	
	private function SaveDocument($id_user, $document){
		
		$rutaarchivo = JPATH_ROOT.'/images/fotos/'.$document['name']['foto'];
		
		if(is_array($document)){
			
			jimport('joomla.filesystem.file');
		
		    if($document['error']['foto'] || $document['size']['foto'] < 1 ){
				$msg .= " No existe archivo.<br />";
			}
		    
			if($document['size']['foto'] > 62914560){
		    	$msg .=" Archivo demasiado grande<br />";
				return $msg;
			}
			
			if(!JFile::upload($document['tmp_name']['foto'], $rutaarchivo)){ 		    
	
				$msg.= JText::_('Error cargando el archivo seleccionado.<br />');
				return $msg;			
	
			}else{
				
				$db = $this->getDbo();
				
				$file = new stdClass;
				
				$file->id_user 	= $id_user;
				$file->foto 	= $document['name']['foto'];
	
				if(!$db->UpdateObject('#__core_user', $file, 'id_user')) {
				    echo $db->stderr();
				    return false;
				}		
				
				return true;
			}
				
		}
		
		return false; 
		
	}
		
	function block(&$pks, $value = 1){
	
		// Initialise variables.
		$table		= $this->getTable();
		$pks		= (array) $pks;
		$user		= JFactory::getUser();		
		
		// Access checks.
		foreach ($pks as $i => $pk){
			
			if ($table->load($pk)){	
															
				// Skip changing of same state
				if ($table->disable == $value) {
					unset($pks[$i]);
					continue;
				}
				
				$table->disable = (int) $value;
				
				// Allow an exception to be thrown.
				try{
					if (!$table->check()) {
						$this->setError($table->getError());
						return false;
					}

					// Trigger the onUserBeforeSave event.
					if (in_array(false, $result, true)) {
						// Plugin will have to raise it's own error or throw an exception.
						return false;
					}

					// Store the table.
					if (!$table->store()) {
						$this->setError($table->getError());
						return false;
					}

				}

				catch (Exception $e){
					$this->setError($e->getMessage());

					return false;
				}		
				
			}
		
		}

		return true;
	}		

} ?>