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

class RrhhModelEmpleados extends JModelAdmin{
	
	protected $item;

	public function getTable($type = 'Funcionarios', $prefix = 'RrhhTable', $config = array()){
		return JTable::getInstance($type, $prefix, $config);

	}
	
	public function getForm($data = array(), $loadData = true){

		// Get the form.
		$form = $this->loadForm('com_rrhh.empleados', 'funcionarios', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form)) {

			return false;

		}

		return $form;

	}

  	protected function loadFormData() {

        // Check the session for previously entered form data.

        $data = JFactory::getApplication()->getUserState('com_rrhh.edit.empleados.data', array());

		if (empty($data)){
           $data = $this->getItem();
        }

        return $data;

    }
	
	public function getItem($pk = NULL){
		
		$db 		= JFactory::getDbo();	
		$id_user 	= JRequest::getVar('id_user');	
		
		$query = $db->getQuery(true);		
		$query->select('a.nombre as cargo, b.nombre as area, c.id_user, c.nombre as nombre, c.foto, c.date_cargo, c.date_ingreso, timestampdiff(MONTH, date_cargo, now()) AS tiempoc, c.nota, c.id_cargo, c.cpt');
		$query->from('#__core_cargos AS a');
		$query->join('inner','#__core_areas AS b ON a.id_area = b.id_area');
		$query->join('left outer','#__core_user AS c ON a.id_cargo = b.id_cargo');
		$query->where('c.id_user = '. $id_user);
		$db->setQuery($query);	
		
		$this->item = $db->loadObject();
		
		$query = $db->getQuery(true);		
		$query->select('b.alias, b.color, c.nombre as cargo, d.nombre as area, a.id_tiempo');
		$query->from('#__core_cargos_rel_users AS a');
		$query->join('inner','#__core_tiempos AS b ON a.id_tiempo = b.id_tiempo');
		$query->join('inner','#__core_cargos AS c ON c.id_cargo = a.id_cargo');
		$query->join('inner','#__core_areas AS d ON d.id_area = c.id_area');
		$query->where('a.id_user = '. $id_user);
		$query->order('b.id_tiempo ASC');
		$db->setQuery($query);	
		$this->item->sucesion = $db->loadObjectList();
		
		$query = $db->getQuery(true);		
		$query->select('b.nombre as cargo, a.date_fin, a.date_inicio');
		$query->from('#__core_user_cargos AS a');
		$query->join('inner','#__core_cargos AS b ON b.id_cargo = a.id_cargo');
		$query->where('a.id_user = '. $id_user);
		$db->setQuery($query);	
		$this->item->cargos = $db->loadObjectList();
		
		$query = $db->getQuery(true);		
		$query->select('a.title');
		$query->from('#__tags AS a');
		$query->join('inner','#__core_users_rel_tags AS b ON b.id_tag = a.id');
		$query->where('a.parent_id = 2 AND b.id_user = '. $id_user);
		$db->setQuery($query);	
		$this->item->fortalezas = $db->loadObjectList();
		
		$query = $db->getQuery(true);		
		$query->select('a.title');
		$query->from('#__tags AS a');
		$query->join('inner','#__core_users_rel_tags AS b ON b.id_tag = a.id');
		$query->where('a.parent_id = 3 AND b.id_user = '. $id_user);
		$db->setQuery($query);	
		$this->item->desarrollos = $db->loadObjectList();
		
		if(!$this->item->desarrollos){
			$this->item->desarrollos = null; 
		}
		
		if(!$this->item->fortalezas){
			$this->item->fortalezas = null; 
		}

		$data = json_decode($this->item->cpt); 
				
		if(!empty($data->CPT_PN1_VE)){
			$this->item->CPT_PN1_VE = $data->CPT_PN1_VE; 
		}
		if(!empty($data->CPT_PN2_ARP)){
			$this->item->CPT_PN2_ARP = $data->CPT_PN2_ARP; 
		}
		if(!empty($data->CPT_PN2_AFN)){
			$this->item->CPT_PN2_AFN = $data->CPT_PN2_AFN; 
		}
		if(!empty($data->CPT_ER1_LE)){
			$this->item->CPT_ER1_LE = $data->CPT_ER1_LE; 
		}
		if(!empty($data->CPT_ER3_LD)){
			$this->item->CPT_ER3_LD = $data->CPT_ER3_LD; 
		}
		if(!empty($data->CPT_CO1_IMO)){
			$this->item->CPT_CO1_IMO = $data->CPT_CO1_IMO; 
		}
		if(!empty($data->CPT_PN1_VE)){
			$this->item->CPT_PN1_VE = $data->CPT_PN1_VE; 
		}
		if(!empty($data->CPT_CO2_AAO)){
			$this->item->CPT_CO2_AAO = $data->CPT_CO2_AAO; 
		}
		if(!empty($data->CPT_CO3_ICR)){
			$this->item->CPT_CO3_ICR = $data->CPT_CO3_ICR; 
		}
		if(!empty($data->CPT_CO4_MI)){
			$this->item->CPT_CO4_MI = $data->CPT_CO4_MI; 
		}
				
		return $this->item;	
	
	}

} ?>