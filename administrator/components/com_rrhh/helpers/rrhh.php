<?php

/**
 * @version		$Id: categories.php 20196 2011-01-09 02:40:25Z ian $
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;


class RrhhHelper{

	public static $extension = 'com_rrhh';

	/**
	 * Configure the Linkbar.
	 *
	 * @param	string	$vName	The name of the active view.
	 *
	 * @return	void
	 * @since	1.6
	 */
	
	public static function getActions($messageId = 0){
		
		jimport('joomla.access.access');
		$user	= JFactory::getUser();
		$result	= new JObject;
 				
		if (empty($messageId)) {
			$assetName = 'com_rrhh';
		}else {
			$assetName = 'com_rrhh.rrhh.'.(int) $messageId;
		}
 		
		$actions = JAccess::getActions('com_rrhh', 'component');
						
		foreach ($actions as $action) {
			$result->set($action->name, $user->authorise($action->name, $assetName));
		}
 	
 		return $result;
	
	}

}

