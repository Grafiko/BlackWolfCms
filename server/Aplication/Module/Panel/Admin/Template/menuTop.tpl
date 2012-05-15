{bw_css file="style.css"}

<div id="panelMenuTop">
	{foreach $oMenuRowset as $oMenuRow}
	<ul>
		<li class="title">{$oMenuRow->name}</li>
		{foreach $oMenuRow->getItems() as $oMenuItem}
			<li class="item">
				<a href="{$oMenuItem->getModuleUrl()}">{$oMenuItem->link_name}</a>
				{if $oMenuItem->getActionUrl()}
				<span>
					<a href="#"  onClick="$('<div />')._window({ id: 'sliderPhotoAdd', title:'{$oMenuItem->action_title}</div>}', content: '{$oMenuItem->getActionUrl()}' });">{$oMenuItem->action_name}</a>
				</span>
			</li>
			{/if}
		{/foreach}
	</ul>
	{/foreach}
</div>

<script type="text/javascript">
$(document).ready(function() {
	var $panelMenuTop = $('#panelMenuTop');
	var $panelMenuTopAllUlWidth = 0;
	var panelMenuTopWidth = $('#panelMenuTop').width();
	$('ul', $panelMenuTop).each(function() {
		$panelMenuTopAllUlWidth+= $(this).outerWidth(true);
	});
	console.log($panelMenuTopAllUlWidth);
});
</script>

<!--
<ul class="menuTop fRight">
	<li class="title">zarządzaj:</li>
	<li><a href="/admin/run,newsletter-messageList.html">newsletter</a></li>
	<li><a href="/admin/run,user-userList.html">użytkownicy</a></li>
	<li><a href="/admin/run,setting-setting.html">system</a></li>
	<li><a href="/admin/run,user-userLogout.html">wyloguj</a></li>
</ul>

<ul class="menuTop columns2 fRight" style="width:160px;">
	<li class="title">multimedia:</li> 
	<li class="aLeft"><a href="/admin/run,slider-sliderList.html">slider</a></li>
	<li class="aRight"><a href="#"  onClick="$('<div />')._window({ id: 'sliderPhotoAdd', title:'Formularz dodania nowego zdjęcia do slidera', content: '/admin/run,slider-photoAdd.html' });">dodaj</a></li>
	<li class="aLeft"><a href="/admin/run,galleryImage-photoList.html">galeria zdjęć</a></li>
	<li class="aRight"><a href="#"  onClick="$('<div />')._window({ id: 'addPhoto', title:'Formularz dodania nowego zdjęcia', content: '/admin/run,galleryImage-photoAdd.html' });">dodaj</a></li>
	<li class="aLeft"><a href="/admin/run,files-itemList.html">menadżer plików</a></li>
	<li class="aRight"><a href="#"  onClick="$('<div />')._window({ id: 'addItem', title:'Formularz dodania nowego pliku', content: '/admin/run,files-itemAdd.html' });">dodaj</a></li>
</ul>

<ul class="menuTop columns2 fRight" style="width:160px;">
	<li class="title">kreator stron:</li>
	<li class="aLeft"><a href="/admin/run,page-pageList.html">strony</a></li>
	<li class="aRight"><a href="#" onClick="$('<div />')._window({ id: 'articleAdd', title:'Formularz dodawania nowej strony', content: '/admin/run,page-pageAdd.html' });">dodaj</a></li>
	<li class="aLeft"><a href="/admin/run,content-articleList.html">artykuły</a></li>
	<li class="aRight"><a href="#"  onClick="$('<div />')._window({ id: 'articleAdd', title:'Formularz dodania nowego artykułu', content: '/admin/run,content-articleAdd.html' });">dodaj</a></li>
	<li class="aLeft"><a href="/admin/run,tpl-tplList.html">szablony</a></li>
	<li class="aRight"><a href="javascript:void(0);" onClick="$('<div />')._window({ id: 'addTpl', title:'Formularz dodawania nowego szablonu', content: '/admin/run,tpl-tplAdd.html' });">dodaj</a></li>
</ul>
-->