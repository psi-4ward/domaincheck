<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 *
 * PHP version 5
 * @copyright  4ward.media 2012
 * @author     Christoph Wiechert <christoph.wiechert@4wardmedia.de>
 * @package    Domaincheck
 * @license	   LGPL
 * @filesource
 */

$GLOBALS['TL_LANG']['domaincheck']['tldError'] 		= '<p class="error">Please choose at least one top-level domain.</p>';
$GLOBALS['TL_LANG']['domaincheck']['domainError'] 	= '<p class="error">Please enter a valid domain.</p>';
$GLOBALS['TL_LANG']['domaincheck']['domain'] 		= 'Domain';
$GLOBALS['TL_LANG']['domaincheck']['tld'] 			= 'top-level domain';
$GLOBALS['TL_LANG']['domaincheck']['submit'] 		= 'check domains';
$GLOBALS['TL_LANG']['domaincheck']['ajaxRunning']	= 'checking domains...';

$GLOBALS['TL_LANG']['domaincheck']['free']			= 'free';
$GLOBALS['TL_LANG']['domaincheck']['registred']		= 'registred';
$GLOBALS['TL_LANG']['domaincheck']['probablyFree']	= 'propbably free';
$GLOBALS['TL_LANG']['domaincheck']['probablyFreeTip'] = 'It was not able to request the state form the registrar.';

?>