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
 * @subpackage Original
 */

/**
 *
 */
$theme_name = 'Original';
$theme_full_version = '2.9';
?>
