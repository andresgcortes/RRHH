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

require_once (JPATH_LIBRARIES.'/mpdf/mpdf.php');

class rrhhControllerRrhh extends JControllerLegacy{
	
    function pdf(){
            
        $base       = JPATH_ROOT;
        $stylesheet = file_get_contents($base.'/templates/protostar/css/template.css');

        $app = JFactory::getApplication();

        $data = "test";

        
        $mpdf = new mPDF('utf-8', 'Legal-L');
            
            //$mpdf->WriteHTML($stylesheet);
        $mpdf->WriteHTML($stylesheet,1);
            
        $mpdf->WriteHTML('<div id="mydiv"><p>HTML content goes here...</p></div>', 2);

        // SALIDA
        $mpdf->Output('nombre.pdf','D');
 
        
        exit;
        //close the $app
        $app->close();
    }
	
}
	