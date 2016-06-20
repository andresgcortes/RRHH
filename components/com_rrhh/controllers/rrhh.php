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
include(JPATH_LIBRARIES.'/MPDF/mpdf.php');

class rrhhControllerRrhh extends JControllerLegacy{
	
    function descargarpdf(){
            
        $base       = JPATH_ROOT;        
        $stylesheet = file_get_contents($base.'/templates/protostar/css/template.css');
        
    	$mpdf= new mPDF('utf-8', 'Legal-L');		
		$mpdf->SetDisplayMode('fullpage');	
		
		$mpdf->WriteHTML($stylesheet, 1);	// The parameter 1 tells that this is css/style only and no body/html/text
		
		$data.= "<div id=\"chart\" class=\"orgChart\">";
		$data.= JRequest::getVar('contenido', '', 'post', 'string', JREQUEST_ALLOWHTML); 
		$data.= "</div>"; 
		
		$mpdf->WriteHTML($data);
		
		ob_get_clean();
		
		$mpdf->Output('documento.pdf', 'D');
			
        exit;

    }
	
}
	