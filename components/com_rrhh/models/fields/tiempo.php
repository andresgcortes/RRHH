<?php 

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('list');

class JFormFieldTiempo extends JFormFieldlist{

	protected $type = 'tiempo';

	protected function getOptions(){
		
		$options = array();

		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('a.id_tiempo AS value, a.nombre AS text');
		$query->from('#__core_tiempos AS a');				
		$query->where('a.disabled = 0');		
		$query->order('a.id_tiempo ASC'); 
		
		// Get the options.
		$db->setQuery($query);
		$option = $db->loadAssocList();

		if(is_array($option) && !empty($option)){
			$options = Array('value' => '1' , 'text'=> 'Seleccione Item');
			array_unshift($option, $options); 
			$options = array_merge(parent::getOptions(), $option);		
		}else{
			$options[] = JHtml::_('select.option', '1', JText::_('Seleccione Item'));	
			$options = array_merge(parent::getOptions(), $options);
		}
		
		return $options;

	}

}