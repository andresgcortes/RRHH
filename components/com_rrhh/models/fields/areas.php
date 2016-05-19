<?php 

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('list');

class JFormFieldAreas extends JFormFieldlist{

	protected $type = 'Aarea';

	protected function getOptions(){
		
		$options = array();

		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('a.id_area AS value, a.nombre AS text');
		$query->from('#__core_areas AS a');				
		$query->where('a.disabled = 0 AND a.id_area > 1');		
		$query->order('a.id_area ASC'); 
		
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