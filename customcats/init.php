<?php 
/**
* @copyright Eric L Barnes
*
* @author EricBarnes
* @version $Revision: 80 $
* @package Modules
*
* @Updated: $Date: 2009-06-24 22:11:43 -0400 (Wed, 24 Jun 2009) $
*/
function install()
{
	global $db, $class_tpl;
	$check=TRUE;
	$result = mysql_query("SELECT ccnoprice FROM ".PREFIX."categories") or $check=FALSE;
	if($check==FALSE)
	{
		$sSQL="ALTER TABLE `".PREFIX."categories` ADD `ccTemplate` VARCHAR( 255 ) NOT NULL ;";
		$db->query($sSQL);
		$sSQL="ALTER TABLE ".PREFIX."categories ADD `ccnoprice` CHAR( 1 ) NOT NULL ;";
		$db->query($sSQL);
	}
	$class_tpl->assign('msg', 'Everything installed successfully.');
}

function upgrade()
{
	global $db, $class_tpl;
	$check=TRUE;
	$result = mysql_query("SELECT ccnoprice FROM ".PREFIX."categories") or $check=FALSE;
	if($check==FALSE)
	{
		$sSQL="ALTER TABLE ".PREFIX."categories ADD `ccnoprice` CHAR( 1 ) NOT NULL ;";
		$db->query($sSQL);
	}
	$class_tpl->assign('msg', 'Everything installed successfully.');
}

function uninstall()
{
	global $db, $class_tpl;
	$sSQL="ALTER TABLE `".PREFIX."categories` DROP `ccnoprice`, DROP `ccTemplate`;";
	$db->query($sSQL);
	
	$class_tpl->assign('msg', 'Everything uninstalled successfully.');
}

/* End of file init.php */
/* Location: ./upload/modules/customcats/init.php */ 
