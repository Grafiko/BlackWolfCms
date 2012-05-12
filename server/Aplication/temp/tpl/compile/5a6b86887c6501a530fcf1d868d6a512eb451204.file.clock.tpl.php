<?php /* Smarty version Smarty-3.1.8, created on 2012-05-12 20:48:11
         compiled from "D:\Projekty\BlackWolfCms\server\Aplication\Module\Panel\Admin\Template\clock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44394faeaf6f6caa55-28203976%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a6b86887c6501a530fcf1d868d6a512eb451204' => 
    array (
      0 => 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Module\\Panel\\Admin\\Template\\clock.tpl',
      1 => 1336848488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44394faeaf6f6caa55-28203976',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4faeaf6f6f98f5_28629534',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faeaf6f6f98f5_28629534')) {function content_4faeaf6f6f98f5_28629534($_smarty_tpl) {?><?php if (!is_callable('smarty_function_bw_js')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_js.php';
if (!is_callable('smarty_function_bw_css')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_css.php';
?><?php echo smarty_function_bw_js(array('file'=>"clock.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_css(array('file'=>"style.css"),$_smarty_tpl);?>


<div id="clockbase">
	<div id="hours"></div>
	<div id="minutes"></div>
	<div id="seconds"></div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		cssClock('hours', 'minutes', 'seconds');
	});
</script><?php }} ?>