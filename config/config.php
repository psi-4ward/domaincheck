<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2011
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    Domaincheck
 * @license	   LGPL
 * @filesource
 */

// Frontend module
$GLOBALS['FE_MOD']['miscellaneous']['domaincheck'] = 'ModuleDomaincheck';


// TLDs
$GLOBALS['TL_CONFIG']['domaincheckTLDs'] = array
(
	'de',
	'com',
	'org',
	'biz',
	'eu',
	'info',
	'net',
	'at'
);
?>