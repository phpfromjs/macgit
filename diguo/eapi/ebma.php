<?php
define('InEBMA',TRUE);
$ebak_ebma_open=0;
include_once(substr(dirname(__FILE__),0,-4).'class/connect.php');
if(!defined('InEmpireBak'))
{
	exit();
}
if(empty($ebak_ebma_open))
{
	exit();
}
include_once(EBAK_PATH.'class/functions.php');
$lur=islogin();
$loginin=$lur['username'];
$rnd=$lur['rnd'];
define('InEmpireApi',TRUE);

//EBMA
$ebma_config=array();

$ebma_config['pmaurl']=Ebak_GetPmaUrl();
$ebma_config['pmasecret']='e-b.a'.$ebak_set_ckrndvaltwo.'b-m!a';
$ebma_config['authtype']=$ebak_ebma_cklogin==1?'config':'cookie';
$ebma_config['dbtype']=empty($phome_db_dbtype)?'mysql':$phome_db_dbtype;
$ebma_config['dbver']=$phome_db_ver;
$ebma_config['dbhost']=$phome_db_server;
$ebma_config['dbport']=$phome_db_port;
$ebma_config['dbuser']=$phome_db_username;
$ebma_config['dbpass']=$phome_db_password;
$ebma_config['dbname']=$phome_db_dbname;
$ebma_config['dbchar']=$phome_db_char;
$ebma_config['fourcheck']='dg'.Ebak_ReturnFourCheckRnd();

define('EbmaPmaurl',$ebma_config['pmaurl']);
define('EbmaPmasecret',$ebma_config['pmasecret']);
define('EbmaAuthtype',$ebma_config['authtype']);
define('EbmaDbtype',$ebma_config['dbtype']);
define('EbmaDbhost',$ebma_config['dbhost']);
define('EbmaDbport',$ebma_config['dbport']);
define('EbmaDbuser',$ebma_config['dbuser']);
define('EbmaDbpass',$ebma_config['dbpass']);
define('EbakFourCheck',$ebma_config['fourcheck']);

@header('Content-Type: text/html; charset=utf-8');

?>