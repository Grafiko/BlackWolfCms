<hr class="mt12" />
<div class="section_box">
	<h2>{bw_i18n txt="size_of_each_directory_containing_the_cache_page"}:</h2>
	<div>
		<p>zdjęcia: <span style="color:#c87501">???</span></p>
		<p>szablony: <span style="color:#c87501">{$SIZE.TPL}</span></p>
		<p>baza danych: <span style="color:#c87501">{$SIZE.DB}</span></p>
		<p>pliki publiczne katalogu asset: <span style="color:#c87501">{$SIZE.ASSET}</span></p>
		<p>pliki tymczasowe: <span style="color:#c87501">???</span></p>
		<p class="mb12">razem całkowity rozmiar na dysku: <span style="color:#c87501">{$SIZE.SUM}</span></p>
		<p>Po wyczyszczeniu pamięci podręcznej cache wszystkie dane niezbędne do prawidłowego działania witryny zostaną ponownie cachowane.</p>

		<div class="buttons" style="padding-left:160px;">
			<a class="btnBigMini orange" href="{$URL.CLEAR}">wyczyść</a>
		</div>
	</div>
</div>