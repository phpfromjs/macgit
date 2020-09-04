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
/* vim: set expandtab sw=4 ts=4 sts=4: */
/**
 *
 * @package PhpMyAdmin
 */

/**
 *
 */
require_once './libraries/common.inc.php';

$GLOBALS['js_include'][] = 'import.js';

/**
 * Gets tables informations and displays top links
 */
require './libraries/db_common.inc.php';
require './libraries/db_info.inc.php';

$import_type = 'database';
require './libraries/display_import.lib.php';

/**
 * Displays the footer
 */
require './libraries/footer.inc.php';
?>

