<?php /* Smarty version Smarty-3.1.8, created on 2012-05-07 14:33:04
         compiled from "D:\Projekty\BlackWolfCms\server\Aplication\Module\User\Admin\Template\loginPanel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139834fa7c1009330e8-86713491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2f845ba2519123606c642347be8b62ab15dc7d9' => 
    array (
      0 => 'D:\\Projekty\\BlackWolfCms\\server\\Aplication\\Module\\User\\Admin\\Template\\loginPanel.tpl',
      1 => 1336386402,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139834fa7c1009330e8-86713491',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PATH' => 0,
    'URL' => 0,
    'V' => 0,
    'E' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.8',
  'unifunc' => 'content_4fa7c100993f77_73311109',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4fa7c100993f77_73311109')) {function content_4fa7c100993f77_73311109($_smarty_tpl) {?><div id="login">
	<div class="logo"><img src="<?php echo $_smarty_tpl->tpl_vars['PATH']->value['IMG'];?>
/logo_login.png" /></div>
	<div class="bg">
		<div id="window">
			<div class="top">Zaloguj do panelu</div>
			<div class="bottom">
				<form name="login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['URL']->value['POST'];?>
" class="standard">
					<fieldset>
						<label>E-mail:</label>
						<input class="w290" type="text" name="_email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['V']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
						<?php if ($_smarty_tpl->tpl_vars['E']->value['name']){?><div class="error"><?php echo $_smarty_tpl->tpl_vars['E']->value['name'];?>
</div><?php }?>
					</fieldset>
					<fieldset>
						<label>Hasło:</label>
						<input class="w290" type="password" name="_pass" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['V']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
						<?php if ($_smarty_tpl->tpl_vars['E']->value['msg']){?><div class="error"><?php echo $_smarty_tpl->tpl_vars['E']->value['msg'];?>
</div><?php }?>
					</fieldset>

					<div class="buttons" style="padding-left:277px;">
						<a class="btnSmall orange bold last" style="font-size:12px;" href="javascript:void(0);" onClick="$('form[name=login]').submit();">Zaloguj</a>
					</div>
				</form>
				<div class="help"><img src="<?php echo $_smarty_tpl->tpl_vars['PATH']->value['IMG'];?>
/loginZapytanie.png" class="fRight" />W wypadku zaginięcia hasła prosimy o kontakt bezpośredni z operatorami<br>Black Wolf CMS - <a href="mailto:info@blackwolfcms.pl">info@blackwolfcms.pl</a><br><br><br></div>
			</div>
		</div>
	</div>
</div><?php }} ?>