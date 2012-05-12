<?php /* Smarty version Smarty-3.1.8, created on 2012-05-12 20:56:01
         compiled from "D:\Projekty\BlackWolfCms\server\Aplication\Template\Admin\start.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23494faeaf6f725351-22482116%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48bf7556dd76890257bdb37bfe5383f393280e27' => 
    array (
      0 => 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Template\\Admin\\start.tpl',
      1 => 1336848915,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23494faeaf6f725351-22482116',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4faeaf6f76a3b1_56332873',
  'variables' => 
  array (
    'TOP_LEFT' => 0,
    'CLOCK' => 0,
    'TOP_MENU' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4faeaf6f76a3b1_56332873')) {function content_4faeaf6f76a3b1_56332873($_smarty_tpl) {?><?php if (!is_callable('smarty_function_bw_css')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_css.php';
if (!is_callable('smarty_function_bw_js')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_js.php';
if (!is_callable('smarty_function_bw_metadata')) include 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Library\\Smarty\\plugins\\function.bw_metadata.php';
?><?php echo smarty_function_bw_css(array('dir'=>"/library/fancybox-1.3.4/default/",'file'=>"style.css"),$_smarty_tpl);?>

<?php echo smarty_function_bw_css(array('file'=>"style.css"),$_smarty_tpl);?>

<?php echo smarty_function_bw_css(array('file'=>"reset.css"),$_smarty_tpl);?>


<?php echo smarty_function_bw_js(array('dir'=>"/library/tmpl/",'file'=>"jquery.tmpl.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_js(array('dir'=>"/library/fancybox-1.3.4/",'file'=>"jquery.fancybox-1.3.4.pack.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_js(array('dir'=>"/library/jquery/",'file'=>"jquery-ui-1.8.20.custom.min.js"),$_smarty_tpl);?>

<?php echo smarty_function_bw_js(array('dir'=>"/library/jquery/",'file'=>"jquery-1.7.2.min.js"),$_smarty_tpl);?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Tarnsitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php echo smarty_function_bw_metadata(array('action'=>"display"),$_smarty_tpl);?>

</head>

<body>
	<div id="container">
		<div id="top">
			<div class="left">
				<div class="logo"><img src="/asset/admin/image/logo.png" /></div>
				<?php echo $_smarty_tpl->tpl_vars['TOP_LEFT']->value;?>

			</div>
			<div class="middle"><?php echo $_smarty_tpl->tpl_vars['CLOCK']->value;?>
</div>
			<div class="right"><?php echo $_smarty_tpl->tpl_vars['TOP_MENU']->value;?>
</div>
		</div>
		<div id="middle"></div>
		<div id="bottom"></div>
	</div>
</BODY>

</html><?php }} ?>