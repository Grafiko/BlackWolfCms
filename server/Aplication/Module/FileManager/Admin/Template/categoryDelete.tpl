<div class="confirmWindow">
	<div class="txt">{bw_i18n txt="are_you_sure_you_want_to_delete_the_following_category_of_files"}</div>
	<div class="title">{$oCategory->name}</div>
	<div class="warning">{bw_i18n txt="warning_if_this_category_contains_files_or_sub-categories_will_also_be_removed"}</div>

	<div class="buttons centerElements">
		<a class="btnSmall orange" href="{$URL.DELETE}">{bw_i18n txt="yes_delete"}</a>
		<a class="btnSmall black last" href="javascript:void(0);" onClick="wClose();">{bw_i18n txt="no_cancel"}</a>
	</div>
</div>