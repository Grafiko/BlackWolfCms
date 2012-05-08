<div id="login">
	<div class="logo"><img src="{$PATH.IMG}/logo_login.png" /></div>
	<div class="bg">
		<div id="window">
			<div class="top">Zaloguj do panelu</div>
			<div class="bottom">
				<form name="login" method="post" action="{$URL.POST}" class="standard">
					<fieldset>
						<label>E-mail:</label>
						<input class="w290" type="text" name="_email" value="{$V->name|escape}" />
						{if $E.name}<div class="error">{$E.name}</div>{/if}
					</fieldset>
					<fieldset>
						<label>Hasło:</label>
						<input class="w290" type="password" name="_pass" value="{$V->name|escape}" />
						{if $E.msg}<div class="error">{$E.msg}</div>{/if}
					</fieldset>

					<div class="buttons" style="padding-left:277px;">
						<a class="btnSmall orange bold last" style="font-size:12px;" href="javascript:void(0);" onClick="$('form[name=login]').submit();">Zaloguj</a>
					</div>
				</form>
				<div class="help"><img src="{$PATH.IMG}/loginZapytanie.png" class="fRight" />W wypadku zaginięcia hasła prosimy o kontakt bezpośredni z operatorami<br>Black Wolf CMS - <a href="mailto:info@blackwolfcms.pl">info@blackwolfcms.pl</a><br><br><br></div>
			</div>
		</div>
	</div>
</div>