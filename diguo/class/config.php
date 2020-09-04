<?php
if(!defined('InEmpireBak'))
{
	exit();
}
define('EmpireBakConfig',TRUE);

//Database
$phome_db_dbtype='mysql';
$phome_db_ver='5.0';
$phome_db_server='localhost';
$phome_db_port='';
$phome_db_username='chinayfhcom';
$phome_db_password='wl123456';
$phome_db_dbname='chinayfhcom';
$baktbpre='';
$phome_db_char='';

//USER
$set_username='admin';
$set_password='0c909a141f1f2c0a1cb602b0b2d7d050';
$set_loginauth='admin123';
$set_loginrnd='eJC5wQu9j4QexsbzL8TRKBbDxMs7JS';
$set_outtime='60';
$set_loginkey='1';
$ebak_set_keytime=60;
$ebak_set_ckuseragent='';

//COOKIE
$phome_cookiedomain='';
$phome_cookiepath='/';
$phome_cookievarpre='xcsneb_';

//LANGUAGE
$langr=ReturnUseEbakLang();
$ebaklang=$langr['lang'];
$ebaklangchar=$langr['langchar'];

//BAK
$bakpath='bdata';
$bakzippath='zip';
$filechmod='1';
$phpsafemod='';
$php_outtime='1000';
$limittype='';
$canlistdb='';
$ebak_set_moredbserver='';
$ebak_set_hidedbs='';
$ebak_set_escapetype='1';

//EBMA
$ebak_ebma_open=1;
$ebak_ebma_path='phpmyadmin';
$ebak_ebma_cklogin=0;

//SYS
$ebak_set_ckrndvar='axmtgndxefhe';
$ebak_set_ckrndval='ba645d48d6ffabebf1966afa334111d1';
$ebak_set_ckrndvaltwo='e05158e3a818624f8e501a7212c86290';
$ebak_set_ckrndvalthree='c3cc782153d874489f69f05c82af23f0';
$ebak_set_ckrndvalfour='851d5e987a76b6637e2542342967253b';

//------------ SYSTEM ------------
HeaderIeChar();
?>