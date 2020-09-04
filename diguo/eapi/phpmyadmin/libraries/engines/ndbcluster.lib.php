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
class PMA_StorageEngine_ndbcluster extends PMA_StorageEngine
{
    /**
     * @return  array
     */
    function getVariables()
    {
        return array(
            'ndb_connectstring' => array(
            ),
         );
    }

    /**
     * @return  string  SQL query LIKE pattern
     */
    function getVariablesLikePattern()
    {
        return 'ndb\\_%';
    }

    /**
     * returns string with filename for the MySQL helppage
     * about this storage engne
     *
     * @return  string  mysql helppage filename
     */
    function getMysqlHelpPage()
    {
        return 'ndbcluster';
    }
}

?>