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
function customcats_category($id)
{
	global $db, $Categories;
	
		$class_tpl = new Template('customcats');
		$sSQL = 'SELECT ccTemplate FROM '.PREFIX.'categories WHERE id='.(int)$id;
		$result=$db->query($sSQL);
		$rs=$result->fetch();
		if($rs['ccTemplate'] <> '')
		{
			//return 'customcats_browse.tpl.php';
			return FILESYSTEM_PATH .'modules/customcats/templates/cattemplates/'.$rs['ccTemplate'];
		}
		else
		{
			return false;
		}
}

/* End of file mod_user.php */
/* Location: ./upload/modules/customcats/mod_user.php */ 