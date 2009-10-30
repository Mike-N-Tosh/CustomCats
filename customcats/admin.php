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
require_once(FILESYSTEM_PATH .'includes/classes/kernel/Categories.php');
$Categories = new Categories;

if(isset($_GET['action']) && $_GET['action']=="modify" && isset($_GET['id']))
	{
		$sSQL = 'SELECT id,ccTemplate,name FROM '.PREFIX.'categories WHERE id='.(int)$_GET['id'];
		$result=$db->query($sSQL);
		$rs=$result->fetch();
        $class_tpl->bulkAssign($rs);
        $result->freeResult();
        $location = FILESYSTEM_PATH .'modules/customcats/templates/cattemplates/';
			if ($handle = opendir($location)) 
			{
				while (false !== ($file = readdir($handle))) 
				{
					if ($file != "." && $file != ".." && $file!=".svn" && $file!="index.htm") 
					{
						$filelist[]=$file;
					}
				}
			   closedir($handle);
			}
		$class_tpl->assign('files', $filelist);
		$class_tpl->assign('body','customcats_edit.tpl');
	}
	elseif (isset($_POST['action']) && $_POST['action']=="save")
	{
		$sSQL = 'UPDATE '.PREFIX.'categories SET ccTemplate="'.$_POST['ccTemplate'].'" WHERE id='.(int)$_POST['id'];
		$result=$db->query($sSQL);
		//sucessfull
		$location="modules.php?mod=customcats";
		$class_tpl->assign('title',LANG_FORWARD_SUCESS);
		$class_tpl->assign('forward',TRUE);
		$class_tpl->assign('location',$location);
		$class_tpl->assign('body','forward.tpl');
	}
	else 
	{
		$tree=$Categories->getAdminCatTree("", 0, TRUE);
		$class_tpl->assign("results", $tree);
		$class_tpl->assign('body','customcats_browse.tpl');
	}
$class_tpl->displayTemplate();

/* End of file admin.php */
/* Location: ./upload/modules/customcats/admin.php */ 