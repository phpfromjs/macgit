<?php
if(!defined('InEmpireBak'))
{
	@include_once('../../../ebma.php');
	if(!defined('EbakFourCheck'))
	{
		exit();
	}
	if(EbakFourCheck==''||EbakFourCheck=='EbakFourCheck')
	{
		exit();
	}
	if(EbakFourCheck<>'dg'.$_COOKIE['qebak_efourcheck'])
	{
		exit();
	}
}
if(!defined('InEmpireApi'))
{
	exit();
}
?><?php
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 * Theme information
 *
 * @package PhpMyAdmin-theme
 * @subpackage pmahomme
 */

/**
 * If you have problems or questions about this theme email mikehomme@users.sourceforge.net
 */
$theme_name = 'pmahomme';
$theme_full_version = '1.1';
?>