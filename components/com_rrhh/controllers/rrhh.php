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

		$imgstr 	= JRequest::getVar('contenido', '', 'post', 'string', JREQUEST_ALLOWHTML);
        $data 		= str_replace('data:image/png;base64,', '', $imgstr);
		$data 		= str_replace(' ', '+', $data);
		$data 		= base64_decode($data); // Decode image using base64_decode
		$file 		= uniqid() . '.png'; //Now you can put this image data to your desired file using file_put_contents function like below:
		$success 	= file_put_contents(JPATH_ROOT.'/images/'.$file, $data);
		
		$uri =  JUri::base(); 
		$data2 = '<img src="'. $uri .'images/'. $file .'" alt="" />';
		
		$mpdf= new mPDF('utf-8', 'Legal-L');		
		$mpdf->SetDisplayMode('fullpage');	
		$mpdf->list_indent_first_level = 0;	// 1 or 0 - whether to indent the first level of a list
       
       	// $stylesheet = file_get_contents($base.'/templates/protostar/css/template.css');
		$mpdf->WriteHTML($stylesheet, 1);	// The parameter 1 tells that this is css/style only and no body/html/text
					
		$mpdf->WriteHTML($data2);
			
		ob_get_clean();
		
		$mpdf->Output('documento.pdf', 'D');
			
        exit; 

    }
	
}
	