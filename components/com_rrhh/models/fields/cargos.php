<?php 

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('list');

class JFormFieldCargos extends JFormFieldlist{

	protected $type = 'Cargo';

	protected function getOptions(){
		
		$options 	= array();
		$area		= JRequest::getVar('area');		

		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('a.id_cargo AS value, a.nombre AS text');
		$query->from('#__core_cargos AS a');				
		$query->where('a.disabled = 0 AND a.id_cargo > 1');		
		
		if(!empty($area)){
			$query->where('a.id_area = '. $area);		
		}
			
		$query->order('a.id_cargo ASC'); 
		
		// Get the options.
		$db->setQuery($query);
		$option = $db->loadAssocList();

		if(is_array($option) && !empty($option)){
			$options = Array('value' => '1' , 'text'=> '-Sin Principal-');
			array_unshift($option, $options); 
			$options = array_merge(parent::getOptions(), $option);		
		}else{
			$options[] = JHtml::_('select.option', '1', JText::_('-Sin Principal-'));	
			$options = array_merge(parent::getOptions(), $options);
		}
		
		return $options;

	}

}