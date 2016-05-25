<?php 

defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('list');

class JFormFieldPadres extends JFormFieldlist{

	protected $type = 'padres';

	protected function getOptions(){
		
		$options = array();

		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		$query->select('a.id AS value, a.title AS text');
		$query->from('#__tags AS a');				
		$query->where('a.published = 1 AND a.parent_id = 1');		
		$query->order('a.title ASC'); 
		
		// Get the options.
		$db->setQuery($query);
		$option = $db->loadAssocList();

		if(is_array($option) && !empty($option)){
			$options = Array('value' => '' , 'text'=> 'Seleccione una Categoria');
			array_unshift($option, $options); 
			$options = array_merge(parent::getOptions(), $option);		
		}else{
			$options[] = JHtml::_('select.option', '', JText::_('Seleccione una Categoria'));	
			$options = array_merge(parent::getOptions(), $options);
		}
		
		return $options;

	}

}