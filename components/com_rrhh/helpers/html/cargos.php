<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//JLoader::register('MenusHelper', JPATH_SITE . '/components/com_conparametrizar/helpers/areas.php');

/**
 * Menus HTML helper class.
 *
 * @package     Joomla.Administrator
 * @subpackage  com_menus
 * @since       1.7
 */
abstract class RrhhHtmlCargos{
	
	/**
	 * Returns a published state on a grid
	 *
	 * @param   integer  $value     The state value.
	 * @param   integer  $i         The row index
	 * @param   boolean  $enabled   An optional setting for access control on the action.
	 * @param   string   $checkbox  An optional prefix for checkboxes.
	 *
	 * @return  string        The Html code
	 *
	 * @see JHtmlJGrid::state
	 *
	 * @since   1.7.1
	 */
	public static function state($value, $i, $enabled = true, $checkbox = 'cb'){
		
		$states = array(
			0 => array(
				'unpublish',
				'COM_MENUS_EXTENSION_PUBLISHED_ENABLED',
				'COM_MENUS_HTML_UNPUBLISH_ENABLED',
				'COM_MENUS_EXTENSION_PUBLISHED_ENABLED',
				true,
				'publish',
				'publish'
			),
			1 => array(
				'publish',
				'COM_MENUS_EXTENSION_UNPUBLISHED_ENABLED',
				'COM_MENUS_HTML_PUBLISH_ENABLED',
				'COM_MENUS_EXTENSION_UNPUBLISHED_ENABLED',
				true,
				'unpublish',
				'unpublish'
			),			
		);

		return JHtml::_('jgrid.state', $states, $value, $i, 'crgo.', $enabled, true, $checkbox);
	}
}
