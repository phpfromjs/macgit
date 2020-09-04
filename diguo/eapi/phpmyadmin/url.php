<?php
if(!defined('InEmpireBak'))
{
	@include_once('../ebma.php');
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
/**
 * URL redirector to avoid leaking Referer with some sensitive information.
 */

/**
 * Gets core libraries and defines some variables
 */
require_once './libraries/common.inc.php';

if (! PMA_isValid($_GET['url']) || ! preg_match('/^https?:\/\/[^\n\r]*$/', $_GET['url'])) {
    header('Location: ' . $cfg['PmaAbsoluteUri']);
} else {
    header('Location: ' . $_GET['url']);
}
die();
?>
