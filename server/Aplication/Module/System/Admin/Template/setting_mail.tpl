<hr class="mt12" />
<form name="settingMail" method="post" action="{$URL.POST}" class="standard">
	<div class="section_box">
		<h2>{bw_i18n txt="the_settings_of_the_access_to_the_smtp_server"}:</h2>
		<fieldset>
			<label>{bw_i18n txt="smtp_server_address"}:</label>
			<input class="w225" type="text" name="smtp_server" value="{$V.smtp_server|escape}" />
			{if isset($E.smtp_server)}<div class="error">{$E.smtp_server}</div>{/if}
		</fieldset>
		<fieldset>
			<label>{bw_i18n txt="email_address"}:</label>
			<input class="w225" type="text" name="smtp_email" value="{$V.smtp_email|escape}" />
			{if isset($E.smtp_email)}<div class="error">{$E.smtp_email}</div>{/if}
		</fieldset>
		<fieldset class="mb16">
			<label>{bw_i18n txt="password"}:</label>
			<input class="w225" type="password" name="smtp_pass" value="{$V.smtp_pass|escape}" />
			{if isset($E.smtp_pass)}<div class="error">{$E.smtp_pass}</div>{/if}
		</fieldset>

		<div class="buttons" style="padding-left:160px;">
			<a class="btnSmall orange last" href="{$URL.TEST}">{bw_i18n txt="test_connection"}</a>
		</div>
	</div>

	<div class="section_box">
		<h2>{bw_i18n txt="other_settings_for_the_shipment"}:</h2>
		<fieldset>
			<label>{bw_i18n txt="the_default_email_address_from"}:</label>
			<input class="w225" type="text" name="email_from" value="{$V.email_from|escape}" />
			{if isset($E.email_from)}<div class="error">{$E.email_from}</div>{/if}
		</fieldset>
		<fieldset>
			<label>{bw_i18n txt="the_name_of_the_default_address"}:</label>
			<input class="w225" type="text" name="email_name" value="{$V.email_name|escape}" />
			{if isset($E.email_name)}<div class="error">{$E.email_name}</div>{/if}
		</fieldset>
		<fieldset>
			<label>{bw_i18n txt="messages_send_per_minute"}:</label>
			<input class="w25" type="text" name="smtp_send_perminute" value="{$V.smtp_send_perminute|escape}" maxlength="3"  />
			{if isset($E.smtp_send_perminute)}<div class="error">{$E.smtp_send_perminute}</div>{/if}
		</fieldset>
	</div>

	<div class="buttons" style="padding-left:160px;">
		<a class="btnSmall orange last" href="javascript:void(0);" onClick="$('form[name=settingMail]').submit();">{bw_i18n txt="save_changes"}</a>
	</div>
</form>