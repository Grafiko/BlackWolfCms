{bw_css file="style.css"}

<div id="login">
	<div class="logo"><img src="/asset/admin/user/loginPanel/image/logo.png" /></div>
	<div class="bg">
		<div id="window">
			<div class="top">{bw_i18n txt="login_to_panel"} <div>{$LANGUAGE}</div></div>
			<div class="bottom">
				<form name="login" method="post" action="{$URL.POST}" class="standard">
					<fieldset>
						<label>E-mail:</label>
						<input class="w290" type="text" name="_email" value="" />
					</fieldset>
					<fieldset>
						<label>Hasło:</label>
						<input class="w290" type="password" name="_pass" value="" />
						{if $E.msg}<div class="error">{$E.msg}</div>{/if}
					</fieldset>

					<div class="buttons" style="padding-left:277px;">
						<a class="btnSmall orange bold last" style="font-size:12px;" href="javascript:void(0);" onClick="$('form[name=login]').submit();">{bw_i18n txt="log_in"}</a>
					</div>
				</form>
				<div class="help">
					<img src="/asset/admin/user/loginPanel/image/loginZapytanie.png" class="fRight" />{bw_i18n txt="login_panel_help_text"}<br>Black Wolf CMS - <a href="mailto:info@blackwolfcms.pl">info@blackwolfcms.pl</a><br><br><br>
				</div>
			</div>
		</div>
	</div>
</div>