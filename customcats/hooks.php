<?php
/**
* @copyright Eric L Barnes
*
* @author EricBarnes
* @version $Revision: 82 $
* @package Modules
*
* @Updated: $Date: 2009-07-14 21:03:16 -0400 (Tue, 14 Jul 2009) $
*/
class customcats_events
{
	/**
	 * Setup the custom cats.
	 *
	 * @access	public
	 */
	function customcats_events(&$modules)
	{
		$modules->register('category', $this, 'customcats_category');
		$modules->register('admin_tpl_layout_category', $this, 'admin_links');

		//no price
		$modules->register('admin_tpl_category_form', $this, 'category_form');
		$modules->register('category_add', $this, 'category_edit');
		$modules->register('category_edit', $this, 'category_edit');
		$modules->register('modify_listing', $this, 'listing_no_price');
		$modules->register('checkout_end', $this, 'listing_no_price');
		$modules->register('viewlisting_end', $this, 'viewlisting_end');
		$modules->register('search_end', $this, 'search_end');
		$modules->register('category_end', $this, 'search_end');
	}

	// --------------------------------------------------------------------

	/**
	 * Show the admin link
	 *
	 * @access	public
	 */
	function admin_links()
	{
		echo '<a href="modules.php?mod=customcats">Custom Cats</a>';
	}

	// --------------------------------------------------------------------

	/**
	 * Unregister price for adding/editing listing
	 *
	 * @access	public
	 */
	function listing_no_price($id=FALSE)
	{
		global $db, $category, $class_tpl, $step;
		$ccnoprice = 'N';
		if (!$category) {
			$category = $class_tpl->get_template_vars('category');
		}
		if($id) {
			$sSQL = 'SELECT section FROM '.PREFIX.'listings WHERE id='.(int)$id;
			$result=$db->query($sSQL);
			$rs=$result->fetch();
			$id=$rs['section'];
			unset($sSQL);
			$sSQL = 'SELECT ccnoprice  FROM '.PREFIX.'categories WHERE id='.(int)$id;
			$result=$db->query($sSQL);
			$rs=$result->fetch();
			$ccnoprice = $rs['ccnoprice'];
		} elseif($step==3 && $category) {
			$sSQL = 'SELECT ccnoprice FROM '.PREFIX.'categories WHERE id='.(int)$category;
			$result=$db->query($sSQL);
			$rs=$result->fetch();
			$ccnoprice = $rs['ccnoprice'];
		}

		if($ccnoprice=='Y') {
			$class_tpl->assign('checkoutDisPrice', 'N');
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Show the custom category template
	 *
	 * @access	public
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
			return FILESYSTEM_PATH .'modules/customcats/templates/cattemplates/'.$rs['ccTemplate'];
		}
		else
		{
			return false;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Edit a category from admin
	 *
	 * @access	public
	 */
	function category_edit($id)
	{
		global $db;
		$ccnoprice = $_POST['ccnoprice'];
		$sSQL = "UPDATE ".PREFIX."categories SET ccnoprice='".$ccnoprice."', ccTemplate='".mysql_real_escape_string($_POST['ccTemplate'])."' WHERE id=".$id;
		$db->query($sSQL);
	}

	// --------------------------------------------------------------------

	/**
	 * Administration Category Form
	 *
	 * @access	public
	 */
	function category_form($id=false)
	{
		global $db;
		$checked='';
		if(isset($_GET['id']) && $_GET['id'] != '')
		{
			$id = (int)$_GET['id'];
			$sSQL = 'SELECT ccTemplate, ccnoprice FROM '.PREFIX.'categories WHERE id='.(int)$id;
			$result=$db->query($sSQL);
			$rs=$result->fetch();
			if($rs['ccnoprice']=='Y') {
				$checked='checked';
			}
			$cctemplate=$rs['ccTemplate'];
		}
		$output='<p>';
		$output.='<label for="ccnoprice">Hide Price</label>';
		$output.='<input name="ccnoprice" id="ccnoprice" type="checkbox" value="Y" '.$checked.' />';
		$output.='</p>';
		
		$files = $this->_get_templates();
		$selected='';
		$output.='<p class="row1">';
		$output.='<label for="ccTemplate">Custom Template:</label>';
		$output.='<select name="ccTemplate" id="ccTemplate">';
		if($cctemplate=='') $selected='selected';
		$output.='<option value="" '.$selected.'>Default</option>';
		$selected='';
		foreach($files AS $row)
		{
			if($cctemplate==$row) $selected=' selected';
			$output.='<option value="'. $row .'"'. $selected .'>'.$row.'</option>';
		}
		$output.='</select>';
		$output.='</p>';
		return $output;
	}

	// --------------------------------------------------------------------

	/**
	 * Get an array of available custom templates.
	 *
	 * @access	public
	 */
	function _get_templates()
	{
		$location = FILESYSTEM_PATH .'modules/customcats/templates/cattemplates/';
		$filelist=array();
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
		return $filelist;
	}
	
	// --------------------------------------------------------------------

	/**
	 * Show template if searching for single cat
	 *
	 * @access	public
	 */
	function search_end()
	{
		global $db, $class_tpl, $Categories;
		
		if(isset($_GET['type']))
		{
			$id = (int)$_GET['type'];
			$sSQL = 'SELECT ccTemplate,ccnoprice FROM '.PREFIX.'categories WHERE id='.(int)$id;
			$result=$db->query($sSQL);
			$rs=$result->fetch();
			if($rs['ccnoprice'] == 'Y')
			{
				$class_tpl->assign('sDisPrice','N');
			}
			if($rs['ccTemplate'] <> '')
			{
				$class_tpl->assign('body', FILESYSTEM_PATH.'modules/customcats/templates/cattemplates/'.$rs['ccTemplate']);
			}
			else
			{
				return false;
			}
		}
	}
	
	// --------------------------------------------------------------------

	/**
	 * Hide the price on viewlisting page.
	 *
	 * @access	public
	 */
	function viewlisting_end($listing_rs)
	{
		//get the listing category
		$class_tpl = Library::loadLibrary('Template');
		$db = Library::loadDb();
		$category = $class_tpl->get_template_vars('section');
		$sql = 'SELECT ccnoprice FROM ' . PREFIX . 'categories WHERE id=' . (int)$category;
		$result = $db->query($sql);
		$row = $result->fetch();
		if ($row['ccnoprice'] == 'Y') 
		{
			$class_tpl->assign('viewprice', 'N');
		}
	}
}

/* End of file hooks.php */
/* Location: ./upload/modules/customcats/hooks.php */