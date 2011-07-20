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

$GLOBALS['TL_LANG']['domaincheck']['tldError'] 		= '<p class="error">Bitte wählen Sie mindestens eine Top-Level-Domain.</p>';
$GLOBALS['TL_LANG']['domaincheck']['domainError'] 	= '<p class="error">Bitte geben Sie eine gültige Domain an.</p>';
$GLOBALS['TL_LANG']['domaincheck']['domain'] 		= 'Domain';
$GLOBALS['TL_LANG']['domaincheck']['tld'] 			= 'Top-Level-Domain';
$GLOBALS['TL_LANG']['domaincheck']['submit'] 		= 'Domains prüfen';
$GLOBALS['TL_LANG']['domaincheck']['ajaxRunning']	= 'Domains werden abgefragt...';

$GLOBALS['TL_LANG']['domaincheck']['free']			= 'frei';
$GLOBALS['TL_LANG']['domaincheck']['registred']		= 'belegt';
$GLOBALS['TL_LANG']['domaincheck']['probablyFree']	= 'wahrscheinlich frei';
$GLOBALS['TL_LANG']['domaincheck']['probablyFreeTip'] = 'Es konnte keine direkte Abfrage an den Registrar durchgeführt werden.';

?>