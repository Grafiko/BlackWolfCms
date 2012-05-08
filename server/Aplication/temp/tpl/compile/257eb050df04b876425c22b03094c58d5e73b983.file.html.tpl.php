<?php /* Smarty version Smarty-3.1.8, created on 2012-05-07 16:27:41
         compiled from "D:\Projekty\BlackWolfCms\server\Aplication\Template\Admin\Start\html.tpl" */ ?>
<?php /*%%SmartyHeaderCode:216124fa7ca7d2a55f2-75243795%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '257eb050df04b876425c22b03094c58d5e73b983' => 
    array (
      0 => 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Template\\Admin\\Start\\html.tpl',
      1 => 1336400857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '216124fa7ca7d2a55f2-75243795',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa7ca7d2fec63_95722579',
  'variables' => 
  array (
    'CONTENT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa7ca7d2fec63_95722579')) {function content_4fa7ca7d2fec63_95722579($_smarty_tpl) {?><?php if (!is_callable('smarty_function_bw_css')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_css.php';
if (!is_callable('smarty_function_bw_js')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_js.php';
?><?php echo smarty_function_bw_css(array('type'=>"admin",'file'=>"style.css"),$_smarty_tpl);?>

<?php echo smarty_function_bw_css(array('type'=>"admin",'file'=>"reset.css"),$_smarty_tpl);?>


<?php echo smarty_function_bw_js(array('dir'=>"library/jquery/",'file'=>"common.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_js(array('dir'=>"library/jquery/",'file'=>"jquery-ui-1.8.20.custom.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_js(array('dir'=>"library/jquery/",'file'=>"1.7.2.min.js"),$_smarty_tpl);?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<html>
<head>

</head>

<body>
	<?php echo $_smarty_tpl->tpl_vars['CONTENT']->value;?>


	<script type="text/javascript">
		$(document).ready(function() {
			$('.centerElements').centerElements();
		});
	</script>
</body>

</html><?php }} ?>