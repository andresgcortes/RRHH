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

$document = JFactory::getDocument();
$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
$document->addScript('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js');

JHtml::script(Juri::base() . 'templates/protostar/js/jquery.jOrgChart.js');
JHtml::script(Juri::base() . 'templates/protostar/css/prettifycargo.css');
JHtml::script(Juri::base() . 'templates/protostar/css/customcargo.css');

//JHtml::script(Juri::base() . 'templates/protostar/css/jquery.jOrgChart.css');

JFactory::getDocument()->addScriptDeclaration('
 jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : \'#chart\',
            dragAndDrop  : true
        });
    });
');  ?>

<style type="text/css">
/* Basic styling */
/* Draw the lines */
.jOrgChart .line{
  height                : 20px;
  width                 : 4px;
}

.jOrgChart .down {
  background-color 		: #888888;	
  margin 				: 0px auto;
}

.jOrgChart .top {
  border-top          : 3px solid #888888;
}

.jOrgChart .left {
  border-right          : 2px solid #888888;
}

.jOrgChart .right {
  border-left           : 2px solid #888888;
}

/* node cell */
.jOrgChart td {
  text-align            : center;
  vertical-align        : top;
  padding               : 0;
}

/* The node */
.jOrgChart .node {
  background-color 		: #35363B;
  display               : inline-block;
  width                 : 171px;
  height                : 100%;
  z-index 				: 10;
  margin               : 0 2px;
}

/* jQuery drag 'n drop */

.drag-active {
  border-style			: dotted !important;
}

.drop-hover {
  border-style			: solid !important;
  border-color 			: #E05E00 !important;
}

body, html, div, p, span, a, h1, h2, h3, h4, h5{
	margin 				: 0;
	padding 			: 0;
}

body, html{	
	width 				: 100%;
}

body{
	background 			: url('../images/bkgd.png') repeat top left;
	color 				: white;
	font-family 		: tahoma;
	font-weight 		: lighter;
	padding-top 		: 40px;
}

	body p{
		font-size 		: 14px;
	}
	
		body p a{
			font-size	: 16px;
		}

h1 {
	color 				: #AEB0B3;	
	font-style 			: italic;
}

a{
	color 				: #AEB0B3;	
	text-decoration		: none;
}

a:hover{
	text-decoration		: underline;
}

/* general */
.clear {
	clear: both;
}

/* Header */
.brand{
	color 				: #AEB0B3 !important;	
	font-family 		: georgia;
	font-style 			: italic;
}

/* list stuff */
#org{
	background-color 	: white;
	margin 				: 10px;
	padding 			: 10px;
}

#show-list{
	cursor 				: pointer;
}

/* bootstrap overrides */
.alert-message{
	margin: 2px 0;
}

.topbar{
	position 			: absolute;
}

/* Custom chart styling */
.jOrgChart {
  margin                : 10px;
  padding               : 20px;
}


.jOrgChart .node {
    font-size: 14px;
    background-color: #FFFFFF;
    border-radius: 8px;
    border: 1px solid #BBBBBB;
    color: #AEB0B3;
    -moz-border-radius: 8px;
}

/* Custom node styling 
.jOrgChart .node {
	font-size 			: 14px;
	background-color 	: #35363B;
	border-radius 		: 8px;
	border 				: 5px solid white;
	color 				: #F38630;
	-moz-border-radius 	: 8px;
}*/
	.node p{
		font-family 	: sans-serif;
		font-size 		: 12px;
		line-height 	: 11px;
		padding 		: 2px;
	}

	.cdescrip{
		background: #FFFFFF;
	} 

	.ccolar{
		color: #AEB0B3;
	}

.jOrgChart .node{
	
    font-size: 20px;
    background-color: #CAC9C9;
    border-radius: 8px;
    border: 1px solid #BBBBBB;
    color: #F6F8FB;
    -moz-border-radius: 8px;
    text-align: center;

}

.jOrgChart .node {
	
    background-color: #8A8A8C;
    display: inline-block;
    width: 190px;
    height: 90px;
    text-align: left;
    padding: 20px;
    line-height: 22px;
}

</style>

<div style="margin-left: auto; margin-right:auto" >
	
	<?php echo $this->html; ?>

</div>

