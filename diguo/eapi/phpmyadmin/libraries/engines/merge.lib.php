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
 * @package PhpMyAdmin-Engines
 */

if (! defined('PHPMYADMIN')) {
    exit;
}

/**
 *
 * @package PhpMyAdmin-Engines
 */
class PMA_StorageEngine_merge extends PMA_StorageEngine
{
}

?>